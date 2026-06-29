@extends('fakultas.layouts.app')
@section('title', 'Timeline Verifikasi')

@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .timeline-container { position:relative; padding-left:40px; }
    .timeline-container::before { content:''; position:absolute; left:18px; top:0; bottom:0; width:3px; background:linear-gradient(180deg,#7c3aed,#a78bfa,#e5e7eb); border-radius:2px; }
    .timeline-item { position:relative; margin-bottom:24px; }
    .timeline-dot { position:absolute; left:-32px; top:6px; width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:10px; color:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.15); }
    .timeline-dot.approved { background:linear-gradient(135deg,#22c55e,#34d399); }
    .timeline-dot.rejected { background:linear-gradient(135deg,#ef4444,#f87171); }
    .timeline-dot.pending { background:linear-gradient(135deg,#f59e0b,#fbbf24); }
    .timeline-dot.default { background:linear-gradient(135deg,#7c3aed,#a78bfa); }

    .timeline-card { background:#fff; border-radius:14px; padding:18px 22px; border:1px solid #e5e7eb; box-shadow:0 2px 8px rgba(0,0,0,0.04); transition:all 0.2s; }
    .timeline-card:hover { box-shadow:0 6px 20px rgba(0,0,0,0.08); transform:translateX(4px); }
    .timeline-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
    .timeline-title { font-size:15px; font-weight:700; color:#111827; }
    .timeline-time { font-size:12px; color:#9ca3af; display:flex; align-items:center; gap:4px; }
    .timeline-body { font-size:13px; color:#6b7280; line-height:1.5; }
    .timeline-meta { display:flex; gap:12px; margin-top:8px; flex-wrap:wrap; }
    .timeline-tag { padding:3px 10px; background:#f3e8ff; color:#7c3aed; border-radius:6px; font-size:11px; font-weight:600; }
    .empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
    .empty-state i { font-size:48px; opacity:0.4; margin-bottom:12px; color:#a78bfa; display:block; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-stream" style="margin-right:10px"></i> Timeline Verifikasi</h1>
        <p>Urutan kronologis proses verifikasi SKPI</p>
    </div>

    <div class="timeline-container">
        @forelse($logs ?? [] as $log)
            @php
                $action = $log->action ?? 'default';
                $dotClass = match($action) {
                    'approved', 'approve' => 'approved',
                    'rejected', 'reject' => 'rejected',
                    'revision', 'revisi' => 'pending',
                    default => 'default',
                };
                $icon = match($action) {
                    'approved', 'approve' => 'fa-check',
                    'rejected', 'reject' => 'fa-times',
                    'revision', 'revisi' => 'fa-undo',
                    default => 'fa-circle',
                };
            @endphp
            <div class="timeline-item">
                <div class="timeline-dot {{ $dotClass }}"><i class="fas {{ $icon }}"></i></div>
                <div class="timeline-card">
                    <div class="timeline-header">
                        <div class="timeline-title">{{ ucfirst(str_replace('_', ' ', $action)) }}</div>
                        <div class="timeline-time">
                            <i class="fas fa-clock"></i>
                            {{ $log->created_at ? $log->created_at->diffForHumans() : '-' }}
                        </div>
                    </div>
                    <div class="timeline-body">
                        <strong>{{ $log->draftSkpi->mahasiswa->nama ?? '-' }}</strong>
                        ({{ $log->draftSkpi->mahasiswa->nim ?? '-' }})
                        @if($log->catatan)
                            <br><em>"{{ $log->catatan }}"</em>
                        @endif
                    </div>
                    <div class="timeline-meta">
                        <span class="timeline-tag">{{ $log->performed_by_name ?? $log->performed_by_role ?? 'Sistem' }}</span>
                        <span class="timeline-tag">{{ $log->created_at ? $log->created_at->format('d M Y H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-stream"></i>
                <h4 style="font-size:16px;font-weight:600;color:#6b7280;margin:0 0 6px 0">Belum Ada Aktivitas</h4>
                <p>Timeline verifikasi akan muncul setelah ada proses approval</p>
            </div>
        @endforelse
    </div>

    @if(method_exists($logs ?? collect(), 'links'))
        <div style="margin-top:20px;display:flex;justify-content:center">{{ $logs->links() }}</div>
    @endif
@endsection
