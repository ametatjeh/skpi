@extends('mahasiswa.layouts.app')

@section('title', 'Detail Verifikasi')
@section('page_title', 'Detail Verifikasi')
@section('page_icon', 'eye')

@section('content')
<style>
    /* ============ DETAIL VERIFIKASI PREMIUM SKY BLUE ============ */
    .detail-page * {
        box-sizing: border-box;
    }

    .detail-page {
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
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(14, 165, 233, 0.25);
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
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 8px 0;
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
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-status-header.pending { background: linear-gradient(135deg, #fef3c7, #fde68a); }
    .detail-status-header.approved { background: linear-gradient(135deg, #dcfce7, #bbf7d0); }
    .detail-status-header.rejected { background: linear-gradient(135deg, #fee2e2, #fecaca); }
    .detail-status-header.revision { background: linear-gradient(135deg, #ffedd5, #fed7aa); }

    .detail-status-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

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

    .detail-status-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }

    .detail-status-header.pending .detail-status-title { color: #92400e; }
    .detail-status-header.approved .detail-status-title { color: #166534; }
    .detail-status-header.rejected .detail-status-title { color: #991b1b; }
    .detail-status-header.revision .detail-status-title { color: #9a3412; }

    .detail-status-subtitle {
        font-size: 13px;
    }

    .detail-status-header.pending .detail-status-subtitle { color: #a16207; }
    .detail-status-header.approved .detail-status-subtitle { color: #15803d; }
    .detail-status-header.rejected .detail-status-subtitle { color: #b91c1c; }
    .detail-status-header.revision .detail-status-subtitle { color: #c2410c; }

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
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
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

    /* Info Table */
    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table tr {
        border-bottom: 1px solid #f3f4f6;
    }

    .detail-table tr:last-child {
        border-bottom: none;
    }

    .detail-table tr:hover {
        background: #f8fafc;
    }

    .detail-table th {
        width: 180px;
        padding: 14px 16px;
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        vertical-align: top;
    }

    .detail-table td {
        padding: 14px 16px;
        color: #111827;
        font-size: 14px;
    }

    .detail-table strong {
        font-weight: 700;
        color: #0ea5e9;
    }

    /* Note Box */
    .detail-note-box {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        padding: 16px 20px;
        border-radius: 12px;
        border-left: 4px solid #0ea5e9;
        color: #0369a1;
        font-size: 14px;
        line-height: 1.6;
    }

    .detail-note-box.warning {
        background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
        border-left-color: #f97316;
        color: #9a3412;
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

    .detail-category-badge.sertifikasi { background: #e0f2fe; color: #0369a1; }
    .detail-category-badge.prestasi { background: #fef3c7; color: #92400e; }
    .detail-category-badge.organisasi { background: #f3e8ff; color: #7c3aed; }
    .detail-category-badge.pkm { background: #dcfce7; color: #166534; }
    .detail-category-badge.karya { background: #fce7f3; color: #be185d; }
    .detail-category-badge.penghargaan { background: #e0e7ff; color: #4f46e5; }

    /* Action Buttons */
    .detail-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .detail-btn-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .detail-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
    }

    .detail-btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .detail-btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
    }

    /* Timeline */
    .detail-timeline {
        position: relative;
        padding-left: 28px;
    }

    .detail-timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e5e7eb;
    }

    .detail-timeline-item {
        position: relative;
        padding-bottom: 20px;
    }

    .detail-timeline-item:last-child {
        padding-bottom: 0;
    }

    .detail-timeline-dot {
        position: absolute;
        left: -28px;
        top: 4px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0ea5e9;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);
    }

    .detail-timeline-content {
        background: #f8fafc;
        padding: 14px 16px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .detail-timeline-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
    }

    .detail-timeline-meta {
        font-size: 12px;
        color: #6b7280;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .detail-header-text h1 {
            font-size: 20px;
        }

        .detail-table th {
            width: 120px;
            font-size: 12px;
        }

        .detail-status-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
    }
</style>

<div class="detail-page">
    {{-- Back Button --}}
    <a href="{{ route('mahasiswa.verifikasi.index') }}" class="detail-back-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>

    @php
        $type = class_basename($verifikasi->verifiable_type);
        $title = $verifikasi->verifiable
            ? $verifikasi->verifiable->judul_prestasi ??
                ($verifikasi->verifiable->nama_sertifikasi ??
                    ($verifikasi->verifiable->nama_organisasi ??
                        ($verifikasi->verifiable->judul_pkm ??
                            ($verifikasi->verifiable->judul_karya ??
                                ($verifikasi->verifiable->nama_penghargaan ?? 'N/A')))))
            : 'Data tidak tersedia';
        
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

        // Status class
        $statusClass = $verifikasi->status == 'revision_required' ? 'revision' : $verifikasi->status;
    @endphp

    {{-- Premium Header --}}
    <div class="detail-header">
        <div class="detail-header-content">
            <div class="detail-header-icon">
                <i class="fas {{ $catIcon }}"></i>
            </div>
            <div class="detail-header-text">
                <h1>{{ \Illuminate\Support\Str::limit($title, 60) }}</h1>
                <p>Detail informasi dan status verifikasi achievement Anda</p>
            </div>
        </div>
    </div>

    {{-- Status Card --}}
    <div class="detail-status-card">
        <div class="detail-status-header {{ $statusClass }}">
            <div class="detail-status-left">
                <div class="detail-status-icon">
                    @if ($verifikasi->status == 'pending')
                        <i class="fas fa-clock"></i>
                    @elseif ($verifikasi->status == 'approved')
                        <i class="fas fa-check-circle"></i>
                    @elseif ($verifikasi->status == 'rejected')
                        <i class="fas fa-times-circle"></i>
                    @elseif ($verifikasi->status == 'revision_required')
                        <i class="fas fa-exclamation-triangle"></i>
                    @endif
                </div>
                <div>
                    <h2 class="detail-status-title">
                        @if ($verifikasi->status == 'pending')
                            Menunggu Verifikasi
                        @elseif ($verifikasi->status == 'approved')
                            Verifikasi Disetujui
                        @elseif ($verifikasi->status == 'rejected')
                            Verifikasi Ditolak
                        @elseif ($verifikasi->status == 'revision_required')
                            Perlu Revisi
                        @endif
                    </h2>
                    <p class="detail-status-subtitle">
                        @if ($verifikasi->status == 'pending')
                            Pengajuan Anda sedang dalam proses verifikasi oleh Prodi
                        @elseif ($verifikasi->status == 'approved')
                            Selamat! Achievement Anda telah diverifikasi dan disetujui
                        @elseif ($verifikasi->status == 'rejected')
                            Maaf, pengajuan Anda tidak dapat disetujui
                        @elseif ($verifikasi->status == 'revision_required')
                            Silakan perbaiki data sesuai catatan verifikator
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="detail-info-card">
        <div class="detail-info-header">
            <div class="detail-info-header-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <h3>Informasi Achievement</h3>
        </div>

        <div class="detail-info-body">
            <table class="detail-table">
                <tr>
                    <th>Kategori</th>
                    <td>
                        <span class="detail-category-badge {{ $catClass }}">
                            <i class="fas {{ $catIcon }}"></i>
                            {{ $catName }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Judul/Nama</th>
                    <td><strong>{{ $title }}</strong></td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>
                        <i class="fas fa-calendar text-sky-500"></i>
                        {{ $verifikasi->tanggal_pengajuan->format('d F Y, H:i') }} WIB
                    </td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $verifikasi->prodi->nama_prodi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Level Verifikasi</th>
                    <td>{{ ucwords(str_replace('_', ' ', $verifikasi->level_verifikasi)) }}</td>
                </tr>
                @if ($verifikasi->catatan)
                    <tr>
                        <th>Catatan Verifikator</th>
                        <td>
                            <div class="detail-note-box {{ $verifikasi->status == 'revision_required' || $verifikasi->status == 'rejected' ? 'warning' : '' }}">
                                <i class="fas fa-comment-alt"></i>
                                {{ $verifikasi->catatan }}
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{-- Action Buttons --}}
            @if ($verifikasi->status == 'revision_required' && $verifikasi->verifiable)
                @php
                    $type = class_basename($verifikasi->verifiable_type);
                    // Tentukan route edit berdasar tipe
                    if (str_contains($type, 'Sertifikasi')) {
                        $editRoute = route('mahasiswa.sertifikasi.edit', $verifikasi->verifiable->id);
                    } elseif (str_contains($type, 'Prestasi')) {
                        $editRoute = route('mahasiswa.prestasi.edit', $verifikasi->verifiable->id);
                    } elseif (str_contains($type, 'Organisasi')) {
                        $editRoute = route('mahasiswa.organisasi.edit', $verifikasi->verifiable->id);
                    } elseif (str_contains($type, 'Pengabdian')) {
                        $editRoute = route('mahasiswa.pkm.edit', $verifikasi->verifiable->id);
                    } elseif (str_contains($type, 'Karya')) {
                        $editRoute = route('mahasiswa.karya.edit', $verifikasi->verifiable->id);
                    } elseif (str_contains($type, 'Penghargaan')) {
                        $editRoute = route('mahasiswa.penghargaan.edit', $verifikasi->verifiable->id);
                    } else {
                        $editRoute = '#';
                    }
                @endphp
                <div class="detail-actions">
                    <a href="{{ $editRoute }}" class="detail-btn detail-btn-warning">
                        <i class="fas fa-edit"></i> Revisi & Edit Data
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Approval History Timeline --}}
    @if ($verifikasi->approvalLogs && $verifikasi->approvalLogs->count() > 0)
        <div class="detail-info-card">
            <div class="detail-info-header">
                <div class="detail-info-header-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3>Riwayat Verifikasi</h3>
            </div>

            <div class="detail-info-body">
                <div class="detail-timeline">
                    @foreach ($verifikasi->approvalLogs->sortByDesc('created_at') as $log)
                        <div class="detail-timeline-item">
                            <div class="detail-timeline-dot"></div>
                            <div class="detail-timeline-content">
                                <div class="detail-timeline-title">
                                    {{ ucfirst($log->action ?? 'Update') }} oleh {{ $log->user->name ?? 'System' }}
                                </div>
                                <div class="detail-timeline-meta">
                                    <i class="fas fa-clock"></i>
                                    {{ $log->created_at->format('d M Y, H:i') }}
                                    @if ($log->catatan)
                                        <br>
                                        <i class="fas fa-comment"></i>
                                        {{ $log->catatan }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
