<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rektor UNIDA',
            'email' => 'rektor@unida-aceh.ac.id',
            'role' => 'rektor',
            'password' => Hash::make('Password123'),
            'is_activated' => true,
        ]);
    }
}
