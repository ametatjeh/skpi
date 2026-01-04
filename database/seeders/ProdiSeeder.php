<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $ft = DB::table('fakultas')->where('nama_fakultas', 'Fakultas Teknik')->value('id');
        $feb = DB::table('fakultas')->where('nama_fakultas', 'Fakultas Ekonomi dan Bisnis')->value('id');

        DB::table('prodi')->insert([
            [
                'fakultas_id' => $ft,
                'nama_prodi' => 'Teknik Informatika',
                'kaprodi' => 'Ir. Andi Surya, M.Kom',
                'akreditasi' => 'A',
                'no_sk' => 'SK-PRODI-TI-2023-011',
                'jenjang_kkni' => 'Level 6',
                'bahasa_pengantar' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'fakultas_id' => $feb,
                'nama_prodi' => 'Manajemen',
                'kaprodi' => 'Dr. Hj. Nurhayati, MM',
                'akreditasi' => 'B',
                'no_sk' => 'SK-PRODI-MNJ-2022-008',
                'jenjang_kkni' => 'Level 6',
                'bahasa_pengantar' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
