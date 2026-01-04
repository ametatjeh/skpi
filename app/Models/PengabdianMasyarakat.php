<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianMasyarakat extends Model
{
    use HasFactory;

    protected $table = 'pengabdian_masyarakat';

    protected $fillable = [
        'mahasiswa_id',
        'judul_pkm',
        'pendanaan',
        'tahun_pelaksanaan',
        'anggota_tim',
        'deskripsi',
        'file_path',
        'status'
    ];
    public function verifikasiSkpi()
    {
        return $this->hasOne(\App\Models\VerifikasiSkpi::class, 'verifiable_id')->where('verifiable_type', self::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
