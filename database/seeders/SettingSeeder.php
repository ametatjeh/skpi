<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'setting_key' => 'sla_verifikasi_prodi',
                'setting_value' => '3',
                'setting_type' => 'number',
                'description' => 'SLA (Batas Waktu) Verifikasi Prodi dalam hari'
            ],
            [
                'setting_key' => 'sla_validasi_wakil_dekan',
                'setting_value' => '2',
                'setting_type' => 'number',
                'description' => 'SLA (Batas Waktu) Validasi Wakil Dekan dalam hari'
            ],
            [
                'setting_key' => 'sla_validasi_dekan',
                'setting_value' => '2',
                'setting_type' => 'number',
                'description' => 'SLA (Batas Waktu) Validasi Dekan dalam hari'
            ],
            [
                'setting_key' => 'max_upload_file_size',
                'setting_value' => '2048',
                'setting_type' => 'number',
                'description' => 'Maksimal ukuran file upload (dalam KB)'
            ],
            [
                'setting_key' => 'enable_email_notification',
                'setting_value' => '0',
                'setting_type' => 'boolean',
                'description' => 'Aktifkan notifikasi email'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['setting_key' => $setting['setting_key']],
                [
                    'setting_value' => $setting['setting_value'],
                    'setting_type' => $setting['setting_type'],
                    'description' => $setting['description'],
                ]
            );
        }
        
        $this->command->info('Settings have been imported to database successfully.');
    }
}
