<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'is_activated',
        'activation_token',
        'activation_token_expires_at',
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
}
