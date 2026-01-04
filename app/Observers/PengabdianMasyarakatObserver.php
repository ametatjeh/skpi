<?php
// app/Observers/PengabdianMasyarakatObserver.php

namespace App\Observers;

use App\Models\PengabdianMasyarakat;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class PengabdianMasyarakatObserver extends BaseAchievementObserver
{
    /**
     * Handle the PengabdianMasyarakat "created" event.
     */
    public function created(PengabdianMasyarakat $pkm)
    {
        $prodiId = optional($pkm->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $pkm->mahasiswa_id,
            'prodi_id'          => $prodiId,
            'verifiable_type'   => get_class($pkm),
            'verifiable_id'     => $pkm->id,
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        Log::info('New PKM created + verifikasi inserted', [
            'id' => $pkm->id,
            'mahasiswa_id' => $pkm->mahasiswa_id,
            'judul_pkm' => $pkm->judul_pkm
        ]);
    }


    /**
     * Handle the PengabdianMasyarakat "deleting" event.
     */
    public function deleting(PengabdianMasyarakat $pkm)
    {
        VerifikasiSkpi::where('verifiable_type', PengabdianMasyarakat::class)
            ->where('verifiable_id', $pkm->id)
            ->delete();

        Log::info('PKM and related verifikasi deleted', [
            'pkm_id' => $pkm->id
        ]);
    }
}
