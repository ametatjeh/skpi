<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use HasFactory;

    protected $table = 'cpl';

    protected $fillable = [
        'prodi_id',
        'kode',
        'kategori',
        'deskripsi',
        'status',
        'urutan'
    ];

    // ===== RELASI =====

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // ===== SCOPE: FILTER CPL AKTIF =====

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // ===== SCOPE: SORT BY URUTAN =====

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
