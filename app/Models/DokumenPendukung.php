<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPendukung extends Model
{
    use HasFactory;

    protected $table = 'dokumen_pendukung';

    protected $fillable = [
        'mahasiswa_id',
        'nama_dokumen',
        'jenis_dokumen',
        'file_path',
        'ukuran_file',
        'tipe_file',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
