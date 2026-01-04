<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CplSeeder extends Seeder
{
    public function run(): void
    {
        $prodiId = DB::table('prodi')->where('nama_prodi', 'Teknik Informatika')->value('id');

        $cpl = [
            ['kategori' => 'sikap', 'deskripsi' => 'Bertakwa kepada Tuhan YME dan menjunjung tinggi nilai kemanusiaan.'],
            ['kategori' => 'pengetahuan', 'deskripsi' => 'Menguasai konsep sistem informasi dan komputasi.'],
            ['kategori' => 'keterampilan_umum', 'deskripsi' => 'Mampu berkomunikasi efektif dan bekerja dalam tim.'],
            ['kategori' => 'keterampilan_khusus', 'deskripsi' => 'Mampu merancang dan mengembangkan perangkat lunak.']
        ];

        foreach ($cpl as $c) {
            DB::table('cpl')->insert([
                'prodi_id' => $prodiId,
                'kategori' => $c['kategori'],
                'deskripsi' => $c['deskripsi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
