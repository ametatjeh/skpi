{{-- resources/views/fakultas/components/notification-bell.blade.php --}}
@php
    $notifUser = auth('fakultas')->user();
    $unreadNotifs = \App\Models\Notifikasi::where('user_id', $notifUser->id ?? 0)
        ->where('is_read', false)
        ->orderByDesc('created_at')
        ->limit(5)
        ->get();
    $unreadCount = $unreadNotifs->count();
@endphp

<style>
    .notif-bell-wrapper {
        position: relative;
        display: inline-flex;
    }

    .notif-bell-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 10px;
        color: #6b7280;
        font-size: 18px;
        transition: all 0.2s;
        position: relative;
    }

    .notif-bell-btn:hover {
        background: rgba(124, 58, 237, 0.08);
        color: #7c3aed;
    }

    .notif-bell-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 18px;
        height: 18px;
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: #fff;
        border-radius: 50%;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
    }

    .notif-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        width: 340px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        border: 1px solid #e5e7eb;
        z-index: 999;
        overflow: hidden;
        margin-top: 8px;
    }

    .notif-bell-wrapper.open .notif-dropdown {
        display: block;
        animation: notifFadeIn 0.2s ease;
    }

    @keyframes notifFadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .notif-dropdown-header {
        padding: 14px 18px;
        background: linear-gradient(135deg, #faf5ff, #f3e8ff);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .notif-dropdown-header h4 {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .notif-dropdown-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .notif-dropdown-item {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        transition: background 0.15s;
        text-decoration: none;
        color: inherit;
    }

    .notif-dropdown-item:hover {
        background: #faf5ff;
    }

    .notif-dropdown-item.unread {
        background: #f5f3ff;
        border-left: 3px solid #7c3aed;
    }

    .notif-item-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #7c3aed, #a78bfa);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .notif-item-content {
        flex: 1;
        min-width: 0;
    }

    .notif-item-title {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .notif-item-time {
        font-size: 11px;
        color: #9ca3af;
    }

    .notif-dropdown-footer {
        padding: 12px 18px;
        text-align: center;
        border-top: 1px solid #f1f5f9;
    }

    .notif-dropdown-footer a {
        font-size: 13px;
        font-weight: 600;
        color: #7c3aed;
        text-decoration: none;
    }

    .notif-dropdown-footer a:hover {
        text-decoration: underline;
    }

    .notif-empty {
        padding: 28px;
        text-align: center;
        color: #9ca3af;
        font-size: 13px;
    }

    .notif-empty i {
        font-size: 28px;
        opacity: 0.4;
        display: block;
        margin-bottom: 8px;
        color: #a78bfa;
    }
</style>

<div class="notif-bell-wrapper" id="notifBellWrapper">
    <button type="button" class="notif-bell-btn" onclick="toggleNotifDropdown()">
        <i class="fas fa-bell"></i>
        @if($unreadCount > 0)
            <span class="notif-bell-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
        @endif
    </button>

    <div class="notif-dropdown">
        <div class="notif-dropdown-header">
            <h4><i class="fas fa-bell" style="margin-right:6px;color:#7c3aed"></i> Notifikasi</h4>
            @if($unreadCount > 0)
                <span style="font-size:11px;color:#7c3aed;font-weight:600">{{ $unreadCount }} baru</span>
            @endif
        </div>
        <div class="notif-dropdown-list">
            @forelse($unreadNotifs as $notif)
                <a href="{{ $notif->link ?? '#' }}" class="notif-dropdown-item {{ $notif->is_read ? '' : 'unread' }}">
                    <div class="notif-item-icon">
                        <i class="fas {{ $notif->icon_class ?? 'fa-bell' }}"></i>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-title">{{ $notif->judul ?? 'Notifikasi' }}</div>
                        <div class="notif-item-time">
                            <i class="fas fa-clock"></i>
                            {{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="notif-empty">
                    <i class="fas fa-check-circle"></i>
                    Tidak ada notifikasi baru
                </div>
            @endforelse
        </div>
        <div class="notif-dropdown-footer">
            <a href="{{ route('fakultas.notifikasi.index') }}">
                <i class="fas fa-arrow-right"></i> Lihat Semua Notifikasi
            </a>
        </div>
    </div>
</div>

<script>
    function toggleNotifDropdown() {
        document.getElementById('notifBellWrapper').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        var w = document.getElementById('notifBellWrapper');
        if (w && !w.contains(e.target)) w.classList.remove('open');
    });
</script>
