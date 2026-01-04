<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WakilDekan extends Model
{
    use HasFactory;

    protected $table = 'wakil_dekans';

    protected $fillable = [
        'fakultas_id',
        'nama',
        'nip',
        'email',
        'bidang', // misal bidang kemahasiswaan/akademik/umum
        'periode_awal',
        'periode_akhir'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
}
