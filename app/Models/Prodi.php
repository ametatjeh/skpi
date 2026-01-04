<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'fakultas_id',
        'nama_prodi',
        'kaprodi',
        'akreditasi',
        'no_sk',
        'jenjang_kkni',
        'bahasa_pengantar',
        'status_akreditasi',
        'nomor_sk_akreditasi',
        'akses_lanjut',
        'status_profesi',
        'jenis_jenjang',
        'nama_prodi_en',
        'kkni_level',
    ];

    // ===== RELASI =====

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function draftSkpi()
    {
        return $this->hasMany(DraftSkpi::class, 'prodi_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(ProdiUser::class, 'prodi_id');
    }

    public function verifikasiSkpi()
    {
        return $this->hasMany(VerifikasiSkpi::class, 'prodi_id');
    }

    // ===== RELASI KE CPL (TAMBAHAN INI WAJIB!) =====

    public function cpl()
    {
        return $this->hasMany(Cpl::class, 'prodi_id');
    }

    // ===== HELPER METHOD: AMBIL CPL BY KATEGORI (TAMBAHAN INI WAJIB!) =====

    /**
     * Ambil CPL berdasarkan kategori (sikap, pengetahuan, keterampilan_umum, keterampilan_khusus)
     * 
     * @param string $kategori
     * @return Cpl|null
     */
    public function getCplByKategori($kategori)
    {
        return $this->cpl()
            ->where('kategori', $kategori)
            ->first();
    }

    /**
     * Ambil semua CPL untuk SKPI dalam bentuk array
     * 
     * @return array
     */
    public function getAllCplForSkpi()
    {
        return [
            'sikap' => $this->getCplByKategori('sikap')?->deskripsi ?? '-',
            'pengetahuan' => $this->getCplByKategori('pengetahuan')?->deskripsi ?? '-',
            'keterampilan_umum' => $this->getCplByKategori('keterampilan_umum')?->deskripsi ?? '-',
            'keterampilan_khusus' => $this->getCplByKategori('keterampilan_khusus')?->deskripsi ?? '-',
        ];
    }
}
