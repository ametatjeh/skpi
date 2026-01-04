@extends('mahasiswa.layouts.app')

@section('title', 'Preview SKPI')
@section('page_title', 'Preview SKPI')
@section('page_icon', 'eye')

@section('content')
<style>
    /* ============ PREVIEW SKPI PREMIUM SKY BLUE ============ */
    .preview-page * {
        box-sizing: border-box;
    }

    .preview-page {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Back Button */
    .preview-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: #fff;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .preview-back-btn:hover {
        background: #f3f4f6;
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .preview-back-btn i {
        transition: transform 0.2s;
    }

    .preview-back-btn:hover i {
        transform: translateX(-4px);
    }

    /* Premium Header */
    .preview-header {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(14, 165, 233, 0.25);
        position: relative;
        overflow: hidden;
    }

    .preview-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .preview-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .preview-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .preview-header-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .preview-header-text h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .preview-header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .preview-status-badge {
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Info Card */
    .preview-info-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .preview-info-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .preview-info-header-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .preview-info-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .preview-info-body {
        padding: 24px;
    }

    /* Info Grid */
    .preview-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .preview-info-item {
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .preview-info-item:hover {
        background: #e0f2fe;
        border-color: #0ea5e9;
    }

    .preview-info-item.full-width {
        grid-column: 1 / -1;
    }

    .preview-info-label {
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .preview-info-label i {
        color: #9ca3af;
    }

    .preview-info-value {
        font-size: 15px;
        font-weight: 600;
        color: #111827;
        line-height: 1.5;
    }

    .preview-info-value.highlight {
        color: #0ea5e9;
    }

    .preview-info-value.mono {
        font-family: 'Courier New', monospace;
        color: #0ea5e9;
    }

    /* Status Badge in Grid */
    .preview-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
    }

    .preview-status.draft {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    .preview-status.final {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
    }

    .preview-status.selesai {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: #0369a1;
    }

    /* Summary Box */
    .preview-summary-box {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border-radius: 12px;
        padding: 16px;
        border-left: 4px solid #0ea5e9;
        font-size: 14px;
        color: #0c4a6e;
        line-height: 1.6;
    }

    /* Actions */
    .preview-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .preview-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .preview-btn-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .preview-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
    }

    .preview-btn-secondary {
        background: #fff;
        color: #374151;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .preview-btn-secondary:hover {
        background: #f3f4f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Note Card */
    .preview-note-card {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 24px;
        border: 1px solid #86efac;
    }

    .preview-note-icon {
        width: 48px;
        height: 48px;
        background: #10b981;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        flex-shrink: 0;
    }

    .preview-note-content {
        flex: 1;
    }

    .preview-note-content h4 {
        font-size: 14px;
        font-weight: 700;
        color: #166534;
        margin: 0 0 4px;
    }

    .preview-note-content p {
        font-size: 13px;
        color: #15803d;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .preview-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .preview-header-text h1 {
            font-size: 20px;
        }

        .preview-info-grid {
            grid-template-columns: 1fr;
        }

        .preview-actions {
            flex-direction: column;
        }

        .preview-btn {
            width: 100%;
            justify-content: center;
        }

        .preview-note-card {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="preview-page">
    {{-- Back Button --}}
    <a href="{{ route('mahasiswa.download.index') }}" class="preview-back-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>

    @php
        $status = $skpi->status ?? 'draft';
        $statusLabel = $status === 'final_issued' || $status === 'final' ? 'Final' : ($status === 'selesai' ? 'Selesai' : 'Draft');
        $statusClass = $status === 'final_issued' || $status === 'final' ? 'final' : ($status === 'selesai' ? 'selesai' : 'draft');
    @endphp

    {{-- Premium Header --}}
    <div class="preview-header">
        <div class="preview-header-content">
            <div class="preview-header-left">
                <div class="preview-header-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="preview-header-text">
                    <h1>Preview SKPI</h1>
                    <p>Dokumen Surat Keterangan Pendamping Ijazah</p>
                </div>
            </div>
            <div class="preview-status-badge">
                <i class="fas fa-circle" style="font-size: 8px; margin-right: 6px;"></i>
                Status: {{ $statusLabel }}
            </div>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="preview-info-card">
        <div class="preview-info-header">
            <div class="preview-info-header-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <h3>Informasi SKPI</h3>
        </div>

        <div class="preview-info-body">
            <div class="preview-info-grid">
                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-hashtag"></i> Nomor SKPI
                    </div>
                    <div class="preview-info-value mono">
                        {{ $skpi->nomor_skpi ?? '-' }}
                    </div>
                </div>

                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-user"></i> Nama Mahasiswa
                    </div>
                    <div class="preview-info-value">
                        {{ $mahasiswa->nama ?? '-' }}
                    </div>
                </div>

                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-id-card"></i> NIM
                    </div>
                    <div class="preview-info-value highlight">
                        {{ $mahasiswa->nim ?? '-' }}
                    </div>
                </div>

                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-graduation-cap"></i> Program Studi
                    </div>
                    <div class="preview-info-value">
                        {{ $mahasiswa->prodi->nama_prodi ?? '-' }}
                    </div>
                </div>

                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-tag"></i> Status
                    </div>
                    <div class="preview-info-value">
                        <span class="preview-status {{ $statusClass }}">
                            @if ($statusClass === 'final')
                                <i class="fas fa-check-circle"></i>
                            @elseif ($statusClass === 'selesai')
                                <i class="fas fa-check-double"></i>
                            @else
                                <i class="fas fa-clock"></i>
                            @endif
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>

                <div class="preview-info-item">
                    <div class="preview-info-label">
                        <i class="fas fa-calendar"></i> Tanggal Dibuat
                    </div>
                    <div class="preview-info-value">
                        {{ $skpi->created_at ? \Carbon\Carbon::parse($skpi->created_at)->format('d F Y, H:i') : '-' }}
                    </div>
                </div>

                @if ($skpi->ringkasan_id)
                    <div class="preview-info-item full-width">
                        <div class="preview-info-label">
                            <i class="fas fa-language"></i> Ringkasan (Bahasa Indonesia)
                        </div>
                        <div class="preview-summary-box">
                            {{ $skpi->ringkasan_id }}
                        </div>
                    </div>
                @endif

                @if ($skpi->ringkasan_en)
                    <div class="preview-info-item full-width">
                        <div class="preview-info-label">
                            <i class="fas fa-globe"></i> Ringkasan (English)
                        </div>
                        <div class="preview-summary-box">
                            {{ $skpi->ringkasan_en }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="preview-actions">
                @if ($pdf_exists ?? false)
                    <a href="{{ route('mahasiswa.download.pdf', $skpi->id) }}" class="preview-btn preview-btn-primary">
                        <i class="fas fa-download"></i> Download PDF SKPI
                    </a>
                @endif
                <a href="{{ route('mahasiswa.download.index') }}" class="preview-btn preview-btn-secondary">
                    <i class="fas fa-list"></i> Lihat Semua SKPI
                </a>
            </div>
        </div>
    </div>

    {{-- Note Card --}}
    @if ($statusClass === 'final')
        <div class="preview-note-card">
            <div class="preview-note-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="preview-note-content">
                <h4>SKPI Siap Diambil</h4>
                <p>Silakan datang ke Biro Akademik (Pusat Bahasa) untuk mengambil dokumen SKPI resmi Anda.</p>
            </div>
        </div>
    @endif
</div>
@endsection
