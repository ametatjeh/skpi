<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    VerifikasiSkpi,
    Mahasiswa,
    ApprovalLog,
    Notifikasi,
    Skpi,
    Setting
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardProdiController extends Controller
{
    /**
     * Display dashboard prodi
     */
    public function index()
    {
        $prodiId = auth()->user()->prodi_id;

        // === Statistik utama ===
        $totalPengajuan = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->count();

        $pengajuanBaru = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'pending')->count();

        $disetujui = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'approved')->count();

        $ditolak = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'rejected')->count();

        $dalamProses = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->whereIn('level_verifikasi', ['fakultas', 'pusat_bahasa', 'dekan'])
            ->where('status', 'pending')->count();

        $selesai = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'dekan')
            ->where('status', 'approved')->count();

        // === Statistik bulan ini ===
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $pengajuanBulanIni = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        $disetujuiBulanIni = ApprovalLog::whereHas('verifikasiSkpi.mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('approver_role', 'prodi')
            ->where('action', 'approve')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        // === Notifikasi, aktivitas, chart, SLA monitoring ===
        $pengajuanTerbaru = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->where('level_verifikasi', 'prodi')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $aktivitasTerbaru = ApprovalLog::with(['verifikasiSkpi.mahasiswa', 'approver'])
            ->whereHas('verifikasiSkpi.mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $notifikasiBelumDibaca = Notifikasi::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $chartData = ['labels' => [], 'data' => []];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $jumlah = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
                ->where('level_verifikasi', 'prodi')
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            $chartData['labels'][] = $bulan->format('M Y');
            $chartData['data'][] = $jumlah;
        }

        $slaProdi = Setting::where('setting_key', 'sla_verifikasi_prodi')->value('setting_value') ?? 3;
        $melebihiSla = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subDays($slaProdi))
            ->count();

        // === Data utama: Group pengajuan per mahasiswa untuk tampilan accordion/collapse ===
        $idMahasiswaYangAdaPengajuan = \App\Models\VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })->pluck('mahasiswa_id')->unique()->toArray();

        $mahasiswaPengajuan = \App\Models\Mahasiswa::with([
            'verifikasiSkpi' => function ($q) use ($prodiId) {
                $q->whereHas('mahasiswa', function ($qq) use ($prodiId) {
                    $qq->where('prodi_id', $prodiId);
                })
                    ->with('verifiable')
                    ->orderBy('created_at', 'desc');
            }
        ])->whereIn('id', $idMahasiswaYangAdaPengajuan)
            ->orderBy('nama')
            ->get();

        // === Return ke view dashboard prodi ===
        return view('prodi.dashboard.index', compact(
            'totalPengajuan',
            'pengajuanBaru',
            'disetujui',
            'ditolak',
            'dalamProses',
            'selesai',
            'pengajuanBulanIni',
            'disetujuiBulanIni',
            'pengajuanTerbaru',
            'aktivitasTerbaru',
            'notifikasiBelumDibaca',
            'chartData',
            'slaProdi',
            'melebihiSla',
            'mahasiswaPengajuan'
        ));
    }


    public function createDraftSummary($mahasiswa_id)
    {
        // Kategori yang wajib ada
        $requiredCategories = [
            'App\Models\SertifikasiKompetensi',
            'App\Models\Prestasi',
            'App\Models\Organisasi',
            'App\Models\PengabdianMasyarakat'
        ];

        $approved = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa_id)
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'approved')
            ->get();

        $approvedCat = $approved->pluck('verifiable_type')->toArray();
        $missing = array_diff($requiredCategories, $approvedCat);

        if (count($missing) === 0) {
            // Semua kategori approved, buat SKPI summary
            $draft = Skpi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'status' => 'valid_prodi'
                // Tambah field lain sesuai kebutuhan
            ]);
            VerifikasiSkpi::where('mahasiswa_id', $mahasiswa_id)
                ->where('level_verifikasi', 'prodi')
                ->where('status', 'approved')
                ->update(['status' => 'included_in_summary']);
            return redirect()->route('prodi.draft-skpi.preview', $draft->id)
                ->with('success', 'Draft SKPI Global berhasil dibuat dan dikirim ke fakultas!');
        } else {
            return redirect()->back()->with('warning', 'Kategori belum lengkap: ' . implode(', ', $missing));
        }
    }

    /**
     * Get statistics data (untuk AJAX)
     */
    public function statistics(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $periode = $request->input('periode', 'bulan_ini');

        $query = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        });

        // Filter berdasarkan periode
        switch ($periode) {
            case 'bulan_ini':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'tahun_ini':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        $statistics = [
            'total' => (clone $query)->where('level_verifikasi', 'prodi')->count(),
            'pending' => (clone $query)->where('level_verifikasi', 'prodi')
                ->where('status', 'pending')->count(),  // ✅ GANTI
            'disetujui' => (clone $query)->where('level_verifikasi', 'prodi')
                ->where('status', 'approved')->count(),  // ✅ GANTI
            'ditolak' => (clone $query)->where('level_verifikasi', 'prodi')
                ->where('status', 'rejected')->count(),  // ✅ GANTI
            'dalam_proses' => (clone $query)->whereIn('level_verifikasi', ['fakultas', 'pusat_bahasa', 'dekan'])
                ->where('status', 'pending')->count(),  // ✅ GANTI
            'selesai' => (clone $query)->where('level_verifikasi', 'dekan')
                ->where('status', 'approved')->count(),  // ✅ GANTI
        ];

        return response()->json([
            'success' => true,
            'data' => $statistics
        ]);
    }

    /**
     * Get recent activities (untuk AJAX)
     */
    public function recentActivities(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $limit = $request->input('limit', 10);

        $activities = ApprovalLog::with(['verifikasiSkpi.mahasiswa', 'approver'])
            ->whereHas('verifikasiSkpi.mahasiswa', function ($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId);
            })
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'mahasiswa' => $log->verifikasiSkpi->mahasiswa->nama ?? '-',
                    'nim' => $log->verifikasiSkpi->mahasiswa->nim ?? '-',
                    'action' => $log->action,
                    'status_from' => $log->status_from,
                    'status_to' => $log->status_to,
                    'approver' => $log->approver->name ?? 'System',
                    'catatan' => $log->catatan,
                    'created_at' => $log->created_at->diffForHumans(),
                    'created_at_full' => $log->created_at->format('d M Y H:i')
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }

    /**
     * Get chart data untuk dashboard (untuk AJAX)
     */
    public function getChartData(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;
        $type = $request->input('type', 'monthly');
        $jumlahPeriode = $request->input('periode', 6);

        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Total Pengajuan',
                    'data' => [],
                    'backgroundColor' => 'rgba(22, 163, 74, 0.2)',
                    'borderColor' => 'rgba(22, 163, 74, 1)',
                    'borderWidth' => 2
                ],
                [
                    'label' => 'Disetujui',
                    'data' => [],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgba(34, 197, 94, 1)',
                    'borderWidth' => 2
                ],
                [
                    'label' => 'Ditolak',
                    'data' => [],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgba(239, 68, 68, 1)',
                    'borderWidth' => 2
                ]
            ]
        ];

        if ($type === 'monthly') {
            for ($i = $jumlahPeriode - 1; $i >= 0; $i--) {
                $bulan = Carbon::now()->subMonths($i);

                $total = VerifikasiSkpi::whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_id', $prodiId);
                })
                    ->where('level_verifikasi', 'prodi')  // ✅ TAMBAH
                    ->whereMonth('created_at', $bulan->month)
                    ->whereYear('created_at', $bulan->year)
                    ->count();

                $disetujui = VerifikasiSkpi::whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_id', $prodiId);
                })
                    ->where('level_verifikasi', 'prodi')
                    ->where('status', 'approved')  // ✅ GANTI
                    ->whereMonth('created_at', $bulan->month)
                    ->whereYear('created_at', $bulan->year)
                    ->count();

                $ditolak = VerifikasiSkpi::whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_id', $prodiId);
                })
                    ->where('level_verifikasi', 'prodi')
                    ->where('status', 'rejected')  // ✅ GANTI
                    ->whereMonth('created_at', $bulan->month)
                    ->whereYear('created_at', $bulan->year)
                    ->count();

                $chartData['labels'][] = $bulan->format('M Y');
                $chartData['datasets'][0]['data'][] = $total;
                $chartData['datasets'][1]['data'][] = $disetujui;
                $chartData['datasets'][2]['data'][] = $ditolak;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $chartData
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markNotificationAsRead($id)
    {
        $notifikasi = Notifikasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notifikasi->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sebagai sudah dibaca'
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllNotificationsAsRead()
    {
        Notifikasi::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sebagai sudah dibaca'
        ]);
    }
}
