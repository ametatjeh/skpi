<?php
// app/Models/RoleAssignment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAssignment extends Model
{
    use HasFactory;

    protected $table = 'role_assignments';

    protected $fillable = [
        'user_id',
        'role_type',
        'prodi_id',
        'fakultas_id',
        'is_active',
        'assigned_at',
        'assigned_by',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'assigned_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: RoleAssignment belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship: RoleAssignment belongs to Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    /**
     * Relationship: RoleAssignment belongs to Fakultas
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    /**
     * Relationship: Assigned by User
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Scope: Get active role assignments
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Get role assignments by role type
     */
    public function scopeByRole($query, $roleType)
    {
        return $query->where('role_type', $roleType);
    }

    /**
     * Scope: Get role assignments for specific prodi
     */
    public function scopeForProdi($query, $prodiId)
    {
        return $query->where('prodi_id', $prodiId);
    }

    /**
     * Scope: Get role assignments for specific fakultas
     */
    public function scopeForFakultas($query, $fakultasId)
    {
        return $query->where('fakultas_id', $fakultasId);
    }

    /**
     * Scope: Get Kaprodi role assignments
     */
    public function scopeKaprodi($query)
    {
        return $query->where('role_type', 'kaprodi');
    }

    /**
     * Scope: Get Wadek1 role assignments
     */
    public function scopeWadek1($query)
    {
        return $query->where('role_type', 'wadek1');
    }

    /**
     * Scope: Get Dekan role assignments
     */
    public function scopeDekan($query)
    {
        return $query->where('role_type', 'dekan');
    }

    /**
     * Scope: Get Pusat Bahasa staff role assignments
     */
    public function scopePusatBahasa($query)
    {
        return $query->where('role_type', 'staff_pusat_bahasa');
    }

    /**
     * Activate this role assignment
     */
    public function activate()
    {
        if (!$this->is_active) {
            $this->update(['is_active' => true]);
        }
    }

    /**
     * Deactivate this role assignment
     */
    public function deactivate()
    {
        if ($this->is_active) {
            $this->update(['is_active' => false]);
        }
    }

    /**
     * Check if role is bound to prodi
     */
    public function isBoundToProdi()
    {
        return in_array($this->role_type, ['kaprodi']);
    }

    /**
     * Check if role is bound to fakultas
     */
    public function isBoundToFakultas()
    {
        return in_array($this->role_type, ['wadek1', 'dekan']);
    }

    /**
     * Check if role is global (not bound to prodi/fakultas)
     */
    public function isGlobalRole()
    {
        return in_array($this->role_type, ['staff_pusat_bahasa', 'staff_bpm', 'admin_biro', 'super_admin']);
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayNameAttribute()
    {
        $roles = [
            'kaprodi' => 'Kepala Program Studi',
            'wadek1' => 'Wakil Dekan I',
            'staff_pusat_bahasa' => 'Staff Pusat Bahasa',
            'dekan' => 'Dekan',
            'staff_bpm' => 'Staff Badan Penjaminan Mutu',
            'admin_biro' => 'Admin Biro Akademik',
            'super_admin' => 'Super Administrator',
        ];

        return $roles[$this->role_type] ?? $this->role_type;
    }

    /**
     * Get scope description (prodi/fakultas name or 'Global')
     */
    public function getScopeDescriptionAttribute()
    {
        if ($this->prodi_id) {
            return 'Prodi: ' . ($this->prodi->nama_prodi ?? 'Unknown');
        }

        if ($this->fakultas_id) {
            return 'Fakultas: ' . ($this->fakultas->nama_fakultas ?? 'Unknown');
        }

        return 'Global';
    }
}
