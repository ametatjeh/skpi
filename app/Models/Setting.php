<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'description'
    ];

    // ===== STATIC METHODS =====

    public static function get($key, $default = null)
    {
        $setting = self::where('setting_key', $key)->first();

        if (!$setting) {
            return $default;
        }

        // Parse value berdasarkan type
        switch ($setting->setting_type) {
            case 'boolean':
                return $setting->setting_value === 'true' || $setting->setting_value === '1';
            case 'number':
                return (int) $setting->setting_value;
            case 'json':
                return json_decode($setting->setting_value, true);
            default:
                return $setting->setting_value;
        }
    }

    public static function set($key, $value, $type = 'text')
    {
        return self::updateOrCreate(
            ['setting_key' => $key],
            [
                'setting_value' => is_array($value) ? json_encode($value) : (string) $value,
                'setting_type' => $type
            ]
        );
    }

    // ===== HELPER METHODS =====

    public static function getSlaProdi()
    {
        return self::get('sla_verifikasi_prodi', 3);
    }

    public static function getSlaWakilDekan()
    {
        return self::get('sla_validasi_wakil_dekan', 2);
    }

    public static function getSlaDekan()
    {
        return self::get('sla_validasi_dekan', 2);
    }

    public static function getMaxUploadSize()
    {
        return self::get('max_upload_file_size', 2048); // KB
    }

    public static function isEmailNotificationEnabled()
    {
        return self::get('enable_email_notification', false);
    }
}
