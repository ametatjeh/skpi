@extends('pusat.layouts.app')
@section('title', 'Laporan & Statistik SKPI')
@section('page_icon', 'chart-bar')
@section('page_title', 'Laporan & Statistik')

@push('styles')
<style>
    /* ============ LAPORAN PAGE STYLES - CYAN THEME ============ */
    .laporan-container * {
        box-sizing: border-box;
    }
    
    .laporan-container {
        max-width: 1200px;
        margin: 0 auto;
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
    
    .filter-form {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .filter-select {
        padding: 10px 16px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .filter-select option {
        color: #111827;
        background: #fff;
    }
    
    .filter-select:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.3);
    }
    
    .filter-btn {
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .filter-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    /* Overview Cards */
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .overview-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s, box-shadow 0.2s;
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
    
    .overview-card.cyan::before { background: linear-gradient(180deg, #0891b2, #06b6d4); }
    .overview-card.green::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .overview-card.red::before { background: linear-gradient(180deg, #ef4444, #f87171); }
    .overview-card.yellow::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    
    .overview-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .overview-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }
    
    .overview-card.cyan .overview-icon { background: #cffafe; color: #0891b2; }
    .overview-card.green .overview-icon { background: #dcfce7; color: #10b981; }
    .overview-card.red .overview-icon { background: #fee2e2; color: #ef4444; }
    .overview-card.yellow .overview-icon { background: #fef3c7; color: #f59e0b; }
    
    .overview-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .overview-label {
        font-size: 13px;
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
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border-radius: 16px;
        padding: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 16px rgba(8, 145, 178, 0.25);
    }
    
    .info-card.green {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.25);
    }
    
    .info-card.yellow {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        box-shadow: 0 4px 16px rgba(245, 158, 11, 0.25);
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
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
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
        gap: 10px;
    }
    
    .chart-title i {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .chart-badge {
        padding: 6px 14px;
        background: #cffafe;
        color: #0891b2;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }
    
    .chart-badge:hover {
        background: #a5f3fc;
    }
    
    .chart-container {
        position: relative;
        height: 280px;
    }
    
    .chart-container.small {
        height: 220px;
    }
    
    /* Trend Grid */
    .trend-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
    }
    
    .trend-item {
        text-align: center;
        padding: 16px 12px;
        background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%);
        border-radius: 12px;
        transition: all 0.2s;
        border: 1px solid #cffafe;
    }
    
    .trend-item:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
    }
    
    .trend-month {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    .trend-approved {
        font-size: 22px;
        font-weight: 800;
        color: #10b981;
    }
    
    .trend-rejected {
        font-size: 13px;
        color: #ef4444;
        margin-top: 4px;
        font-weight: 600;
    }
    
    /* Recent Activity Table */
    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .recent-table thead th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e5e7eb;
        background: #f8fafc;
    }
    
    .recent-table tbody td {
        padding: 16px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .recent-table tbody tr:hover {
        background: #f0fdfa;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.final { background: #cffafe; color: #0891b2; }
    
    /* Student Info in Table */
    .student-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .student-avatar-sm {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }
    
    .student-name {
        font-weight: 600;
        color: #111827;
    }
    
    .student-nim {
        font-size: 12px;
        color: #9ca3af;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .overview-grid {
            grid-template-columns: repeat(2, 1fr);
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
        
        .trend-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .filter-form {
            width: 100%;
            flex-wrap: wrap;
        }
        
        .overview-grid {
            grid-template-columns: 1fr;
        }
        
        .trend-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

@section('content')
<div class="laporan-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <h1>Laporan & Statistik</h1>
                    <p>Monitoring dan analisis data SKPI Pusat Bahasa tahun {{ $tahun }}</p>
                </div>
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
    </div>
    
    {{-- Overview Cards --}}
    <div class="overview-grid">
        <div class="overview-card cyan">
            <div class="overview-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="overview-value">{{ $totalDraftMasuk }}</div>
            <div class="overview-label">Total Draft Masuk</div>
        </div>
        
        <div class="overview-card green">
            <div class="overview-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="overview-value">{{ $totalDraftApproved }}</div>
            <div class="overview-label">Draft Disetujui</div>
        </div>
        
        <div class="overview-card red">
            <div class="overview-icon">
                <i class="fas fa-undo"></i>
            </div>
            <div class="overview-value">{{ $totalDraftRevisi }}</div>
            <div class="overview-label">Draft Dikembalikan</div>
        </div>
        
        <div class="overview-card yellow">
            <div class="overview-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="overview-value">{{ $totalDraftPending }}</div>
            <div class="overview-label">Menunggu Verifikasi</div>
        </div>
    </div>
    
    {{-- Info Cards --}}
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ number_format($avgProcessTime ?? 0, 1) }} hari</div>
                <div class="info-label">Rata-rata Waktu Proses</div>
            </div>
        </div>
        
        <div class="info-card green">
            <div class="info-icon">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ $totalDraftMasuk > 0 ? number_format(($totalDraftApproved / $totalDraftMasuk) * 100, 1) : 0 }}%</div>
                <div class="info-label">Tingkat Approval</div>
            </div>
        </div>
        
        <div class="info-card yellow">
            <div class="info-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="info-content">
                <div class="info-value">{{ date('Y') }}</div>
                <div class="info-label">Tahun Aktif</div>
            </div>
        </div>
    </div>
    
    {{-- Charts Grid --}}
    <div class="charts-grid">
        {{-- Line Chart: Draft per Bulan --}}
        <div class="chart-card full-width">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-chart-line"></i>
                    Tren Draft SKPI per Bulan
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
        
        {{-- Bar Chart: Per Fakultas --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-building"></i>
                    Draft per Fakultas
                </div>
            </div>
            <div class="chart-container small">
                <canvas id="chartFakultas"></canvas>
            </div>
        </div>
        
        {{-- Horizontal Bar: Top 10 Prodi --}}
        <div class="chart-card full-width">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-graduation-cap"></i>
                    Top 10 Program Studi
                </div>
            </div>
            <div class="chart-container">
                <canvas id="chartProdi"></canvas>
            </div>
        </div>
    </div>
    
    {{-- Trend Approval 6 Bulan --}}
    <div class="chart-card" style="margin-bottom: 24px;">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fas fa-history"></i>
                Tren Approval 6 Bulan Terakhir
            </div>
        </div>
        <div class="trend-grid">
            @foreach($trendApproval as $trend)
            <div class="trend-item">
                <div class="trend-month">{{ $trend['bulan'] }}</div>
                <div class="trend-approved">{{ $trend['approved'] }}</div>
                <div class="trend-rejected">
                    <i class="fas fa-arrow-down"></i> {{ $trend['rejected'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    {{-- Recent Activity Table --}}
    <div class="chart-card">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fas fa-list"></i>
                Aktivitas Terbaru
            </div>
            <a href="{{ route('pusat.verifikasi.index') }}" class="chart-badge">
                Lihat Semua →
            </a>
        </div>
        
        <table class="recent-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDrafts as $draft)
                <tr>
                    <td>
                        <div class="student-info">
                            <div class="student-avatar-sm">
                                {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                            </div>
                            <div>
                                <div class="student-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                                <div class="student-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                    <td>
                        @switch($draft->status)
                            @case('valid_pusat_bahasa')
                            @case('di_pusat_bahasa')
                                <span class="status-badge pending"><i class="fas fa-clock"></i> Menunggu</span>
                                @break
                            @case('valid_fakultas')
                                <span class="status-badge approved"><i class="fas fa-check"></i> Ke Fakultas</span>
                                @break
                            @case('revisi_prodi')
                                <span class="status-badge rejected"><i class="fas fa-undo"></i> Revisi</span>
                                @break
                            @case('final_issued')
                                <span class="status-badge final"><i class="fas fa-certificate"></i> Final</span>
                                @break
                            @default
                                <span class="status-badge pending">{{ ucfirst(str_replace('_', ' ', $draft->status)) }}</span>
                        @endswitch
                    </td>
                    <td>{{ $draft->updated_at ? $draft->updated_at->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #9ca3af; padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 32px; opacity: 0.3; margin-bottom: 12px; display: block;"></i>
                        Belum ada aktivitas terbaru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CYAN COLOR PALETTE
    const colors = {
        cyan: 'rgba(8, 145, 178, 1)',
        cyanLight: 'rgba(6, 182, 212, 1)',
        green: 'rgba(16, 185, 129, 1)',
        red: 'rgba(239, 68, 68, 1)',
        yellow: 'rgba(245, 158, 11, 1)',
        blue: 'rgba(59, 130, 246, 1)',
        purple: 'rgba(124, 58, 237, 1)',
    };
    
    const bgColors = [
        'rgba(8, 145, 178, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(239, 68, 68, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(59, 130, 246, 0.8)',
        'rgba(236, 72, 153, 0.8)',
        'rgba(124, 58, 237, 0.8)',
    ];
    
    // Chart 1: Line Chart - Draft per Bulan
    new Chart(document.getElementById('chartBulan'), {
        type: 'line',
        data: {
            labels: @json($chartBulan),
            datasets: [{
                label: 'Jumlah Draft',
                data: @json($chartTotal),
                borderColor: colors.cyan,
                backgroundColor: 'rgba(8, 145, 178, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: colors.cyan,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
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
                    ticks: { stepSize: 1, color: '#6b7280' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280' }
                }
            }
        }
    });
    
    // Chart 2: Doughnut Chart - Status Distribution
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: @json($chartStatusLabels),
            datasets: [{
                data: @json($chartStatusData),
                backgroundColor: bgColors,
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
                        font: { size: 11 }
                    }
                }
            }
        }
    });
    
    // Chart 3: Bar Chart - Per Fakultas
    new Chart(document.getElementById('chartFakultas'), {
        type: 'bar',
        data: {
            labels: @json($chartFakultasLabels),
            datasets: [{
                label: 'Jumlah Draft',
                data: @json($chartFakultasData),
                backgroundColor: bgColors,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { stepSize: 1 }
                },
                x: { grid: { display: false } }
            }
        }
    });
    
    // Chart 4: Horizontal Bar - Top 10 Prodi
    new Chart(document.getElementById('chartProdi'), {
        type: 'bar',
        data: {
            labels: @json($chartProdiLabels),
            datasets: [{
                label: 'Jumlah Draft',
                data: @json($chartProdiData),
                backgroundColor: 'rgba(8, 145, 178, 0.8)',
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { stepSize: 1 }
                },
                y: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
