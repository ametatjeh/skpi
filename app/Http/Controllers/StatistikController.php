<?php

namespace App\Http\Controllers;

use App\Models\DraftSkpi;
use App\Exports\SkpiExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class StatistikController extends Controller
{
    /**
     * Halaman index statistik publik
     */
    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year; // Default null (Semua Tahun)

        // 1. Build Query for Table (Pagination)
        $query = DraftSkpi::with(['mahasiswa.prodi.fakultas', 'prodi'])->whereYear('created_at', '>=', 2023);

        if ($year) {
            $query->whereYear('created_at', $year);
        }
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $skpi = $query->latest()->paginate(30)->withQueryString();

        // 2. Build Collection for Stats (Get ALL matching records)
        $statsQuery = DraftSkpi::with(['mahasiswa.prodi', 'prodi'])->whereYear('created_at', '>=', 2023);
        if ($year) {
            $statsQuery->whereYear('created_at', $year);
        }
        if ($month) {
            $statsQuery->whereMonth('created_at', $month);
        }
        $allData = $statsQuery->get();

        // --- STATS AGGREGATION ---

        // Summary Cards
        $summaryTotal = $allData->count();
        $summaryApproved = $allData->whereIn('status', ['approved', 'final_issued', 'final'])->count();
        $summaryPending = $allData->whereIn('status', ['pending', 'submitted', 'draft', 'diverifikasi_prodi'])->count();

        // Chart 1: Top 5 Prodi
        $chartProdiData = $allData->groupBy(function($item) {
                return $item->prodi->nama_prodi ?? $item->mahasiswa->prodi->nama_prodi ?? 'Tanpa Prodi';
            })
            ->map->count()
            ->sortDesc()
            ->take(5);

        $chartProdiKeys = array_values($chartProdiData->keys()->toArray());
        $chartProdiValues = array_values($chartProdiData->values()->toArray());

        // Chart 2: Status
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
            $trendLabel = "Tren Bulanan ($year)";
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $chartTrendKeys = $months;
            $chartTrendValues = [];

            foreach (range(1, 12) as $mIdx) {
                $count = $allData->filter(function($item) use ($mIdx) {
                    return $item->created_at->month == $mIdx;
                })->count();
                $chartTrendValues[] = $count;
            }
        } else {
            $trendLabel = "Tren Tahunan";
            $chartTrendKeys = [];
            $chartTrendValues = [];
            foreach (range(2023, max(2023, (int) date('Y'))) as $y) {
                $chartTrendKeys[] = (string) $y;
                $chartTrendValues[] = $allData->filter(fn($item) => $item->created_at->year == $y)->count();
            }
        }

        return view('welcome', compact(
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
        return Excel::download(new SkpiExport, 'laporan-skpi-' . now()->format('Y-m-d') . '.xlsx');
    }
}
