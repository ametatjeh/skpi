<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class MahasiswaImport implements ToCollection, SkipsOnFailure
{
    use SkipsFailures;

    protected $importedCount = 0;
    protected $skippedCount = 0;
    protected $errors = [];
    protected $columnIndexes = [];

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            $this->errors[] = "File kosong.";
            return;
        }

        Log::info("Total rows: " . $rows->count());

        // 1. Pre-load Data untuk Memory Lookup (Optimasi Query)
        // Ambil semua NIM yang sudah ada untuk cek duplikat tanpa query per baris
        $existingNims = Mahasiswa::pluck('nim')->flip()->toArray();
        
        // Ambil semua Prodi untuk lookup tanpa query per baris
        $prodisData = Prodi::all();
        if ($prodisData->isEmpty()) {
            $this->errors[] = "Data Program Studi masih kosong di database. Harap input data Prodi terlebih dahulu.";
            return;
        }

        // Menggunakan mapping nama lower case -> ID
        $prodis = $prodisData->mapWithKeys(function ($item) {
            return [strtolower(trim($item->nama_prodi)) => $item->id];
        })->toArray();
        
        // Ambil default prodi ID
        $defaultProdiId = $prodisData->first()->id;

        // Cari header row
        $headerRowIndex = null;
        foreach ($rows as $index => $row) {
            $rowValues = array_map(function($val) {
                return strtolower(trim((string) $val));
            }, $row->toArray());
            $rowStr = implode(' ', $rowValues);
            
            if ((strpos($rowStr, 'nim') !== false || strpos($rowStr, 'npm') !== false) 
                && strpos($rowStr, 'nama') !== false) {
                
                $headerRowIndex = $index;
                $this->mapHeaderColumns($rowValues);
                Log::info("Header found at row {$index}");
                break;
            }
        }

        if ($headerRowIndex === null) {
            $this->errors[] = "Header kolom (NIM, Nama) tidak ditemukan.";
            return;
        }

        // Disable Query Log untuk hemat memori
        DB::connection()->disableQueryLog();

        // 2. Proses Data dalam Batch
        $dataRows = $rows->slice($headerRowIndex + 1);
        
        foreach ($dataRows as $row) {
            $values = array_values($row->toArray());
            
            // Extract data using mapped indexes
            $nim = $this->getValue($values, 'nim');
            $nama = $this->getValue($values, 'nama');
            
            // Validasi dasar di memory
            if (empty($nim) || empty($nama)) continue;
            
            // Clean NIM
            $nim = trim((string) $nim);
            $nama = trim((string) $nama);
            
             // Skip jika numeric tapi bukan NIM valid
            if (!is_numeric(str_replace(['-', ' '], '', $nim)) || strlen($nim) < 5) {
                continue;
            }

            // Check duplicate di memory (Optional optimization, but let DB handle it for safety)
            if (isset($existingNims[$nim])) {
                $this->skippedCount++;
                continue;
            }

            // Lookup Prodi di memory
            $prodiName = strtolower(trim($this->getValue($values, 'prodi') ?? ''));
            $prodiId = $defaultProdiId;
            
            if (!empty($prodiName)) {
                if (isset($prodis[$prodiName])) {
                    $prodiId = $prodis[$prodiName];
                } else {
                    foreach ($prodis as $pName => $pId) {
                        if (strpos($prodiName, $pName) !== false || strpos($pName, $prodiName) !== false) {
                            $prodiId = $pId;
                            break;
                        }
                    }
                }
            }

            // Siapkan Data
            $email = $this->getValue($values, 'email');
            $nik = $this->getValue($values, 'nik');
            $status = $this->getValue($values, 'status');
            $jk = $this->getValue($values, 'jenis_kelamin');
            $tgl_masuk = $this->getValue($values, 'tanggal_masuk');
            $tgl_lulus = $this->getValue($values, 'tanggal_lulus');
            $angkatan = $this->getValue($values, 'angkatan');
            $agama = $this->getValue($values, 'agama');
            $alamat = $this->getValue($values, 'alamat');
            $tempatTanggalLahir = $this->getValue($values, 'tempat_tanggal_lahir');
            $gelar = $this->getValue($values, 'gelar');
            $noIjazah = $this->getValue($values, 'no_ijazah');

            // Generate email (hanya untuk data mahasiswa, tidak create user)
            $email = !empty($email) ? $email : $nim . '@unida-aceh.ac.id';
            
            // Parsing Data Helper
            $jkClean = strtoupper(trim((string) ($jk ?? 'L')));
            $jenisKelamin = (in_array($jkClean, ['P', 'PEREMPUAN', 'W', 'WANITA', 'F'])) ? 'P' : 'L';

            // NIK Cleaning
            $nikClean = '';
            if (!empty($nik)) {
                if (is_numeric($nik)) $nikClean = number_format((float) $nik, 0, '', '');
                else $nikClean = preg_replace('/[^0-9]/', '', (string) $nik);
            }

            // Angkatan Logic
            if (empty($angkatan)) {
               $angkatan = date('Y');
               if (preg_match('/^(\d{2})(\d{2})/', $nim, $matches)) {
                   $year = (int) $matches[2];
                   $angkatan = ($year > 50) ? '19' . $matches[2] : '20' . $matches[2];
               }
            }

            // Tanggal Masuk Parsing
            $tanggalMasuk = null;
            if (!empty($tgl_masuk)) {
                try {
                    if (is_numeric($tgl_masuk)) {
                        $tanggalMasuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tgl_masuk)->format('Y-m-d');
                    } else {
                         $ts = strtotime($tgl_masuk);
                         if ($ts) $tanggalMasuk = date('Y-m-d', $ts);
                    }
                } catch (\Exception $e) {}
            }

            // Tanggal Lulus Parsing
            $tanggalLulus = null;
            if (!empty($tgl_lulus)) {
                try {
                    if (is_numeric($tgl_lulus)) {
                        $tanggalLulus = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tgl_lulus)->format('Y-m-d');
                    } else {
                         $ts = strtotime($tgl_lulus);
                         if ($ts) $tanggalLulus = date('Y-m-d', $ts);
                    }
                } catch (\Exception $e) {}
            }

            try {
                Mahasiswa::create([
                    'user_id' => null,
                    'prodi_id' => $prodiId,
                    'nim' => $nim,
                    'nama' => $nama,
                    'email' => $email,
                    'nik' => substr($nikClean, 0, 16),
                    'jenis_kelamin' => $jenisKelamin,
                    'agama' => !empty($agama) ? $agama : 'Islam', // Default
                    'alamat' => $alamat ?? '',
                    'tahun_masuk' => $angkatan,
                    'angkatan' => $angkatan,
                    'tanggal_masuk' => $tanggalMasuk,
                    'status_mahasiswa' => $this->parseStatus($status),
                    'tanggal_lulus' => $tanggalLulus,
                    'gelar' => $gelar ?? '',
                    'no_ijazah' => $noIjazah ?? '',
                    'tempat_tanggal_lahir' => $tempatTanggalLahir ?? '',
                ]);
                $this->importedCount++;
            } catch (\Illuminate\Database\QueryException $e) {
                // Cek error duplicate entry (1062)
                if ($e->errorInfo[1] == 1062) {
                    $this->skippedCount++;
                    // Optional: catat error duplikat jika perlu
                    // $this->errors[] = "NIM {$nim} sudah ada, dilewati.";
                } else {
                    $this->errors[] = "Error NIM {$nim}: " . $e->getMessage();
                    Log::error("Import Error NIM {$nim}: " . $e->getMessage());
                }
            } catch (\Exception $e) {
                $this->errors[] = "Error NIM {$nim}: " . $e->getMessage();
            }
        }
        
        Log::info("Import completed. Total: {$this->importedCount}, Skipped: {$this->skippedCount}");
    }



    protected function mapHeaderColumns($rowValues) {
        foreach ($rowValues as $colIndex => $val) {
            if (strpos($val, 'nim') !== false || strpos($val, 'npm') !== false || strpos($val, 'nrp') !== false || strpos($val, 'no_mhs') !== false) $this->columnIndexes['nim'] = $colIndex;
            if (strpos($val, 'nik') !== false || strpos($val, 'no_ktp') !== false || strpos($val, 'ktp') !== false) $this->columnIndexes['nik'] = $colIndex;
            if (strpos($val, 'nama') !== false) $this->columnIndexes['nama'] = $colIndex;
            if (strpos($val, 'email') !== false || strpos($val, 'e-mail') !== false) $this->columnIndexes['email'] = $colIndex;
            if (strpos($val, 'prodi') !== false || strpos($val, 'program') !== false) $this->columnIndexes['prodi'] = $colIndex;
            if (strpos($val, 'tanggal') !== false && strpos($val, 'masuk') !== false) $this->columnIndexes['tanggal_masuk'] = $colIndex;
            if (strpos($val, 'tanggal') !== false && strpos($val, 'lulus') !== false) $this->columnIndexes['tanggal_lulus'] = $colIndex;
            if ($val === 'status' || strpos($val, 'status m') !== false || strpos($val, 'status_m') !== false) $this->columnIndexes['status'] = $colIndex;
            if (strpos($val, 'kelamin') !== false || $val === 'jk' || strpos($val, 'gender') !== false) $this->columnIndexes['jenis_kelamin'] = $colIndex;
            if ($val === 'angkatan' || strpos($val, 'thn_masuk') !== false) $this->columnIndexes['angkatan'] = $colIndex;
            if (strpos($val, 'agama') !== false) $this->columnIndexes['agama'] = $colIndex;
            if (strpos($val, 'alamat') !== false) $this->columnIndexes['alamat'] = $colIndex;
            if (strpos($val, 'tempat') !== false && strpos($val, 'lahir') !== false) $this->columnIndexes['tempat_tanggal_lahir'] = $colIndex;
            if (strpos($val, 'gelar') !== false) $this->columnIndexes['gelar'] = $colIndex;
            if (strpos($val, 'ijazah') !== false) $this->columnIndexes['no_ijazah'] = $colIndex;
        }
    }

    protected function getValue($values, $key) {
        return isset($this->columnIndexes[$key]) ? ($values[$this->columnIndexes[$key]] ?? null) : null;
    }

    protected function parseStatus($status)
    {
        if (empty($status)) return 'Aktif';
        
        $status = strtolower(trim((string) $status));
        
        if (strpos($status, 'lulus') !== false) return 'Lulus';
        if (strpos($status, 'aktif') !== false) return 'Aktif';
        if (strpos($status, 'cuti') !== false) return 'Cuti';
        if (strpos($status, 'do') !== false || strpos($status, 'drop') !== false) return 'DO';
        if (strpos($status, 'pindah') !== false) return 'Mengundurkan Diri';
        if (strpos($status, 'keluar') !== false || strpos($status, 'mengundurkan') !== false) return 'Mengundurkan Diri';
        
        return 'Aktif';
    }

    public function getImportedCount() { return $this->importedCount; }
    public function getSkippedCount() { return $this->skippedCount; }
    public function getErrors() { return $this->errors; }
}
