<?php
// app/Observers/PrestasiObserver.php

namespace App\Observers;

use App\Models\Prestasi;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class PrestasiObserver extends BaseAchievementObserver
{
    /**
     * Handle the Prestasi "created" event.
     */
    public function created(Prestasi $prestasi)
    {
        // Pastikan relasi mahasiswa tersedia dan punya prodi_id
        $prodiId = optional($prestasi->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $prestasi->mahasiswa_id,
            'prodi_id'          => $prodiId, // ambil dari relasi mahasiswa
            'verifiable_type'   => get_class($prestasi), // simpan tipe model
            'verifiable_id'     => $prestasi->id,        // id prestasi
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
            // Tambahkan field lain sesuai struktur tabel verifikasi_skpi
        ]);

        Log::info('New prestasi created + verifikasi inserted', [
            'id' => $prestasi->id,
            'mahasiswa_id' => $prestasi->mahasiswa_id,
            'judul_prestasi' => $prestasi->judul_prestasi
        ]);
    }


    /**
     * Handle the Prestasi "deleting" event.
     */
    public function deleting(Prestasi $prestasi)
    {
        VerifikasiSkpi::where('verifiable_type', Prestasi::class)
            ->where('verifiable_id', $prestasi->id)
            ->delete();

        Log::info('Prestasi and related verifikasi deleted', [
            'prestasi_id' => $prestasi->id
        ]);
    }
}
