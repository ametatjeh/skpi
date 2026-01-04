@extends('fakultas.layouts.app')
@section('title', 'Laporan & Statistik SKPI')
@section('page_title', 'Laporan & Statistik')
@section('page_icon', 'chart-bar')

@push('styles')
<style>
    /* ============ LAPORAN PAGE - PURPLE THEME ============ */
    
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
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }
    
    .stat-card.purple::before { background: linear-gradient(180deg, #7c3aed 0%, #a78bfa 100%); }
    .stat-card.green::before { background: linear-gradient(180deg, #10b981 0%, #34d399 100%); }
    .stat-card.red::before { background: linear-gradient(180deg, #ef4444 0%, #f87171 100%); }
    .stat-card.yellow::before { background: linear-gradient(180deg, #f59e0b 0%, #fbbf24 100%); }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }
    
    .stat-card.purple .stat-icon { background: #f3e8ff; color: #7c3aed; }
    .stat-card.green .stat-icon { background: #dcfce7; color: #10b981; }
    .stat-card.red .stat-icon { background: #fee2e2; color: #ef4444; }
    .stat-card.yellow .stat-icon { background: #fef3c7; color: #f59e0b; }
    
    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 8px;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1;
    }
    
    /* Charts Grid */
    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    
    /* Card */
    .card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
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
    
    .chart-container {
        position: relative;
        height: 280px;
    }
    
    /* Table Wrapper */
    .table-wrapper {
        width: 100%;
        overflow-x: scroll;
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
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        border-radius: 10px;
    }
    
    /* Table */
    .modern-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }
    
    .modern-table thead th {
        padding: 14px 16px;
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
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
    }
    
    .modern-table tbody tr:hover {
        background: #faf5ff;
    }
    
    /* Student Info */
    .student-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .student-avatar {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
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
        font-size: 11px;
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
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
    }
    
    /* SKPI Number */
    .skpi-number {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #7c3aed;
        background: #f3e8ff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 40px;
        opacity: 0.4;
        margin-bottom: 12px;
        color: #a78bfa;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 18px;
        }
        
        .stat-value {
            font-size: 24px;
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
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <h1>Laporan & Statistik SKPI</h1>
                    <p>Analisis dan rekap data SKPI Fakultas</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card purple">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-label">Total SKPI Diajukan</div>
            <div class="stat-value">{{ $stat['total_diajukan'] ?? 0 }}</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-label">SKPI Final</div>
            <div class="stat-value">{{ $stat['total_final'] ?? 0 }}</div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-label">Revisi / Ditolak</div>
            <div class="stat-value">{{ $stat['total_revisi'] ?? 0 }}</div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-label">Belum Diverifikasi</div>
            <div class="stat-value">{{ $stat['total_pending'] ?? 0 }}</div>
        </div>
    </div>
    
    {{-- Charts Grid --}}
    <div class="charts-grid">
        {{-- Pie Chart --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3>Distribusi Status SKPI</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>
        
        {{-- Bar Chart --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3>SKPI per Bulan (Tahun Ini)</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="monthlyBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Table Section --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-icon">
                <i class="fas fa-list"></i>
            </div>
            <h3>Daftar SKPI Final (1 Tahun Terakhir)</h3>
        </div>
        <div class="table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Prodi</th>
                        <th>No SKPI</th>
                        <th>Status</th>
                        <th>Tgl Finalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listFinal ?? [] as $i => $draft)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="student-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                                        <div class="student-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td><span class="skpi-number">{{ $draft->nomor_skpi ?? '-' }}</span></td>
                            <td>
                                <span class="status-badge">
                                    <i class="fas fa-check-circle"></i> Final
                                </span>
                            </td>
                            <td>{{ $draft->updated_at ? $draft->updated_at->format('d M Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada data SKPI Final</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Purple theme colors
    const purpleColors = {
        primary: '#7c3aed',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        light: '#a78bfa'
    };
    
    // Pie Chart - Status Distribution
    const pieCtx = document.getElementById('statusPieChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Final', 'Revisi/Ditolak', 'Pending'],
                datasets: [{
                    data: [
                        {{ $stat['total_final'] ?? 0 }},
                        {{ $stat['total_revisi'] ?? 0 }},
                        {{ $stat['total_pending'] ?? 0 }}
                    ],
                    backgroundColor: [
                        purpleColors.success,
                        purpleColors.danger,
                        purpleColors.warning
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
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
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Bar Chart - Monthly Data
    const barCtx = document.getElementById('monthlyBarChart');
    if (barCtx) {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        // Sample data - replace with actual monthly data from controller
        @php
            $monthlyData = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthlyData[] = \App\Models\DraftSkpi::where('status', 'final_issued')
                    ->whereYear('updated_at', now()->year)
                    ->whereMonth('updated_at', $i)
                    ->count();
            }
        @endphp
        
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'SKPI Final',
                    data: @json($monthlyData),
                    backgroundColor: 'rgba(124, 58, 237, 0.8)',
                    borderColor: purpleColors.primary,
                    borderWidth: 0,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11,
                                weight: '600'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
