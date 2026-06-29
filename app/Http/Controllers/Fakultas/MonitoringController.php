<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DraftSkpi;
use App\Models\Prodi;
use App\Models\ApprovalLog;

class MonitoringController extends Controller
{
    public function index()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $draftQ = DraftSkpi::whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId));

        $totalProcessed = (clone $draftQ)->whereIn('status', ['final_issued', 'revisi_prodi'])->count();
        $totalPending = (clone $draftQ)->where('status', 'valid_fakultas')->count();
        $totalFinal = (clone $draftQ)->where('status', 'final_issued')->count();

        // Avg days (approximate)
        $avgDays = (clone $draftQ)->where('status', 'final_issued')
            ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
            ->value('avg_days');
        $avgDays = $avgDays ? round($avgDays) : 0;

        $maxDays = (clone $draftQ)->where('status', 'final_issued')
            ->selectRaw('MAX(DATEDIFF(updated_at, created_at)) as max_days')
            ->value('max_days') ?? 0;

        // Per prodi stats
        $prodis = Prodi::where('fakultas_id', $fakultasId)->get();
        $statsPerProdi = $prodis->map(function ($prodi) {
            $q = DraftSkpi::whereHas('mahasiswa', fn($m) => $m->where('prodi_id', $prodi->id));
            return [
                'nama_prodi' => $prodi->nama_prodi,
                'total' => (clone $q)->count(),
                'approved' => (clone $q)->where('status', 'final_issued')->count(),
                'rejected' => (clone $q)->where('status', 'revisi_prodi')->count(),
                'pending' => (clone $q)->where('status', 'valid_fakultas')->count(),
            ];
        });

        return view('fakultas.monitoring.dashboard', compact(
            'totalProcessed', 'totalPending', 'totalFinal', 'avgDays', 'maxDays', 'statsPerProdi'
        ));
    }

    public function perProdi()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $prodis = Prodi::where('fakultas_id', $fakultasId)->get();
        $statsPerProdi = $prodis->map(function ($prodi) {
            $q = DraftSkpi::whereHas('mahasiswa', fn($m) => $m->where('prodi_id', $prodi->id));
            return [
                'nama_prodi' => $prodi->nama_prodi,
                'total' => (clone $q)->count(),
                'approved' => (clone $q)->where('status', 'final_issued')->count(),
                'rejected' => (clone $q)->where('status', 'revisi_prodi')->count(),
                'pending' => (clone $q)->where('status', 'valid_fakultas')->count(),
            ];
        });

        return view('fakultas.monitoring.per-prodi', compact('statsPerProdi'));
    }

    public function timeline()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $logs = ApprovalLog::whereHas('draftSkpi.mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId))
            ->with(['draftSkpi.mahasiswa'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('fakultas.monitoring.timeline', compact('logs'));
    }

    public function bottleneck()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        // Drafts yang sudah >7 hari belum diproses
        $stuckDrafts = DraftSkpi::with('mahasiswa.prodi')
            ->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId))
            ->where('status', 'valid_fakultas')
            ->where('created_at', '<', now()->subDays(7))
            ->orderBy('created_at')
            ->get();

        return view('fakultas.monitoring.bottleneck', compact('stuckDrafts'));
    }
}
