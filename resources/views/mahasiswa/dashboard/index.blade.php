@extends('mahasiswa.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Mahasiswa')
@section('page_icon', 'home')

@section('content')
<style>
    /* ============ DASHBOARD MAHASISWA PREMIUM CYAN ============ */
    .mhs-dashboard * {
        box-sizing: border-box;
    }

    .mhs-dashboard {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Welcome Header */
    .mhs-welcome {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .mhs-welcome::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .mhs-welcome-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .mhs-welcome-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .mhs-welcome-avatar {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .mhs-welcome-text h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .mhs-welcome-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .mhs-welcome-badge {
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

    .mhs-welcome-badge i {
        font-size: 18px;
    }

    /* Stats Grid */
    .mhs-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .mhs-stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .mhs-stat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
    }

    .mhs-stat-card.cyan::before { background: linear-gradient(180deg, #0891b2, #06b6d4); }
    .mhs-stat-card.amber::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    .mhs-stat-card.green::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .mhs-stat-card.purple::before { background: linear-gradient(180deg, #8b5cf6, #a78bfa); }

    .mhs-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .mhs-stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .mhs-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .mhs-stat-card.cyan .mhs-stat-icon { background: #cffafe; color: #0891b2; }
    .mhs-stat-card.amber .mhs-stat-icon { background: #fef3c7; color: #f59e0b; }
    .mhs-stat-card.green .mhs-stat-icon { background: #dcfce7; color: #10b981; }
    .mhs-stat-card.purple .mhs-stat-icon { background: #f3e8ff; color: #8b5cf6; }

    .mhs-stat-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .mhs-stat-badge.pending { background: #fef3c7; color: #92400e; }
    .mhs-stat-badge.approved { background: #dcfce7; color: #15803d; }

    .mhs-stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .mhs-stat-label {
        font-size: 13px;
        color: #6b7280;
    }

    /* Achievement Cards Grid */
    .mhs-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mhs-section-title i {
        color: #0891b2;
    }

    .mhs-cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .mhs-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: all 0.2s;
    }

    .mhs-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(8, 145, 178, 0.12);
        border-color: #0891b2;
    }

    .mhs-card-body {
        padding: 28px 24px;
        text-align: center;
    }

    .mhs-card-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .mhs-card.sertifikasi .mhs-card-icon { background: linear-gradient(135deg, #cffafe, #a5f3fc); color: #0891b2; }
    .mhs-card.prestasi .mhs-card-icon { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #f59e0b; }
    .mhs-card.organisasi .mhs-card-icon { background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #10b981; }
    .mhs-card.pkm .mhs-card-icon { background: linear-gradient(135deg, #f3e8ff, #e9d5ff); color: #8b5cf6; }

    .mhs-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .mhs-card-text {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .mhs-card-btn {
        display: inline-flex;
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

    .mhs-card-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.35);
    }

    /* Content Grid */
    .mhs-content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    /* Steps Card */
    .mhs-steps-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .mhs-steps-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mhs-steps-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .mhs-steps-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .mhs-steps-body {
        padding: 20px 24px;
    }

    .mhs-step {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.2s;
    }

    .mhs-step:last-child {
        margin-bottom: 0;
    }

    .mhs-step:hover {
        background: #cffafe;
        transform: translateX(4px);
    }

    .mhs-step-number {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
    }

    .mhs-step-content h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }

    .mhs-step-content p {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    /* Quick Actions */
    .mhs-quick-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .mhs-quick-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mhs-quick-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .mhs-quick-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .mhs-quick-body {
        padding: 20px;
    }

    .mhs-quick-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 12px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .mhs-quick-item:last-child {
        margin-bottom: 0;
    }

    .mhs-quick-item:hover {
        background: #cffafe;
        transform: translateX(4px);
    }

    .mhs-quick-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .mhs-quick-icon.cyan { background: #cffafe; color: #0891b2; }
    .mhs-quick-icon.green { background: #dcfce7; color: #10b981; }
    .mhs-quick-icon.amber { background: #fef3c7; color: #f59e0b; }

    .mhs-quick-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }

    .mhs-quick-info p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .mhs-stats-grid,
        .mhs-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .mhs-content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .mhs-welcome-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .mhs-stats-grid,
        .mhs-cards-grid {
            grid-template-columns: 1fr;
        }

        .mhs-welcome-text h1 {
            font-size: 20px;
        }
    }

    /* ===== SKPI NOTIFICATION BANNER ===== */
    .skpi-notification {
        background: linear-gradient(135deg, #10b981 0%, #34d399 50%, #6ee7b7 100%);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .skpi-notification::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .skpi-notification-content {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .skpi-notification-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .skpi-notification-text {
        flex: 1;
    }

    .skpi-notification-text h3 {
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .skpi-notification-text p {
        font-size: 14px;
        margin: 0;
        opacity: 0.95;
        line-height: 1.5;
    }

    .skpi-notification-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .skpi-notification-btn {
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .skpi-notification-btn:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: translateY(-2px);
    }

    .skpi-notification-close {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .skpi-notification-close:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: rotate(90deg);
    }

    .skpi-notification.hiding {
        animation: slideUp 0.3s ease-out forwards;
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    @media (max-width: 768px) {
        .skpi-notification-content {
            flex-direction: column;
            text-align: center;
        }

        .skpi-notification-actions {
            width: 100%;
            justify-content: center;
        }

        .skpi-notification-btn {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="mhs-dashboard">
    {{-- SKPI Final Notification Banner --}}
    @if(isset($skpiFinal) && $skpiFinal)
        <div class="skpi-notification" id="skpiNotification">
            <div class="skpi-notification-content">
                <div class="skpi-notification-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="skpi-notification-text">
                    <h3>
                        🎉 SKPI Anda Sudah Final!
                    </h3>
                    <p>
                        Selamat! Dokumen SKPI Anda dengan nomor <strong>{{ $skpiFinal->nomor_skpi ?? 'N/A' }}</strong> 
                        sudah selesai diverifikasi dan siap untuk diambil. 
                        Silakan datang ke <strong>Biro Akademik (Pusat Bahasa)</strong> untuk mencetak dokumen resmi Anda.
                    </p>
                </div>
                <div class="skpi-notification-actions">
                    <a href="{{ route('mahasiswa.download.index') }}" class="skpi-notification-btn">
                        <i class="fas fa-file-download"></i> Lihat Status SKPI
                    </a>
                    <button type="button" class="skpi-notification-close" onclick="dismissSkpiNotification()" title="Tutup notifikasi">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Welcome Header --}}
    <div class="mhs-welcome">
        <div class="mhs-welcome-content">
            <div class="mhs-welcome-left">
                <div class="mhs-welcome-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 2)) }}
                </div>
                <div class="mhs-welcome-text">
                    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p>NIM: {{ auth()->user()->mahasiswa->nim ?? '-' }} • {{ auth()->user()->mahasiswa->prodi->nama_prodi ?? 'Program Studi' }}</p>
                </div>
            </div>
            <div class="mhs-welcome-badge">
                <i class="fas fa-calendar-alt"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    @php
        $stats = [
            'sertifikasi' => auth()->user()->mahasiswa->sertifikasi()->count() ?? 0,
            'prestasi' => auth()->user()->mahasiswa->prestasi()->count() ?? 0,
            'organisasi' => auth()->user()->mahasiswa->organisasi()->count() ?? 0,
            'pkm' => auth()->user()->mahasiswa->pengabdian()->count() ?? 0,
        ];
        $totalPending = auth()->user()->mahasiswa->verifikasiSkpi()->where('status', 'pending')->count() ?? 0;
        $totalApproved = auth()->user()->mahasiswa->verifikasiSkpi()->where('status', 'approved')->count() ?? 0;
    @endphp

    <div class="mhs-stats-grid">
        <div class="mhs-stat-card cyan">
            <div class="mhs-stat-header">
                <div class="mhs-stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                @if($stats['sertifikasi'] > 0)
                    <span class="mhs-stat-badge approved"><i class="fas fa-check"></i> Ada</span>
                @else
                    <span class="mhs-stat-badge pending">Belum</span>
                @endif
            </div>
            <div class="mhs-stat-value">{{ $stats['sertifikasi'] }}</div>
            <div class="mhs-stat-label">Sertifikasi</div>
        </div>

        <div class="mhs-stat-card amber">
            <div class="mhs-stat-header">
                <div class="mhs-stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                @if($stats['prestasi'] > 0)
                    <span class="mhs-stat-badge approved"><i class="fas fa-check"></i> Ada</span>
                @else
                    <span class="mhs-stat-badge pending">Belum</span>
                @endif
            </div>
            <div class="mhs-stat-value">{{ $stats['prestasi'] }}</div>
            <div class="mhs-stat-label">Prestasi</div>
        </div>

        <div class="mhs-stat-card green">
            <div class="mhs-stat-header">
                <div class="mhs-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                @if($stats['organisasi'] > 0)
                    <span class="mhs-stat-badge approved"><i class="fas fa-check"></i> Ada</span>
                @else
                    <span class="mhs-stat-badge pending">Belum</span>
                @endif
            </div>
            <div class="mhs-stat-value">{{ $stats['organisasi'] }}</div>
            <div class="mhs-stat-label">Organisasi</div>
        </div>

        <div class="mhs-stat-card purple">
            <div class="mhs-stat-header">
                <div class="mhs-stat-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                @if($stats['pkm'] > 0)
                    <span class="mhs-stat-badge approved"><i class="fas fa-check"></i> Ada</span>
                @else
                    <span class="mhs-stat-badge pending">Belum</span>
                @endif
            </div>
            <div class="mhs-stat-value">{{ $stats['pkm'] }}</div>
            <div class="mhs-stat-label">PKM</div>
        </div>
    </div>

    {{-- Achievement Cards --}}
    <h2 class="mhs-section-title"><i class="fas fa-layer-group"></i> Kategori Achievement</h2>
    <div class="mhs-cards-grid">
        <div class="mhs-card sertifikasi">
            <div class="mhs-card-body">
                <div class="mhs-card-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="mhs-card-title">Sertifikasi Kompetensi</div>
                <p class="mhs-card-text">Sertifikat keahlian profesional yang Anda miliki.</p>
                <a href="{{ route('mahasiswa.sertifikasi.list') }}" class="mhs-card-btn">
                    <i class="fas fa-arrow-right"></i> Kelola
                </a>
            </div>
        </div>

        <div class="mhs-card prestasi">
            <div class="mhs-card-body">
                <div class="mhs-card-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="mhs-card-title">Prestasi</div>
                <p class="mhs-card-text">Penghargaan dan pencapaian akademik.</p>
                <a href="{{ route('mahasiswa.prestasi.list') }}" class="mhs-card-btn">
                    <i class="fas fa-arrow-right"></i> Kelola
                </a>
            </div>
        </div>

        <div class="mhs-card organisasi">
            <div class="mhs-card-body">
                <div class="mhs-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="mhs-card-title">Organisasi</div>
                <p class="mhs-card-text">Pengalaman organisasi dan kepemimpinan.</p>
                <a href="{{ route('mahasiswa.organisasi.list') }}" class="mhs-card-btn">
                    <i class="fas fa-arrow-right"></i> Kelola
                </a>
            </div>
        </div>

        <div class="mhs-card pkm">
            <div class="mhs-card-body">
                <div class="mhs-card-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="mhs-card-title">Pengabdian Masyarakat</div>
                <p class="mhs-card-text">Program Kemitraan Masyarakat (PKM).</p>
                <a href="{{ route('mahasiswa.pkm.list') }}" class="mhs-card-btn">
                    <i class="fas fa-arrow-right"></i> Kelola
                </a>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="mhs-content-grid">
        {{-- Steps Card --}}
        <div class="mhs-steps-card">
            <div class="mhs-steps-header">
                <i class="fas fa-list-ol"></i>
                <h3>Langkah Mengisi SKPI</h3>
            </div>
            <div class="mhs-steps-body">
                <div class="mhs-step">
                    <div class="mhs-step-number">1</div>
                    <div class="mhs-step-content">
                        <h4>Lengkapi semua kategori pencapaian</h4>
                        <p>Isi data sertifikasi, prestasi, organisasi & PKM Anda.</p>
                    </div>
                </div>
                <div class="mhs-step">
                    <div class="mhs-step-number">2</div>
                    <div class="mhs-step-content">
                        <h4>Upload dokumen pendukung</h4>
                        <p>Sertifikat, bukti prestasi, dan dokumen lainnya.</p>
                    </div>
                </div>
                <div class="mhs-step">
                    <div class="mhs-step-number">3</div>
                    <div class="mhs-step-content">
                        <h4>Tunggu verifikasi dari Prodi</h4>
                        <p>Pantau status verifikasi secara berkala.</p>
                    </div>
                </div>
                <div class="mhs-step">
                    <div class="mhs-step-number">4</div>
                    <div class="mhs-step-content">
                        <h4>Download SKPI Final</h4>
                        <p>Setelah disetujui oleh semua pihak terkait.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="mhs-quick-card">
            <div class="mhs-quick-header">
                <i class="fas fa-bolt"></i>
                <h3>Aksi Cepat</h3>
            </div>
            <div class="mhs-quick-body">
                <a href="{{ route('mahasiswa.verifikasi.index') }}" class="mhs-quick-item">
                    <div class="mhs-quick-icon cyan">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="mhs-quick-info">
                        <h4>Status Verifikasi</h4>
                        <p>Cek status pengajuan Anda</p>
                    </div>
                </a>
                <a href="{{ route('mahasiswa.approval.index') }}" class="mhs-quick-item">
                    <div class="mhs-quick-icon amber">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="mhs-quick-info">
                        <h4>Riwayat Approval</h4>
                        <p>Lihat riwayat persetujuan</p>
                    </div>
                </a>
                <a href="{{ route('mahasiswa.download.index') }}" class="mhs-quick-item">
                    <div class="mhs-quick-icon green">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="mhs-quick-info">
                        <h4>Download SKPI</h4>
                        <p>Unduh dokumen SKPI final</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@if(isset($skpiFinal) && $skpiFinal)
@push('scripts')
<script>
    // Check if notification was dismissed for this specific SKPI
    const skpiId = '{{ $skpiFinal->id }}';
    const dismissKey = 'skpi_notification_dismissed_' + skpiId;
    
    document.addEventListener('DOMContentLoaded', function() {
        const notification = document.getElementById('skpiNotification');
        if (notification) {
            // Check if this notification was dismissed before
            if (localStorage.getItem(dismissKey) === 'true') {
                notification.style.display = 'none';
            }
        }
    });

    function dismissSkpiNotification() {
        const notification = document.getElementById('skpiNotification');
        if (notification) {
            // Add hiding animation
            notification.classList.add('hiding');
            
            // Save to localStorage
            localStorage.setItem(dismissKey, 'true');
            
            // Remove element after animation
            setTimeout(function() {
                notification.style.display = 'none';
            }, 300);
        }
    }
</script>
@endpush
@endif
@endsection


