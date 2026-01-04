<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi; // Switch to correct model
use App\Exports\SkpiExport; // Might need update if it relies on Skpi
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanAdminController extends Controller
{
    /**
     * Halaman index laporan
     */
    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year; // Default null (Semua Tahun)

        // 1. Build Query for Table (Pagination)
        // Use DraftSkpi which allows us to see 'final_issued', 'draft', etc.
        $query = DraftSkpi::with(['mahasiswa.prodi.fakultas', 'prodi']);

        if ($year) {
            $query->whereYear('created_at', $year);
        }
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $skpi = $query->latest()->paginate(30);

        // 2. Build Collection for Stats (Get ALL matching records)
        $statsQuery = DraftSkpi::with(['mahasiswa.prodi', 'prodi']);
        if ($year) {
            $statsQuery->whereYear('created_at', $year);
        }
        if ($month) {
            $statsQuery->whereMonth('created_at', $month);
        }
        $allData = $statsQuery->get();

        // --- STATS AGGREGATION (Collection Math) ---

        // Summary Cards
        $summaryTotal = $allData->count();
        // 'final_issued' is the correct DB status for Final
        $summaryApproved = $allData->whereIn('status', ['approved', 'final_issued', 'final'])->count(); 
        $summaryPending = $allData->whereIn('status', ['pending', 'submitted', 'draft', 'diverifikasi_prodi'])->count();

        // Chart 1: Top 5 Prodi
        // Priority: Use direct prodi relation if available, fallback to mahasiswa.prodi
        $chartProdiData = $allData->groupBy(function($item) {
                return $item->prodi->nama_prodi ?? $item->mahasiswa->prodi->nama_prodi ?? 'Tanpa Prodi';
            })
            ->map->count()
            ->sortDesc()
            ->take(5);

        $chartProdiKeys = array_values($chartProdiData->keys()->toArray());
        $chartProdiValues = array_values($chartProdiData->values()->toArray());

        // Chart 2: Status
        // Map raw DB statuses to cleaner labels
        $chartStatusData = $allData->groupBy('status')->map->count();
        $chartStatusKeys = array_values($chartStatusData->keys()->map(function($s) {
            return match($s) {
                'final_issued' => 'Final',
                'diverifikasi_prodi' => 'Verif Prodi',
                'submitted' => 'Diajukan',
                default => ucfirst($s)
            };
        })->toArray());
        $chartStatusValues = array_values($chartStatusData->values()->toArray());

        // Chart 3: Trend
        if ($year) {
            // Monthly Trend for selected year
            $trendLabel = "Tren Bulanan ($year)";
            
            // Ensure sorting Jan-Dec
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $chartTrendKeys = $months; // Use English Short for keys or indonesian if preferred
            $chartTrendValues = [];
            
            // Helper to get month index from date
            foreach (range(1, 12) as $mIdx) {
                $count = $allData->filter(function($item) use ($mIdx) {
                    return $item->created_at->month == $mIdx;
                })->count();
                $chartTrendValues[] = $count;
            }
        } else {
            // Yearly Trend
            $trendLabel = "Tren Tahunan";
            $trendData = $allData->groupBy(fn($item) => $item->created_at->format('Y'))->map->count()->sortKeys();
            $chartTrendKeys = array_values($trendData->keys()->toArray());
            $chartTrendValues = array_values($trendData->values()->toArray());
        }

        return view('admin.laporan.index', compact(
            'skpi', 
            'chartProdiKeys', 'chartProdiValues',
            'chartStatusKeys', 'chartStatusValues',
            'chartTrendKeys', 'chartTrendValues',
            'trendLabel',
            'month', 'year',
            'summaryTotal', 'summaryApproved', 'summaryPending'
        ));
    }

    /**
     * Export ke PDF
     */
    public function exportPdf()
    {
        // Use DraftSkpi
        $skpi = DraftSkpi::with(['mahasiswa.prodi.fakultas'])
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('skpi'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-skpi-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export ke Excel
     */
    public function exportExcel()
    {
        // Need to update SkpiExport to use DraftSkpi if it doesn't already
        return Excel::download(new SkpiExport, 'laporan-skpi-' . now()->format('Y-m-d') . '.xlsx');
    }
}
