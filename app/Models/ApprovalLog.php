<?php
// app/Models/ApprovalLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLog extends Model
{
    use HasFactory;

    protected $table = 'approval_log';

    protected $fillable = [
        'draft_skpi_id',

        'verifikasi_skpi_id',
        'approver_id',
        'approver_role',
        'action',
        'status_from',
        'status_to',
        'catatan',
    ];

    // Disable updated_at karena ini log (immutable)
    const UPDATED_AT = null;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Relationship: ApprovalLog belongs to VerifikasiSkpi
     */
    public function verifikasiSkpi()
    {
        return $this->belongsTo(VerifikasiSkpi::class, 'verifikasi_skpi_id');
    }

    public function draftSkpi()
    {
        return $this->hasMany(\App\Models\DraftSkpi::class, 'prodi_id', 'id');
    }


    /**
     * Relationship: ApprovalLog belongs to User (approver)
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    /**
     * Scope: Get logs by action type
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope: Get logs by approver role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('approver_role', $role);
    }

    /**
     * Scope: Get approval logs (approved only)
     */
    public function scopeApproved($query)
    {
        return $query->where('action', 'approve');
    }

    /**
     * Scope: Get rejection logs
     */
    public function scopeRejected($query)
    {
        return $query->where('action', 'reject');
    }

    /**
     * Scope: Get system actions (auto-forwarded, etc)
     */
    public function scopeSystemActions($query)
    {
        return $query->where('approver_role', 'system');
    }

    /**
     * Check if this is a system action
     */
    public function isSystemAction()
    {
        return $this->approver_role === 'system';
    }

    /**
     * Get formatted action text
     */
    public function getActionTextAttribute()
    {
        $actions = [
            'approve' => 'Disetujui',
            'reject' => 'Ditolak',
            'submit' => 'Diajukan',
            'submitted' => 'Diajukan',
            'auto_forward' => 'Diteruskan Otomatis',
            'revision_request' => 'Permintaan Revisi',
        ];

        return $actions[$this->action] ?? $this->action;
    }
}
