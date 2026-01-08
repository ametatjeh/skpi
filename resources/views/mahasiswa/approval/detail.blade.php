@extends('mahasiswa.layouts.app')

@section('title', 'Detail Riwayat Approval')
@section('page_title', 'Detail Riwayat Approval')
@section('page_icon', 'eye')

@section('content')
<style>
    /* ============ DETAIL APPROVAL PREMIUM SKY BLUE ============ */
    .detail-approval-page * {
        box-sizing: border-box;
    }

    .detail-approval-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Back Button */
    .detail-back-btn {
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

    .detail-back-btn:hover {
        background: #f3f4f6;
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .detail-back-btn i {
        transition: transform 0.2s;
    }

    .detail-back-btn:hover i {
        transform: translateX(-4px);
    }

    /* Premium Header */
    .detail-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .detail-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .detail-header-content {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .detail-header-icon {
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

    .detail-header-text h1 {
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 8px 0;
        line-height: 1.3;
    }

    .detail-header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    /* Status Card */
    .detail-status-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .detail-status-header {
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .detail-status-header.pending { background: linear-gradient(135deg, #fef3c7, #fde68a); }
    .detail-status-header.approved { background: linear-gradient(135deg, #dcfce7, #bbf7d0); }
    .detail-status-header.rejected { background: linear-gradient(135deg, #fee2e2, #fecaca); }
    .detail-status-header.revision { background: linear-gradient(135deg, #ffedd5, #fed7aa); }

    .detail-status-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .detail-status-header.pending .detail-status-icon { background: #f59e0b; color: #fff; }
    .detail-status-header.approved .detail-status-icon { background: #10b981; color: #fff; }
    .detail-status-header.rejected .detail-status-icon { background: #ef4444; color: #fff; }
    .detail-status-header.revision .detail-status-icon { background: #f97316; color: #fff; }

    .detail-status-info h2 {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }

    .detail-status-header.pending .detail-status-info h2 { color: #92400e; }
    .detail-status-header.approved .detail-status-info h2 { color: #166534; }
    .detail-status-header.rejected .detail-status-info h2 { color: #991b1b; }
    .detail-status-header.revision .detail-status-info h2 { color: #9a3412; }

    .detail-status-info p {
        font-size: 13px;
        margin: 0;
    }

    .detail-status-header.pending .detail-status-info p { color: #a16207; }
    .detail-status-header.approved .detail-status-info p { color: #15803d; }
    .detail-status-header.rejected .detail-status-info p { color: #b91c1c; }
    .detail-status-header.revision .detail-status-info p { color: #c2410c; }

    /* Info Card */
    .detail-info-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .detail-info-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .detail-info-header-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
    }

    .detail-info-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .detail-info-body {
        padding: 24px;
    }

    /* Info Grid */
    .detail-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .detail-info-item {
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .detail-info-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-info-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .detail-info-value {
        font-size: 15px;
        font-weight: 600;
        color: #111827;
    }

    .detail-info-value.highlight {
        color: #0891b2;
    }

    /* Category Badge */
    .detail-category-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
    }

    .detail-category-badge.sertifikasi { background: #cffafe; color: #0369a1; }
    .detail-category-badge.prestasi { background: #fef3c7; color: #92400e; }
    .detail-category-badge.organisasi { background: #f3e8ff; color: #7c3aed; }
    .detail-category-badge.pkm { background: #dcfce7; color: #166534; }
    .detail-category-badge.karya { background: #fce7f3; color: #be185d; }
    .detail-category-badge.penghargaan { background: #e0e7ff; color: #4f46e5; }

    /* Timeline */
    .detail-timeline {
        position: relative;
        padding-left: 32px;
    }

    .detail-timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 16px;
        bottom: 16px;
        width: 2px;
        background: linear-gradient(180deg, #0891b2, #06b6d4);
    }

    .detail-timeline-item {
        position: relative;
        padding-bottom: 24px;
    }

    .detail-timeline-item:last-child {
        padding-bottom: 0;
    }

    .detail-timeline-dot {
        position: absolute;
        left: -32px;
        top: 6px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(8, 145, 178, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-timeline-dot i {
        font-size: 10px;
        color: #fff;
    }

    .detail-timeline-content {
        background: #f8fafc;
        padding: 18px 20px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .detail-timeline-content:hover {
        background: #cffafe;
        border-color: #0891b2;
        transform: translateX(4px);
    }

    .detail-timeline-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .detail-timeline-action {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
    }

    .detail-timeline-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        background: #cffafe;
        color: #0369a1;
    }

    .detail-timeline-meta {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .detail-timeline-meta i {
        margin-right: 6px;
        color: #9ca3af;
    }

    .detail-timeline-note {
        background: #fff;
        padding: 12px 14px;
        border-radius: 8px;
        border-left: 3px solid #0891b2;
        font-size: 13px;
        color: #374151;
        margin-top: 8px;
    }

    .detail-timeline-note i {
        color: #0891b2;
        margin-right: 6px;
    }

    /* Empty Timeline */
    .detail-timeline-empty {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .detail-timeline-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #9ca3af;
    }

    .detail-timeline-empty p {
        font-size: 14px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .detail-header-text h1 {
            font-size: 18px;
        }

        .detail-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="detail-approval-page">
    {{-- Back Button --}}
    <a href="{{ route('mahasiswa.approval.index') }}" class="detail-back-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>

    @php
        $type = class_basename($approval->verifiable_type ?? '');
        $judul = $approval->verifiable->judul_prestasi ??
            ($approval->verifiable->nama_sertifikasi ??
                ($approval->verifiable->nama_organisasi ??
                    ($approval->verifiable->judul_pkm ??
                        ($approval->verifiable->judul_karya ??
                            ($approval->verifiable->nama_penghargaan ?? '-')))));
        
        // Determine category
        if (str_contains($type, 'Sertifikasi')) {
            $catClass = 'sertifikasi';
            $catIcon = 'fa-certificate';
            $catName = 'Sertifikasi';
        } elseif (str_contains($type, 'Prestasi')) {
            $catClass = 'prestasi';
            $catIcon = 'fa-trophy';
            $catName = 'Prestasi';
        } elseif (str_contains($type, 'Organisasi')) {
            $catClass = 'organisasi';
            $catIcon = 'fa-users';
            $catName = 'Organisasi';
        } elseif (str_contains($type, 'Pengabdian')) {
            $catClass = 'pkm';
            $catIcon = 'fa-handshake';
            $catName = 'PKM';
        } elseif (str_contains($type, 'Karya')) {
            $catClass = 'karya';
            $catIcon = 'fa-book';
            $catName = 'Karya Ilmiah';
        } else {
            $catClass = 'penghargaan';
            $catIcon = 'fa-award';
            $catName = 'Penghargaan';
        }

        $status = $approval->status;
        $statusClass = $status == 'revision_required' ? 'revision' : $status;
    @endphp

    {{-- Premium Header --}}
    <div class="detail-header">
        <div class="detail-header-content">
            <div class="detail-header-icon">
                <i class="fas {{ $catIcon }}"></i>
            </div>
            <div class="detail-header-text">
                <h1>{{ \Illuminate\Support\Str::limit($judul, 60) }}</h1>
                <p>Detail riwayat approval dan timeline persetujuan</p>
            </div>
        </div>
    </div>

    {{-- Status Card --}}
    <div class="detail-status-card">
        <div class="detail-status-header {{ $statusClass }}">
            <div class="detail-status-icon">
                @if ($status == 'pending')
                    <i class="fas fa-clock"></i>
                @elseif ($status == 'approved')
                    <i class="fas fa-check-circle"></i>
                @elseif ($status == 'rejected')
                    <i class="fas fa-times-circle"></i>
                @elseif ($status == 'revision_required')
                    <i class="fas fa-exclamation-triangle"></i>
                @endif
            </div>
            <div class="detail-status-info">
                <h2>
                    @if ($status == 'pending')
                        Menunggu Verifikasi
                    @elseif ($status == 'approved')
                        Pengajuan Disetujui
                    @elseif ($status == 'rejected')
                        Pengajuan Ditolak
                    @elseif ($status == 'revision_required')
                        Perlu Revisi
                    @endif
                </h2>
                <p>
                    @if ($status == 'pending')
                        Pengajuan Anda sedang dalam proses review
                    @elseif ($status == 'approved')
                        Selamat! Achievement ini telah diverifikasi
                    @elseif ($status == 'rejected')
                        Maaf, pengajuan Anda tidak dapat disetujui
                    @elseif ($status == 'revision_required')
                        Silakan perbaiki sesuai catatan verifikator
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="detail-info-card">
        <div class="detail-info-header">
            <div class="detail-info-header-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <h3>Informasi Pengajuan</h3>
        </div>

        <div class="detail-info-body">
            <div class="detail-info-grid">
                <div class="detail-info-item">
                    <div class="detail-info-label">Kategori</div>
                    <div class="detail-info-value">
                        <span class="detail-category-badge {{ $catClass }}">
                            <i class="fas {{ $catIcon }}"></i>
                            {{ $catName }}
                        </span>
                    </div>
                </div>
                <div class="detail-info-item">
                    <div class="detail-info-label">Tanggal Pengajuan</div>
                    <div class="detail-info-value">
                        <i class="fas fa-calendar" style="color: #0891b2; margin-right: 6px;"></i>
                        {{ $approval->tanggal_pengajuan->format('d F Y') }}
                    </div>
                </div>
                <div class="detail-info-item full-width">
                    <div class="detail-info-label">Judul Pengajuan</div>
                    <div class="detail-info-value highlight">{{ $judul }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Timeline Card --}}
    <div class="detail-info-card">
        <div class="detail-info-header">
            <div class="detail-info-header-icon">
                <i class="fas fa-history"></i>
            </div>
            <h3>Timeline Approval</h3>
        </div>

        <div class="detail-info-body">
            @if ($approval->approvalLogs && $approval->approvalLogs->count() > 0)
                <div class="detail-timeline">
                    @foreach ($approval->approvalLogs->sortByDesc('created_at') as $log)
                        <div class="detail-timeline-item">
                            <div class="detail-timeline-dot">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="detail-timeline-content">
                                <div class="detail-timeline-header">
                                    <span class="detail-timeline-action">
                                        {{ ucfirst($log->action ?? 'Update') }}
                                    </span>
                                    <span class="detail-timeline-badge">
                                        <i class="fas fa-user"></i>
                                        {{ $log->approver_role ?? 'System' }}
                                    </span>
                                </div>
                                <div class="detail-timeline-meta">
                                    <i class="fas fa-clock"></i>
                                    {{ $log->created_at->format('d M Y, H:i') }} WIB
                                </div>
                                @if ($log->catatan)
                                    <div class="detail-timeline-note">
                                        <i class="fas fa-comment-alt"></i>
                                        {{ $log->catatan }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="detail-timeline-empty">
                    <div class="detail-timeline-empty-icon">
                        <i class="fas fa-stream"></i>
                    </div>
                    <p>Belum ada riwayat approval untuk pengajuan ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

