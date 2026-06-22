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
            'penerbit' => 'Lembaga Bahasa UNIDA',
            'tanggal_terbit' => '2022-01-01',
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('prestasi')->insert([
            'mahasiswa_id' => $mhs,
            'judul_prestasi' => 'Juara 1 Lomba Coding Nasional',
            'tingkat' => 'nasional',
            'tanggal_perolehan' => '2023-05-15',
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'mahasiswa_id' => $mhs,
            'nama_organisasi' => 'Himpunan Mahasiswa Informatika',
            'posisi' => 'Ketua Umum',
            'tahun_masuk' => '2022',
            'tahun_keluar' => '2023',
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pengabdian_masyarakat')->insert([
            'mahasiswa_id' => $mhs,
            'judul_pkm' => 'Pelatihan Komputer untuk Masyarakat',
            'tahun_pelaksanaan' => '2023',
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
