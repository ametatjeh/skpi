@extends('mahasiswa.layouts.app')

@section('title', 'Riwayat Approval')
@section('page_title', 'Riwayat Approval')
@section('page_icon', 'history')

@section('content')
<style>
    /* ============ RIWAYAT APPROVAL PREMIUM SKY BLUE ============ */
    .approval-page * {
        box-sizing: border-box;
    }

    .approval-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Premium Header */
    .approval-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .approval-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .approval-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .approval-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .approval-header-icon {
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

    .approval-header-text h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .approval-header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .approval-header-badge {
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

    .approval-header-badge i {
        font-size: 18px;
    }

    /* Stats Grid */
    .approval-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .approval-stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .approval-stat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
    }

    .approval-stat-card.total::before { background: linear-gradient(180deg, #0891b2, #06b6d4); }
    .approval-stat-card.approved::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .approval-stat-card.pending::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    .approval-stat-card.rejected::before { background: linear-gradient(180deg, #ef4444, #f87171); }

    .approval-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .approval-stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .approval-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .approval-stat-card.total .approval-stat-icon { background: #cffafe; color: #0891b2; }
    .approval-stat-card.approved .approval-stat-icon { background: #dcfce7; color: #10b981; }
    .approval-stat-card.pending .approval-stat-icon { background: #fef3c7; color: #f59e0b; }
    .approval-stat-card.rejected .approval-stat-icon { background: #fee2e2; color: #ef4444; }

    .approval-stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .approval-stat-label {
        font-size: 13px;
        color: #6b7280;
    }

    /* Section Title */
    .approval-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .approval-section-title i {
        color: #0891b2;
    }

    /* Table Card */
    .approval-table-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .approval-table-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .approval-table-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .approval-table-title-icon {
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

    .approval-table-title h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .approval-table-title p {
        font-size: 12px;
        color: #6b7280;
        margin: 2px 0 0;
    }

    .approval-table-container {
        overflow-x: auto;
    }

    .approval-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .approval-table thead th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #f8fafc;
        border-bottom: 2px solid #e5e7eb;
    }

    .approval-table tbody td {
        padding: 16px 20px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .approval-table tbody tr {
        transition: all 0.2s;
    }

    .approval-table tbody tr:hover {
        background: #f0f9ff;
    }

    .approval-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Row Number */
    .approval-row-num {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #cffafe, #a5f3fc);
        color: #0369a1;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    /* Item Info */
    .approval-item-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .approval-item-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .approval-item-icon.sertifikasi { background: #cffafe; color: #0891b2; }
    .approval-item-icon.prestasi { background: #fef3c7; color: #f59e0b; }
    .approval-item-icon.organisasi { background: #f3e8ff; color: #8b5cf6; }
    .approval-item-icon.pkm { background: #dcfce7; color: #10b981; }
    .approval-item-icon.karya { background: #fce7f3; color: #ec4899; }
    .approval-item-icon.penghargaan { background: #e0e7ff; color: #6366f1; }

    .approval-item-text h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px;
    }

    .approval-item-text p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    /* Status Badge */
    .approval-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .approval-badge.approved {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
    }

    .approval-badge.pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    .approval-badge.rejected {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
    }

    .approval-badge.revision {
        background: linear-gradient(135deg, #ffedd5, #fed7aa);
        color: #9a3412;
    }

    /* Date */
    .approval-date {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #6b7280;
    }

    .approval-date i {
        color: #9ca3af;
    }

    /* Action Button */
    .approval-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
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

    .approval-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }

    /* Empty State */
    .approval-empty {
        padding: 60px 40px;
        text-align: center;
    }

    .approval-empty-icon {
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

    .approval-empty-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .approval-empty-text {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    .approval-empty-btn {
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

    .approval-empty-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .approval-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .approval-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .approval-stats-grid {
            grid-template-columns: 1fr;
        }

        .approval-header-text h1 {
            font-size: 20px;
        }

        .approval-table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>

<div class="approval-page">
    {{-- Premium Header --}}
    <div class="approval-header">
        <div class="approval-header-content">
            <div class="approval-header-left">
                <div class="approval-header-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div class="approval-header-text">
                    <h1>Riwayat Approval</h1>
                    <p>Lacak perjalanan approval setiap pengajuan achievement Anda</p>
                </div>
            </div>
            <div class="approval-header-badge">
                <i class="fas fa-clock"></i>
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    @php
        $totalApproval = $approvalHistory->count();
        $totalApproved = $approvalHistory->where('status', 'approved')->count();
        $totalPending = $approvalHistory->where('status', 'pending')->count();
        $totalRejected = $approvalHistory->where('status', 'rejected')->count();
    @endphp

    <div class="approval-stats-grid">
        <div class="approval-stat-card total">
            <div class="approval-stat-header">
                <div class="approval-stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
            <div class="approval-stat-value">{{ $totalApproval }}</div>
            <div class="approval-stat-label">Total Pengajuan</div>
        </div>

        <div class="approval-stat-card approved">
            <div class="approval-stat-header">
                <div class="approval-stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="approval-stat-value">{{ $totalApproved }}</div>
            <div class="approval-stat-label">Disetujui</div>
        </div>

        <div class="approval-stat-card pending">
            <div class="approval-stat-header">
                <div class="approval-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="approval-stat-value">{{ $totalPending }}</div>
            <div class="approval-stat-label">Menunggu</div>
        </div>

        <div class="approval-stat-card rejected">
            <div class="approval-stat-header">
                <div class="approval-stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="approval-stat-value">{{ $totalRejected }}</div>
            <div class="approval-stat-label">Ditolak</div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="approval-table-card">
        <div class="approval-table-header">
            <div class="approval-table-title">
                <div class="approval-table-title-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div>
                    <h3>Daftar Riwayat Approval</h3>
                    <p>Klik "Detail" untuk melihat timeline lengkap</p>
                </div>
            </div>
        </div>

        @if ($approvalHistory->count() > 0)
            <div class="approval-table-container">
                <table class="approval-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Pengajuan</th>
                            <th style="width: 150px;">Tanggal</th>
                            <th style="width: 160px;">Status</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvalHistory as $key => $item)
                            @php
                                $type = class_basename($item->verifiable_type ?? '');
                                $title = $item->verifiable->judul_prestasi ??
                                    ($item->verifiable->nama_sertifikasi ??
                                        ($item->verifiable->nama_organisasi ??
                                            ($item->verifiable->judul_pkm ??
                                                ($item->verifiable->judul_karya ??
                                                    ($item->verifiable->nama_penghargaan ?? '-')))));
                                
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

                                $status = $item->status;
                                $statusClass = $status == 'revision_required' ? 'revision' : $status;
                            @endphp
                            <tr>
                                <td>
                                    <div class="approval-row-num">{{ $key + 1 }}</div>
                                </td>
                                <td>
                                    <div class="approval-item-info">
                                        <div class="approval-item-icon {{ $catClass }}">
                                            <i class="fas {{ $catIcon }}"></i>
                                        </div>
                                        <div class="approval-item-text">
                                            <h4>{{ \Illuminate\Support\Str::limit($title, 40) }}</h4>
                                            <p>{{ $catName }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="approval-date">
                                        <i class="fas fa-calendar"></i>
                                        {{ $item->tanggal_pengajuan->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="approval-badge {{ $statusClass }}">
                                        @if ($status == 'approved')
                                            <i class="fas fa-check-circle"></i> Disetujui
                                        @elseif ($status == 'pending')
                                            <i class="fas fa-clock"></i> Menunggu
                                        @elseif ($status == 'rejected')
                                            <i class="fas fa-times-circle"></i> Ditolak
                                        @elseif ($status == 'revision_required')
                                            <i class="fas fa-exclamation-triangle"></i> Revisi
                                        @else
                                            {{ ucfirst($status) }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('mahasiswa.approval.detail', $item->id) }}" class="approval-btn">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="approval-empty">
                <div class="approval-empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="approval-empty-title">Belum Ada Riwayat Approval</div>
                <div class="approval-empty-text">
                    Submit achievement Anda terlebih dahulu untuk memulai proses approval.
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="approval-empty-btn">
                    <i class="fas fa-plus"></i> Tambah Achievement
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

