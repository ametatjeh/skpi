<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;
use App\Models\VerifikasiSkpi;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter tahun (default tahun ini)
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan'); // optional

        // ============ STATISTIK OVERVIEW ============
        $totalDraftMasuk = DraftSkpi::whereYear('created_at', $tahun)->count();
        $totalDraftApproved = DraftSkpi::where('status', 'valid_fakultas')
            ->orWhere('status', 'final_issued')
            ->whereYear('created_at', $tahun)
            ->count();
        $totalDraftRevisi = DraftSkpi::where('status', 'revisi_prodi')
            ->whereYear('created_at', $tahun)
            ->count();
        $totalDraftPending = DraftSkpi::where('status', 'valid_pusat_bahasa')
            ->whereYear('created_at', $tahun)
            ->count();

        // ============ DATA CHART: DRAFT PER BULAN ============
        $draftPerBulan = DraftSkpi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Fill missing months with 0
        $chartBulan = [];
        $chartTotal = [];
        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i = 1; $i <= 12; $i++) {
            $chartBulan[] = $namaBulan[$i - 1];
            $chartTotal[] = $draftPerBulan[$i] ?? 0;
        }

        // ============ DATA CHART: STATUS DISTRIBUTION ============
        $statusDistribution = DraftSkpi::selectRaw('status, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusLabels = [
            'valid_pusat_bahasa' => 'Menunggu Verifikasi',
            'valid_fakultas' => 'Diteruskan ke Fakultas',
            'revisi_prodi' => 'Dikembalikan ke Prodi',
            'final_issued' => 'Final/Terbit',
            'valid_prodi' => 'Dari Prodi',
        ];

        $chartStatusLabels = [];
        $chartStatusData = [];
        foreach ($statusDistribution as $status => $total) {
            $chartStatusLabels[] = $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status));
            $chartStatusData[] = $total;
        }

        // ============ DATA CHART: PER FAKULTAS ============
        $perFakultas = DraftSkpi::with('mahasiswa.prodi.fakultas')
            ->whereYear('created_at', $tahun)
            ->get()
            ->groupBy(function ($draft) {
                return $draft->mahasiswa->prodi->fakultas->nama_fakultas ?? 'Tidak Diketahui';
            })
            ->map->count()
            ->sortDesc();

        $chartFakultasLabels = $perFakultas->keys()->toArray();
        $chartFakultasData = $perFakultas->values()->toArray();

        // ============ DATA CHART: PER PRODI ============
        $perProdi = DraftSkpi::with('mahasiswa.prodi')
            ->whereYear('created_at', $tahun)
            ->get()
            ->groupBy(function ($draft) {
                return $draft->mahasiswa->prodi->nama_prodi ?? 'Tidak Diketahui';
            })
            ->map->count()
            ->sortDesc()
            ->take(10); // Top 10 prodi

        $chartProdiLabels = $perProdi->keys()->toArray();
        $chartProdiData = $perProdi->values()->toArray();

        // ============ TREND APPROVAL (6 BULAN TERAKHIR) ============
        $trendApproval = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $approved = DraftSkpi::whereIn('status', ['valid_fakultas', 'final_issued'])
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $rejected = DraftSkpi::where('status', 'revisi_prodi')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $trendApproval[] = [
                'bulan' => $date->translatedFormat('M Y'),
                'approved' => $approved,
                'rejected' => $rejected,
            ];
        }

        // ============ RATA-RATA WAKTU PROSES ============
        $avgProcessTime = DraftSkpi::whereIn('status', ['valid_fakultas', 'final_issued'])
            ->whereYear('created_at', $tahun)
            ->get()
            ->avg(function ($draft) {
                if ($draft->tanggal_pengesahan && $draft->created_at) {
                    return $draft->created_at->diffInDays($draft->tanggal_pengesahan);
                }
                return 0;
            });

        // ============ RECENT ACTIVITY ============
        $recentDrafts = DraftSkpi::with(['mahasiswa.prodi'])
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        // ============ TAHUN OPTIONS ============
        $tahunOptions = range(date('Y') - 5, date('Y'));

        return view('pusat.laporan.index', compact(
            'tahun',
            'totalDraftMasuk',
            'totalDraftApproved',
            'totalDraftRevisi',
            'totalDraftPending',
            'chartBulan',
            'chartTotal',
            'chartStatusLabels',
            'chartStatusData',
            'chartFakultasLabels',
            'chartFakultasData',
            'chartProdiLabels',
            'chartProdiData',
            'trendApproval',
            'avgProcessTime',
            'recentDrafts',
            'tahunOptions'
        ));
    }
}
