<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'nama_beasiswa',
        'penyelenggara',
        'tahun_mulai',
        'tahun_selesai',
        'jenis',
        'deskripsi',
    ];
}
