<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->where('role', 'mahasiswa')->value('id');
        $prodiId = DB::table('prodi')->where('nama_prodi', 'Teknik Informatika')->value('id');

        DB::table('mahasiswa')->insert([
            'user_id' => $userId,
            'prodi_id' => $prodiId,
            'nim' => '215180001',
            'nama' => 'Ahmad Mahasiswa',
            'tempat_lahir' => 'Parepare',
            'tanggal_lahir' => '2001-03-15',
            'tahun_masuk' => '2019',
            'tanggal_lulus' => '2023-09-20',
            'gelar' => 'Sarjana Komputer (S.Kom)',
            'no_ijazah' => 'UMPAR-2023-TI-0001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
