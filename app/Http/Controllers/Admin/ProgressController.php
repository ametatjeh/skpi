<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prestasi;
use App\Models\SertifikasiKompetensi;
use App\Models\Organisasi;
use App\Models\KaryaIlmiah;
use App\Models\DokumenPendukung;
use App\Models\DraftSkpi; // ✅ Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Mahasiswa::with(['prodi', 'user'])
            ->select('mahasiswa.*');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->orderBy('nama')->get();

        $progressData = $mahasiswas->map(function ($mahasiswa) {
            $progress = $this->calculateProgress($mahasiswa);

            return [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'prodi' => $mahasiswa->prodi->nama_prodi ?? '-',
                'progress' => $progress['percentage'],
                'status' => $progress['status'],
                'updated' => $progress['last_updated'],
                'details' => $progress['details'],
                'draft_status' => $progress['draft_status'] // ✅ Tambah info draft
            ];
        });

        if ($status && $status != 'all') {
            $progressData = $progressData->filter(function ($data) use ($status) {
                return $data['status'] == $status;
            });
        }

        return view('admin.progress.index', compact('progressData', 'search', 'status'));
    }

    /**
     * ✅ PERBAIKAN: Hitung progress dengan mempertimbangkan Draft SKPI
     */
    private function calculateProgress($mahasiswa)
    {
        // ✅ CEK DULU: Apakah sudah punya Draft SKPI dengan status final_issued?
        $draftSkpi = DraftSkpi::where('mahasiswa_id', $mahasiswa->id)->first();

        // Jika SKPI sudah final_issued = 100% selesai!
        if ($draftSkpi && $draftSkpi->status == 'final_issued') {
            return [
                'percentage' => 100,
                'status' => 'Selesai',
                'last_updated' => $draftSkpi->updated_at->format('Y-m-d'),
                'details' => [
                    'draft_skpi' => 'Final Issued',
                    'data_pribadi' => 'Lengkap',
                    'prestasi' => Prestasi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'SertifikasiKompetensi' => SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'organisasi' => Organisasi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'karya_ilmiah' => KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'dokumen_pendukung' => DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->count() . ' dokumen',
                ],
                'draft_status' => 'final_issued'
            ];
        }

        // ✅ Jika ada draft tapi belum final_issued
        if ($draftSkpi) {
            $draftProgress = $this->getDraftProgress($draftSkpi->status);

            return [
                'percentage' => $draftProgress['percentage'],
                'status' => $draftProgress['status'],
                'last_updated' => $draftSkpi->updated_at->format('Y-m-d'),
                'details' => [
                    'draft_skpi' => $this->getDraftStatusLabel($draftSkpi->status),
                    'data_pribadi' => 'Lengkap',
                    'prestasi' => Prestasi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'SertifikasiKompetensi' => SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'organisasi' => Organisasi::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'karya_ilmiah' => KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)->count() . ' item',
                    'dokumen_pendukung' => DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->count() . ' dokumen',
                ],
                'draft_status' => $draftSkpi->status
            ];
        }

        // ✅ Jika belum ada draft, hitung dari komponen
        $components = [
            'data_pribadi' => 15,
            'prestasi' => 20,
            'SertifikasiKompetensi' => 20,
            'organisasi' => 20,
            'karya_ilmiah' => 15,
            'dokumen_pendukung' => 10,
        ];

        $totalProgress = 0;
        $details = [];
        $lastUpdated = null;

        // 1. Data Pribadi (15%)
        $dataPribadiComplete = $this->checkDataPribadi($mahasiswa);
        if ($dataPribadiComplete) {
            $totalProgress += $components['data_pribadi'];
            $details['data_pribadi'] = 'Lengkap';
        } else {
            $details['data_pribadi'] = 'Belum Lengkap';
        }

        // 2. Prestasi (20%)
        $prestasiCount = Prestasi::where('mahasiswa_id', $mahasiswa->id)->count();
        if ($prestasiCount > 0) {
            $totalProgress += $components['prestasi'];
            $details['prestasi'] = $prestasiCount . ' item';

            $latestPrestasi = Prestasi::where('mahasiswa_id', $mahasiswa->id)
                ->latest('updated_at')->first();
            if ($latestPrestasi && (!$lastUpdated || $latestPrestasi->updated_at > $lastUpdated)) {
                $lastUpdated = $latestPrestasi->updated_at;
            }
        } else {
            $details['prestasi'] = 'Belum ada';
        }

        // 3. SertifikasiKompetensi (20%)
        $SertifikasiKompetensiCount = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)->count();
        if ($SertifikasiKompetensiCount > 0) {
            $totalProgress += $components['SertifikasiKompetensi'];
            $details['SertifikasiKompetensi'] = $SertifikasiKompetensiCount . ' item';

            $latestSertifikasiKompetensi = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)
                ->latest('updated_at')->first();
            if ($latestSertifikasiKompetensi && (!$lastUpdated || $latestSertifikasiKompetensi->updated_at > $lastUpdated)) {
                $lastUpdated = $latestSertifikasiKompetensi->updated_at;
            }
        } else {
            $details['SertifikasiKompetensi'] = 'Belum ada';
        }

        // 4. Organisasi (20%)
        $organisasiCount = Organisasi::where('mahasiswa_id', $mahasiswa->id)->count();
        if ($organisasiCount > 0) {
            $totalProgress += $components['organisasi'];
            $details['organisasi'] = $organisasiCount . ' item';

            $latestOrganisasi = Organisasi::where('mahasiswa_id', $mahasiswa->id)
                ->latest('updated_at')->first();
            if ($latestOrganisasi && (!$lastUpdated || $latestOrganisasi->updated_at > $lastUpdated)) {
                $lastUpdated = $latestOrganisasi->updated_at;
            }
        } else {
            $details['organisasi'] = 'Belum ada';
        }

        // 5. Karya Ilmiah (15%)
        $karyaIlmiahCount = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)->count();
        if ($karyaIlmiahCount > 0) {
            $totalProgress += $components['karya_ilmiah'];
            $details['karya_ilmiah'] = $karyaIlmiahCount . ' item';

            $latestKarya = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)
                ->latest('updated_at')->first();
            if ($latestKarya && (!$lastUpdated || $latestKarya->updated_at > $lastUpdated)) {
                $lastUpdated = $latestKarya->updated_at;
            }
        } else {
            $details['karya_ilmiah'] = 'Belum ada';
        }

        // 6. Dokumen Pendukung (10%)
        $dokumenCount = DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->count();
        if ($dokumenCount > 0) {
            $totalProgress += $components['dokumen_pendukung'];
            $details['dokumen_pendukung'] = $dokumenCount . ' dokumen';

            $latestDokumen = DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)
                ->latest('updated_at')->first();
            if ($latestDokumen && (!$lastUpdated || $latestDokumen->updated_at > $lastUpdated)) {
                $lastUpdated = $latestDokumen->updated_at;
            }
        } else {
            $details['dokumen_pendukung'] = 'Belum ada';
        }

        // Tentukan status
        if ($totalProgress == 0) {
            $status = 'Belum Mulai';
        } elseif ($totalProgress == 100) {
            $status = 'Selesai';
        } else {
            $status = 'Dalam Proses';
        }

        return [
            'percentage' => $totalProgress,
            'status' => $status,
            'last_updated' => $lastUpdated ? $lastUpdated->format('Y-m-d') : '-',
            'details' => $details,
            'draft_status' => null
        ];
    }

    /**
     * ✅ Get progress berdasarkan status draft SKPI
     */
    private function getDraftProgress($status)
    {
        $statusMap = [
            'draft' => ['percentage' => 60, 'status' => 'Dalam Proses'],
            'valid_prodi' => ['percentage' => 70, 'status' => 'Dalam Proses'],
            'valid_fakultas' => ['percentage' => 80, 'status' => 'Dalam Proses'],
            'valid_dekan' => ['percentage' => 90, 'status' => 'Dalam Proses'],
            'final_issued' => ['percentage' => 100, 'status' => 'Selesai'],
        ];

        return $statusMap[$status] ?? ['percentage' => 50, 'status' => 'Dalam Proses'];
    }

    /**
     * ✅ Get label status draft
     */
    private function getDraftStatusLabel($status)
    {
        $labels = [
            'draft' => 'Draft',
            'valid_prodi' => 'Disetujui Prodi',
            'valid_fakultas' => 'Disetujui Fakultas',
            'valid_dekan' => 'Disetujui Dekan',
            'final_issued' => 'Final Issued',
        ];

        return $labels[$status] ?? 'Unknown';
    }

    private function checkDataPribadi($mahasiswa)
    {
        $requiredFields = [
            'nim',
            'nama',
            'jenis_kelamin',
            'agama',
            'tempat_tanggal_lahir',
            'prodi_id',
            'tahun_masuk',
            'angkatan',
        ];

        foreach ($requiredFields as $field) {
            if (empty($mahasiswa->$field)) {
                return false;
            }
        }

        return true;
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with(['prodi', 'user'])->findOrFail($id);
        $progress = $this->calculateProgress($mahasiswa);

        $prestasi = Prestasi::where('mahasiswa_id', $id)->latest()->get();
        $SertifikasiKompetensi = SertifikasiKompetensi::where('mahasiswa_id', $id)->latest()->get();
        $organisasi = Organisasi::where('mahasiswa_id', $id)->latest()->get();
        $karyaIlmiah = KaryaIlmiah::where('mahasiswa_id', $id)->latest()->get();
        $dokumen = DokumenPendukung::where('mahasiswa_id', $id)->latest()->get();
        $draftSkpi = DraftSkpi::where('mahasiswa_id', $id)->first();

        return view('admin.progress.show', compact(
            'mahasiswa',
            'progress',
            'prestasi',
            'SertifikasiKompetensi',
            'organisasi',
            'karyaIlmiah',
            'dokumen',
            'draftSkpi'
        ));
    }
}
