<?php
// app/Observers/SertifikasiObserver.php

namespace App\Observers;

use App\Models\SertifikasiKompetensi;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Log;

class SertifikasiObserver extends BaseAchievementObserver
{
    /**
     * Handle the SertifikasiKompetensi "created" event.
     */
    public function created(SertifikasiKompetensi $sertifikasi)
    {
        // Pastikan relasi mahasiswa tersedia dan punya prodi_id
        $prodiId = optional($sertifikasi->mahasiswa)->prodi_id;

        VerifikasiSkpi::create([
            'mahasiswa_id'      => $sertifikasi->mahasiswa_id,
            'prodi_id'          => $prodiId, // ambil dari relasi mahasiswa
            'verifiable_type'   => get_class($sertifikasi),
            'verifiable_id'     => $sertifikasi->id,
            'level_verifikasi'  => 'prodi',
            'status'            => 'pending',
            'tanggal_pengajuan' => now(),
            // Tambahkan field lain sesuai struktur tabel verifikasi_skpi
        ]);

        Log::info('New sertifikasi created + verifikasi inserted', [
            'id' => $sertifikasi->id,
            'mahasiswa_id' => $sertifikasi->mahasiswa_id,
            'nama_sertifikasi' => $sertifikasi->nama_sertifikasi
        ]);
    }


    /**
     * Handle the SertifikasiKompetensi "deleting" event.
     */
    public function deleting(SertifikasiKompetensi $sertifikasi)
    {
        // Hapus verifikasi terkait jika ada
        VerifikasiSkpi::where('verifiable_type', SertifikasiKompetensi::class)
            ->where('verifiable_id', $sertifikasi->id)
            ->delete();

        Log::info('Sertifikasi and related verifikasi deleted', [
            'sertifikasi_id' => $sertifikasi->id
        ]);
    }
}
