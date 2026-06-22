<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApprovalLog;
use App\Models\VerifikasiSkpi;

class ApprovalController extends Controller
{
    /**
     * Display approval history untuk verifikasi tertentu
     */
    public function history($verifikasiId)
    {
        $verifikasi = VerifikasiSkpi::with('approvalLogs.approver')->findOrFail($verifikasiId);

        // Sort logs descending
        $approvalLogs = $verifikasi->approvalLogs->sortByDesc('created_at');

        return view('prodi.approval.history', compact('verifikasi', 'approvalLogs'));
    }

    /**
     * Get approval timeline via AJAX
     */
    public function timeline($verifikasiId)
    {
        $approvalLogs = ApprovalLog::where('verifikasi_skpi_id', $verifikasiId)
            ->with('approver')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'approver' => $log->approver->name ?? 'System',
                    'action' => $log->action,
                    'status_from' => $log->status_from,
                    'status_to' => $log->status_to,
                    'catatan' => $log->catatan,
                    'created_at' => $log->created_at->format('d M Y H:i'),
                    'icon' => match ($log->action) {
                        'approve' => 'check-circle',
                        'reject' => 'times-circle',
                        'revision_request' => 'edit',
                        default => 'circle'
                    },
                    'color' => match ($log->action) {
                        'approve' => 'success',
                        'reject' => 'danger',
                        'revision_request' => 'warning',
                        default => 'info'
                    }
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $approvalLogs
        ]);
    }
}
