<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ApprovalLog;
use Illuminate\Support\Facades\Auth;

class HistoryVerifikasiController extends Controller
{
    public function index()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $logs = ApprovalLog::whereHas('draftSkpi.mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId))
            ->with(['draftSkpi.mahasiswa.prodi'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('fakultas.verifikasi.history', compact('logs'));
    }
}
