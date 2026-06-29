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
        $query = DraftSkpi::with(['mahasiswa.prodi.fakultas', 'prodi'])->whereYear('created_at', '>=', 2023);

        if ($year) {
            $query->whereYear('created_at', $year);
        }
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $skpi = $query->latest()->paginate(30);

        // 2. Build Collection for Stats (Get ALL matching records)
        $statsQuery = DraftSkpi::with(['mahasiswa.prodi', 'prodi'])->whereYear('created_at', '>=', 2023);
        if ($year) {
            $statsQuery->whereYear('created_at', $year);
        }
        if ($month) {
            $statsQuery->whereMonth('created_at', $month);
        }
        $allData = $statsQuery->get();

        // Query khusus untuk Trend (agar filter bulan tidak merusak tren 12 bulan di tahun tersebut)
        $trendQuery = DraftSkpi::whereYear('created_at', '>=', 2023);
        if ($year) {
            $trendQuery->whereYear('created_at', $year);
        }
        $trendData = $trendQuery->get();

        // --- STATS AGGREGATION ---

        // Summary Cards — sama persis dengan StatistikController
        $summaryTotal    = $allData->count();
        $summaryApproved = $allData->whereIn('status', ['approved', 'final_issued', 'final', 'valid_fakultas'])->count();
        $summaryPending  = $allData->whereNotIn('status', ['approved', 'final_issued', 'final', 'valid_fakultas', 'rejected', 'revisi_prodi', 'revisi_fakultas'])->count();

        // Chart 1: Top 5 Prodi
        $chartProdiData = $allData->groupBy(function($item) {
                return $item->prodi->nama_prodi ?? $item->mahasiswa->prodi->nama_prodi ?? 'Tanpa Prodi';
            })
            ->map->count()
            ->sortDesc()
            ->take(5);

        $chartProdiKeys   = array_values($chartProdiData->keys()->toArray());
        $chartProdiValues = array_values($chartProdiData->values()->toArray());

        // Chart 2: Status — sama persis dengan StatistikController
        $chartStatusData   = $allData->groupBy('status')->map->count();
        $chartStatusKeys   = array_values($chartStatusData->keys()->map(function($s) {
            return match($s) {
                'final_issued', 'final', 'approved' => 'Final / Disetujui',
                'diverifikasi_prodi', 'valid_prodi'  => 'Verif Prodi',
                'di_pusat_bahasa', 'valid_pusat_bahasa' => 'Pusat Bahasa',
                'valid_fakultas'                     => 'Fakultas',
                'revisi_prodi', 'revisi_fakultas'    => 'Revisi',
                'submitted', 'pending'               => 'Diajukan',
                'draft'                              => 'Draft',
                default                              => ucfirst(str_replace('_', ' ', $s))
            };
        })->toArray());
        $chartStatusValues = array_values($chartStatusData->values()->toArray());

        // Chart 3: Trend — gunakan $trendData (query tanpa filter bulan)
        if ($year) {
            $trendLabel       = "Tren Bulanan ($year)";
            $months           = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $chartTrendKeys   = $months;
            $chartTrendValues = [];

            foreach (range(1, 12) as $mIdx) {
                $count = $trendData->filter(function($item) use ($mIdx) {
                    return $item->created_at->month == $mIdx;
                })->count();
                $chartTrendValues[] = $count;
            }
        } else {
            $trendLabel       = "Tren Tahunan";
            $chartTrendKeys   = [];
            $chartTrendValues = [];
            foreach (range(2023, max(2023, (int) date('Y'))) as $y) {
                $chartTrendKeys[]   = (string) $y;
                $chartTrendValues[] = $trendData->filter(fn($item) => $item->created_at->year == $y)->count();
            }
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
