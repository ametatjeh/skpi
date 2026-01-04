@extends('fakultas.layouts.app')
@section('title', 'Arsip SKPI Fakultas')
@section('page_title', 'Arsip SKPI')
@section('page_icon', 'archive')

@push('styles')
<style>
    /* ============ ARSIP SKPI PAGE - PURPLE THEME ============ */
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(124, 58, 237, 0.25);
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        position: relative;
        z-index: 1;
    }
    
    .page-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .header-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        backdrop-filter: blur(4px);
    }
    
    .page-header h1 {
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 13px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Stats Mini */
    .stats-mini {
        display: flex;
        gap: 12px;
    }
    
    .stat-mini-item {
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 20px;
        border-radius: 12px;
        text-align: center;
        backdrop-filter: blur(4px);
    }
    
    .stat-mini-value {
        font-size: 24px;
        font-weight: 800;
    }
    
    .stat-mini-label {
        font-size: 11px;
        opacity: 0.9;
        text-transform: uppercase;
    }
    
    /* Card */
    .card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .card-header-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .card-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    /* Search Form */
    .search-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .search-input {
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #fff;
        font-size: 13px;
        min-width: 220px;
        transition: all 0.2s;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
    
    .btn-search {
        padding: 10px 18px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }
    
    /* Table Wrapper */
    .table-wrapper {
        width: 100%;
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar {
        height: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-track {
        background: #e5e7eb;
        border-radius: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        border-radius: 10px;
    }
    
    /* Table */
    .modern-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }
    
    .modern-table thead th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .modern-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
    }
    
    .modern-table tbody tr:hover {
        background: #faf5ff;
    }
    
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Student Info */
    .student-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .student-name {
        font-weight: 600;
        color: #111827;
    }
    
    .student-nim {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 8px 14px;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .btn-action.primary {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
    }
    
    .btn-action.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }
    
    .btn-action.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    .btn-action.success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
    }
    
    /* SKPI Number */
    .skpi-number {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #7c3aed;
        background: #f3e8ff;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 56px;
        opacity: 0.4;
        margin-bottom: 16px;
        color: #a78bfa;
    }
    
    .empty-state h4 {
        font-size: 18px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 0 8px 0;
    }
    
    .empty-state p {
        font-size: 14px;
        margin: 0;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-mini {
            width: 100%;
        }
        
        .stat-mini-item {
            flex: 1;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-form {
            width: 100%;
        }
        
        .search-input {
            flex: 1;
            min-width: unset;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }

    /* ========== LOADING OVERLAY ========== */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 99999;
        backdrop-filter: blur(8px);
    }

    .loading-overlay.active {
        display: flex;
    }

    .loading-box {
        text-align: center;
        color: #fff;
    }

    .loading-spinner {
        width: 80px;
        height: 80px;
        border: 6px solid rgba(255, 255, 255, 0.2);
        border-top: 6px solid #8b5cf6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 25px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-text {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        animation: pulse-text 1.5s ease-in-out infinite;
    }

    .loading-subtext {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }

    @keyframes pulse-text {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-archive"></i>
                </div>
                <div>
                    <h1>Arsip SKPI Final</h1>
                    <p>Daftar SKPI yang sudah diterbitkan dan diarsipkan</p>
                </div>
            </div>
            <div class="stats-mini">
                <div class="stat-mini-item">
                    <div class="stat-mini-value">{{ $arsipDraft->count() }}</div>
                    <div class="stat-mini-label">Total Arsip</div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Main Card --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3>Daftar SKPI Final</h3>
            </div>
            <form method="GET" class="search-form">
                <input type="text" name="q" class="search-input" placeholder="🔍 Cari NIM atau Nama..." value="{{ request('q') }}">
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
        
        <div class="table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Prodi</th>
                        <th>No SKPI</th>
                        <th>Status</th>
                        <th>Tgl Diterbitkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsipDraft as $index => $draft)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="student-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                                        <div class="student-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td>
                                <span class="skpi-number">{{ $draft->nomor_skpi ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="status-badge">
                                    <i class="fas fa-check-circle"></i> Final
                                </span>
                            </td>
                            <td>{{ $draft->updated_at ? $draft->updated_at->format('d M Y') : '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('fakultas.arsip.show', $draft->id) }}" class="btn-action primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('fakultas.arsip.download.pdf', $draft->id) }}" class="btn-action success btn-download-pdf">
                                        <i class="fas fa-download"></i> PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <h4>Belum Ada Arsip SKPI</h4>
                                    <p>SKPI yang sudah final akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

{{-- LOADING OVERLAY --}}
<div id="loadingOverlay" class="loading-overlay">
    <div class="loading-box">
        <div class="loading-spinner"></div>
        <div class="loading-text">Menyiapkan Dokumen PDF...</div>
        <div class="loading-subtext">Mohon tunggu sebentar</div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-download-pdf').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            document.getElementById('loadingOverlay').classList.add('active');
            
            // Hide loading after 5 seconds
            setTimeout(function() {
                document.getElementById('loadingOverlay').classList.remove('active');
            }, 5000);
        });
    });
</script>
@endsection
