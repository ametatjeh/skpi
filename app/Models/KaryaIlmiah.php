<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaIlmiah extends Model
{
    protected $table = 'karya_ilmiah';

    protected $fillable = [
        'mahasiswa_id',
        'judul_karya',
        'jenis_publikasi',
        'nama_jurnal_konferensi',
        'tahun_publikasi',
        'doi_issn',
        'deskripsi',
        'file_path',
        'status'
    ];

    // PENTING: Hanya cast sebagai integer, BUKAN date/datetime!
    protected $casts = [
        'tahun_publikasi' => 'integer',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
