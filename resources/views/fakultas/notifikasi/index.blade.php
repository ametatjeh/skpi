@extends('fakultas.layouts.app')
@section('title', 'Notifikasi')
@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .notif-list { display:flex; flex-direction:column; gap:12px; }
    .notif-item { background:#fff; border-radius:14px; padding:18px 22px; border:1px solid #e5e7eb; box-shadow:0 2px 8px rgba(0,0,0,0.04); display:flex; align-items:flex-start; gap:16px; transition:all 0.2s; }
    .notif-item:hover { box-shadow:0 6px 20px rgba(0,0,0,0.08); transform:translateX(4px); }
    .notif-item.unread { background:#f5f3ff; border-left:4px solid #7c3aed; }
    .notif-icon { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
    .notif-icon.info { background:linear-gradient(135deg,#dbeafe,#bfdbfe); color:#3b82f6; }
    .notif-icon.success { background:linear-gradient(135deg,#dcfce7,#bbf7d0); color:#22c55e; }
    .notif-icon.warning { background:linear-gradient(135deg,#fef3c7,#fde68a); color:#f59e0b; }
    .notif-icon.error { background:linear-gradient(135deg,#fee2e2,#fecaca); color:#ef4444; }
    .notif-icon.default { background:linear-gradient(135deg,#f3e8ff,#ede9fe); color:#7c3aed; }
    .notif-content { flex:1; min-width:0; }
    .notif-title { font-size:15px; font-weight:700; color:#111827; margin-bottom:4px; }
    .notif-message { font-size:13px; color:#6b7280; line-height:1.5; margin-bottom:6px; }
    .notif-time { font-size:11px; color:#9ca3af; display:flex; align-items:center; gap:4px; }
    .notif-actions { display:flex; flex-direction:column; gap:6px; align-items:flex-end; }
    .btn-read { padding:6px 14px; background:#f3e8ff; color:#7c3aed; border:none; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; transition:all 0.2s; }
    .btn-read:hover { background:#7c3aed; color:#fff; }
    .empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
    .empty-state i { font-size:56px; opacity:0.4; margin-bottom:14px; color:#a78bfa; display:block; }
</style>
@endpush
@section('content')
    <div class="page-header">
        <h1><i class="fas fa-bell" style="margin-right:10px"></i> Notifikasi</h1>
        <p>Semua notifikasi terkait proses SKPI di fakultas Anda</p>
    </div>

    <div class="notif-list">
        @forelse($notifikasi ?? [] as $notif)
            @php $iconType = $notif->tipe ?? 'default'; @endphp
            <div class="notif-item {{ $notif->is_read ? '' : 'unread' }}">
                <div class="notif-icon {{ $iconType }}">
                    <i class="fas {{ $notif->icon_class ?? 'fa-bell' }}"></i>
                </div>
                <div class="notif-content">
                    <div class="notif-title">{{ $notif->judul ?? 'Notifikasi' }}</div>
                    <div class="notif-message">{{ $notif->pesan ?? '' }}</div>
                    <div class="notif-time">
                        <i class="fas fa-clock"></i>
                        {{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}
                    </div>
                </div>
                <div class="notif-actions">
                    @if(!$notif->is_read)
                        <form method="POST" action="{{ route('fakultas.notifikasi.read', $notif->id) }}">
                            @csrf
                            <button type="submit" class="btn-read"><i class="fas fa-check"></i> Tandai Dibaca</button>
                        </form>
                    @else
                        <span style="font-size:11px;color:#22c55e;font-weight:600"><i class="fas fa-check-circle"></i> Dibaca</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <h4 style="font-size:18px;font-weight:600;color:#6b7280;margin:0 0 8px 0">Tidak Ada Notifikasi</h4>
                <p>Notifikasi baru akan muncul di sini</p>
            </div>
        @endforelse
    </div>

    @if(method_exists($notifikasi ?? collect(), 'links'))
        <div style="margin-top:20px;display:flex;justify-content:center">{{ $notifikasi->links() }}</div>
    @endif
@endsection
