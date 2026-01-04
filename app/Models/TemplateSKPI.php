<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSkpi extends Model
{
    use HasFactory;

    protected $table = 'template_skpi';

    protected $fillable = [
        'nama_pt',
        'alamat_pt',
        'bahasa_pengantar',
        'sk_pendirian',
        'status_akreditasi',
        'nomor_sk_akreditasi',
        'nomor_sk_pt',
        'persyaratan_penerimaan',
        'sistem_penilaian',
        'lama_studi_reguler',
    ];
}
