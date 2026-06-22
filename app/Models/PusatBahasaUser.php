<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PusatBahasaUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_activated',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'pusat_bahasa');
        });
        static::creating(function ($model) {
            $model->role = 'pusat_bahasa';
        });
    }
}
