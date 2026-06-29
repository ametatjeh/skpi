<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- SEO Meta Tags --}}
    <title>STATISTIK - SKPI UNIDA | Universitas Iskandar Muda</title>
    <meta name="description" content="Statistik dan Laporan SKPI Universitas Iskandar Muda.">
    <meta name="keywords" content="SKPI, UNIDA, Statistik, Laporan, Universitas Iskandar Muda" />
    <meta name="author" content="Universitas Iskandar Muda" />
    <meta name="robots" content="index, follow" />
    <meta name="language" content="Indonesian" />
    <link rel="canonical" href="{{ url('statistik') }}" />
    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v=2" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        body {font-family: 'Poppins', sans-serif; overflow-x: hidden; background: #f5f5f5; color: #111827; display: flex; flex-direction: column; min-height: 100vh;}
        a {text-decoration: none;}
        @include('partials.styles')
    </style>
</head>
<body>
    @include('partials.header')
    <section style="position: relative; flex: 1; min-height: calc(100vh - 200px); display: flex; flex-direction: column; align-items: center; justify-content: flex-start; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); padding: 40px 20px; font-family: 'Poppins', sans-serif; color: #ffffff; overflow: hidden;">
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: 0;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: 0;"></div>
        
        <style>
            .content-wrapper {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                position: relative;
                z-index: 10;
                color: #ffffff;
            }

            .header-skema {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                padding: 24px 30px;
                margin-bottom: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 20px;
            }

            .header-skema h2 {
                font-size: 24px;
                font-weight: 700;
                color: #ffffff;
                margin: 0;
            }

            .header-skema p {
                color: #cbd5e1;
                font-size: 14px;
                margin-top: 5px;
            }

            .filter-bar {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .filter-group {
                display: flex;
                align-items: center;
                gap: 10px;
                background: rgba(255, 255, 255, 0.08);
                padding: 6px 14px;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
            }

            .filter-icon {
                color: #93c5fd;
                font-size: 14px;
            }

            .filter-select {
                padding: 8px 12px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background-color: rgba(15, 23, 42, 0.8);
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                outline: none;
                transition: all 0.2s ease;
            }

            .filter-select:hover, .filter-select:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            }

            .filter-select option {
                background-color: #1e293b;
                color: #ffffff;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .stat-card {
                background: rgba(255, 255, 255, 0.06);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                padding: 24px;
                border-left: 4px solid #3b82f6;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.25);
            }

            .stat-card h3 {
                font-size: 32px;
                font-weight: 800;
                color: #ffffff;
                margin: 0 0 5px 0;
            }

            .stat-card p {
                font-size: 14px;
                color: #cbd5e1;
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-weight: 600;
            }

            .charts-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 24px;
                margin-bottom: 40px;
            }

            .chart-card {
                background: rgba(255, 255, 255, 0.06);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                padding: 24px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .chart-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.25);
            }

            .chart-card.full-width {
                grid-column: 1 / -1;
            }

            .chart-card h4 {
                font-size: 16px;
                font-weight: 700;
                color: #f8fafc;
                margin-bottom: 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 12px;
                letter-spacing: 0.5px;
            }

            @media (max-width: 768px) {
                * { box-sizing: border-box; }
                .header-skema { flex-direction: column; align-items: stretch; gap: 15px; }
                .stat-card h3 { font-size: 24px; }
                .filter-bar { width: 100%; }
                .filter-group { flex-direction: column; align-items: stretch; width: 100%; }
                .filter-select { width: 100%; }
                .filter-icon { display: none; }
            }
        </style>

        <div class="content-wrapper">
            <div class="header-skema">
                <div>
                    <h2><i class="fas fa-chart-bar" style="color: #60a5fa; margin-right: 8px;"></i> Statistik SKPI</h2>
                    <p>Rekapitulasi dan grafik penerbitan SKPI Universitas Iskandar Muda</p>
                </div>
                
                {{-- FILTER FORM --}}
                @php
                    $bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                @endphp
                <form method="GET" action="{{ route('statistik') }}" class="filter-bar">
                    <div class="filter-group">
                        <i class="fas fa-filter filter-icon"></i>
                        
                        <select name="month" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Bulan</option>
                            @foreach($bulanIndo as $mIdx => $mName)
                                <option value="{{ $mIdx }}" {{ ($month ?? '') == $mIdx ? 'selected' : '' }}>
                                    {{ $mName }}
                                </option>
                            @endforeach
                        </select>

                        <select name="year" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @foreach(range(date('Y'), 2023) as $y)
                                <option value="{{ $y }}" {{ ($year ?? '') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            {{-- RINGKASAN DATA --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>{{ $summaryTotal ?? 0 }}</h3>
                    <p>Total SKPI</p>
                </div>
                <div class="stat-card" style="border-left-color: #10b981;">
                    <h3>{{ $summaryApproved ?? 0 }}</h3>
                    <p>Disetujui / Final</p>
                </div>
                <div class="stat-card" style="border-left-color: #f59e0b;">
                    <h3>{{ $summaryPending ?? 0 }}</h3>
                    <p>Pending / Proses</p>
                </div>
            </div>

            {{-- CHARTS GRID --}}
            <div class="charts-grid">
                {{-- Chart 1: Top Prodi --}}
                <div class="chart-card">
                    <h4><i class="fas fa-university" style="color: #60a5fa; margin-right: 8px;"></i> Top Prodi Pengajuan SKPI</h4>
                    <div id="chartProdi"></div>
                </div>

                {{-- Chart 2: Status Distribution --}}
                <div class="chart-card">
                    <h4><i class="fas fa-chart-pie" style="color: #34d399; margin-right: 8px;"></i> Status SKPI</h4>
                    <div id="chartStatus"></div>
                </div>
                
                {{-- Chart 3: Trend --}}
                <div class="chart-card full-width">
                    <h4><i class="fas fa-chart-line" style="color: #a78bfa; margin-right: 8px;"></i> {{ $trendLabel ?? 'Tren Pengajuan' }}</h4>
                    <div id="chartTrend"></div>
                </div>
            </div>

            {{-- SCRIPTS FOR CHARTS --}}
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                // 1. Chart Prodi
                var optionsProdi = {
                    series: [{
                        name: 'Total SKPI',
                        data: {!! json_encode($chartProdiValues ?? []) !!}
                    }],
                    chart: {
                        type: 'bar',
                        height: 300,
                        background: 'transparent',
                        toolbar: { show: false }
                    },
                    theme: { mode: 'dark' },
                    grid: { borderColor: 'rgba(255, 255, 255, 0.1)' },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                        }
                    },
                    dataLabels: { enabled: false },
                    xaxis: {
                        categories: {!! json_encode($chartProdiKeys ?? []) !!},
                    },
                    colors: ['#3b82f6']
                };
                new ApexCharts(document.querySelector("#chartProdi"), optionsProdi).render();

                // 2. Chart Status
                var optionsStatus = {
                    series: {!! json_encode($chartStatusValues ?? []) !!},
                    chart: {
                        type: 'donut',
                        height: 320,
                        background: 'transparent'
                    },
                    theme: { mode: 'dark' },
                    stroke: { colors: ['rgba(255, 255, 255, 0.05)'] },
                    labels: {!! json_encode($chartStatusKeys ?? []) !!},
                    colors: ['#f59e0b', '#10b981', '#ef4444', '#3b82f6'], 
                    legend: { position: 'bottom' }
                };
                new ApexCharts(document.querySelector("#chartStatus"), optionsStatus).render();

                // 3. Chart: Trend
                var optionsTrend = {
                    series: [{
                        name: 'Pengajuan',
                        data: {!! json_encode($chartTrendValues ?? []) !!}
                    }],
                    chart: {
                        height: 300,
                        type: 'area',
                        background: 'transparent',
                        toolbar: { show: false }
                    },
                    theme: { mode: 'dark' },
                    grid: { borderColor: 'rgba(255, 255, 255, 0.1)' },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    markers: { size: 5, hover: { size: 7 } },
                    xaxis: {
                        categories: {!! json_encode($chartTrendKeys ?? []) !!}
                    },
                    colors: ['#8b5cf6'],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.2,
                        }
                    }
                };
                new ApexCharts(document.querySelector("#chartTrend"), optionsTrend).render();
            </script>
        </div>
    </section>
    @include('partials.footer')
</body>
</html>
