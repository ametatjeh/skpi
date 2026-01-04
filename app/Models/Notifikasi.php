<?php
// app/Models/Notifikasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'is_read',
        'link',
        'read_at',
    ];

    // Disable updated_at karena tidak diperlukan
    const UPDATED_AT = null;

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    /**
     * Relationship: Notifikasi belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope: Get unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope: Get read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope: Get notifications by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('tipe', $type);
    }

    /**
     * Scope: Get recent notifications (last 30 days)
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope: Get notifications for specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }
    }

    /**
     * Mark notification as unread
     */
    public function markAsUnread()
    {
        if ($this->is_read) {
            $this->update([
                'is_read' => false,
                'read_at' => null
            ]);
        }
    }

    /**
     * Check if notification is urgent (based on type)
     */
    public function isUrgent()
    {
        return in_array($this->tipe, ['warning', 'error', 'critical']);
    }

    /**
     * Get icon class based on notification type
     */
    public function getIconClassAttribute()
    {
        $icons = [
            'info' => 'fa-info-circle text-info',
            'success' => 'fa-check-circle text-success',
            'warning' => 'fa-exclamation-triangle text-warning',
            'error' => 'fa-times-circle text-danger',
            'approval' => 'fa-clipboard-check text-primary',
        ];

        return $icons[$this->tipe] ?? 'fa-bell text-secondary';
    }

    /**
     * Get notification color class
     */
    public function getColorClassAttribute()
    {
        $colors = [
            'info' => 'alert-info',
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-danger',
            'approval' => 'alert-primary',
        ];

        return $colors[$this->tipe] ?? 'alert-secondary';
    }
}
