<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi';

    protected $fillable = [
        'mahasiswa_id',
        'nama_organisasi',
        'posisi',
        'tahun_masuk',
        'tahun_keluar',
        'deskripsi_peran',
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
