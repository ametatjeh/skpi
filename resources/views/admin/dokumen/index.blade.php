@extends('admin.layouts.app')

@section('title', 'Dokumen Pendukung')
@section('page_title', 'Dokumen Pendukung')
@section('page_icon', 'folder-open')

@section('content')

    <style>
        /* ========================================
           DOKUMEN - TEMA HIJAU MODERN
           ======================================== */

        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

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
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-wrapper {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .table-wrapper::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #059669;
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

        .badge-prestasi {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-sertifikasi {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-organisasi {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-pkm {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .file-name {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-family: monospace;
            font-size: 12px;
            color: #64748b;
        }

        .file-size {
            font-size: 11px;
            color: #94a3b8;
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

        .empty-state p {
            margin: 0;
        }

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
                min-width: 80px;
                justify-content: center;
                font-size: 12px;
                padding: 8px 12px;
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

        @if ($errors->any())
            <div class="alert" style="background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626;">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p style="margin: 0;">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ✅ BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-folder-open"></i> Dokumen Pendukung
            </span>
        </div>

        {{-- ✅ HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-folder-open"></i>
                    Dokumen Pendukung
                </h2>
                <p>
                    Kelola semua file dan dokumen mahasiswa dari berbagai kategori
                </p>
            </div>

            <div class="action-group">
                {{-- SEARCH --}}
                <form action="{{ route('admin.dokumen.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama mahasiswa..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- ✅ FILTER TABS BY KATEGORI --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.dokumen.index') }}" class="filter-tab {{ !request('kategori') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.dokumen.index', ['kategori' => 'Prestasi']) }}"
                class="filter-tab {{ request('kategori') == 'Prestasi' ? 'active' : '' }}">
                <i class="fas fa-trophy"></i> Prestasi
            </a>
            <a href="{{ route('admin.dokumen.index', ['kategori' => 'Sertifikasi']) }}"
                class="filter-tab {{ request('kategori') == 'Sertifikasi' ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Sertifikasi
            </a>
            <a href="{{ route('admin.dokumen.index', ['kategori' => 'Organisasi']) }}"
                class="filter-tab {{ request('kategori') == 'Organisasi' ? 'active' : '' }}">
                <i class="fas fa-users"></i> Organisasi
            </a>
            <a href="{{ route('admin.dokumen.index', ['kategori' => 'PKM']) }}"
                class="filter-tab {{ request('kategori') == 'PKM' ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i> PKM
            </a>
        </div>

        {{-- ✅ SCROLLABLE TABLE --}}
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Kategori</th>
                            <th>Judul Kegiatan</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Nama File</th>
                            <th>Tanggal Upload</th>
                            <th>Status</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumenList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    @if ($item['kategori'] == 'Prestasi')
                                        <span class="badge badge-prestasi">
                                            <i class="fas fa-trophy"></i> Prestasi
                                        </span>
                                    @elseif($item['kategori'] == 'Sertifikasi')
                                        <span class="badge badge-sertifikasi">
                                            <i class="fas fa-certificate"></i> Sertifikasi
                                        </span>
                                    @elseif($item['kategori'] == 'Organisasi')
                                        <span class="badge badge-organisasi">
                                            <i class="fas fa-users"></i> Organisasi
                                        </span>
                                    @else
                                        <span class="badge badge-pkm">
                                            <i class="fas fa-lightbulb"></i> PKM
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $item['judul'] ?? '-' }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $item['mahasiswa']->nim ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $item['mahasiswa']->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $item['mahasiswa']->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="file-name" title="{{ basename($item['file_path']) }}">
                                        <i class="fas fa-file-pdf" style="color: #ef4444;"></i>
                                        {{ basename($item['file_path']) }}
                                    </div>
                                    @if (file_exists(storage_path('app/public/' . $item['file_path'])))
                                        <div class="file-size">
                                            {{ number_format(filesize(storage_path('app/public/' . $item['file_path'])) / 1024, 2) }}
                                            KB
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $item['created_at']->format('d M Y, H:i') }}</td>
                                <td>
                                    @if ($item['status'] == 'submitted')
                                        <span class="badge badge-info">Submitted</span>
                                    @elseif($item['status'] == 'draft')
                                        <span class="badge badge-warning">Draft</span>
                                    @else
                                        <span class="badge badge-success">{{ ucfirst($item['status']) }}</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center;">
                                        <a href="{{ asset('storage/' . $item['file_path']) }}" target="_blank"
                                            class="btn btn-info btn-sm" title="Lihat File">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.download', [$item['kategori'], $item['id']]) }}"
                                            class="btn btn-primary btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Tidak ada dokumen</p>
                                    @if (request('search'))
                                        <p style="font-size: 12px; margin-top: 5px;">
                                            Tidak ditemukan hasil untuk "{{ request('search') }}"
                                        </p>
                                    @endif
                                    @if (request('kategori'))
                                        <p style="font-size: 12px; margin-top: 5px;">
                                            pada kategori <strong>{{ request('kategori') }}</strong>
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ INFO COUNT --}}
            @if ($dokumenList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $dokumenList->count() }}</strong> dokumen
                    @if (request('kategori'))
                        dari kategori <strong>{{ request('kategori') }}</strong>
                    @endif
                    @if (request('search'))
                        dengan pencarian "<strong>{{ request('search') }}</strong>"
                    @endif
                </div>
            @endif
        </div>

    </div>

@endsection
