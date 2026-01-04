<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ProdiUser extends Authenticatable
{
    protected $table = 'prodi_users';

    protected $fillable = [
        'prodi_id',
        'name',
        'email',
        'password',
        'is_activated',
        'activation_token',
        'activation_token_expires_at',
    ];

    protected $hidden = [
        'password',
        'activation_token',
    ];

    protected $casts = [
        'activation_token_expires_at' => 'datetime',
        'is_activated' => 'boolean',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
