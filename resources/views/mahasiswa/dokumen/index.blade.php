@extends('mahasiswa.layouts.app')
@section('title', 'Dokumen Pendukung')
@section('page_title', 'Dokumen Pendukung')
@section('page_icon', 'folder-open')

@section('content')
<style>
    .doc-page { max-width: 1000px; margin: 0 auto; }
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(8, 145, 178, 0.25);
    }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }
    .header-actions { margin-top:14px; position:relative; z-index:1; }
    .btn-upload { padding:10px 22px; background:rgba(255,255,255,0.2); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:8px; backdrop-filter:blur(4px); transition:all 0.2s; }
    .btn-upload:hover { background:rgba(255,255,255,0.3); transform:translateY(-2px); }

    .doc-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; }
    .doc-card .card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#f0f9ff,#cffafe); }
    .doc-card .card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#0891b2,#06b6d4); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
    .doc-card .card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .modern-table { width:100%; border-collapse:collapse; }
    .modern-table thead th { padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
    .modern-table tbody td { padding:14px 20px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#374151; }
    .modern-table tbody tr:hover { background:#f0f9ff; }

    .file-icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:16px; }
    .file-icon.pdf { background:#fee2e2; color:#dc2626; }
    .file-icon.image { background:#dbeafe; color:#3b82f6; }
    .file-icon.doc { background:#f0f9ff; color:#0891b2; }
    .file-info { display:flex; align-items:center; gap:12px; }
    .file-name { font-weight:600; color:#111827; }
    .file-size { font-size:12px; color:#9ca3af; }
    .status-badge { padding:4px 10px; border-radius:6px; font-size:11px; font-weight:600; }
    .status-badge.uploaded { background:#dcfce7; color:#15803d; }
    .status-badge.pending { background:#fef3c7; color:#92400e; }
    .btn-sm { padding:6px 14px; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:all 0.2s; border:none; cursor:pointer; }
    .btn-sm.download { background:#f0f9ff; color:#0891b2; }
    .btn-sm.download:hover { background:#0891b2; color:#fff; }
    .btn-sm.delete { background:#fee2e2; color:#dc2626; }
    .btn-sm.delete:hover { background:#dc2626; color:#fff; }
    .empty-state { text-align:center; padding:48px 20px; color:#9ca3af; }
    .empty-state i { font-size:48px; opacity:0.4; margin-bottom:12px; color:#06b6d4; display:block; }

    .alert-success { padding:14px 18px; border-radius:12px; margin-bottom:20px; display:flex; align-items:center; gap:12px; font-size:14px; background:linear-gradient(135deg,#dcfce7,#bbf7d0); color:#166534; border-left:4px solid #22c55e; }

    @media (max-width:768px) { .modern-table { min-width:600px; } }
</style>

<div class="doc-page">
    <div class="page-header">
        <h1><i class="fas fa-folder-open" style="margin-right:10px"></i> Dokumen Pendukung</h1>
        <p>Kelola semua dokumen pendukung untuk pengajuan SKPI Anda</p>
        <div class="header-actions">
            <a href="{{ route('mahasiswa.dokumen.upload') }}" class="btn-upload">
                <i class="fas fa-cloud-upload-alt"></i> Upload Dokumen Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success"><i class="fas fa-check-circle" style="font-size:18px"></i> {{ session('success') }}</div>
    @endif

    <div class="doc-card">
        <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-file-alt"></i></div>
            <h3>Daftar Dokumen ({{ count($dokumen ?? []) }})</h3>
        </div>
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Dokumen</th>
                        <th>Jenis</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumen ?? [] as $doc)
                        @php
                            $ext = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
                            $iconClass = in_array($ext, ['pdf']) ? 'pdf' : (in_array($ext, ['jpg','jpeg','png','gif']) ? 'image' : 'doc');
                            $iconName = in_array($ext, ['pdf']) ? 'fa-file-pdf' : (in_array($ext, ['jpg','jpeg','png','gif']) ? 'fa-file-image' : 'fa-file-alt');
                        @endphp
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon {{ $iconClass }}"><i class="fas {{ $iconName }}"></i></div>
                                    <div>
                                        <div class="file-name">{{ $doc->nama_dokumen }}</div>
                                        <div class="file-size">{{ strtoupper($ext) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $doc->jenis_dokumen }}</td>
                            <td>{{ $doc->ukuran_file ? number_format($doc->ukuran_file / 1024, 1) . ' KB' : '-' }}</td>
                            <td><span class="status-badge {{ $doc->status ?? 'uploaded' }}">{{ ucfirst($doc->status ?? 'Uploaded') }}</span></td>
                            <td>{{ $doc->created_at ? $doc->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                <div style="display:flex;gap:6px">
                                    <a href="{{ route('mahasiswa.dokumen.download', $doc->id) }}" class="btn-sm download"><i class="fas fa-download"></i></a>
                                    <form method="POST" action="{{ route('mahasiswa.dokumen.destroy', $doc->id) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <h4 style="font-size:16px;font-weight:600;color:#6b7280;margin:0 0 6px 0">Belum Ada Dokumen</h4>
                                    <p>Upload dokumen pendukung untuk melengkapi pengajuan SKPI Anda</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
