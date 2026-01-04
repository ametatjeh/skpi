@extends('prodi.layouts.app')

@section('title', 'Analytics - Prodi')
@section('page_title', 'Analytics Dashboard')

@push('styles')
    <style>
        body {
            overflow-x: hidden;
        }

        /* Top stats */
        .analytics-stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
            max-width: 100%;
        }

        .analytics-chart-wrapper {
            padding: 20px;
            position: relative;
            height: 280px;
            max-width: 100%;
        }

        .analytics-chart-wrapper canvas {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }

        @media (max-width: 768px) {
            .analytics-stat-row {
                grid-template-columns: minmax(0, 1fr);
            }

            .analytics-chart-wrapper {
                padding: 16px;
                height: 240px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Top Stats -->
    <div class="analytics-stat-row">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-paper-plane"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Pengajuan</div>
                <div class="stat-value">{{ $totalSemua }}</div>
                <div class="stat-change up"><i class="fas fa-chart-line"></i> All time</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $totalSetuju }}</div>
                <div class="stat-change">
                    @php $persen = $totalSemua > 0 ? round(($totalSetuju / $totalSemua) * 100, 1) : 0; @endphp
                    {{ $persen }}% dari total
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Ditolak</div>
                <div class="stat-value">{{ $totalTolak }}</div>
                <div class="stat-change">
                    @php $persen = $totalSemua > 0 ? round(($totalTolak / $totalSemua) * 100, 1) : 0; @endphp
                    {{ $persen }}% dari total
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Trend Pengajuan (6 Bulan Terakhir)</h3>
        </div>

        <div class="analytics-chart-wrapper">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('trendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Total Pengajuan',
                    data: chartData.data,
                    backgroundColor: 'rgba(22, 163, 74, 0.1)',
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(22, 163, 74, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // ikut tinggi .analytics-chart-wrapper
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        padding: 10,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
