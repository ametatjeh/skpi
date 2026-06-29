@extends('fakultas.layouts.app')
@section('title', 'Draft SKPI Menunggu Keputusan')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(124,58,237,0.25);
    }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }
    .tab-nav { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; }
    .tab-btn {
        padding:10px 20px; border-radius:10px; text-decoration:none;
        font-size:13px; font-weight:600; display:inline-flex; align-items:center; gap:8px;
        transition:all 0.2s; border:2px solid #e5e7eb; color:#6b7280; background:#fff;
    }
    .tab-btn:hover { border-color:#7c3aed; color:#7c3aed; }
    .tab-btn.active { background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-color:#7c3aed; box-shadow:0 4px 12px rgba(124,58,237,0.35); }
    .tab-badge { padding:2px 8px; border-radius:12px; font-size:10px; font-weight:700; }
    .tab-btn.active .tab-badge { background:rgba(255,255,255,0.3); color:#fff; }
    .tab-btn:not(.active) .tab-badge { background:#fef3c7; color:#92400e; }

    .draft-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:20px; }
    .draft-card {
        background:#fff; border-radius:16px; border:1px solid #e5e7eb;
        box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; transition:all 0.3s;
    }
    .draft-card:hover { transform:translateY(-4px); box-shadow:0 8px 30px rgba(0,0,0,0.08); }
    .draft-card-header { padding:18px 20px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:14px; }
    .draft-avatar {
        width:48px; height:48px; border-radius:12px;
        background:linear-gradient(135deg,#7c3aed,#a78bfa); color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:18px; font-weight:700; flex-shrink:0;
    }
    .draft-info h4 { font-size:15px; font-weight:700; color:#111827; margin:0 0 2px 0; }
    .draft-info small { font-size:12px; color:#6b7280; }
    .draft-card-body { padding:18px 20px; }
    .draft-meta { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:14px; }
    .draft-meta-item label { display:block; font-size:11px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.3px; }
    .draft-meta-item span { font-size:13px; font-weight:600; color:#374151; }
    .status-badge { padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; gap:4px; }
    .status-badge.pending { background:#fef3c7; color:#92400e; }
    .status-badge.process { background:#f3e8ff; color:#7c3aed; }
    .draft-card-footer { padding:14px 20px; border-top:1px solid #f1f5f9; display:flex; gap:8px; }
    .btn-sm {
        padding:8px 16px; border-radius:8px; font-size:12px; font-weight:600;
        text-decoration:none; display:inline-flex; align-items:center; gap:6px;
        border:none; cursor:pointer; transition:all 0.2s;
    }
    .btn-sm:hover { transform:translateY(-1px); }
    .btn-sm.purple { background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; }
    .btn-sm.green { background:#22c55e; color:#fff; }
    .btn-sm.red { background:#ef4444; color:#fff; }

    .empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
    .empty-state i { font-size:56px; opacity:0.4; margin-bottom:14px; color:#a78bfa; display:block; }
    .empty-state h4 { font-size:18px; font-weight:600; color:#6b7280; margin:0 0 8px 0; }

    @media (max-width:768px) { .draft-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-hourglass-half" style="margin-right:10px"></i> Draft Menunggu Keputusan</h1>
        <p>Draft SKPI yang memerlukan persetujuan atau penolakan dari fakultas</p>
    </div>

    <div class="tab-nav">
        <a href="{{ route('fakultas.approval.index', ['status' => '']) }}" class="tab-btn active">
            <i class="fas fa-hourglass-half"></i> Menunggu
            <span class="tab-badge">{{ $drafts->total() ?? 0 }}</span>
        </a>
        <a href="{{ route('fakultas.arsip.index') }}" class="tab-btn">
            <i class="fas fa-check-circle"></i> Disetujui
        </a>
    </div>

    <div class="draft-grid">
        @forelse($drafts ?? [] as $draft)
            <div class="draft-card">
                <div class="draft-card-header">
                    <div class="draft-avatar">
                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                    </div>
                    <div class="draft-info">
                        <h4>{{ $draft->mahasiswa->nama ?? '-' }}</h4>
                        <small>{{ $draft->mahasiswa->nim ?? '-' }} &bull; {{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</small>
                    </div>
                </div>
                <div class="draft-card-body">
                    <div class="draft-meta">
                        <div class="draft-meta-item">
                            <label>Status</label>
                            <span class="status-badge pending">
                                <i class="fas fa-clock"></i> {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                            </span>
                        </div>
                        <div class="draft-meta-item">
                            <label>Tanggal Masuk</label>
                            <span>{{ $draft->created_at ? $draft->created_at->format('d M Y') : '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="draft-card-footer">
                    <a href="{{ route('fakultas.approval.show', $draft->id) }}" class="btn-sm purple">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1">
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>Tidak Ada Draft Menunggu</h4>
                    <p>Saat ini tidak ada draft SKPI yang memerlukan keputusan Anda</p>
                </div>
            </div>
        @endforelse
    </div>

    @if(method_exists($drafts ?? collect(), 'links'))
        <div style="margin-top:20px;display:flex;justify-content:center">
            {{ $drafts->links() }}
        </div>
    @endif
@endsection
