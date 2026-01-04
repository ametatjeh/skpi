<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpiFinal extends Model
{
    use HasFactory;

    protected $table = 'skpi_final';

    protected $fillable = [
        'mahasiswa_id',
        'nomor_skpi',
        'status',
        'approved_by_prodi',
        'approved_by_fakultas',
        'translated_by',
        'signed_by_dekan',
        'approved_prodi_at',
        'approved_fakultas_at',
        'translated_at',
        'signed_dekan_at',
        'pdf_path_id',
        'pdf_path_en',
        'qr_code_id',
        'printed_at',
        'printed_by',
        'blanko_serial',
        'distributed_at',
        'distributed_by',
        'received_by_mahasiswa',
        'received_at',
        'validated_by_bpm',
        'validated_bpm_at',
    ];

    protected $casts = [
        'approved_prodi_at' => 'datetime',
        'approved_fakultas_at' => 'datetime',
        'translated_at' => 'datetime',
        'signed_dekan_at' => 'datetime',
        'printed_at' => 'datetime',
        'distributed_at' => 'datetime',
        'received_at' => 'datetime',
        'validated_bpm_at' => 'datetime',
        'received_by_mahasiswa' => 'boolean',
    ];

    /**
     * Relationship: SkpiFinal belongs to Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    /**
     * Relationship: SkpiFinal has QR Code
     */
    public function qrCode()
    {
        return $this->belongsTo(QrCode::class, 'qr_code_id');
    }

    /**
     * Relationship: Approved by Prodi (User)
     */
    public function approvedByProdi()
    {
        return $this->belongsTo(User::class, 'approved_by_prodi');
    }

    /**
     * Relationship: Approved by Fakultas (User)
     */
    public function approvedByFakultas()
    {
        return $this->belongsTo(User::class, 'approved_by_fakultas');
    }

    /**
     * Relationship: Translated by (User)
     */
    public function translatedBy()
    {
        return $this->belongsTo(User::class, 'translated_by');
    }

    /**
     * Relationship: Signed by Dekan (User)
     */
    public function signedByDekan()
    {
        return $this->belongsTo(User::class, 'signed_by_dekan');
    }

    /**
     * Relationship: Printed by (User)
     */
    public function printedBy()
    {
        return $this->belongsTo(User::class, 'printed_by');
    }

    /**
     * Relationship: Distributed by (User)
     */
    public function distributedBy()
    {
        return $this->belongsTo(User::class, 'distributed_by');
    }

    /**
     * Relationship: Validated by BPM (User)
     */
    public function validatedByBpm()
    {
        return $this->belongsTo(User::class, 'validated_by_bpm');
    }

    /**
     * Scope: Get SKPI yang ready to print
     */
    public function scopeReadyToPrint($query)
    {
        return $query->where('status', 'ready_to_print');
    }

    /**
     * Scope: Get SKPI yang sudah printed
     */
    public function scopePrinted($query)
    {
        return $query->where('status', 'printed');
    }

    /**
     * Scope: Get SKPI yang sudah distributed
     */
    public function scopeDistributed($query)
    {
        return $query->where('status', 'distributed');
    }

    /**
     * Check apakah SKPI sudah fully approved
     */
    public function isFullyApproved()
    {
        return !is_null($this->approved_prodi_at) &&
            !is_null($this->approved_fakultas_at) &&
            !is_null($this->translated_at) &&
            !is_null($this->signed_dekan_at);
    }

    /**
     * Check apakah SKPI ready untuk di-download mahasiswa
     */
    public function isReadyForDownload()
    {
        return $this->status === 'ready_to_print' ||
            $this->status === 'printed' ||
            $this->status === 'distributed';
    }
}
