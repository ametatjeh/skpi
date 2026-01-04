<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikasiKompetensi extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi_kompetensi';

    protected $fillable = [
        'mahasiswa_id',
        'nama_sertifikasi',
        'nomor_sertifikat',
        'penerbit',
        'tanggal_terbit',
        'tanggal_kadaluarsa',
        'deskripsi',
        'file_path',
        'status'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_kadaluarsa' => 'date',
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
