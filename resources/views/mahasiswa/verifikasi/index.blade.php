@extends('mahasiswa.layouts.app')

@section('title', 'Status Verifikasi')
@section('page_title', 'Status Verifikasi')
@section('page_icon', 'check-circle')

@section('content')
<style>
    /* ============ STATUS VERIFIKASI PREMIUM SKY BLUE ============ */
    .verif-page * {
        box-sizing: border-box;
    }

    .verif-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Premium Header */
    .verif-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .verif-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .verif-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .verif-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .verif-header-icon {
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

    .verif-header-text h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .verif-header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .verif-header-badge {
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 600;
    }

    .verif-header-badge i {
        font-size: 18px;
    }

    /* Stats Grid */
    .verif-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .verif-stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .verif-stat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
    }

    .verif-stat-card.pending::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    .verif-stat-card.approved::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .verif-stat-card.rejected::before { background: linear-gradient(180deg, #ef4444, #f87171); }
    .verif-stat-card.revision::before { background: linear-gradient(180deg, #f97316, #fb923c); }

    .verif-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .verif-stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .verif-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .verif-stat-card.pending .verif-stat-icon { background: #fef3c7; color: #f59e0b; }
    .verif-stat-card.approved .verif-stat-icon { background: #dcfce7; color: #10b981; }
    .verif-stat-card.rejected .verif-stat-icon { background: #fee2e2; color: #ef4444; }
    .verif-stat-card.revision .verif-stat-icon { background: #ffedd5; color: #f97316; }

    .verif-stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .verif-stat-label {
        font-size: 13px;
        color: #6b7280;
    }

    /* Info Box */
    .verif-info-box {
        background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
        border-left: 4px solid #0891b2;
        padding: 16px 20px;
        border-radius: 12px;
        font-size: 14px;
        color: #0369a1;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .verif-info-box i {
        font-size: 20px;
        color: #0891b2;
    }

    /* Section Title */
    .verif-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .verif-section-title i {
        color: #0891b2;
    }

    /* Cards Grid */
    .verif-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .verif-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: all 0.2s;
    }

    .verif-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(8, 145, 178, 0.12);
        border-color: #0891b2;
    }

    .verif-card-header {
        padding: 20px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .verif-card-header::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -20%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .verif-card-header.sertifikasi { background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); }
    .verif-card-header.prestasi { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); }
    .verif-card-header.organisasi { background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); }
    .verif-card-header.pkm { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); }
    .verif-card-header.karya { background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); }
    .verif-card-header.penghargaan { background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%); }

    .verif-card-chip {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        opacity: 0.9;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        position: relative;
        z-index: 1;
    }

    .verif-card-title {
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        position: relative;
        z-index: 1;
    }

    .verif-card-body {
        padding: 20px;
    }

    /* Status Badge */
    .verif-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .verif-badge.pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    .verif-badge.approved {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
    }

    .verif-badge.rejected {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
    }

    .verif-badge.revision {
        background: linear-gradient(135deg, #ffedd5, #fed7aa);
        color: #9a3412;
    }

    .verif-meta {
        margin-bottom: 16px;
    }

    .verif-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #6b7280;
        padding: 8px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .verif-meta-item:last-child {
        border-bottom: none;
    }

    .verif-meta-item i {
        width: 20px;
        color: #9ca3af;
    }

    .verif-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
    }

    .verif-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }

    /* Empty State */
    .verif-empty {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 60px 40px;
        text-align: center;
        grid-column: 1 / -1;
    }

    .verif-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #cffafe, #a5f3fc);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: #0891b2;
    }

    .verif-empty-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .verif-empty-text {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    .verif-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
        transition: all 0.2s;
    }

    .verif-empty-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .verif-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .verif-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .verif-stats-grid {
            grid-template-columns: 1fr;
        }

        .verif-cards-grid {
            grid-template-columns: 1fr;
        }

        .verif-header-text h1 {
            font-size: 20px;
        }
    }
</style>

<div class="verif-page">
    {{-- Premium Header --}}
    <div class="verif-header">
        <div class="verif-header-content">
            <div class="verif-header-left">
                <div class="verif-header-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="verif-header-text">
                    <h1>Status Verifikasi SKPI</h1>
                    <p>Pantau status verifikasi achievement Anda secara real-time</p>
                </div>
            </div>
            <div class="verif-header-badge">
                <i class="fas fa-user-graduate"></i>
                {{ auth()->user()->mahasiswa->nim ?? '-' }}
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    @php
        $totalPending = $verifikasi->where('status', 'pending')->count();
        // Support 'approved', 'valid', and 'included_in_summary'
        $totalApproved = $verifikasi->whereIn('status', ['approved', 'valid', 'included_in_summary'])->count();
        // Support 'rejected', 'tidak_valid', 'failed'
        $totalRejected = $verifikasi->whereIn('status', ['rejected', 'tidak_valid', 'failed'])->count();
        $totalRevision = $verifikasi->whereIn('status', ['revision_required', 'revisi'])->count();
    @endphp

    <div class="verif-stats-grid">
        <div class="verif-stat-card pending">
            <div class="verif-stat-header">
                <div class="verif-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="verif-stat-value">{{ $totalPending }}</div>
            <div class="verif-stat-label">Menunggu Verifikasi</div>
        </div>

        <div class="verif-stat-card approved">
            <div class="verif-stat-header">
                <div class="verif-stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="verif-stat-value">{{ $totalApproved }}</div>
            <div class="verif-stat-label">Disetujui</div>
        </div>

        <div class="verif-stat-card rejected">
            <div class="verif-stat-header">
                <div class="verif-stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="verif-stat-value">{{ $totalRejected }}</div>
            <div class="verif-stat-label">Ditolak</div>
        </div>

        <div class="verif-stat-card revision">
            <div class="verif-stat-header">
                <div class="verif-stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <div class="verif-stat-value">{{ $totalRevision }}</div>
            <div class="verif-stat-label">Perlu Revisi</div>
        </div>
    </div>

    {{-- Info Box --}}
    <div class="verif-info-box">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>Informasi:</strong> Pastikan semua achievement sudah terverifikasi sebelum mengunduh SKPI final. 
            Klik tombol "Lihat Detail" untuk melihat informasi lengkap setiap pengajuan.
        </div>
    </div>

    {{-- Section Title --}}
    <h2 class="verif-section-title">
        <i class="fas fa-list-check"></i>
        Daftar Pengajuan Verifikasi
    </h2>

    {{-- Cards Grid --}}
    <div class="verif-cards-grid">
        @if ($verifikasi->count() > 0)
            @foreach ($verifikasi as $item)
                @php
                    $type = class_basename($item->verifiable_type);
                    $title = $item->verifiable
                        ? $item->verifiable->judul_prestasi ??
                            ($item->verifiable->nama_sertifikasi ??
                                ($item->verifiable->nama_organisasi ??
                                    ($item->verifiable->judul_pkm ??
                                        ($item->verifiable->judul_karya ??
                                            ($item->verifiable->nama_penghargaan ?? 'N/A')))))
                        : 'Data tidak tersedia';
                    
                    // Determine category class
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
                @endphp

                <div class="verif-card">
                    <div class="verif-card-header {{ $catClass }}">
                        <div class="verif-card-chip">
                            <i class="fas {{ $catIcon }}"></i>
                            {{ $catName }}
                        </div>
                        <div class="verif-card-title">
                            {{ \Illuminate\Support\Str::limit($title, 50) }}
                        </div>
                    </div>

                    <div class="verif-card-body">
                        {{-- Status Badge --}}
                        @if ($item->status == 'pending')
                            <span class="verif-badge pending">
                                <i class="fas fa-clock"></i> Menunggu Verifikasi
                            </span>
                        @elseif (in_array($item->status, ['approved', 'valid', 'included_in_summary']))
                            <span class="verif-badge approved">
                                <i class="fas fa-check-circle"></i> Disetujui
                            </span>
                        @elseif (in_array($item->status, ['rejected', 'tidak_valid', 'failed']))
                            <span class="verif-badge rejected">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </span>
                        @elseif (in_array($item->status, ['revision_required', 'revisi']))
                            <span class="verif-badge revision">
                                <i class="fas fa-exclamation-triangle"></i> Perlu Revisi
                            </span>
                        @else
                             {{-- Fallback: Show raw status --}}
                             <span class="verif-badge badge-secondary" style="background: #e5e7eb; color: #374151;">
                                <i class="fas fa-question-circle"></i> {{ ucfirst($item->status ?? 'Status Kosong') }}
                            </span>
                        @endif

                        {{-- Meta Info --}}
                        <div class="verif-meta">
                            <div class="verif-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Diajukan: {{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d M Y') : '-' }}</span>
                            </div>
                            <div class="verif-meta-item">
                                <i class="fas fa-layer-group"></i>
                                <span>Level: {{ ucwords(str_replace('_', ' ', $item->level_verifikasi ?? '-')) }}</span>
                            </div>
                        </div>

                        {{-- Detail Button --}}
                        <a href="{{ route('mahasiswa.verifikasi.detail', $item->id) }}" class="verif-btn">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="verif-empty">
                <div class="verif-empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="verif-empty-title">Belum Ada Pengajuan Verifikasi</div>
                <div class="verif-empty-text">
                    Submit achievement Anda terlebih dahulu untuk memulai proses verifikasi SKPI.
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="verif-empty-btn">
                    <i class="fas fa-plus"></i> Tambah Achievement
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

