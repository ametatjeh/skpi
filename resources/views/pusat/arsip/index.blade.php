@extends('pusat.layouts.app')
@section('title', 'Arsip SKPI - Pusat Bahasa')

@push('styles')
<style>
    /* ============ PREMIUM ARSIP SKPI STYLES - CYAN THEME ============ */
    .arsip-container * {
        box-sizing: border-box;
    }
    
    .arsip-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
    }
    
    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
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
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    .header-stats {
        display: flex;
        gap: 24px;
    }
    
    .header-stat {
        text-align: center;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
    }
    
    .header-stat-value {
        font-size: 28px;
        font-weight: 800;
    }
    
    .header-stat-label {
        font-size: 12px;
        opacity: 0.8;
    }
    
    /* Filter Section */
    .filter-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    
    .filter-input, .filter-select {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        min-width: 180px;
        transition: all 0.2s;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }
    
    .filter-btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .filter-btn.primary {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
    }
    
    .filter-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }
    
    /* Table Card */
    .table-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .table-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .table-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .table-title i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .table-badge {
        padding: 8px 16px;
        background: #cffafe;
        color: #0e7490;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
    }
    
    /* Arsip Table */
    .arsip-table-wrapper {
        overflow-x: auto;
    }
    
    .arsip-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }
    
    .arsip-table th,
    .arsip-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .arsip-table th {
        background: #fafbfc;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .arsip-table tbody tr {
        transition: background 0.2s;
    }
    
    .arsip-table tbody tr:hover {
        background: #f0fdfa;
    }
    
    .arsip-table tbody tr:last-child td {
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
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }
    
    .student-details h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }
    
    .student-details span {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* SKPI Number */
    .skpi-number {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
        color: #0e7490;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }
    
    /* Prodi Badge */
    .prodi-badge {
        padding: 6px 12px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    
    .status-badge.final {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
    }
    
    /* Date */
    .date-info {
        font-size: 13px;
        color: #6b7280;
    }
    
    .date-info i {
        margin-right: 4px;
        color: #9ca3af;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-detail {
        background: #f0fdfa;
        color: #0891b2;
    }
    
    .btn-detail:hover {
        background: #cffafe;
    }
    
    .btn-download {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
    }
    
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 56px;
        margin-bottom: 16px;
        opacity: 0.4;
        color: #d1d5db;
    }
    
    .empty-state h4 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }
    
    /* Pagination */
    .pagination-wrapper {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-stats {
            width: 100%;
            justify-content: space-around;
        }
        
        .filter-section {
            flex-direction: column;
        }
        
        .filter-input, .filter-select {
            width: 100%;
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
        border-top: 6px solid #06b6d4;
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
@php
    $totalArsip = $arsipSkpi->total();
@endphp

<div class="arsip-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-archive"></i>
                </div>
                <div>
                    <h1>Arsip SKPI</h1>
                    <p>Rekap SKPI yang sudah terbit dan berstatus final</p>
                </div>
            </div>
            <div class="header-stats">
                <div class="header-stat">
                    <div class="header-stat-value">{{ $totalArsip }}</div>
                    <div class="header-stat-label">Total SKPI Terbit</div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Filter Section --}}
    <div class="filter-section">
        <input type="text" class="filter-input" placeholder="Cari nama atau NIM...">
        <select class="filter-select">
            <option value="">Semua Prodi</option>
        </select>
        <select class="filter-select">
            <option value="">Semua Tahun</option>
        </select>
        <button class="filter-btn primary">
            <i class="fas fa-search"></i> Filter
        </button>
    </div>
    
    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-file-certificate"></i>
                Daftar SKPI Final
            </div>
            <span class="table-badge">{{ $arsipSkpi->total() }} SKPI</span>
        </div>
        
        @if($arsipSkpi->count())
            <div class="arsip-table-wrapper">
                <table class="arsip-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>No. SKPI</th>
                            <th>Status</th>
                            <th>Tanggal Final</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arsipSkpi as $i => $arsip)
                            <tr>
                                <td>
                                    <span style="font-weight: 600; color: #6b7280;">{{ $i + 1 }}</span>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($arsip->mahasiswa->nama ?? 'M', 0, 1)) }}
                                        </div>
                                        <div class="student-details">
                                            <h4>{{ $arsip->mahasiswa->nama ?? '-' }}</h4>
                                            <span>{{ $arsip->mahasiswa->nim ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="prodi-badge">
                                        {{ $arsip->mahasiswa->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="skpi-number">
                                        <i class="fas fa-hashtag"></i>
                                        {{ $arsip->nomor_skpi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge final">
                                        <i class="fas fa-check-circle"></i> Final
                                    </span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <i class="fas fa-calendar-check"></i>
                                        {{ $arsip->updated_at ? $arsip->updated_at->format('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if(Route::has('pusat.arsip.show'))
                                            <a href="{{ route('pusat.arsip.show', $arsip->id) }}" class="btn-action btn-detail">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        @endif
                                        @if(Route::has('pusat.arsip.downloadPdf'))
                                            <a href="{{ route('pusat.arsip.downloadPdf', $arsip->id) }}" class="btn-action btn-download btn-download-pdf">
                                                <i class="fas fa-download"></i> PDF
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($arsipSkpi->hasPages())
                <div class="pagination-wrapper">
                    {{ $arsipSkpi->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-archive"></i>
                <h4>Belum Ada SKPI Terbit</h4>
                <p>SKPI yang sudah final akan muncul di sini</p>
            </div>
        @endif
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
