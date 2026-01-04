@extends('admin.layouts.app')

@section('title', 'Progress SKPI')
@section('page_title', 'Progress SKPI')
@section('page_icon', 'tasks')

@section('content')

    <style>
        /* ========================================
               PROGRESS SKPI - TEMA HIJAU
               ======================================== */

        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* ========================================
               BREADCRUMB
               ======================================== */

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .breadcrumb-nav a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .breadcrumb-nav a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .breadcrumb-nav .separator {
            color: #cbd5e1;
        }

        .breadcrumb-nav .current {
            color: #1e293b;
            font-weight: 600;
        }

        /* ========================================
               HEADER
               ======================================== */

        .header-actions {
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: #10b981;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
        }

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ========================================
               BUTTONS
               ======================================== */

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

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .search-input {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            width: 280px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* ========================================
               FILTER TABS
               ======================================== */

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 20px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-tab:hover {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }

        .filter-tab.active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border-color: #10b981;
        }

        /* ========================================
               TABLE
               ======================================== */

        .table-container {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 600px;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background: linear-gradient(135deg, #10b981, #059669);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            white-space: nowrap;
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
            white-space: nowrap;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #d1fae5;
        }

        /* ========================================
               BADGES
               ======================================== */

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
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

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        /* ========================================
               PROGRESS BAR
               ======================================== */

        .progress-container {
            width: 120px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            height: 8px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #059669);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 12px;
            font-weight: 600;
            color: #10b981;
            margin-top: 4px;
        }

        /* ========================================
               EMPTY STATE
               ======================================== */

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

        .empty-state p {
            margin: 0;
        }

        /* ========================================
               INFO COUNT
               ======================================== */

        .info-count {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-top: 15px;
            font-weight: 600;
        }

        /* ========================================
               ALERT
               ======================================== */

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        /* ========================================
               RESPONSIVE
               ======================================== */

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 20px 15px;
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .filter-tabs {
                justify-content: center;
            }

            .filter-tab {
                flex: 1;
                min-width: 100px;
                justify-content: center;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 11px;
            }

            .progress-container {
                width: 80px;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- ✅ SUCCESS ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-tasks"></i> Progress SKPI
            </span>
        </div>

        {{-- ✅ HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-tasks"></i>
                    Progress SKPI Mahasiswa
                </h2>
                <p>
                    Monitor progress pengisian dan status SKPI mahasiswa
                </p>
            </div>

            <div class="action-group">
                {{-- SEARCH --}}
                <form action="{{ route('admin.progress.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama atau NIM mahasiswa..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- ✅ FILTER TABS --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.progress.index') }}"
                class="filter-tab {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.progress.index', ['status' => 'Dalam Proses']) }}"
                class="filter-tab {{ request('status') == 'Dalam Proses' ? 'active' : '' }}">
                <i class="fas fa-clock"></i> Dalam Proses
            </a>
            <a href="{{ route('admin.progress.index', ['status' => 'Selesai']) }}"
                class="filter-tab {{ request('status') == 'Selesai' ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i> Selesai
            </a>
            <a href="{{ route('admin.progress.index', ['status' => 'Belum Mulai']) }}"
                class="filter-tab {{ request('status') == 'Belum Mulai' ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i> Belum Mulai
            </a>
        </div>

        {{-- ✅ TABLE --}}
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Progress (%)</th>
                        <th>Status</th>
                        <th>Terakhir Update</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($progressData as $i => $data)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><span class="badge badge-info">{{ $data['nim'] }}</span></td>
                            <td><strong>{{ $data['nama'] }}</strong></td>
                            <td>{{ $data['prodi'] }}</td>
                            <td>
                                <div class="progress-container">
                                    <div class="progress-bar" style="width: {{ $data['progress'] }}%"></div>
                                </div>
                                <div class="progress-text">{{ $data['progress'] }}%</div>
                            </td>
                            <td>
                                @if ($data['status'] == 'Selesai')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> {{ $data['status'] }}
                                    </span>
                                @elseif($data['status'] == 'Dalam Proses')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> {{ $data['status'] }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $data['status'] }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $data['updated'] }}</td>
                            <td style="text-align: center;">
                                {{-- <a href="{{ route('admin.progress.show', $data['id']) }}" class="btn btn-info btn-sm"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Tidak ada data progress SKPI</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ INFO COUNT --}}
        <div class="info-count">
            Total: <strong>{{ $progressData->count() }}</strong> mahasiswa
        </div>

    </div>

@endsection
