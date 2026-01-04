<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Str;
use App\Jobs\SendActivationEmailJob;

class GenerateUserAccounts extends Command
{
    protected $signature = 'users:generate';
    protected $description = 'Generate user accounts from mahasiswa data';

    public function handle()
    {
        $mahasiswa = Mahasiswa::whereNotNull('email')
            ->whereDoesntHave('user') // Hanya yang belum punya akun
            ->get();

        $this->info("Generating {$mahasiswa->count()} user accounts...");

        foreach ($mahasiswa as $mhs) {
            $user = User::create([
                'nim' => $mhs->nim,
                'prodi_id' => $mhs->prodi_id,
                'name' => $mhs->nama,
                'email' => $mhs->email,
                'role' => 'mahasiswa',
                'is_activated' => false,
                'activation_token' => Str::random(60),
                'activation_token_expires_at' => now()->addDays(7),
            ]);

            // Dispatch job untuk kirim email
            SendActivationEmailJob::dispatch($user);

            $this->info("User created for: {$mhs->nama}");
        }

        $this->info('Done!');
    }
}
