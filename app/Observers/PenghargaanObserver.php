<?php
// app/Observers/PenghargaanObserver.php

namespace App\Observers;

use App\Models\Penghargaan;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class PenghargaanObserver extends BaseAchievementObserver
{
    /**
     * Handle the Penghargaan "created" event.
     */
    public function created(Penghargaan $penghargaan)
    {
        $prodiId = optional($penghargaan->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $penghargaan->mahasiswa_id,
            'prodi_id'          => $prodiId,
            'verifiable_type'   => get_class($penghargaan),
            'verifiable_id'     => $penghargaan->id,
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        Log::info('New penghargaan created + verifikasi inserted', [
            'id' => $penghargaan->id,
            'mahasiswa_id' => $penghargaan->mahasiswa_id,
            'nama_penghargaan' => $penghargaan->nama_penghargaan
        ]);
    }


    /**
     * Handle the Penghargaan "deleting" event.
     */
    public function deleting(Penghargaan $penghargaan)
    {
        VerifikasiSkpi::where('verifiable_type', Penghargaan::class)
            ->where('verifiable_id', $penghargaan->id)
            ->delete();

        Log::info('Penghargaan and related verifikasi deleted', [
            'penghargaan_id' => $penghargaan->id
        ]);
    }
}
