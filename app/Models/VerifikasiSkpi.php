<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiSkpi extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_skpi';

    protected $fillable = [
        'mahasiswa_id',
        'prodi_id',
        'verifiable_type',      // Polymorphic: App\Models\SertifikasiKompetensi, dll
        'verifiable_id',        // ID dari achievement (sertifikasi, prestasi, dll)
        'level_verifikasi',     // prodi, fakultas, pusat_bahasa, dekan
        'status',               // pending, approved, rejected, revision_required
        'verifikator_id',       // User ID yang melakukan verifikasi
        'verifikator_role',     // kaprodi, wadek1, staff_pusat_bahasa, dekan
        'tanggal_pengajuan',
        'tanggal_verifikasi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===== RELATIONSHIPS =====

    /**
     * Relationship: VerifikasiSkpi belongs to Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function verifiable()
    {
        return $this->morphTo();
    }




    /**
     * Relationship: VerifikasiSkpi belongs to Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    /**
     * Relationship: VerifikasiSkpi belongs to User (verifikator)
     */
    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }

    /**
     * Polymorphic relationship: Get the achievement being verified
     * Could be: SertifikasiKompetensi, Prestasi, Organisasi, dll
     */

    /**
     * Relationship: VerifikasiSkpi has many ApprovalLogs
     */
    public function approvalLogs()
    {
        return $this->hasMany(ApprovalLog::class, 'verifikasi_skpi_id');
    }

    // ===== SCOPES =====

    /**
     * Scope: Get verifikasi by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Get pending verifikasi
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Get approved verifikasi
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope: Get rejected verifikasi
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope: Get verifikasi by level
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level_verifikasi', $level);
    }

    /**
     * Scope: Get verifikasi for specific mahasiswa
     */
    public function scopeForMahasiswa($query, $mahasiswaId)
    {
        return $query->where('mahasiswa_id', $mahasiswaId);
    }

    /**
     * Scope: Get verifikasi for specific prodi
     */
    public function scopeForProdi($query, $prodiId)
    {
        return $query->where('prodi_id', $prodiId);
    }

    // ===== HELPER METHODS =====

    /**
     * Check if verifikasi is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if verifikasi is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if verifikasi is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
    public function dokumenPendukung()
    {
        // Relasi berdasarkan mahasiswa_id (BUKAN verifikasi_skpi_id!)
        return $this->hasMany(\App\Models\DokumenPendukung::class, 'mahasiswa_id', 'mahasiswa_id');
    }



    // ===== ACCESSORS (untuk View) =====

    /**
     * ✅ ACCESSOR: Status Badge class untuk UI
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            'revision_required' => 'badge-info'
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }

    /**
     * ✅ ACCESSOR: Status Label dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'revision_required' => 'Perlu Revisi'
        ];

        return $labels[$this->status] ?? 'Tidak Diketahui';
    }

    /**
     * ✅ ACCESSOR: Level Verifikasi Label
     */
    public function getLevelLabelAttribute()
    {
        $levels = [
            'prodi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'pusat_bahasa' => 'Pusat Bahasa',
            'dekan' => 'Dekan'
        ];

        return $levels[$this->level_verifikasi] ?? 'Tidak Diketahui';
    }

    /**
     * Get achievement name (for display)
     */
    public function getAchievementNameAttribute()
    {
        if (!$this->verifiable) {
            return 'N/A';
        }

        // Get appropriate name field based on type
        switch ($this->verifiable_type) {
            case 'App\Models\SertifikasiKompetensi':
                return $this->verifiable->nama_sertifikasi ?? 'N/A';
            case 'App\Models\Prestasi':
                return $this->verifiable->judul_prestasi ?? 'N/A';
            case 'App\Models\Organisasi':
                return $this->verifiable->nama_organisasi ?? 'N/A';
            case 'App\Models\PengabdianMasyarakat':
                return $this->verifiable->judul_pkm ?? 'N/A';
            case 'App\Models\KaryaIlmiah':
                return $this->verifiable->judul_karya ?? 'N/A';
            case 'App\Models\Penghargaan':
                return $this->verifiable->nama_penghargaan ?? 'N/A';
            default:
                return 'Unknown';
        }
    }

    /**
     * Get achievement type display name
     */
    public function getAchievementTypeDisplayAttribute()
    {
        $types = [
            'App\Models\SertifikasiKompetensi' => 'Sertifikasi Kompetensi',
            'App\Models\Prestasi' => 'Prestasi',
            'App\Models\Organisasi' => 'Organisasi',
            'App\Models\PengabdianMasyarakat' => 'Pengabdian Masyarakat',
            'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
            'App\Models\Penghargaan' => 'Penghargaan',
        ];

        return $types[$this->verifiable_type] ?? 'Unknown';
    }

    /**
     * ✅ ACCESSOR: Achievement Type Label (Short)
     */
    public function getAchievementTypeLabelAttribute()
    {
        $types = [
            'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
            'App\Models\Prestasi' => 'Prestasi',
            'App\Models\Organisasi' => 'Organisasi',
            'App\Models\PengabdianMasyarakat' => 'PKM',
            'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
            'App\Models\Penghargaan' => 'Penghargaan',
        ];

        return $types[$this->verifiable_type] ?? 'Achievement';
    }

    /**
     * ✅ ACCESSOR: Achievement Type Icon
     */
    public function getAchievementTypeIconAttribute()
    {
        $icons = [
            'App\Models\SertifikasiKompetensi' => 'fa-certificate',
            'App\Models\Prestasi' => 'fa-trophy',
            'App\Models\Organisasi' => 'fa-users',
            'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
            'App\Models\KaryaIlmiah' => 'fa-book',
            'App\Models\Penghargaan' => 'fa-award',
        ];

        return $icons[$this->verifiable_type] ?? 'fa-file';
    }
}
