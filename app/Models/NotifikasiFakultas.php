<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model NotifikasiFakultas
 * 
 * Extend dari Notifikasi dengan scope tambahan untuk konteks fakultas.
 * Memudahkan query notifikasi khusus user fakultas.
 */
class NotifikasiFakultas extends Notifikasi
{
    use HasFactory;

    /**
     * Scope: Get notifications for a specific fakultas
     * Filter berdasarkan user yang memiliki fakultas_id tertentu
     */
    public function scopeForFakultas($query, $fakultasId)
    {
        return $query->whereHas('user', function ($q) use ($fakultasId) {
            $q->where('fakultas_id', $fakultasId);
        });
    }

    /**
     * Scope: Get notifications for fakultas role users only
     */
    public function scopeFakultasOnly($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('role', 'fakultas');
        });
    }

    /**
     * Scope: Get unread notifications for a fakultas
     */
    public function scopeUnreadForFakultas($query, $fakultasId)
    {
        return $query->forFakultas($fakultasId)->unread();
    }

    /**
     * Get unread count for a specific fakultas
     */
    public static function unreadCountForFakultas($fakultasId)
    {
        return static::forFakultas($fakultasId)->unread()->count();
    }
}
