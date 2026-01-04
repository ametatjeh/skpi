<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    protected $table = 'penghargaan';

    protected $fillable = [
        'mahasiswa_id',
        'nama_penghargaan',
        'tingkat',
        'pemberi_penghargaan',
        'tahun_perolehan',
        'deskripsi',
        'file_path',
        'status'
    ];

    // PENTING: Cast sebagai integer, BUKAN date/datetime!
    protected $casts = [
        'tahun_perolehan' => 'integer',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
