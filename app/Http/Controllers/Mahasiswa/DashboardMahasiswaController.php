<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\{Mahasiswa, SertifikasiKompetensi, Prestasi, Organisasi, PengabdianMasyarakat, KaryaIlmiah, Penghargaan, DokumenPendukung, DraftSkpi};

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $stats = [
            'sertifikasi' => SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)->count(),
            'prestasi' => Prestasi::where('mahasiswa_id', $mahasiswa->id)->count(),
            'organisasi' => Organisasi::where('mahasiswa_id', $mahasiswa->id)->count(),
            'pkm' => PengabdianMasyarakat::where('mahasiswa_id', $mahasiswa->id)->count(),
            'karya' => KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)->count(),
            'penghargaan' => Penghargaan::where('mahasiswa_id', $mahasiswa->id)->count(),
            'dokumen' => DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->count(),
        ];

        // Check if there's a final SKPI ready for pickup (using DraftSkpi model)
        $skpiFinal = DraftSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', ['final', 'final_issued'])
            ->first();

        return view('mahasiswa.dashboard.index', compact('stats', 'mahasiswa', 'skpiFinal'));
    }
}
