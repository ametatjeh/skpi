<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'mahasiswa_id',
        'judul_prestasi',
        'tingkat',
        'penyelenggara',
        'tanggal_perolehan',
        'deskripsi',
        'file_path',
        'status'
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
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
