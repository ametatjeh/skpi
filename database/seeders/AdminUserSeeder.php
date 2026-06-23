<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AdminUser::create([
            'name' => 'Administrator',
            'email' => 'humas@unida-aceh.ac.id',
            'role' => 'biro_akademik',
            'password' => bcrypt('password'),
            'is_activated' => true,
        ]);
    }
}
