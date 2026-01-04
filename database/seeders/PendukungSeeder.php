<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendukungSeeder extends Seeder
{
    public function run(): void
    {
        $mhs = DB::table('mahasiswa')->where('nim', '215180001')->value('id');

        DB::table('sertifikasi_kompetensi')->insert([
            'mahasiswa_id' => $mhs,
            'nama_sertifikasi' => 'TOEFL ITP',
            'lembaga_penerbit' => 'Lembaga Bahasa UMPAR',
            'tahun' => 2022,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('prestasi')->insert([
            'mahasiswa_id' => $mhs,
            'nama_kegiatan' => 'Juara 1 Lomba Coding Nasional',
            'tingkat' => 'nasional',
            'tahun' => 2023,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'mahasiswa_id' => $mhs,
            'nama_organisasi' => 'Himpunan Mahasiswa Informatika',
            'jabatan' => 'Ketua Umum',
            'periode' => '2022-2023',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pengabdian_masyarakat')->insert([
            'mahasiswa_id' => $mhs,
            'nama_kegiatan' => 'Pelatihan Komputer untuk Masyarakat',
            'tahun' => 2023,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
