@extends('admin.layouts.app')

@section('title', 'Organisasi Mahasiswa')
@section('page_title', 'Organisasi')
@section('page_icon', 'users-cog')

@section('content')

    <style>
        /* ========================================
                   ORGANISASI - TEMA HIJAU
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

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
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
                   TABLE
                   ======================================== */

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            max-width: 100%; /* Ensure it doesn't push parent width */
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

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-purple {
            background: #ede9fe;
            color: #6d28d9;
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

        /* ========================================
                   PAGINATION
                   ======================================== */

        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* ========================================
                   RESPONSIVE
                   ======================================== */

        @media (max-width: 768px) {
            /* Add box-sizing to prevent padding from increasing width */
            * {
                box-sizing: border-box;
            }

            .content-wrapper {
                padding: 15px; /* Reduce padding for mobile */
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
                gap: 12px;
            }

            .search-form {
                flex-direction: column !important;
                width: 100%;
                gap: 10px;
            }

            .search-input {
                width: 100% !important;
            }
            
            .btn, .btn-sm, .btn-info {
                width: 100%;
                justify-content: center;
                text-align: center;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 11px;
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
                <i class="fas fa-users-cog"></i> Organisasi
            </span>
        </div>

        {{-- ✅ HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-users-cog"></i>
                    Organisasi Mahasiswa
                </h2>
                <p>
                    Kelola data keikutsertaan mahasiswa dalam organisasi
                </p>
            </div>

            <div class="action-group">
                {{-- SEARCH --}}
                <form action="{{ route('admin.organisasi.index') }}" method="GET" class="search-form" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input"
                        placeholder="Cari nama mahasiswa atau organisasi..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
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
                        <th>Nama Organisasi</th>
                        <th>Jabatan</th>
                        <th>Periode</th>
                        <th>Tingkat</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organisasiList as $i => $item)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><span class="badge badge-info">{{ $item->mahasiswa->nim ?? '-' }}</span></td>
                            <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                                </span>
                            </td>
                            <td><strong>{{ $item->nama_organisasi ?? '-' }}</strong></td>
                            <td>{{ $item->posisi ?? '-' }}</td>
                            <td>
                                @if ($item->tahun_masuk && $item->tahun_keluar)
                                    {{ $item->tahun_masuk }} - {{ $item->tahun_keluar }}
                                @elseif($item->tahun_masuk)
                                    {{ $item->tahun_masuk }} - Sekarang
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'submitted')
                                    <span class="badge badge-info">Submitted</span>
                                @elseif($item->status == 'draft')
                                    <span class="badge badge-warning">Draft</span>
                                @else
                                    <span class="badge badge-success">{{ ucfirst($item->status ?? '-') }}</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('admin.organisasi.show', $item->id) }}" class="btn btn-info btn-sm"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.organisasi.destroy', $item->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Yakin hapus data organisasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Tidak ada data organisasi</p>
                                @if (request('search'))
                                    <p style="font-size: 12px; margin-top: 5px;">
                                        Tidak ditemukan hasil untuk "{{ request('search') }}"
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @if ($organisasiList->count() > 0)
            <div
                style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0; margin-top: 20px; border-radius: 10px;">
                Menampilkan: <strong>{{ $organisasiList->count() }}</strong> data organisasi
                @if (request('search'))
                    dari pencarian "<strong>{{ request('search') }}</strong>"
                @endif
            </div>
        @endif

    </div>

@endsection
