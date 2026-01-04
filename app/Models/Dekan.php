<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    use HasFactory;

    protected $table = 'dekans';

    protected $fillable = [
        'fakultas_id',
        'nama',
        'nip',
        'email',
        'periode_awal',
        'periode_akhir'
    ];

    // Relasi ke Fakultas
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
}
