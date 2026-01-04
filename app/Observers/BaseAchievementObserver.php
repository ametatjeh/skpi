<?php
// app/Observers/BaseAchievementObserver.php

namespace App\Observers;

use App\Models\VerifikasiSkpi;
use App\Models\Notifikasi;
use App\Models\ApprovalLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class BaseAchievementObserver
{
    /**
     * Handle the model "updated" event.
     * Trigger ketika status berubah dari 'draft' ke 'submitted'
     */
    public function updated(Model $achievement)
    {
        // Log for debugging
        Log::info('Observer updated() called', [
            'achievement_id' => $achievement->id,
            'achievement_class' => get_class($achievement),
            'current_status' => $achievement->status,
            'original_status' => $achievement->getOriginal('status'),
            'is_dirty' => $achievement->isDirty('status'),
        ]);

        // Check apakah status berubah dari draft ke submitted
        if (
            $achievement->isDirty('status') &&
            $achievement->status === 'submitted' &&
            $achievement->getOriginal('status') === 'draft'
        ) {

            Log::info('Conditions met, creating verification');
            $this->createVerification($achievement);
        } else {
            Log::warning('Conditions NOT met', [
                'isDirty' => $achievement->isDirty('status'),
                'status' => $achievement->status,
                'original' => $achievement->getOriginal('status'),
            ]);
        }
    }

    /**
     * Create verifikasi_skpi record untuk achievement
     */
    protected function createVerification(Model $achievement)
    {
        try {
            Log::info('createVerification() called', [
                'achievement_id' => $achievement->id
            ]);

            // Get mahasiswa data
            $mahasiswa = $achievement->mahasiswa;

            if (!$mahasiswa) {
                Log::error('Mahasiswa not found for achievement', [
                    'achievement_id' => $achievement->id,
                    'achievement_type' => get_class($achievement)
                ]);
                return;
            }

            // Check apakah sudah ada verifikasi untuk achievement ini
            $existingVerifikasi = VerifikasiSkpi::where('verifiable_type', get_class($achievement))
                ->where('verifiable_id', $achievement->id)
                ->first();

            if ($existingVerifikasi) {
                Log::warning('Verifikasi already exists', [
                    'achievement_id' => $achievement->id,
                    'verifikasi_id' => $existingVerifikasi->id
                ]);
                return;
            }

            // Create verifikasi di level Prodi (level pertama)
            $verifikasi = VerifikasiSkpi::create([
                'mahasiswa_id' => $achievement->mahasiswa_id,
                'prodi_id' => $mahasiswa->prodi_id,
                'verifiable_type' => get_class($achievement),
                'verifiable_id' => $achievement->id,
                'level_verifikasi' => 'prodi',
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);

            Log::info('Verifikasi created successfully', [
                'verifikasi_id' => $verifikasi->id,
                'achievement_type' => get_class($achievement),
                'achievement_id' => $achievement->id
            ]);

            // Send notification ke Kaprodi
            $this->notifyProdi($verifikasi, $achievement);

            // Log the action
            $this->logAction($verifikasi, $achievement);
        } catch (\Exception $e) {
            Log::error('Error creating verification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'achievement_id' => $achievement->id,
                'achievement_type' => get_class($achievement)
            ]);
        }
    }

    /**
     * Send notification ke verifikator Prodi
     */
    protected function notifyProdi($verifikasi, $achievement)
    {
        try {
            // Get Kaprodi user dari role_assignments
            $kaprodi = User::where('role', 'prodi')
                ->whereHas('roleAssignments', function ($query) use ($verifikasi) {
                    $query->where('prodi_id', $verifikasi->prodi_id)
                        ->where('role_type', 'kaprodi')
                        ->where('is_active', 1);
                })
                ->first();

            if ($kaprodi) {
                Notifikasi::create([
                    'user_id' => $kaprodi->id,
                    'judul' => 'Pengajuan ' . class_basename($achievement) . ' Baru',
                    'pesan' => 'Mahasiswa ' . $verifikasi->mahasiswa->nama . ' mengajukan ' .
                        class_basename($achievement) . ' untuk diverifikasi.',
                    'tipe' => 'approval',
                    'link' => '/prodi/verifikasi/' . $verifikasi->id
                ]);

                Log::info('Notification sent to Kaprodi', [
                    'kaprodi_id' => $kaprodi->id,
                    'verifikasi_id' => $verifikasi->id
                ]);
            } else {
                Log::warning('Kaprodi not found for prodi', [
                    'prodi_id' => $verifikasi->prodi_id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error sending notification', [
                'error' => $e->getMessage(),
                'verifikasi_id' => $verifikasi->id
            ]);
        }
    }

    /**
     * Log approval action
     */
    protected function logAction($verifikasi, $achievement)
    {
        try {
            ApprovalLog::create([
                'verifikasi_skpi_id' => $verifikasi->id,
                'approver_id' => null, // System action
                'approver_role' => 'system',
                'action' => 'submitted',
                'status_from' => 'draft',
                'status_to' => 'pending',
                'catatan' => 'Achievement submitted by mahasiswa'
            ]);
        } catch (\Exception $e) {
            Log::error('Error logging action', [
                'error' => $e->getMessage(),
                'verifikasi_id' => $verifikasi->id
            ]);
        }
    }
}
