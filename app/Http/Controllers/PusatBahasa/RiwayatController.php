<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApprovalLog;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = ApprovalLog::with(['draftSkpi.mahasiswa.prodi'])
            ->where('performed_by_role', 'pusat_bahasa');

        if ($request->filled('status')) {
            $query->where('action', $request->status);
        }
        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $logs = $query->orderByDesc('created_at')->paginate(20);

        return view('pusat.riwayat.index', compact('logs'));
    }
}
