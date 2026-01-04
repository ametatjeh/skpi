@extends('fakultas.layouts.app')
@section('title', 'Detail Arsip SKPI')
@section('page_title', 'Detail Arsip SKPI')
@section('page_icon', 'file-alt')

@push('styles')
<style>
    /* ============ DETAIL ARSIP PAGE - PURPLE THEME ============ */
    
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
    
    .header-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-header {
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-header.back {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        backdrop-filter: blur(4px);
    }
    
    .btn-header.download {
        background: #fff;
        color: #7c3aed;
    }
    
    .btn-header:hover {
        transform: translateY(-2px);
    }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 24px;
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
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .card-header-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .card-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .card-body {
        padding: 24px;
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .info-item.full {
        grid-column: span 2;
    }
    
    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    
    .info-value.highlight {
        color: #7c3aed;
        font-family: 'Courier New', monospace;
        background: #f3e8ff;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
    }
    
    /* Profile Card */
    .profile-card {
        text-align: center;
        padding: 32px 24px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        margin: 0 auto 16px;
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
    }
    
    .profile-name {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .profile-nim {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 16px;
    }
    
    .profile-prodi {
        font-size: 13px;
        color: #7c3aed;
        background: #f3e8ff;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }
    
    /* Activity Section */
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .activity-item {
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 10px;
        border-left: 3px solid #7c3aed;
    }
    
    .activity-title {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .activity-desc {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Bilingual Summary */
    .bilingual-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .bilingual-card {
        padding: 16px;
        border-radius: 12px;
        background: #f8fafc;
    }
    
    .bilingual-card.id {
        border-left: 4px solid #dc2626;
    }
    
    .bilingual-card.en {
        border-left: 4px solid #1e40af;
    }
    
    .bilingual-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .bilingual-card.id .bilingual-header { color: #dc2626; }
    .bilingual-card.en .bilingual-header { color: #1e40af; }
    
    .bilingual-text {
        font-size: 13px;
        color: #374151;
        line-height: 1.6;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
        
        .bilingual-section {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .info-item.full {
            grid-column: span 1;
        }
    }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <h1>Detail Arsip SKPI</h1>
                    <p>Nomor SKPI: {{ $draft->nomor_skpi ?? '-' }}</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('fakultas.arsip.index') }}" class="btn-header back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('fakultas.arsip.download.pdf', $draft->id) }}" class="btn-header download">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
    
    <div class="content-grid">
        {{-- Left Column --}}
        <div>
            {{-- Data SKPI --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3>Informasi SKPI</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nomor SKPI</span>
                            <span class="info-value highlight">{{ $draft->nomor_skpi ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tahun Lulus</span>
                            <span class="info-value">{{ $draft->tahun_lulus ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Pengesahan</span>
                            <span class="info-value">
                                @if($draft->tanggal_pengesahan)
                                    {{ $draft->tanggal_pengesahan->format('d M Y') }}
                                @elseif($draft->updated_at)
                                    {{ $draft->updated_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="status-badge">
                                <i class="fas fa-check-circle"></i> Final / Terbit
                            </span>
                        </div>
                        @if($draft->catatan)
                        <div class="info-item full">
                            <span class="info-label">Catatan</span>
                            <span class="info-value">{{ $draft->catatan }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Ringkasan Bilingual --}}
            @if($draft->ringkasan_id || $draft->ringkasan_en)
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h3>Ringkasan Bilingual</h3>
                </div>
                <div class="card-body">
                    <div class="bilingual-section">
                        <div class="bilingual-card id">
                            <div class="bilingual-header">
                                <i class="fas fa-flag"></i> Bahasa Indonesia
                            </div>
                            <div class="bilingual-text">
                                {{ $draft->ringkasan_id ?? 'Belum diisi' }}
                            </div>
                        </div>
                        <div class="bilingual-card en">
                            <div class="bilingual-header">
                                <i class="fas fa-globe"></i> English
                            </div>
                            <div class="bilingual-text">
                                {{ $draft->ringkasan_en ?? 'Not filled yet' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        {{-- Right Column - Profile --}}
        <div>
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Data Mahasiswa</h3>
                </div>
                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                    </div>
                    <div class="profile-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                    <div class="profile-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                    <div class="profile-prodi">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}
                    </div>
                </div>
            </div>
            
            {{-- Quick Info --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>Informasi Tambahan</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid" style="grid-template-columns: 1fr;">
                        <div class="info-item">
                            <span class="info-label">Fakultas</span>
                            <span class="info-value">{{ $draft->mahasiswa->prodi->fakultas->nama ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Dibuat Pada</span>
                            <span class="info-value">{{ $draft->created_at ? $draft->created_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terakhir Update</span>
                            <span class="info-value">{{ $draft->updated_at ? $draft->updated_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
