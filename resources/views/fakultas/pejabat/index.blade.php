@extends('fakultas.layouts.app')
@section('title', 'Pejabat Fakultas')
@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .pejabat-section { margin-bottom:28px; }
    .pejabat-section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
    .pejabat-section-title { font-size:18px; font-weight:700; color:#111827; display:flex; align-items:center; gap:10px; }
    .pejabat-section-icon { width:36px; height:36px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:14px; }
    .btn-add { padding:8px 18px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
    .btn-add:hover { transform:translateY(-2px); box-shadow:0 4px 12px rgba(124,58,237,0.35); }

    .pejabat-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:18px; }
    .pejabat-card { background:#fff; border-radius:16px; padding:22px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); transition:all 0.3s; }
    .pejabat-card:hover { transform:translateY(-4px); box-shadow:0 8px 30px rgba(0,0,0,0.08); }
    .pejabat-card-top { display:flex; align-items:center; gap:14px; margin-bottom:14px; }
    .pejabat-avatar { width:56px; height:56px; border-radius:14px; background:linear-gradient(135deg,#7c3aed,#a78bfa); color:#fff; display:flex; align-items:center; justify-content:center; font-size:20px; font-weight:700; }
    .pejabat-name { font-size:16px; font-weight:700; color:#111827; }
    .pejabat-nip { font-size:12px; color:#6b7280; }
    .pejabat-meta { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:14px; }
    .pejabat-meta-item label { display:block; font-size:10px; font-weight:600; color:#9ca3af; text-transform:uppercase; }
    .pejabat-meta-item span { font-size:13px; font-weight:600; color:#374151; }
    .pejabat-card-actions { display:flex; gap:8px; }
    .btn-sm { padding:6px 14px; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:all 0.2s; }
    .btn-sm.edit { background:#f3e8ff; color:#7c3aed; }
    .btn-sm.edit:hover { background:#7c3aed; color:#fff; }
    .empty-state { text-align:center; padding:40px; color:#9ca3af; grid-column:1/-1; }
    .empty-state i { font-size:36px; opacity:0.4; display:block; margin-bottom:8px; color:#a78bfa; }
</style>
@endpush
@section('content')
    <div class="page-header">
        <h1><i class="fas fa-user-tie" style="margin-right:10px"></i> Pejabat Fakultas</h1>
        <p>Kelola data dekan dan wakil dekan fakultas</p>
    </div>

    {{-- Dekan --}}
    <div class="pejabat-section">
        <div class="pejabat-section-header">
            <div class="pejabat-section-title">
                <div class="pejabat-section-icon"><i class="fas fa-user-tie"></i></div> Dekan
            </div>
            <a href="{{ route('fakultas.dekan.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="pejabat-grid">
            @forelse($dekans ?? [] as $dekan)
                <div class="pejabat-card">
                    <div class="pejabat-card-top">
                        <div class="pejabat-avatar">{{ strtoupper(substr($dekan->nama ?? 'D', 0, 1)) }}</div>
                        <div>
                            <div class="pejabat-name">{{ $dekan->nama ?? '-' }}</div>
                            <div class="pejabat-nip">NIP: {{ $dekan->nip ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="pejabat-meta">
                        <div class="pejabat-meta-item"><label>Periode Mulai</label><span>{{ $dekan->periode_mulai ?? '-' }}</span></div>
                        <div class="pejabat-meta-item"><label>Periode Selesai</label><span>{{ $dekan->periode_selesai ?? '-' }}</span></div>
                    </div>
                    <div class="pejabat-card-actions">
                        <a href="{{ route('fakultas.dekan.edit', $dekan->id) }}" class="btn-sm edit"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            @empty
                <div class="empty-state"><i class="fas fa-user-tie"></i>Belum ada data dekan</div>
            @endforelse
        </div>
    </div>

    {{-- Wakil Dekan --}}
    <div class="pejabat-section">
        <div class="pejabat-section-header">
            <div class="pejabat-section-title">
                <div class="pejabat-section-icon"><i class="fas fa-users"></i></div> Wakil Dekan
            </div>
            <a href="{{ route('fakultas.wakil-dekan.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="pejabat-grid">
            @forelse($wakilDekans ?? [] as $wd)
                <div class="pejabat-card">
                    <div class="pejabat-card-top">
                        <div class="pejabat-avatar" style="background:linear-gradient(135deg,#059669,#34d399)">{{ strtoupper(substr($wd->nama ?? 'W', 0, 1)) }}</div>
                        <div>
                            <div class="pejabat-name">{{ $wd->nama ?? '-' }}</div>
                            <div class="pejabat-nip">NIP: {{ $wd->nip ?? '-' }} &bull; {{ $wd->bidang ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="pejabat-meta">
                        <div class="pejabat-meta-item"><label>Bidang</label><span>{{ $wd->bidang ?? '-' }}</span></div>
                        <div class="pejabat-meta-item"><label>Periode</label><span>{{ $wd->periode_mulai ?? '-' }}</span></div>
                    </div>
                    <div class="pejabat-card-actions">
                        <a href="{{ route('fakultas.wakil-dekan.edit', $wd->id) }}" class="btn-sm edit"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            @empty
                <div class="empty-state"><i class="fas fa-users"></i>Belum ada data wakil dekan</div>
            @endforelse
        </div>
    </div>
@endsection
