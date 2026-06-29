@extends('fakultas.layouts.app')
@section('title', 'SKPI Ditolak / Revisi')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 50%, #f87171 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(220,38,38,0.25);
    }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .rejected-card {
        background:#fff; border-radius:16px; border:1px solid #e5e7eb;
        box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden;
    }
    .rejected-card .card-header {
        padding:18px 24px; border-bottom:1px solid #f1f5f9;
        display:flex; align-items:center; justify-content:space-between;
        background:linear-gradient(135deg,#fef2f2,#fee2e2);
    }
    .rejected-card .card-header-left { display:flex; align-items:center; gap:12px; }
    .rejected-card .card-header-icon {
        width:40px; height:40px; background:linear-gradient(135deg,#dc2626,#ef4444);
        color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center;
    }
    .rejected-card .card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }

    .modern-table { width:100%; border-collapse:collapse; }
    .modern-table thead th { padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
    .modern-table tbody td { padding:14px 20px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#374151; }
    .modern-table tbody tr:hover { background:#fef2f2; }

    .student-info { display:flex; align-items:center; gap:12px; }
    .student-avatar { width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,#dc2626,#f87171); color:#fff; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; }
    .student-name { font-weight:600; color:#111827; }
    .student-nim { font-size:12px; color:#6b7280; }
    .status-badge { padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; gap:4px; }
    .status-badge.rejected { background:#fee2e2; color:#dc2626; }
    .status-badge.revision { background:#fef3c7; color:#92400e; }
    .catatan-text { font-size:13px; color:#991b1b; max-width:250px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .btn-view { padding:8px 16px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border:none; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
    .btn-view:hover { transform:translateY(-2px); box-shadow:0 4px 12px rgba(124,58,237,0.35); }
    .empty-state { text-align:center; padding:48px 20px; color:#9ca3af; }
    .empty-state i { font-size:48px; opacity:0.4; margin-bottom:12px; color:#f87171; }
    .empty-state h4 { font-size:16px; font-weight:600; color:#6b7280; margin:0 0 6px 0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-times-circle" style="margin-right:10px"></i> SKPI Ditolak / Revisi</h1>
        <p>Draft SKPI yang dikembalikan untuk perbaikan</p>
    </div>

    <div class="rejected-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon"><i class="fas fa-undo"></i></div>
                <h3>Draft Dikembalikan</h3>
            </div>
            <span style="font-size:13px;color:#dc2626;font-weight:700">{{ count($drafts ?? []) }} Draft</span>
        </div>
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Status</th>
                        <th>Catatan Penolakan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drafts ?? [] as $draft)
                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">{{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}</div>
                                    <div>
                                        <div class="student-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                                        <div class="student-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td>
                                <span class="status-badge {{ str_contains($draft->status, 'revisi') ? 'revision' : 'rejected' }}">
                                    <i class="fas {{ str_contains($draft->status, 'revisi') ? 'fa-undo' : 'fa-times-circle' }}"></i>
                                    {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                                </span>
                            </td>
                            <td>
                                <div class="catatan-text" title="{{ $draft->catatan ?? '-' }}">
                                    {{ $draft->catatan ?? 'Tidak ada catatan' }}
                                </div>
                            </td>
                            <td>{{ $draft->updated_at ? $draft->updated_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('fakultas.approval.show', $draft->id) }}" class="btn-view">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-check-double"></i>
                                    <h4>Tidak Ada Draft Ditolak</h4>
                                    <p>Semua draft sudah diproses dengan baik</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
