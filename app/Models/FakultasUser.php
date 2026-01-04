<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FakultasUser extends Authenticatable
{
    use Notifiable;

    // Penamaan tabel di database
    protected $table = 'fakultas_users';

    // Field yang boleh diisi/assign massal
    protected $fillable = [
        'fakultas_id',
        'name',
        'email',
        'password',
        'is_activated',
        'activation_token',
        'activation_token_expires_at',
    ];

    // Field yang disembunyikan di serialisasi/jika dikirim ke API/json
    protected $hidden = [
        'password',
        'activation_token',
    ];

    // Cast otomatis ke tipe data yang benar
    protected $casts = [
        'is_activated' => 'boolean',
        'activation_token_expires_at' => 'datetime',
    ];

    // Relasi ke model Fakultas (jika ada)
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
}
