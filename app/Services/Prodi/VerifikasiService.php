<?php

namespace App\Services\Prodi;

use App\Models\VerifikasiSkpi;
use App\Models\ApprovalLog;
use App\Models\Setting;
use Carbon\Carbon;

class VerifikasiService
{
    /**
     * Ambil statistik verifikasi untuk prodi tertentu
     *
     * @param int $prodiId
     * @return array
     */
    public function getStatistik($prodiId)
    {
        $baseQuery = fn() => VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })->where('level_verifikasi', 'prodi');

        return [
            'total' => $baseQuery()->count(),
            'pending' => $baseQuery()->where('status', 'pending')->count(),
            'approved' => $baseQuery()->where('status', 'approved')->count(),
            'rejected' => $baseQuery()->where('status', 'rejected')->count(),
            'revision' => $baseQuery()->where('status', 'revision_required')->count(),
        ];
    }

    /**
     * Hitung jumlah pengajuan yang masih pending
     *
     * @param int $prodiId
     * @return int
     */
    public function getPendingCount($prodiId)
    {
        return VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'pending')
            ->count();
    }

    /**
     * Cek status SLA verifikasi prodi
     * Mengembalikan info jumlah pengajuan yang melebihi SLA
     *
     * @param int $prodiId
     * @return array
     */
    public function getSlaStatus($prodiId)
    {
        $slaHari = Setting::where('setting_key', 'sla_verifikasi_prodi')
            ->value('setting_value') ?? 3;

        $batasWaktu = Carbon::now()->subDays($slaHari);

        $melebihiSla = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'pending')
            ->where('created_at', '<', $batasWaktu)
            ->count();

        $totalPending = $this->getPendingCount($prodiId);

        return [
            'sla_hari' => (int) $slaHari,
            'melebihi_sla' => $melebihiSla,
            'total_pending' => $totalPending,
            'dalam_sla' => $totalPending - $melebihiSla,
            'persentase_tepat_waktu' => $totalPending > 0
                ? round(($totalPending - $melebihiSla) / $totalPending * 100, 1)
                : 100,
        ];
    }

    /**
     * Ambil statistik bulanan (6 bulan terakhir)
     *
     * @param int $prodiId
     * @return array
     */
    public function getChartData($prodiId)
    {
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

        return $chartData;
    }

    /**
     * Ambil aktivitas verifikasi terbaru
     *
     * @param int $prodiId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentActivities($prodiId, $limit = 5)
    {
        return ApprovalLog::with(['verifikasiSkpi.mahasiswa', 'approver'])
            ->whereHas('verifikasiSkpi.mahasiswa', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            })
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
}
