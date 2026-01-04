<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerifikasiSkpi;
use App\Models\DraftSkpi;
use App\Models\Prodi;
use App\Exports\LaporanVerifikasiProdiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ExportProdiController extends Controller
{
    /**
     * Export verifikasi ke PDF
     */
    public function exportVerifikasi(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $tahun = $request->input('tahun', Carbon::now()->year);
        
        $prodi = Prodi::find($prodiId);

        // Get verifikasi data
        $verifikasi = VerifikasiSkpi::with(['mahasiswa', 'verifiable'])
            ->whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistics
        $stats = [
            'total' => $verifikasi->count(),
            'pending' => $verifikasi->where('status', 'pending')->count(),
            'approved' => $verifikasi->where('status', 'approved')->count(),
            'rejected' => $verifikasi->where('status', 'rejected')->count(),
            'revision' => $verifikasi->where('status', 'revision_required')->count(),
        ];

        // Approval rate
        $approvalRate = $stats['total'] > 0 
            ? round(($stats['approved'] / $stats['total']) * 100, 1) 
            : 0;

        // Per kategori
        $perKategori = $verifikasi->groupBy('verifiable_type')->map->count();

        $pdf = Pdf::loadView('prodi.laporan.export-pdf', [
            'prodi' => $prodi,
            'verifikasi' => $verifikasi,
            'stats' => $stats,
            'approvalRate' => $approvalRate,
            'perKategori' => $perKategori,
            'tahun' => $tahun,
            'tanggalCetak' => Carbon::now()->translatedFormat('d F Y'),
        ])->setPaper('a4', 'portrait');

        $filename = "Laporan_Verifikasi_SKPI_{$prodi->nama_prodi}_{$tahun}.pdf";
        
        return $pdf->download($filename);
    }

    /**
     * Export summary ke Excel
     */
    public function exportSummary(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $tahun = $request->input('tahun', Carbon::now()->year);
        
        $prodi = Prodi::find($prodiId);

        // Get verifikasi data
        $verifikasi = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = "Laporan_Verifikasi_SKPI_{$prodi->nama_prodi}_{$tahun}.xlsx";

        return Excel::download(
            new LaporanVerifikasiProdiExport($verifikasi, $prodi, $tahun),
            $filename
        );
    }
}
