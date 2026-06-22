<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Auth Guard & Password Reset
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => 'web',      // default: mahasiswa (users)
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [

        // Mahasiswa & user umum
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // Admin (tabel admin_users)
        'admin' => [
            'driver'   => 'session',
            'provider' => 'admin_users',
        ],

        // Prodi
        'prodi' => [
            'driver'   => 'session',
            'provider' => 'prodis',
        ],

        // Fakultas
        'fakultas' => [
            'driver'   => 'session',
            'provider' => 'fakultas_users',
        ],

        // Pusat Bahasa
        'pusat_bahasa' => [
            'driver'   => 'session',
            'provider' => 'pusat_bahasa_users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [

        // Mahasiswa (tabel users)
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // Admin (tabel admin_users)
        'admin_users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // Operator Prodi (tabel prodi_users)
        'prodis' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // Operator Fakultas (tabel fakultas_users)
        'fakultas_users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // Operator Pusat Bahasa (tabel pusat_bahasa_users)
        'pusat_bahasa_users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    */
    'passwords' => [

        // Reset password user (mahasiswa)
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
            'throttle' => 60,
        ],

        // Jika ingin reset password prodi, bisa pakai provider prodis
        'prodis' => [
            'provider' => 'prodis',
            'table'    => 'password_resets',
            'expire'   => 60,
            'throttle' => 60,
        ],

        // (opsional) tambah reset untuk admin/prodi/fakultas/pusat_bahasa jika perlu
        // 'admins' => [...],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => 10800,

];
