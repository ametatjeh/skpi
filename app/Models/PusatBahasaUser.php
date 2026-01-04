<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PusatBahasaUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'pusat_bahasa_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_activated',
        'role', // tambahkan ini kalau memang ada kolomnya
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
    ];
}
