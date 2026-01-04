<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_code';
    public $timestamps = false;

    protected $fillable = [
        'skpi_id',
        'mahasiswa_id',
        'qr_code_string',
        'qr_image_path',
        'is_active',
        'expired_at',
        'created_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expired_at' => 'datetime',
        'created_at' => 'datetime'
    ];

    // ===== RELATIONSHIPS =====

    public function skpi()
    {
        return $this->belongsTo(Skpi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // ===== SCOPES =====

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    // ===== METHODS =====

    public function isExpired()
    {
        if (!$this->expired_at) {
            return false;
        }
        return now()->isAfter($this->expired_at);
    }

    public function deactivate()
    {
        return $this->update(['is_active' => false]);
    }
}
