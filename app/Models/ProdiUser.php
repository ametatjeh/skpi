<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ProdiUser extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'prodi_id',
        'name',
        'email',
        'password',
        'is_activated',
        'activation_token',
        'activation_token_expires_at',
        'role'
    ];

    protected $hidden = [
        'password',
        'activation_token',
    ];

    protected $casts = [
        'activation_token_expires_at' => 'datetime',
        'is_activated' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'prodi');
        });
        static::creating(function ($model) {
            $model->role = 'prodi';
        });
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
