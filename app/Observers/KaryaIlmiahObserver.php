<?php
// app/Observers/KaryaIlmiahObserver.php

namespace App\Observers;

use App\Models\KaryaIlmiah;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class KaryaIlmiahObserver extends BaseAchievementObserver
{
    /**
     * Handle the KaryaIlmiah "created" event.
     */
    public function created(KaryaIlmiah $karya)
    {
        $prodiId = optional($karya->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $karya->mahasiswa_id,
            'prodi_id'          => $prodiId,
            'verifiable_type'   => get_class($karya),
            'verifiable_id'     => $karya->id,
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        Log::info('New karya ilmiah created + verifikasi inserted', [
            'id' => $karya->id,
            'mahasiswa_id' => $karya->mahasiswa_id,
            'judul_karya' => $karya->judul_karya
        ]);
    }


    /**
     * Handle the KaryaIlmiah "deleting" event.
     */
    public function deleting(KaryaIlmiah $karya)
    {
        VerifikasiSkpi::where('verifiable_type', KaryaIlmiah::class)
            ->where('verifiable_id', $karya->id)
            ->delete();

        Log::info('Karya Ilmiah and related verifikasi deleted', [
            'karya_id' => $karya->id
        ]);
    }
}
