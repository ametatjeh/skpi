@extends('fakultas.layouts.app')
@section('title', 'Bottleneck Analysis')

@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#dc2626 0%,#ef4444 50%,#f87171 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(220,38,38,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .alert-card { background:linear-gradient(135deg,#fef2f2,#fee2e2); border:1px solid #fecaca; border-radius:14px; padding:18px 22px; margin-bottom:20px; display:flex; align-items:center; gap:14px; }
    .alert-icon { width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,#ef4444,#f87171); color:#fff; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }

    .stuck-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:18px; }
    .stuck-card { background:#fff; border-radius:16px; border:1px solid #fecaca; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; transition:all 0.3s; border-left:4px solid #ef4444; }
    .stuck-card:hover { transform:translateY(-4px); box-shadow:0 8px 30px rgba(0,0,0,0.08); }
    .stuck-card-body { padding:20px; }
    .stuck-student { display:flex; align-items:center; gap:14px; margin-bottom:14px; }
    .stuck-avatar { width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,#ef4444,#f87171); color:#fff; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; }
    .stuck-name { font-size:15px; font-weight:700; color:#111827; }
    .stuck-nim { font-size:12px; color:#6b7280; }
    .stuck-meta { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    .stuck-meta-item label { display:block; font-size:11px; font-weight:600; color:#9ca3af; text-transform:uppercase; }
    .stuck-meta-item span { font-size:13px; font-weight:600; color:#374151; }
    .days-badge { padding:4px 10px; background:#fee2e2; color:#dc2626; border-radius:6px; font-size:12px; font-weight:700; display:inline-flex; align-items:center; gap:4px; }
    .btn-view { padding:10px 18px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border:none; border-radius:10px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; margin-top:14px; }
    .btn-view:hover { transform:translateY(-2px); box-shadow:0 4px 12px rgba(124,58,237,0.35); }
    .empty-state { text-align:center; padding:60px 20px; color:#9ca3af; grid-column:1/-1; }
    .empty-state i { font-size:56px; opacity:0.4; margin-bottom:14px; color:#34d399; display:block; }

    @media (max-width:768px) { .stuck-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-exclamation-triangle" style="margin-right:10px"></i> Bottleneck Analysis</h1>
        <p>Draft SKPI yang terlambat diproses (> 7 hari menunggu)</p>
    </div>

    @if(count($stuckDrafts ?? []) > 0)
        <div class="alert-card">
            <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <strong style="color:#991b1b;font-size:15px">{{ count($stuckDrafts) }} Draft Terlambat</strong>
                <div style="font-size:13px;color:#b91c1c">Draft berikut sudah lebih dari 7 hari menunggu verifikasi</div>
            </div>
        </div>
    @endif

    <div class="stuck-grid">
        @forelse($stuckDrafts ?? [] as $draft)
            @php
                $daysWaiting = $draft->created_at ? $draft->created_at->diffInDays(now()) : 0;
            @endphp
            <div class="stuck-card">
                <div class="stuck-card-body">
                    <div class="stuck-student">
                        <div class="stuck-avatar">{{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}</div>
                        <div>
                            <div class="stuck-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                            <div class="stuck-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="stuck-meta">
                        <div class="stuck-meta-item">
                            <label>Prodi</label>
                            <span>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</span>
                        </div>
                        <div class="stuck-meta-item">
                            <label>Menunggu</label>
                            <span class="days-badge">
                                <i class="fas fa-exclamation-circle"></i> {{ $daysWaiting }} hari
                            </span>
                        </div>
                        <div class="stuck-meta-item">
                            <label>Masuk Sejak</label>
                            <span>{{ $draft->created_at ? $draft->created_at->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="stuck-meta-item">
                            <label>Status</label>
                            <span>{{ ucfirst(str_replace('_', ' ', $draft->status)) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('fakultas.approval.show', $draft->id) }}" class="btn-view">
                        <i class="fas fa-eye"></i> Proses Sekarang
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-check-double"></i>
                <h4 style="font-size:18px;font-weight:600;color:#059669;margin:0 0 8px 0">Semua Tepat Waktu!</h4>
                <p>Tidak ada draft yang terlambat diproses. Kerja bagus!</p>
            </div>
        @endforelse
    </div>
@endsection
