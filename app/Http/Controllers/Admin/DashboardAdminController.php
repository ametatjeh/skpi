<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\DraftSkpi;
use App\Models\VerifikasiSkpi;
use App\Models\LaporanMonev;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik
        $totalUser       = User::count();
        $totalMahasiswa  = Mahasiswa::count();
        $totalProdi      = Prodi::count();
        $totalFakultas   = Fakultas::count();

        // ============================
        // STATUS SKPI SESUAI DATABASE
        // ============================

        // Draft SKPI (status = draft)
        $totalSkpiDraft = DraftSkpi::where('status', 'draft')->count();

        // Disetujui & Ditolak (dari verifikasi_skpi)
        $totalSkpiDisetujui = VerifikasiSkpi::where('status', 'approved')->count();
        $totalSkpiDitolak   = VerifikasiSkpi::where('status', 'rejected')->count();

        // SKPI Final = dari draft_skpi yang final_issued
        $totalSkpiFinal = DraftSkpi::where('status', 'final_issued')->count();

        // Laporan Monev
        $totalLaporanMonev = LaporanMonev::count();


        // ==========================================
        // 5 SKPI FINAL TERBARU – dari draft_skpi
        // ==========================================
        $recentSkpiFinal = DraftSkpi::with(['mahasiswa.prodi'])
            ->where('status', 'final_issued')   // ambil yg benar-benar final
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();


        return view('admin.dashboard.index', compact(
            'totalUser',
            'totalMahasiswa',
            'totalProdi',
            'totalFakultas',

            'totalSkpiDraft',
            'totalSkpiDisetujui',
            'totalSkpiDitolak',
            'totalSkpiFinal',

            'totalLaporanMonev',
            'recentSkpiFinal'
        ));
    }
}
