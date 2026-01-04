<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'prodi_id',
        'name',
        'email',
        'password',
        'is_activated',
        'activation_token',
        'activation_token_expires_at',
        'role',
        'signature_path'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
        'activation_token_expires_at' => 'datetime',
    ];

    // Cek role
    public function isRole($role)
    {
        return $this->role === $role;
    }

    // Relasi ke mahasiswa (via user_id)
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    // Relasi ke prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
