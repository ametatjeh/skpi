<?php
// app/Observers/OrganisasiObserver.php

namespace App\Observers;

use App\Models\Organisasi;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class OrganisasiObserver extends BaseAchievementObserver
{
    /**
     * Handle the Organisasi "created" event.
     */
    public function created(Organisasi $organisasi)
    {
        $prodiId = optional($organisasi->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $organisasi->mahasiswa_id,
            'prodi_id'          => $prodiId,
            'verifiable_type'   => get_class($organisasi),
            'verifiable_id'     => $organisasi->id,
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
            // tambahkan field lain sesuai struktur verifikasi_skpi
        ]);

        Log::info('New organisasi created + verifikasi inserted', [
            'id' => $organisasi->id,
            'mahasiswa_id' => $organisasi->mahasiswa_id,
            'nama_organisasi' => $organisasi->nama_organisasi
        ]);
    }


    /**
     * Handle the Organisasi "deleting" event.
     */
    public function deleting(Organisasi $organisasi)
    {
        VerifikasiSkpi::where('verifiable_type', Organisasi::class)
            ->where('verifiable_id', $organisasi->id)
            ->delete();

        Log::info('Organisasi and related verifikasi deleted', [
            'organisasi_id' => $organisasi->id
        ]);
    }
}
