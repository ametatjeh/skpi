<?php

namespace App\Observers;

use App\Models\VerifikasiSkpi;
use App\Models\Notifikasi;
use App\Models\ApprovalLog;
use Illuminate\Support\Facades\Log;

class VerifikasiSkpiObserver
{
    /**
     * Handle the VerifikasiSkpi "updated" event.
     * Catat audit & notif per kategori (tidak trigger global summary).
     */
    public function updated(VerifikasiSkpi $verifikasi)
    {
        if ($verifikasi->isDirty('status')) {
            // Log approval/reject per kategori
            $this->logApproval($verifikasi);
            // Notifikasi ke mahasiswa
            $this->notifyMahasiswa($verifikasi);
            // Tidak perlu auto-forward global summary di sini
        }
    }

    protected function logApproval($verifikasi)
    {
        try {
            ApprovalLog::create([
                'verifikasi_skpi_id' => $verifikasi->id,
                'approver_id' => $verifikasi->verifikator_id,
                'approver_role' => $verifikasi->level_verifikasi,
                'action' => $verifikasi->status === 'approved' ? 'approve' : 'reject',
                'status_from' => 'pending',
                'status_to' => $verifikasi->status,
                'catatan' => $verifikasi->catatan
            ]);
        } catch (\Exception $e) {
            Log::error('Error logging approval', [
                'error' => $e->getMessage(),
                'verifikasi_id' => $verifikasi->id
            ]);
        }
    }

    protected function notifyMahasiswa($verifikasi)
    {
        try {
            $mahasiswa = $verifikasi->mahasiswa;
            $user = $mahasiswa->user;
            if (!$user) return;

            $message = $verifikasi->status === 'approved'
                ? "Kategori {$verifikasi->verifiable_type} telah disetujui di level {$verifikasi->level_verifikasi}"
                : "Kategori {$verifikasi->verifiable_type} ditolak di level {$verifikasi->level_verifikasi}" .
                ($verifikasi->catatan ? ". Catatan: {$verifikasi->catatan}" : '');

            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Status Verifikasi SKPI',
                'pesan' => $message,
                'tipe' => $verifikasi->status === 'approved' ? 'success' : 'warning',
                'link' => '/mahasiswa/verifikasi/status'
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending notif to mahasiswa', [
                'error' => $e->getMessage(),
                'verifikasi_id' => $verifikasi->id
            ]);
        }
    }
}
