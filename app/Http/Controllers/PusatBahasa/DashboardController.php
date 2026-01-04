<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary statistik SKPI pusat bahasa (ambil dari tabel draft_skpi)
        $draftMenunggu = DraftSkpi::where('status', 'valid_pusat_bahasa')->count();
        $draftApproved = DraftSkpi::where('status', 'final_issued')->count();
        $draftRevisi   = DraftSkpi::where('status', 'revisi_fakultas')->count();
        $draftFinal    = DraftSkpi::where('status', 'final_issued')->count();

        // Draft SKPI 7 terbaru yang masuk pusat bahasa (hanya status valid_pusat_bahasa)
        $draftTerbaru = DraftSkpi::with(['mahasiswa.prodi'])
            ->where('status', 'valid_pusat_bahasa')
            ->orderByDesc('created_at')
            ->limit(7)
            ->get();

        return view('pusat.dashboard.index', compact(
            'draftMenunggu',
            'draftApproved',
            'draftRevisi',
            'draftFinal',
            'draftTerbaru'
        ));
    }
}
