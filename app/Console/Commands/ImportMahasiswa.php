<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use League\Csv\Reader;
use Carbon\Carbon;

class ImportMahasiswa extends Command
{
    protected $signature = 'import:mahasiswa {path}';
    protected $description = 'Import data mahasiswa dari file CSV';

    public function handle()
    {
        $path = $this->argument('path');
        $csv = Reader::createFromPath(storage_path('app/' . $path), 'r');
        $csv->setDelimiter(';'); // Pastikan delimiter sesuai CSV kamu
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $sukses = 0;
        $gagal = [];
        foreach ($records as $idx => $r) {
            try {
                // Debug log isi satu baris
                // $this->info("BARIS $idx: " . json_encode($r));

                // Validasi minimal field utama
                if (!isset($r['Program Studi']) || trim($r['Program Studi']) === '') {
                    $gagal[] = "BARIS $idx: Kolom 'Program Studi' kosong/tidak ditemukan";
                    continue;
                }
                if (!isset($r['NIM']) || trim($r['NIM']) === '') {
                    $gagal[] = "BARIS $idx: Kolom 'NIM' kosong/tidak ditemukan";
                    continue;
                }

                // Ambil prodi id
                $prodi = Prodi::where('nama_prodi', trim($r['Program Studi']))->first();
                if (!$prodi) {
                    $gagal[] = "BARIS $idx: Prodi tidak ditemukan: " . ($r['Program Studi'] ?? '(empty)');
                    continue;
                }

                // ambil data
                // Setelah $csv->setHeaderOffset(0);
                $headers = $csv->getHeader();
                $this->info("Header CSV: " . json_encode($headers));

                $agama = isset($r['Agama']) ? trim($r['Agama']) : '';
                $alamat = isset($r['Alamat']) ? trim($r['Alamat']) : '';
                $nama = isset($r['Nama']) ? trim($r['Nama']) : '';
                $nik = isset($r['NIK']) ? trim($r['NIK']) : '';
                $jenis_kelamin = $this->mapJenisKelamin($r['Jenis Kelamin'] ?? '');
                $status_mahasiswa = $this->mapStatusMahasiswa($r['Status Mahasiswa'] ?? '');
                $tempat_tanggal_lahir = isset($r['Tempat,Tanggal Lahir']) ? trim($r['Tempat,Tanggal Lahir']) : '';
                $gelar = isset($r['Gelar']) ? trim($r['Gelar']) : '';
                $no_ijazah = isset($r['No Ijazah']) ? trim($r['No Ijazah']) : '';

                // Tanggal dan tahun masuk: handle 2 digit tahun
                $tanggalMasukRaw = isset($r['Tanggal Masuk']) ? trim($r['Tanggal Masuk']) : '';
                $tanggalMasuk = null;
                $tahunMasuk = '';
                $angkatan = '';

                if ($tanggalMasukRaw) {
                    // Ubah 14-Sep-20 jadi 14-Sep-2020
                    if (preg_match('/^\d{1,2}-[A-Za-z]{3}-\d{2}$/', $tanggalMasukRaw)) {
                        $tanggalMasukRaw = preg_replace('/-(\d{2})$/', '-20$1', $tanggalMasukRaw);
                    }
                    try {
                        $parsedTanggal = Carbon::createFromFormat('d-M-Y', $tanggalMasukRaw);
                        $tanggalMasuk = $parsedTanggal->format('Y-m-d');
                        $tahunMasuk = $parsedTanggal->format('Y');
                        $angkatan = $parsedTanggal->format('Y');
                    } catch (\Throwable $e) {
                        $tanggalMasuk = null;
                        $tahunMasuk = '';
                        $angkatan = '';
                    }
                }
                Mahasiswa::updateOrCreate(
                    ['nim' => trim($r['NIM'])],
                    [
                        'nik' => $nik,
                        'nama' => $nama,
                        'prodi_id' => $prodi->id,
                        'jenis_kelamin' => $jenis_kelamin,
                        'agama' => $agama,
                        'alamat' => $alamat,
                        'tahun_masuk' => $tahunMasuk,
                        'angkatan' => $angkatan,
                        'tanggal_masuk' => $tanggalMasuk,
                        'status_mahasiswa' => $status_mahasiswa,
                        'tempat_tanggal_lahir' => $tempat_tanggal_lahir,
                        'gelar' => $gelar,
                        'no_ijazah' => $no_ijazah
                        // tambahkan kolom lain sesuai kebutuhan
                    ]
                );
                $sukses++;
            } catch (\Throwable $e) {
                $gagal[] = "BARIS $idx: " . $e->getMessage();
            }
        }

        $this->info("Sukses import: $sukses");
        if ($gagal) {
            $this->warn("Gagal import: " . count($gagal));
            foreach ($gagal as $err) $this->error($err);
        }
    }

    private function mapJenisKelamin($value)
    {
        $value = strtoupper(trim($value)); // ubah ke huruf besar!
        if ($value == 'L') return 'L';
        if ($value == 'P') return 'P';
        return 'L'; // fallback default
    }


    private function mapStatusMahasiswa($value)
    {
        $value = strtolower(trim($value));
        $mapping = [
            'aktif' => 'aktif',
            'akfif' => 'aktif', // typo biasa
            'cuti' => 'cuti',
            'lulus' => 'lulus',
            'do' => 'DO',
            'drop out' => 'DO',
            'mutasi' => 'mutasi',
            'pindah' => 'pindah',
            'keluar' => 'keluar',
            'putus studi' => 'putus studi',
            'mengajukan pengunduran diri' => 'mengajukan pengunduran diri',
            'meninggal dunia' => 'meninggal dunia'
        ];
        $val = strtolower(trim($value));
        return $mapping[$val] ?? 'aktif';
    }
}
