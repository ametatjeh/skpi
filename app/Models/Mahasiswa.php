<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'prodi_id',
        'nim',
        'email',
        'nik',
        'nama',
        'jenis_kelamin',
        'agama',
        'alamat',
        'tahun_masuk',
        'angkatan',
        'tanggal_masuk',
        'status_mahasiswa',
        'tanggal_lulus',
        'gelar',
        'no_ijazah',
        'tempat_tanggal_lahir', // Atau split jadi tempat_lahir dan tanggal_lahir jika ada
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_lulus' => 'date',
    ];

    // ===== RELATIONSHIPS =====

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
    public function verifikasiSkpi()
    {
        return $this->hasMany(\App\Models\VerifikasiSkpi::class, 'mahasiswa_id');
    }
    public function draftSkpi()
    {
        return $this->hasMany(\App\Models\DraftSkpi::class, 'mahasiswa_id');
    }
    public function kategoriSummary()
    {
        return $this->hasMany(\App\Models\VerifikasiSkpi::class, 'mahasiswa_id', 'id')
            ->where('status', 'included_in_summary');
    }


    // 6 Kategori Pencapaian
    public function sertifikasi()
    {
        return $this->hasMany(SertifikasiKompetensi::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function organisasi()
    {
        return $this->hasMany(Organisasi::class);
    }

    public function pengabdian()
    {
        return $this->hasMany(PengabdianMasyarakat::class);
    }

    public function karya()
    {
        return $this->hasMany(KaryaIlmiah::class);
    }

    public function penghargaan()
    {
        return $this->hasMany(Penghargaan::class);
    }

    // Supporting Features
    public function dokumen()
    {
        return $this->hasMany(DokumenPendukung::class);
    }

    public function verifikasi()
    {
        return $this->hasMany(VerifikasiSkpi::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function skpi()
    {
        return $this->hasMany(Skpi::class);
    }
}
