@extends('prodi.layouts.app')
@section('title', 'Dashboard Prodi SKPI')
@section('page_title', 'Dashboard Prodi')
@section('page_icon', 'chart-pie')

@push('styles')
<style>
    /* ============ DASHBOARD PRODI PREMIUM - CYAN THEME ============ */
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px 36px;
        margin-bottom: 28px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(8, 145, 178, 0.25);
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }
    
    .page-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .header-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        backdrop-filter: blur(4px);
    }
    
    .page-header h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }
    
    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    .header-date {
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        backdrop-filter: blur(4px);
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        border-radius: 4px 0 0 4px;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }
    
    .stat-card.emerald::before { background: linear-gradient(180deg, #0891b2 0%, #22d3ee 100%); }
    .stat-card.green::before { background: linear-gradient(180deg, #06b6d4 0%, #22d3ee 100%); }
    .stat-card.yellow::before { background: linear-gradient(180deg, #f59e0b 0%, #fbbf24 100%); }
    .stat-card.red::before { background: linear-gradient(180deg, #ef4444 0%, #f87171 100%); }
    .stat-card.purple::before { background: linear-gradient(180deg, #8b5cf6 0%, #a78bfa 100%); }
    .stat-card.blue::before { background: linear-gradient(180deg, #3b82f6 0%, #60a5fa 100%); }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    
    .stat-card.emerald .stat-icon { background: linear-gradient(135deg, #cffafe 0%, #a7f3d0 100%); color: #0891b2; }
    .stat-card.green .stat-icon { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #16a34a; }
    .stat-card.yellow .stat-icon { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #f59e0b; }
    .stat-card.red .stat-icon { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #ef4444; }
    .stat-card.purple .stat-icon { background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%); color: #8b5cf6; }
    .stat-card.blue .stat-icon { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #3b82f6; }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-label {
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1;
        margin-bottom: 6px;
    }
    
    .stat-change {
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .stat-change.up { color: #06b6d4; }
    .stat-change.down { color: #ef4444; }
    .stat-change.neutral { color: #6b7280; }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    
    /* Card */
    .dashboard-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #f0fdfa 0%, #cffafe 100%);
    }
    
    .card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .card-header-icon {
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
    
    .card-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .card-header-badge {
        padding: 6px 14px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .card-header-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }
    
    .card-body {
        padding: 0;
    }
    
    /* Table Wrapper for Mobile Scroll */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
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
        background: linear-gradient(135deg, #0891b2 0%, #22d3ee 100%);
        border-radius: 10px;
    }
    
    /* Table */
    .modern-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }
    
    .modern-table thead th {
        padding: 14px 20px;
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
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
    }
    
    .modern-table tbody tr:hover {
        background: #f0fdfa;
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
        background: linear-gradient(135deg, #0891b2 0%, #22d3ee 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
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
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.rejected { background: #fee2e2; color: #dc2626; }
    .status-badge.process { background: #cffafe; color: #0891b2; }
    
    /* Action Button */
    .btn-view {
        padding: 8px 16px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
        color: #fff;
    }
    
    /* Quick Actions */
    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 20px;
    }
    
    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        text-decoration: none;
        color: #374151;
        transition: all 0.2s;
    }
    
    .quick-action-btn:hover {
        background: #f0fdfa;
        transform: translateX(4px);
    }
    
    .quick-action-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .quick-action-icon.emerald { background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); color: #fff; }
    .quick-action-icon.green { background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%); color: #fff; }
    .quick-action-icon.blue { background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); color: #fff; }
    .quick-action-icon.purple { background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); color: #fff; }
    
    .quick-action-text h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }
    
    .quick-action-text p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 48px;
        opacity: 0.4;
        margin-bottom: 12px;
        color: #22d3ee;
    }
    
    .empty-state h4 {
        font-size: 16px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 0 6px 0;
    }
    
    .empty-state p {
        font-size: 13px;
        margin: 0;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 24px;
        }
        
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
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
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h1>Selamat Datang, {{ auth()->user()->name ?? 'Operator Prodi' }}!</h1>
                    <p>Pantau progres & rekap status SKPI seluruh mahasiswa dari panel ini.</p>
                </div>
            </div>
            <div class="header-date">
                <i class="fas fa-calendar-alt"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>
    
    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card emerald">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Pengajuan</div>
                <div class="stat-value">{{ $totalPengajuan ?? 0 }}</div>
                <div class="stat-change up">
                    <i class="fas fa-arrow-up"></i>
                    {{ $pengajuanBulanIni ?? 0 }} bulan ini
                </div>
            </div>
        </div>
        
        <div class="stat-card yellow">
            <div class="stat-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-value">{{ $pengajuanBaru ?? 0 }}</div>
                <div class="stat-change neutral">
                    <i class="fas fa-clock"></i>
                    Perlu diproses
                </div>
            </div>
        </div>
        
        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $disetujui ?? 0 }}</div>
                <div class="stat-change up">
                    <i class="fas fa-arrow-up"></i>
                    {{ $disetujuiBulanIni ?? 0 }} bulan ini
                </div>
            </div>
        </div>
        
        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Ditolak/Revisi</div>
                <div class="stat-value">{{ $ditolak ?? 0 }}</div>
                <div class="stat-change down">
                    <i class="fas fa-exclamation-triangle"></i>
                    Perlu perbaikan
                </div>
            </div>
        </div>
    </div>
    
    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Recent Submissions Table --}}
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Pengajuan SKPI Terbaru</h3>
                </div>
                <a href="{{ route('prodi.verifikasi.index') }}" class="card-header-badge">
                    <i class="fas fa-arrow-right"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuanTerbaru ?? [] as $pengajuan)
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($pengajuan->mahasiswa->nama ?? 'M', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="student-name">{{ $pengajuan->mahasiswa->nama ?? '-' }}</div>
                                            <div class="student-nim">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge process">
                                        <i class="fas {{ $pengajuan->achievement_type_icon ?? 'fa-folder' }}"></i>
                                        {{ $pengajuan->achievement_type_label ?? 'Pengajuan' }}
                                    </span>
                                </td>
                                <td>
                                    @if($pengajuan->status == 'approved')
                                        <span class="status-badge approved">
                                            <i class="fas fa-check-circle"></i> Disetujui
                                        </span>
                                    @elseif($pengajuan->status == 'rejected')
                                        <span class="status-badge rejected">
                                            <i class="fas fa-times-circle"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="status-badge pending">
                                            <i class="fas fa-clock"></i> {{ $pengajuan->status_label ?? 'Pending' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('prodi.verifikasi.detail', $pengajuan->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h4>Belum Ada Pengajuan</h4>
                                        <p>Pengajuan SKPI dari mahasiswa akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- Quick Actions --}}
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Aksi Cepat</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('prodi.verifikasi.index') }}" class="quick-action-btn">
                        <div class="quick-action-icon emerald">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="quick-action-text">
                            <h4>Verifikasi Draft SKPI</h4>
                            <p>Review dan approve draft mahasiswa</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('prodi.draft-skpi.index') }}" class="quick-action-btn">
                        <div class="quick-action-icon green">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="quick-action-text">
                            <h4>Lihat Draft SKPI</h4>
                            <p>Rekap draft SKPI yang sudah dibuat</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('prodi.cpl.index') }}" class="quick-action-btn">
                        <div class="quick-action-icon purple">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="quick-action-text">
                            <h4>Kelola CPL</h4>
                            <p>Manage Capaian Pembelajaran Lulusan</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('prodi.laporan.verifikasi') }}" class="quick-action-btn">
                        <div class="quick-action-icon blue">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="quick-action-text">
                            <h4>Laporan & Statistik</h4>
                            <p>Analisis data SKPI program studi</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

