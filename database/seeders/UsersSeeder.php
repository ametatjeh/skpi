<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Ahmad Mahasiswa', 'email' => 'ahmad@student.umpar.ac.id', 'role' => 'mahasiswa'],
            ['name' => 'Admin Prodi Teknik Informatika', 'email' => 'prodi.ti@umpar.ac.id', 'role' => 'prodi'],
            ['name' => 'Wakil Dekan I FT', 'email' => 'wd1.ft@umpar.ac.id', 'role' => 'fakultas'],
            ['name' => 'Petugas Pusat Bahasa', 'email' => 'pusatbahasa@umpar.ac.id', 'role' => 'pusat_bahasa'],
            ['name' => 'Biro Akademik UMPAR', 'email' => 'biroakademik@umpar.ac.id', 'role' => 'biro_akademik'],
            ['name' => 'Petugas BPM', 'email' => 'bpm@umpar.ac.id', 'role' => 'bpm'],
            ['name' => 'Rektor UMPAR', 'email' => 'rektor@umpar.ac.id', 'role' => 'rektorat']
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'),
                'role' => $user['role'],
                'signature_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
