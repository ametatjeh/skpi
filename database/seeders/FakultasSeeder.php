<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fakultas')->insert([
            [
                'nama_fakultas' => 'Fakultas Teknik',
                'dekan' => 'Dr. Ir. Muhammad Ali, M.Eng',
                'akreditasi' => 'A',
                'no_sk' => 'SK-FT-2023-001',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
                'dekan' => 'Dr. Siti Rahma, SE., M.Si',
                'akreditasi' => 'B',
                'no_sk' => 'SK-FEB-2022-010',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
