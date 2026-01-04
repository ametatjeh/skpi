<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\VerifikasiSkpi;

class ReportSkpiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;

        // Rekap SKPI untuk laporan
        $rekap = VerifikasiSkpi::whereHas('mahasiswa.prodi', function ($prodiQuery) use ($fakultas) {
            $prodiQuery->where('fakultas_id', $fakultas->id);
        })
            ->orderByDesc('created_at')
            ->get();

        return view('fakultas.report.index', compact('rekap', 'fakultas'));
    }

    // Untuk export/cetak PDF nanti tinggal tambah method exportPdf/exportExcel
}
