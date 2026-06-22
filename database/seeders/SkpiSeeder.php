<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkpiSeeder extends Seeder
{
    public function run(): void
    {
        $mhsId = DB::table('mahasiswa')->where('nim', '215180001')->value('id');

        $skpiId = DB::table('skpi')->insertGetId([
            'mahasiswa_id' => $mhsId,
            'nomor_skpi' => 'SKPI-UNIDA-2023-TI-0001',
            'status' => 'diajukan',
            'catatan' => 'Pengajuan SKPI oleh mahasiswa',
            'tanggal_pengajuan' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $prodiUser = DB::table('users')->where('role', 'prodi')->value('id');
        $tiId = DB::table('prodi')->where('nama_prodi', 'Teknik Informatika')->value('id');

        DB::table('verifikasi_skpi')->insert([
            'mahasiswa_id' => $mhsId,
            'prodi_id' => $tiId,
            'verifiable_type' => 'App\\Models\\Skpi',
            'verifiable_id' => $skpiId,
            'level_verifikasi' => 'prodi',
            'status' => 'pending',
            'verifikator_id' => $prodiUser,
            'verifikator_role' => 'prodi',
            'tanggal_pengajuan' => now(),
            'catatan' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
