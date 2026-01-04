<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $fillable = [
        'nama_fakultas',
        'dekan',
        'akreditasi',
        'no_sk'
    ];

    /**
     * Relationship dengan Prodi
     */
    public function prodis()
    {
        return $this->hasMany(Prodi::class, 'fakultas_id');
    }
}
