<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DraftSkpi extends Model
{
    protected $table = 'draft_skpi';

    protected $fillable = [
        'mahasiswa_id',
        'prodi_id',
        'nomor_skpi',
        'tahun_lulus',
        'status',
        'tanggal_pengesahan',
        'file_path',
        'catatan',
        'ringkasan_id',  // Ringkasan Bahasa Indonesia
        'ringkasan_en',  // Ringkasan English
    ];

    protected $casts = [
        'tanggal_pengesahan' => 'date', // ← CAST KE DATE
    ];

    /** ===== RELASI ===== */

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function verifikasiSkpi()
    {
        return $this->hasMany(VerifikasiSkpi::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function approvalLogs()
    {
        return $this->hasMany(ApprovalLog::class, 'draft_skpi_id');
    }

    /** ===== SCOPES UNTUK DASHBOARD ===== */

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeFinal($query)
    {
        return $query->where('status', 'final');
    }

    /** ===== HELPER METHOD: FORMAT TANGGAL PENGESAHAN ===== */

    /**
     * Get formatted tanggal pengesahan (Bahasa Indonesia)
     * @return string
     */
    public function getTanggalPengesahanFormatted()
    {
        if ($this->tanggal_pengesahan) {
            return Carbon::parse($this->tanggal_pengesahan)->translatedFormat('d F Y');
        }
        return Carbon::now()->translatedFormat('d F Y');
    }

    /**
     * Get formatted tanggal pengesahan (English)
     * @return string
     */
    public function getTanggalPengesahanEnFormatted()
    {
        if ($this->tanggal_pengesahan) {
            return Carbon::parse($this->tanggal_pengesahan)->format('F d, Y');
        }
        return Carbon::now()->format('F d, Y');
    }
}
