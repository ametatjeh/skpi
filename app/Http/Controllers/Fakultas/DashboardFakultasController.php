<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\VerifikasiSkpi;
use App\Models\ApprovalLog;
use App\Models\DraftSkpi;
use App\Models\Prodi;

class DashboardFakultasController extends Controller
{
    public function index()
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;

        // Query only draft SKPI untuk summary rekap fakultas
        $draftQ = DraftSkpi::whereHas(
            'mahasiswa.prodi',
            fn($q) =>
            $q->where('fakultas_id', $fakultas->id)
        );

        // Jumlah final issued di fakultas
        $jumlahFinalFakultas = (clone $draftQ)->where('status', 'final_issued')->count();

        // Persen final issued dari seluruh draft SKPI di fakultas
        $totalDraftFakultas = (clone $draftQ)->count();
        $persenFinalFakultas = $totalDraftFakultas > 0
            ? round(($jumlahFinalFakultas / $totalDraftFakultas) * 100, 1)
            : 0;

        // Draft menunggu verifikasi di fakultas (valid_fakultas)
        $jumlahDraftMenunggu = (clone $draftQ)->where('status', 'valid_fakultas')->count();

        // Draft revisi di fakultas (revisi_prodi)
        $jumlahDraftRevisi = (clone $draftQ)->where('status', 'revisi_prodi')->count();

        // Jumlah prodi aktif di fakultas yang pernah mengajukan draft SKPI
        $jumlahProdiAktif = Prodi::where('fakultas_id', $fakultas->id)
            ->whereHas('draftSkpi')
            ->count();


        // Rekap pengajuan terbaru (7 draft terbaru apapun status/role)
        $rekapPengajuanBaru = (clone $draftQ)
            ->with(['mahasiswa'])
            ->orderByDesc('created_at')
            ->limit(7)
            ->get();

        // Data untuk statistik lama versi card (boleh, jika blade kamu butuh)
        $statTotalPengajuan = (clone $draftQ)->count();
        $bulanIni = now()->startOfMonth();
        $statPengajuanBulanIni = (clone $draftQ)->where('created_at', '>=', $bulanIni)->count();

        // Dummy, tidak wajib
        $statPengajuanBaru = (clone $draftQ)->where('status', 'valid_fakultas')->count();
        $statDisetujui = (clone $draftQ)->where('status', 'final_issued')->count();
        $statDitolak = (clone $draftQ)->where('status', 'revisi_prodi')->count();
        $statDisetujuiBulanIni = (clone $draftQ)->where('status', 'final_issued')->where('updated_at', '>=', $bulanIni)->count();

        // (Opsional) Data aktivitas terakhir
        $aktivitasTerbaru = ApprovalLog::whereHas('draftSkpi', function ($q) use ($fakultas) {
            $q->whereHas('mahasiswa.prodi', fn($qq) => $qq->where('fakultas_id', $fakultas->id));
        })->orderByDesc('created_at')->limit(5)->get();

        return view('fakultas.dashboard.index', compact(
            'fakultas',
            'jumlahFinalFakultas',
            'persenFinalFakultas',
            'jumlahDraftMenunggu',
            'jumlahDraftRevisi',
            'jumlahProdiAktif',
            'rekapPengajuanBaru',
            // Opsional card statistik lain
            'statTotalPengajuan',
            'statPengajuanBaru',
            'statDisetujui',
            'statDitolak',
            'statPengajuanBulanIni',
            'statDisetujuiBulanIni',
            'aktivitasTerbaru'
        ));
    }
}
