<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{VerifikasiSkpi, ApprovalLog, DraftSkpi, Mahasiswa};
use Carbon\Carbon;

class LaporanProdiController extends Controller
{
    /**
     * Main Laporan Dashboard with Charts
     */
    public function verifikasi(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $tahun = $request->input('tahun', Carbon::now()->year);

        // ============ OVERVIEW STATS ============
        $baseQuery = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })->whereYear('created_at', $tahun);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
            'revision' => (clone $baseQuery)->where('status', 'revision_required')->count(),
        ];

        // Draft SKPI stats
        $draftStats = [
            'total' => DraftSkpi::where('prodi_id', $prodiId)->whereYear('created_at', $tahun)->count(),
            'valid_prodi' => DraftSkpi::where('prodi_id', $prodiId)->where('status', 'valid_prodi')->count(),
            'valid_pusat' => DraftSkpi::where('prodi_id', $prodiId)->where('status', 'valid_pusat_bahasa')->count(),
            'final' => DraftSkpi::where('prodi_id', $prodiId)->where('status', 'final_issued')->count(),
        ];

        // ============ CHART: VERIFIKASI PER BULAN ============
        $chartBulan = [];
        $chartApproved = [];
        $chartRejected = [];
        $chartPending = [];
        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 1; $i <= 12; $i++) {
            $chartBulan[] = $namaBulan[$i - 1];
            
            $monthQuery = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $i);
            
            $chartApproved[] = (clone $monthQuery)->where('status', 'approved')->count();
            $chartRejected[] = (clone $monthQuery)->where('status', 'rejected')->count();
            $chartPending[] = (clone $monthQuery)->where('status', 'pending')->count();
        }

        // ============ CHART: PER KATEGORI ACHIEVEMENT ============
        $perKategori = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
        ->whereYear('created_at', $tahun)
        ->selectRaw('verifiable_type, COUNT(*) as total')
        ->groupBy('verifiable_type')
        ->pluck('total', 'verifiable_type')
        ->toArray();

        $kategoriLabels = [];
        $kategoriData = [];
        $kategoriMap = [
            'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
            'App\Models\Prestasi' => 'Prestasi',
            'App\Models\Organisasi' => 'Organisasi',
            'App\Models\PengabdianMasyarakat' => 'PKM',
            'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
            'App\Models\Penghargaan' => 'Penghargaan',
        ];
        
        foreach ($perKategori as $type => $total) {
            $kategoriLabels[] = $kategoriMap[$type] ?? class_basename($type);
            $kategoriData[] = $total;
        }

        // ============ CHART: STATUS DISTRIBUTION ============
        $statusLabels = ['Pending', 'Approved', 'Rejected', 'Revisi'];
        $statusData = [$stats['pending'], $stats['approved'], $stats['rejected'], $stats['revision']];

        // ============ TREND 6 BULAN TERAKHIR ============
        $trendData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthQuery = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month);
            
            $trendData[] = [
                'bulan' => $date->translatedFormat('M Y'),
                'total' => (clone $monthQuery)->count(),
                'approved' => (clone $monthQuery)->where('status', 'approved')->count(),
                'rejected' => (clone $monthQuery)->where('status', 'rejected')->count(),
            ];
        }

        // ============ APPROVAL RATE ============
        $approvalRate = $stats['total'] > 0 
            ? round(($stats['approved'] / $stats['total']) * 100, 1) 
            : 0;

        // ============ RATA-RATA WAKTU PROSES ============
        $avgProcessTime = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
        ->where('status', 'approved')
        ->whereYear('created_at', $tahun)
        ->whereNotNull('tanggal_verifikasi')
        ->get()
        ->avg(function ($item) {
            if ($item->created_at && $item->tanggal_verifikasi) {
                return $item->created_at->diffInDays($item->tanggal_verifikasi);
            }
            return 0;
        });

        // ============ RECENT ACTIVITY ============
        $recentActivity = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
        ->with(['mahasiswa', 'verifiable'])
        ->orderByDesc('updated_at')
        ->limit(10)
        ->get();

        // ============ TOP MAHASISWA (paling banyak achievement) ============
        $topMahasiswa = Mahasiswa::where('prodi_id', $prodiId)
            ->withCount(['verifikasiSkpi as approved_count' => function ($q) use ($tahun) {
                $q->where('status', 'approved')->whereYear('created_at', $tahun);
            }])
            ->having('approved_count', '>', 0)
            ->orderByDesc('approved_count')
            ->limit(5)
            ->get();

        // ============ TAHUN OPTIONS ============
        $tahunOptions = range(date('Y') - 5, date('Y'));

        return view('prodi.laporan.verifikasi', compact(
            'stats',
            'draftStats',
            'chartBulan',
            'chartApproved',
            'chartRejected',
            'chartPending',
            'kategoriLabels',
            'kategoriData',
            'statusLabels',
            'statusData',
            'trendData',
            'approvalRate',
            'avgProcessTime',
            'recentActivity',
            'topMahasiswa',
            'tahun',
            'tahunOptions'
        ));
    }

    /**
     * Display analytics dashboard
     */
    public function analytics(Request $request)
    {
        return redirect()->route('prodi.laporan.verifikasi');
    }

    /**
     * Display SLA monitoring (siapa yang terlambat)
     */
    public function slaMonitoring(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $slaProdi = \App\Models\Setting::getSlaProdi() ?? 3;

        // Get pengajuan yang melebihi SLA
        $melebihiSla = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subDays($slaProdi))
            ->with('mahasiswa')
            ->get();

        // Get pengajuan yang masih dalam SLA
        $dalamSla = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('status', 'pending')
            ->where('created_at', '>=', Carbon::now()->subDays($slaProdi))
            ->with('mahasiswa')
            ->get();

        $stats = [
            'melebihi_sla' => $melebihiSla->count(),
            'dalam_sla' => $dalamSla->count(),
            'sla_hari' => $slaProdi
        ];

        return view('prodi.laporan.sla-monitoring', compact('melebihiSla', 'dalamSla', 'stats'));
    }
}
