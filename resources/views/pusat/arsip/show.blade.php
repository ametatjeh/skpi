@extends('pusat.layouts.app')
@section('title', 'Detail SKPI - Pusat Bahasa')

@push('styles')
<style>
    /* ============ PREMIUM DETAIL SKPI STYLES - CYAN THEME ============ */
    .detail-container * {
        box-sizing: border-box;
    }
    
    .detail-container {
        max-width: 1100px;
        margin: 0 auto;
    }
    
    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
        font-size: 14px;
    }
    
    .breadcrumb a {
        color: #6b7280;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
    }
    
    .breadcrumb a:hover {
        color: #0891b2;
    }
    
    .breadcrumb span {
        color: #9ca3af;
    }
    
    .breadcrumb .current {
        color: #111827;
        font-weight: 600;
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
    
    .header-badge {
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Student Card */
    .student-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
    }
    
    .student-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }
    
    .student-avatar-large {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
    }
    
    .student-main-info h3 {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 8px 0;
    }
    
    .student-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .info-badge {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .info-badge.nim {
        background: #cffafe;
        color: #0e7490;
    }
    
    .info-badge.prodi {
        background: #f3f4f6;
        color: #374151;
    }
    
    .info-badge.fakultas {
        background: #fef3c7;
        color: #92400e;
    }
    
    .student-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .meta-label {
        font-size: 12px;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .meta-label i {
        color: #9ca3af;
    }
    
    .meta-value {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    
    /* Content Cards */
    .content-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .content-header {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .content-header.indonesian {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        color: #fff;
    }
    
    .content-header.english {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .content-header.capaian {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
    }
    
    .content-header i {
        font-size: 20px;
    }
    
    .content-header h4 {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }
    
    .content-body {
        padding: 24px;
    }
    
    .content-text {
        font-size: 14px;
        color: #374151;
        line-height: 1.8;
        white-space: pre-line;
    }
    
    .content-empty {
        color: #9ca3af;
        font-style: italic;
        text-align: center;
        padding: 20px;
    }
    
    /* Bilingual Grid */
    .bilingual-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }
    
    /* Capaian Table */
    .capaian-table-wrapper {
        overflow-x: auto;
    }
    
    .capaian-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .capaian-table th,
    .capaian-table td {
        padding: 14px 18px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .capaian-table th {
        background: #f8fafc;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
    }
    
    .capaian-table tbody tr:hover {
        background: #f0fdfa;
    }
    
    .capaian-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .kategori-badge {
        padding: 5px 12px;
        background: #cffafe;
        color: #0e7490;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Action Buttons */
    .action-bar {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 14px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-back {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-back:hover {
        background: #e5e7eb;
    }
    
    .btn-download {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
    }
    
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .student-meta-grid {
            grid-template-columns: 1fr;
        }
        
        .bilingual-grid {
            grid-template-columns: 1fr;
        }
        
        .action-bar {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('pusat.arsip') }}">
            <i class="fas fa-archive"></i> Arsip SKPI
        </a>
        <span>/</span>
        <span class="current">Detail SKPI</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-file-certificate"></i>
                </div>
                <div>
                    <h1>Detail SKPI</h1>
                    <p>{{ $arsip->nomor_skpi ?? 'No. SKPI belum tersedia' }}</p>
                </div>
            </div>
            <div class="header-badge">
                <i class="fas fa-check-circle"></i> Status: Final
            </div>
        </div>
    </div>
    
    {{-- Student Card --}}
    <div class="student-card">
        <div class="student-card-header">
            <div class="student-avatar-large">
                {{ strtoupper(substr($arsip->mahasiswa->nama ?? 'M', 0, 1)) }}
            </div>
            <div class="student-main-info">
                <h3>{{ $arsip->mahasiswa->nama ?? '-' }}</h3>
                <div class="student-badges">
                    <span class="info-badge nim">
                        <i class="fas fa-id-card"></i> {{ $arsip->mahasiswa->nim ?? '-' }}
                    </span>
                    <span class="info-badge prodi">
                        {{ $arsip->mahasiswa->prodi->nama_prodi ?? '-' }}
                    </span>
                    <span class="info-badge fakultas">
                        {{ $arsip->mahasiswa->prodi->fakultas->nama_fakultas ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="student-meta-grid">
            <div class="meta-item">
                <span class="meta-label"><i class="fas fa-hashtag"></i> Nomor SKPI</span>
                <span class="meta-value">{{ $arsip->nomor_skpi ?? '-' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label"><i class="fas fa-calendar-check"></i> Tanggal Final</span>
                <span class="meta-value">{{ $arsip->updated_at ? $arsip->updated_at->format('d M Y') : '-' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label"><i class="fas fa-info-circle"></i> Status</span>
                <span class="meta-value" style="color: #15803d;">✓ Final / Terbit</span>
            </div>
        </div>
    </div>
    
    {{-- Bilingual Content --}}
    <div class="bilingual-grid">
        <div class="content-card">
            <div class="content-header indonesian">
                <i class="fas fa-flag"></i>
                <h4>Ringkasan Bahasa Indonesia</h4>
            </div>
            <div class="content-body">
                @if($arsip->ringkasan_id)
                    <div class="content-text">{{ $arsip->ringkasan_id }}</div>
                @else
                    <div class="content-empty">Belum ada ringkasan</div>
                @endif
            </div>
        </div>
        
        <div class="content-card">
            <div class="content-header english">
                <i class="fas fa-globe"></i>
                <h4>Summary in English</h4>
            </div>
            <div class="content-body">
                @if($arsip->ringkasan_en)
                    <div class="content-text">{{ $arsip->ringkasan_en }}</div>
                @else
                    <div class="content-empty">No English summary available</div>
                @endif
            </div>
        </div>
    </div>
    
    {{-- Capaian/Prestasi Table --}}
    @if($arsip->mahasiswa && $arsip->mahasiswa->kategoriSummary && $arsip->mahasiswa->kategoriSummary->count())
        <div class="content-card">
            <div class="content-header capaian">
                <i class="fas fa-trophy"></i>
                <h4>Capaian / Prestasi yang Tercetak di SKPI</h4>
            </div>
            <div class="content-body" style="padding: 0;">
                <div class="capaian-table-wrapper">
                    <table class="capaian-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 140px;">Kategori</th>
                                <th>Deskripsi</th>
                                <th style="width: 180px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arsip->mahasiswa->kategoriSummary as $i => $item)
                                <tr>
                                    <td style="font-weight: 600; color: #6b7280;">{{ $i + 1 }}</td>
                                    <td>
                                        <span class="kategori-badge">{{ $item->kategori }}</span>
                                    </td>
                                    <td style="color: #374151;">{{ $item->deskripsi_id }}</td>
                                    <td style="color: #6b7280;">{{ $item->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    
    {{-- Action Bar --}}
    <div class="action-bar">
        <a href="{{ route('pusat.arsip') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        @if(Route::has('pusat.arsip.downloadPdf'))
            <a href="{{ route('pusat.arsip.downloadPdf', $arsip->id) }}" class="btn btn-download" target="_blank">
                <i class="fas fa-download"></i> Download PDF
            </a>
        @endif
    </div>
</div>
@endsection
