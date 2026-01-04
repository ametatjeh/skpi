@extends('prodi.layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')
<style>
    /* ============ LAPORAN PRODI PREMIUM STYLES ============ */
    .laporan-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Header */
    .laporan-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    
    .laporan-title-section h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px 0;
    }
    
    .laporan-title-section p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }
    
    .filter-form {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .filter-select {
        padding: 10px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        background: #fff;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .filter-btn {
        padding: 10px 20px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
    }
    
    /* Overview Cards Grid */
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .overview-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }
    
    .overview-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }
    
    .overview-card.blue::before { background: linear-gradient(180deg, #059669, #10b981); }
    .overview-card.yellow::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    .overview-card.green::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .overview-card.red::before { background: linear-gradient(180deg, #ef4444, #f87171); }
    .overview-card.purple::before { background: linear-gradient(180deg, #7c3aed, #a78bfa); }
    
    .overview-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .overview-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }
    
    .overview-card.blue .overview-icon { background: #d1fae5; color: #059669; }
    .overview-card.yellow .overview-icon { background: #fef3c7; color: #f59e0b; }
    .overview-card.green .overview-icon { background: #dcfce7; color: #10b981; }
    .overview-card.red .overview-icon { background: #fee2e2; color: #ef4444; }
    .overview-card.purple .overview-icon { background: #f3e8ff; color: #7c3aed; }
    
    .overview-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .overview-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* Info Cards */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .info-card {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-radius: 16px;
        padding: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 20px rgba(5, 150, 105, 0.25);
    }
    
    .info-card.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.25);
    }
    
    .info-card.purple {
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.25);
    }
    
    .info-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-value {
        font-size: 28px;
        font-weight: 800;
    }
    
    .info-label {
        font-size: 13px;
        opacity: 0.9;
    }
    
    /* Chart Cards */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .chart-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    
    .chart-card.full-width {
        grid-column: span 2;
    }
    
    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .chart-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .chart-title i {
        color: #059669;
    }
    
    .chart-badge {
        padding: 4px 10px;
        background: #d1fae5;
        color: #059669;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .chart-container {
        position: relative;
        height: 280px;
    }
    
    .chart-container.small {
        height: 220px;
    }
    
    /* Trend Cards */
    .trend-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 16px;
    }
    
    .trend-item {
        text-align: center;
        padding: 16px 12px;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.2s;
    }
    
    .trend-item:hover {
        background: #d1fae5;
        transform: translateY(-2px);
    }
    
    .trend-month {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .trend-total {
        font-size: 20px;
        font-weight: 800;
        color: #111827;
    }
    
    .trend-stats {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 6px;
        font-size: 11px;
    }
    
    .trend-approved { color: #10b981; }
    .trend-rejected { color: #ef4444; }
    
    /* Top Mahasiswa */
    .top-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .top-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.2s;
    }
    
    .top-item:hover {
        background: #d1fae5;
        transform: translateX(4px);
    }
    
    .top-rank {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #059669, #10b981);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }
    
    .top-rank.gold { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .top-rank.silver { background: linear-gradient(135deg, #6b7280, #9ca3af); }
    .top-rank.bronze { background: linear-gradient(135deg, #ea580c, #f97316); }
    
    .top-info {
        flex: 1;
    }
    
    .top-name {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    
    .top-nim {
        font-size: 12px;
        color: #6b7280;
    }
    
    .top-count {
        padding: 4px 12px;
        background: #dcfce7;
        color: #15803d;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Recent Activity Table */
    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .recent-table thead th {
        padding: 12px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .recent-table tbody td {
        padding: 14px 16px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .recent-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.revision { background: #d1fae5; color: #059669; }
    
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
    }
    
    /* Export Buttons */
    .export-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-export.pdf {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    .btn-export.excel {
        background: #dcfce7;
        color: #15803d;
    }
    
    .btn-export:hover {
        transform: translateY(-2px);
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .overview-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .charts-grid {
            grid-template-columns: 1fr;
        }
        
        .chart-card.full-width {
            grid-column: span 1;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .overview-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .laporan-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .filter-form {
            width: 100%;
            flex-wrap: wrap;
        }
        
        .trend-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="laporan-container">
    {{-- Header --}}
    <div class="laporan-header">
        <div class="laporan-title-section">
            <h1><i class="fas fa-chart-bar"></i> Laporan & Statistik</h1>
            <p>Analisis verifikasi SKPI Program Studi - Tahun {{ $tahun }}</p>
        </div>
        
        <form class="filter-form" method="GET">
            <select name="tahun" class="filter-select">
                @foreach($tahunOptions as $opt)
                    <option value="{{ $opt }}" {{ $tahun == $opt ? 'selected' : '' }}>Tahun {{ $opt }}</option>
                @endforeach
            </select>
            <button type="submit" class="filter-btn">
                <i class="fas fa-filter"></i> Filter
            </button>
        </form>
    </div>
    
    {{-- Overview Cards --}}
    <div class="overview-grid">
        <div class="overview-card blue">
            <div class="overview-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="overview-value">{{ $stats['total'] }}</div>
            <div class="overview-label">Total Pengajuan</div>
        </div>
        
        <div class="overview-card yellow">
            <div class="overview-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="overview-value">{{ $stats['pending'] }}</div>
            <div class="overview-label">Menunggu</div>
        </div>
        
        <div class="overview-card green">
            <div class="overview-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="overview-value">{{ $stats['approved'] }}</div>
            <div class="overview-label">Disetujui</div>
        </div>
        
        <div class="overview-card red">
            <div class="overview-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="overview-value">{{ $stats['rejected'] }}</div>
            <div class="overview-label">Ditolak</div>
        </div>
        
        <div class="overview-card purple">
            <div class="overview-icon">
                <i class="fas fa-redo"></i>
            </div>
            <div class="overview-value">{{ $stats['revision'] }}</div>
            <div class="overview-label">Perlu Revisi</div>
        </div>
    </div>
    
    {{-- Info Cards --}}
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ $approvalRate }}%</div>
                <div class="info-label">Tingkat Approval</div>
            </div>
        </div>
        
        <div class="info-card green">
            <div class="info-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ number_format($avgProcessTime ?? 0, 1) }} hari</div>
                <div class="info-label">Rata-rata Waktu Proses</div>
            </div>
        </div>
        
        <div class="info-card purple">
            <div class="info-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ $draftStats['total'] }}</div>
                <div class="info-label">Draft SKPI Dibuat</div>
            </div>
        </div>
    </div>
    
    {{-- Charts Grid --}}
    <div class="charts-grid">
        {{-- Line Chart: Verifikasi per Bulan --}}
        <div class="chart-card full-width">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-chart-line"></i>
                    Tren Verifikasi per Bulan
                </div>
                <span class="chart-badge">{{ $tahun }}</span>
            </div>
            <div class="chart-container">
                <canvas id="chartBulan"></canvas>
            </div>
        </div>
        
        {{-- Doughnut Chart: Status Distribution --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-chart-pie"></i>
                    Distribusi Status
                </div>
            </div>
            <div class="chart-container small">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>
        
        {{-- Bar Chart: Per Kategori --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-layer-group"></i>
                    Per Kategori Achievement
                </div>
            </div>
            <div class="chart-container small">
                <canvas id="chartKategori"></canvas>
            </div>
        </div>
    </div>
    
    {{-- Trend Cards --}}
    <div class="chart-card" style="margin-bottom: 24px;">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fas fa-history"></i>
                Tren 6 Bulan Terakhir
            </div>
        </div>
        <div class="trend-grid">
            @foreach($trendData as $trend)
            <div class="trend-item">
                <div class="trend-month">{{ $trend['bulan'] }}</div>
                <div class="trend-total">{{ $trend['total'] }}</div>
                <div class="trend-stats">
                    <span class="trend-approved"><i class="fas fa-check"></i> {{ $trend['approved'] }}</span>
                    <span class="trend-rejected"><i class="fas fa-times"></i> {{ $trend['rejected'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="charts-grid">
        {{-- Top Mahasiswa --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-trophy"></i>
                    Top 5 Mahasiswa
                </div>
                <span class="chart-badge">Terbanyak Achievement</span>
            </div>
            
            <div class="top-list">
                @forelse($topMahasiswa as $index => $mhs)
                <div class="top-item">
                    <div class="top-rank {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : ($index == 2 ? 'bronze' : '')) }}">
                        {{ $index + 1 }}
                    </div>
                    <div class="top-info">
                        <div class="top-name">{{ $mhs->nama }}</div>
                        <div class="top-nim">{{ $mhs->nim }}</div>
                    </div>
                    <div class="top-count">{{ $mhs->approved_count }} approved</div>
                </div>
                @empty
                <div style="text-align: center; color: #9ca3af; padding: 32px;">
                    Belum ada data mahasiswa.
                </div>
                @endforelse
            </div>
        </div>
        
        {{-- Recent Activity --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-list"></i>
                    Aktivitas Terbaru
                </div>
                <a href="{{ route('prodi.verifikasi.index') }}" class="chart-badge" style="text-decoration: none;">
                    Lihat Semua →
                </a>
            </div>
            
            <div style="max-height: 320px; overflow-y: auto;">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivity as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->mahasiswa->nama ?? '-' }}</strong>
                                <br><small style="color: #9ca3af;">{{ $item->mahasiswa->nim ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="type-badge">{{ $item->achievement_type_label }}</span>
                            </td>
                            <td>
                                @switch($item->status)
                                    @case('pending')
                                        <span class="status-badge pending">Pending</span>
                                        @break
                                    @case('approved')
                                        <span class="status-badge approved">Approved</span>
                                        @break
                                    @case('rejected')
                                        <span class="status-badge rejected">Rejected</span>
                                        @break
                                    @case('revision_required')
                                        <span class="status-badge revision">Revisi</span>
                                        @break
                                    @default
                                        <span class="status-badge pending">{{ $item->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #9ca3af; padding: 32px;">
                                Belum ada aktivitas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- Draft SKPI Stats --}}
    <div class="chart-card">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fas fa-file-contract"></i>
                Status Draft SKPI
            </div>
            <div class="export-buttons">
                <a href="{{ route('prodi.laporan.export-verifikasi', ['tahun' => $tahun]) }}" class="btn-export pdf">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('prodi.laporan.export-summary', ['tahun' => $tahun]) }}" class="btn-export excel">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>
        
        <div class="overview-grid" style="margin-bottom: 0;">
            <div class="overview-card blue">
                <div class="overview-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="overview-value">{{ $draftStats['total'] }}</div>
                <div class="overview-label">Total Draft</div>
            </div>
            
            <div class="overview-card yellow">
                <div class="overview-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="overview-value">{{ $draftStats['valid_prodi'] }}</div>
                <div class="overview-label">Siap Kirim</div>
            </div>
            
            <div class="overview-card purple">
                <div class="overview-icon">
                    <i class="fas fa-language"></i>
                </div>
                <div class="overview-value">{{ $draftStats['valid_pusat'] }}</div>
                <div class="overview-label">Di Pusat Bahasa</div>
            </div>
            
            <div class="overview-card green">
                <div class="overview-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="overview-value">{{ $draftStats['final'] }}</div>
                <div class="overview-label">Final/Terbit</div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Color palette
    const colors = {
        blue: 'rgba(37, 99, 235, 1)',
        green: 'rgba(16, 185, 129, 1)',
        red: 'rgba(239, 68, 68, 1)',
        yellow: 'rgba(245, 158, 11, 1)',
        purple: 'rgba(124, 58, 237, 1)',
    };
    
    const bgColors = [
        'rgba(37, 99, 235, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(239, 68, 68, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(124, 58, 237, 0.8)',
        'rgba(236, 72, 153, 0.8)',
    ];
    
    // Chart 1: Line Chart - Verifikasi per Bulan
    new Chart(document.getElementById('chartBulan'), {
        type: 'line',
        data: {
            labels: @json($chartBulan),
            datasets: [
                {
                    label: 'Approved',
                    data: @json($chartApproved),
                    borderColor: colors.green,
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.green,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                },
                {
                    label: 'Rejected',
                    data: @json($chartRejected),
                    borderColor: colors.red,
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.red,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                },
                {
                    label: 'Pending',
                    data: @json($chartPending),
                    borderColor: colors.yellow,
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.yellow,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
    
    // Chart 2: Doughnut Chart - Status Distribution
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: @json($statusLabels),
            datasets: [{
                data: @json($statusData),
                backgroundColor: [colors.yellow, colors.green, colors.red, colors.purple],
                borderWidth: 0,
                hoverOffset: 10,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            }
        }
    });
    
    // Chart 3: Bar Chart - Per Kategori
    new Chart(document.getElementById('chartKategori'), {
        type: 'bar',
        data: {
            labels: @json($kategoriLabels),
            datasets: [{
                label: 'Jumlah',
                data: @json($kategoriData),
                backgroundColor: bgColors,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush
