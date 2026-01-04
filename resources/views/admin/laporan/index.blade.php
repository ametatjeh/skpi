@extends('admin.layouts.app')

@section('title', 'Laporan SKPI')

@section('content')
    <style>
        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .export-btns {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #047857, #059669);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #3b82f6;
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 5px 0;
        }

        .stat-card p {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }

        .table-container {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
        }

        th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            /* Fix box sizing to prevent overflow */
            * {
                box-sizing: border-box;
            }

            .content-wrapper {
                padding: 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .export-btns {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .stat-card h3 {
                font-size: 24px;
            }

            .table-container {
                max-width: 100%;
            }

            /* Stack filters on mobile */
            .filter-bar {
                width: 100%;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }

            .filter-select {
                width: 100%;
            }
            
            .filter-icon {
                display: none; /* Hide icon to save space or center it if preferred */
            }
        }

        /* NEW FILTER STYLES */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f1f5f9;
            padding: 5px 10px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .filter-icon {
            color: #64748b;
            font-size: 14px;
        }

        .filter-select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background-color: white;
            color: #334155;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
            min-width: 140px;
        }

        .filter-select:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .filter-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>

    <div class="content-wrapper">
        <div class="page-header">
            <div>
                <h2><i class="fas fa-chart-bar"></i> Laporan SKPI</h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Rekap dan export data SKPI
                </p>
            </div>
            
            {{-- FILTER FORM --}}
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-bar">
                <div class="filter-group">
                    <i class="fas fa-filter filter-icon"></i>
                    
                    <select name="month" class="filter-select" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>

                    <select name="year" class="filter-select" onchange="this.form.submit()">
                        <option value="">Semua Tahun</option>
                        @foreach(range(date('Y'), 2020) as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="export-btns">
                <a href="{{ route('admin.laporan.export.pdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>

        {{-- CHARTS GRID --}}
        <div class="row mb-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
            {{-- Chart 1: Top Prodi --}}
            <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">Top Prodi Pengajuan SKPI</h4>
                <div id="chartProdi"></div>
            </div>

            {{-- Chart 2: Status Distribution --}}
            <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">Status SKPI</h4>
                <div id="chartStatus"></div>
            </div>
            
             {{-- Chart 3: Trend --}}
             <div style="grid-column: 1 / -1; background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">{{ $trendLabel }}</h4>
                <div id="chartTrend"></div>
            </div>
        </div>

        {{-- STATISTIK (Keeping original stats as summary cards) --}}
        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">Ringkasan Data</h4>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>{{ $summaryTotal }}</h3>
                <p>Total SKPI</p>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>{{ $summaryApproved }}</h3>
                <p>SKPI Disetujui / Final</p>
            </div>
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <h3>{{ $summaryPending }}</h3>
                <p>SKPI Pending / Proses</p>
            </div>
        </div>

        {{-- SCRIPTS FOR CHARTS --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // 1. Chart Prodi
            var optionsProdi = {
                series: [{
                    name: 'Total SKPI',
                    data: {!! json_encode($chartProdiValues) !!}
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: {!! json_encode($chartProdiKeys) !!},
                },
                colors: ['#3b82f6']
            };
            new ApexCharts(document.querySelector("#chartProdi"), optionsProdi).render();

            // 2. Chart Status
            var optionsStatus = {
                series: {!! json_encode($chartStatusValues) !!},
                chart: {
                    type: 'donut',
                    height: 320
                },
                labels: {!! json_encode($chartStatusKeys) !!},
                colors: ['#f59e0b', '#10b981', '#ef4444', '#3b82f6'], 
                legend: { position: 'bottom' }
            };
            new ApexCharts(document.querySelector("#chartStatus"), optionsStatus).render();

             // 3. Chart: Trend (Monthly or Yearly)
            var optionsTrend = {
                series: [{
                    name: 'Pengajuan',
                    data: {!! json_encode($chartTrendValues) !!}
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                // ADD MARKERS so single points are visible
                markers: { size: 5, hover: { size: 7 } },
                xaxis: {
                    categories: {!! json_encode($chartTrendKeys) !!}
                },
                colors: ['#8b5cf6'],
                fill: {
                     type: "gradient",
                     gradient: {
                       shadeIntensity: 1,
                       opacityFrom: 0.7,
                       opacityTo: 0.3,
                     }
                  }
            };
            new ApexCharts(document.querySelector("#chartTrend"), optionsTrend).render();
        </script>

        {{-- TABEL --}}
        <div class="table-container">
            @if ($skpi->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skpi as $i => $item)
                            <tr>
                                <td>{{ $skpi->firstItem() + $i }}</td>
                                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                                <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                                <td>{{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 'approved')
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif($item->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-info">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="padding: 15px; text-align: center;">
                    {{ $skpi->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-chart-pie"></i>
                    <h3>Belum ada data SKPI</h3>
                    <p>Data SKPI akan muncul setelah mahasiswa mengajukan</p>
                </div>
            @endif
        </div>
    </div>
@endsection
