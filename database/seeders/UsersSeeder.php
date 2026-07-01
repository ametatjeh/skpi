<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $ftId = DB::table('fakultas')->where('nama_fakultas', 'Fakultas Teknik')->value('id');
        $tiId = DB::table('prodi')->where('nama_prodi', 'Teknik Informatika')->value('id');

        $users = [
            ['name' => 'Ahmad Mahasiswa', 'email' => 'ahmad@unida-aceh.ac.id', 'role' => 'mahasiswa', 'prodi_id' => $tiId, 'fakultas_id' => $ftId],
            ['name' => 'Admin Prodi Teknik Informatika', 'email' => 'prodi.ti@unida-aceh.ac.id', 'role' => 'prodi', 'prodi_id' => $tiId, 'fakultas_id' => $ftId],
            ['name' => 'Wakil Dekan I FT', 'email' => 'wd1.ft@unida-aceh.ac.id', 'role' => 'fakultas', 'prodi_id' => null, 'fakultas_id' => $ftId],
            ['name' => 'Petugas Pusat Bahasa', 'email' => 'pusatbahasa@unida-aceh.ac.id', 'role' => 'pusat_bahasa', 'prodi_id' => null, 'fakultas_id' => null],
            ['name' => 'Biro Akademik UNIDA', 'email' => 'akademik@unida-aceh.ac.id', 'role' => 'biro_akademik', 'prodi_id' => null, 'fakultas_id' => null],
            ['name' => 'Petugas BPM', 'email' => 'bpm@unida-aceh.ac.id', 'role' => 'bpm', 'prodi_id' => null, 'fakultas_id' => null],
            ['name' => 'Rektor UNIDA', 'email' => 'rektor@unida-aceh.ac.id', 'role' => 'rektorat', 'prodi_id' => null, 'fakultas_id' => null]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'prodi_id' => $user['prodi_id'],
                'fakultas_id' => $user['fakultas_id'],
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
