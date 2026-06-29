@extends('fakultas.layouts.app')
@section('title', 'SKPI Disetujui')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(5,150,105,0.25);
    }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .approved-card {
        background:#fff; border-radius:16px; border:1px solid #e5e7eb;
        box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden;
    }
    .approved-card .card-header {
        padding:18px 24px; border-bottom:1px solid #f1f5f9;
        display:flex; align-items:center; justify-content:space-between;
        background:linear-gradient(135deg,#f0fdf4,#dcfce7);
    }
    .approved-card .card-header-left { display:flex; align-items:center; gap:12px; }
    .approved-card .card-header-icon {
        width:40px; height:40px; background:linear-gradient(135deg,#059669,#10b981);
        color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center;
    }
    .approved-card .card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }

    .modern-table { width:100%; border-collapse:collapse; }
    .modern-table thead th { padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
    .modern-table tbody td { padding:14px 20px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#374151; }
    .modern-table tbody tr:hover { background:#f0fdf4; }

    .student-info { display:flex; align-items:center; gap:12px; }
    .student-avatar { width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,#059669,#34d399); color:#fff; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; }
    .student-name { font-weight:600; color:#111827; }
    .student-nim { font-size:12px; color:#6b7280; }
    .status-badge { padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; gap:4px; }
    .status-badge.final { background:#dcfce7; color:#15803d; }
    .btn-view { padding:8px 16px; background:linear-gradient(135deg,#059669,#10b981); color:#fff; border:none; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
    .btn-view:hover { transform:translateY(-2px); box-shadow:0 4px 12px rgba(5,150,105,0.35); }
    .empty-state { text-align:center; padding:48px 20px; color:#9ca3af; }
    .empty-state i { font-size:48px; opacity:0.4; margin-bottom:12px; color:#34d399; }
    .empty-state h4 { font-size:16px; font-weight:600; color:#6b7280; margin:0 0 6px 0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-check-circle" style="margin-right:10px"></i> SKPI Disetujui</h1>
        <p>Daftar draft SKPI yang telah disetujui oleh fakultas</p>
    </div>

    <div class="approved-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon"><i class="fas fa-trophy"></i></div>
                <h3>Draft SKPI Final</h3>
            </div>
            <span style="font-size:13px;color:#059669;font-weight:700">{{ count($drafts ?? []) }} SKPI</span>
        </div>
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Nomor SKPI</th>
                        <th>Tanggal Pengesahan</th>
                        <th>Status</th>
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
                            <td><strong>{{ $draft->nomor_skpi ?? '-' }}</strong></td>
                            <td>{{ $draft->tanggal_pengesahan ? \Carbon\Carbon::parse($draft->tanggal_pengesahan)->format('d M Y') : '-' }}</td>
                            <td>
                                <span class="status-badge final"><i class="fas fa-check-circle"></i> Final</span>
                            </td>
                            <td>
                                <a href="{{ route('fakultas.arsip.show', $draft->id) }}" class="btn-view">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-trophy"></i>
                                    <h4>Belum Ada SKPI Disetujui</h4>
                                    <p>Draft SKPI yang telah disetujui akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
