<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

// DATA ADMIN BARU (Silakan sesuaikan)
$email = 'akademik.baru@unida-aceh.ac.id';
$name = 'Akademik Baru';
$password = 'DaakaNew1mikX#';

// Cek apakah email sudah terdaftar
$exists = AdminUser::where('email', $email)->exists();

if (!$exists) {
    AdminUser::create([
        'name' => $name,
        'email' => $email,
        'role' => 'admin',
        'password' => Hash::make($password),
        'is_activated' => true,
    ]);
    echo "Admin baru berhasil dibuat!\n";
    echo "Email: " . $email . "\n";
    echo "Password: " . $password . "\n";
} else {
    echo "Gagal: Admin dengan email " . $email . " sudah ada di database.\n";
}
