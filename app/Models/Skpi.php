<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    use HasFactory;

    protected $table = 'skpi';

    protected $fillable = [
        'mahasiswa_id',
        'status',
        'tanggal_pengajuan',
        'nomor_skpi',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // ===== RELATIONSHIPS =====

    /**
     * Relationship ke Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // ===== SCOPES =====

    /**
     * Filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Filter by mahasiswa
     */
    public function scopeByMahasiswa($query, $mahasiswaId)
    {
        return $query->where('mahasiswa_id', $mahasiswaId);
    }

    /**
     * Get draft SKPI
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Get submitted SKPI
     */
    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    // ===== ACCESSORS & MUTATORS =====

    /**
     * Get status badge class untuk styling
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'status-lainnya',
            'submitted' => 'status-diverifikasi',
            'final' => 'status-diverifikasi',
            'diverifikasi_prodi' => 'status-diverifikasi',
            'ditolak_prodi' => 'status-ditolak',
        ];

        return $badges[$this->status] ?? 'status-lainnya';
    }

    /**
     * Get status label untuk display
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'draft' => 'Draft',
            'submitted' => 'Submitted',
            'final' => 'Final',
            'diverifikasi_prodi' => 'Diverifikasi Prodi',
            'ditolak_prodi' => 'Ditolak Prodi',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at?->format('d M Y H:i') ?? '-';
    }
}
