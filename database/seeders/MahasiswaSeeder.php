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
            'nik' => '1234567890123456',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Jl. Jend. Sudirman, Parepare',
            'tempat_tanggal_lahir' => 'Parepare, 15 Maret 2001',
            'tahun_masuk' => '2019',
            'angkatan' => '2019',
            'tanggal_masuk' => '2019-08-01',
            'status_mahasiswa' => 'Aktif',
            'tanggal_lulus' => '2023-09-20',
            'gelar' => 'Sarjana Komputer (S.Kom)',
            'no_ijazah' => 'UNIDA-2023-TI-0001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
