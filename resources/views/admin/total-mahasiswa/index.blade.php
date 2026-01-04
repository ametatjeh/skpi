@extends('admin.layouts.app')

@section('title', 'Total Mahasiswa')
@section('page_title', 'Total Mahasiswa')
@section('page_icon', 'user-graduate')

@section('content')

    <style>
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
        }

        .btn-back {
            padding: 10px 20px;
            background: #64748b;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #475569;
            transform: translateY(-2px);
        }

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
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

        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            background: #f8fafc;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
        }

        .per-page-selector label {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            white-space: nowrap;
        }

        .per-page-selector select {
            padding: 8px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            background: white;
            transition: all 0.3s ease;
        }

        .per-page-selector select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(10, 185, 129, 0.1);
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
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-info {
            background: #0ea5e9;
            color: white;
        }

        .btn-info:hover {
            background: #0284c7;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-search {
            background: #64748b;
            color: white;
        }

        .btn-search:hover {
            background: #475569;
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            max-width: 100%; /* Ensure it doesn't push parent width */
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
        }

        thead {
            background: linear-gradient(135deg, #10b981, #059669);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #d1fae5;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
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

        .info-count {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            padding: 15px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .modal:target {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .close-modal {
            text-decoration: none;
            font-size: 28px;
            color: #94a3b8;
            transition: color 0.2s ease;
            line-height: 1;
        }

        .close-modal:hover {
            color: #475569;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

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
                gap: 15px; /* Reduced gap */
            }

            .page-header {
                text-align: center;
                margin-bottom: 5px;
            }

            .action-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            /* Back Button & Search Form - Full Width (Span 2 Columns) */
            .btn-back, 
            .search-form {
                grid-column: 1 / -1;
                width: 100%;
            }

            /* Search Form: Keep Inline (Side-by-side) */
            .search-form {
                display: flex !important;
                flex-direction: row !important;
                gap: 8px;
            }

            .search-input {
                width: auto !important;
                flex: 1; /* Input takes remaining space */
                font-size: 13px; /* Slightly smaller font */
            }

            .btn-search {
                width: auto; /* Button fits content */
                padding: 10px 15px;
            }

            /* Buttons inside stack take full width */
            .btn {
                width: 100%;
                justify-content: center;
                text-align: center;
                padding: 12px;
            }

            .action-buttons {
                flex-direction: column;
            }

            /* Per Page Selector Compact */
            .per-page-selector {
                flex-direction: row;
                justify-content: center;
                gap: 10px;
                margin-top: 5px;
                padding: 8px;
            }

            .per-page-selector label {
                display: none; /* Hide label to save space */
            }

            .per-page-selector select {
                width: auto;
                font-size: 13px;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-user-graduate"></i> Total Mahasiswa
            </span>
        </div>


        {{-- Success/Error now handled by animated modals --}}

        @if (session('import_errors'))
            <div class="alert" style="background: #fef3c7; color: #92400e; border-left: 4px solid #f59e0b; flex-direction: column; align-items: flex-start;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Beberapa data dilewati:</strong>
                </div>
                <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                    @foreach (session('import_errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2><i class="fas fa-user-graduate"></i> Data Mahasiswa</h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Daftar seluruh mahasiswa terdaftar
                </p>
            </div>

            <div class="action-group">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <form action="{{ route('admin.total-mahasiswa.index') }}" method="GET" class="search-form" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama, NIM, atau email..."
                        value="{{ request('search') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 50) }}">
                    <button type="submit" class="btn btn-search btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>

                <a href="#addModal" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>

                <a href="#importModal" class="btn btn-import" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                    <i class="fas fa-file-excel"></i> Import Excel
                </a>
            </div>
        </div>

        {{-- PER PAGE SELECTOR --}}
        <div class="per-page-selector">
            <label><i class="fas fa-list"></i> Tampilkan:</label>
            <select id="perPageSelect" onchange="changePerPage(this.value)">
                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 Data</option>
                <option value="200" {{ request('per_page') == 200 ? 'selected' : '' }}>200 Data</option>
                <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500 Data</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua Data</option>
            </select>
        </div>

        {{-- SCROLLABLE TABLE --}}
        <div class="table-container">
            @if ($mahasiswa->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <th style="width: 150px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $i => $mhs)
                                <tr>
                                    <td style="text-align: center;">{{ $i + 1 }}</td>
                                    <td><strong>{{ $mhs->nim }}</strong></td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->user->email ?? $mhs->email ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            {{ $mhs->prodi->nama_prodi ?? '-' }}
                                        </span>
                                    </td>
                                    <td>{{ $mhs->prodi->fakultas->nama_fakultas ?? '-' }}</td>
                                    <td>
                                        <div class="action-buttons" style="justify-content: center;">
                                            <a href="{{ route('admin.total-mahasiswa.show', $mhs->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <form action="{{ route('admin.total-mahasiswa.destroy', $mhs->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Yakin hapus mahasiswa {{ $mhs->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="info-count">
                    Menampilkan: <strong>{{ $mahasiswa->count() }}</strong> mahasiswa
                    @if (request('search'))
                        dari hasil pencarian "<strong>{{ request('search') }}</strong>"
                    @endif
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Tidak ada data mahasiswa</h3>
                    @if (request('search'))
                        <p>Tidak ditemukan hasil untuk "{{ request('search') }}"</p>
                    @else
                        <p>Belum ada mahasiswa terdaftar</p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL IMPORT --}}
    <div id="importModal" class="modal">
        <div class="modal-content" style="max-width: 650px;">
            <div class="modal-header" style="border-bottom-color: #f59e0b;">
                <h3 style="color: #d97706;"><i class="fas fa-file-excel"></i> Import Data Mahasiswa</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>

            <form action="{{ route('admin.total-mahasiswa.import') }}" method="POST" enctype="multipart/form-data" id="importForm" onsubmit="showLoadingOverlay()">
                @csrf

                {{-- INFO BOX --}}
                <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 15px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #f59e0b;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <i class="fas fa-info-circle" style="color: #d97706; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #92400e;">Panduan Import:</strong>
                            <ul style="margin: 8px 0 0 0; padding-left: 18px; color: #78350f; font-size: 13px; line-height: 1.6;">
                                <li>Format: <strong>Excel (.xlsx, .xls)</strong> atau <strong>CSV</strong></li>
                                <li>Maksimal ukuran file: <strong>10 MB</strong></li>
                                <li>Password default: <strong>NIM mahasiswa</strong></li>
                                <li>Nama Prodi harus sesuai dengan database</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- DOWNLOAD TEMPLATE --}}
                <div style="background: #f0fdf4; padding: 15px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <i class="fas fa-download" style="color: #10b981; margin-right: 8px;"></i>
                        <span style="color: #065f46; font-weight: 600;">Download template untuk format yang benar</span>
                    </div>
                    <a href="{{ route('admin.total-mahasiswa.template') }}" class="btn" style="background: #10b981; color: white; padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-file-csv"></i> Download Template
                    </a>
                </div>

                {{-- FILE UPLOAD --}}
                <div class="form-group">
                    <label><i class="fas fa-upload" style="color: #f59e0b;"></i> Pilih File <span style="color: #ef4444;">*</span></label>
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required 
                        style="padding: 12px; border: 2px dashed #e2e8f0; border-radius: 10px; cursor: pointer;">
                    <small style="color: #64748b; display: block; margin-top: 8px;">
                        Accepted: .xlsx, .xls, .csv (max 10MB)
                    </small>
                </div>

                {{-- KOLOM YANG DIBUTUHKAN --}}
                <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <strong style="color: #475569; font-size: 13px;"><i class="fas fa-columns"></i> Kolom yang dibutuhkan:</strong>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600;">nim*</span>
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600;">nama*</span>
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600;">prodi*</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">email</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">nik</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">jenis_kelamin</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">agama</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">alamat</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">tahun_masuk</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">angkatan</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">tanggal_masuk</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">status_mahasiswa</span>
                        <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px;">tempat_tanggal_lahir</span>
                    </div>
                    <small style="color: #94a3b8; display: block; margin-top: 8px;">* = Wajib diisi</small>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="btn" style="width: 100%; padding: 14px; font-size: 15px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                    <i class="fas fa-upload"></i> Import Data Mahasiswa
                </button>
            </form>
        </div>
    </div>

    {{-- LOADING OVERLAY --}}
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); justify-content: center; align-items: center; z-index: 999999; backdrop-filter: blur(6px);">
        <div style="text-align: center; color: white;">
            {{-- Spinning Circle --}}
            <div style="width: 80px; height: 80px; border: 4px solid rgba(255,255,255,0.3); border-top: 4px solid #f59e0b; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 25px;"></div>
            <h3 style="font-size: 22px; margin-bottom: 10px; font-weight: 600;">Mengimport Data...</h3>
            <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 5px;">Mohon tunggu, proses ini memerlukan waktu beberapa menit</p>
            <p style="color: rgba(255,255,255,0.5); font-size: 13px;">Jangan tutup atau refresh halaman ini</p>
            {{-- Progress Dots --}}
            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 8px;">
                <div style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; animation: bounce 1.4s ease-in-out infinite;"></div>
                <div style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; animation: bounce 1.4s ease-in-out 0.2s infinite;"></div>
                <div style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; animation: bounce 1.4s ease-in-out 0.4s infinite;"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
    </style>

    {{-- MODAL ADD --}}
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-plus"></i> Tambah Mahasiswa</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>NIM <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM"
                        value="{{ old('nim') }}" required>
                </div>

                <div class="form-group">
                    <label>Nama <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap"
                        value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label>Email <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="email@umpar.ac.id"
                        value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Program Studi <span style="color: #ef4444;">*</span></label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        @php
                            $prodisGrouped = DB::table('prodi')
                                ->join('fakultas', 'fakultas.id', '=', 'prodi.fakultas_id')
                                ->select('prodi.id', 'prodi.nama_prodi', 'prodi.fakultas_id', 'fakultas.nama_fakultas')
                                ->orderBy('fakultas.nama_fakultas')
                                ->orderBy('prodi.nama_prodi')
                                ->get()
                                ->groupBy('nama_fakultas');
                        @endphp

                        @foreach ($prodisGrouped as $fakultasNama => $prodiList)
                            <optgroup label="📚 {{ $fakultasNama }}">
                                @foreach ($prodiList as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->fakultas_id }} {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Password <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter"
                        required>
                </div>

                @if ($errors->any())
                    <div class="alert"
                        style="background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626; margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi Kesalahan:</strong>
                            <ul style="margin: 5px 0 0 20px; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Simpan Mahasiswa
                </button>
            </form>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        function changePerPage(value) {
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', value);
            window.location.href = url.toString();
        }

        // Loading Overlay Function
        function showLoadingOverlay() {
            document.getElementById('loadingOverlay').style.display = 'flex';
            // Close import modal
            window.location.hash = '';
            return true; // Allow form submission
        }

        // Modal Functions
        function showSuccessModal(message) {
            document.getElementById('successModalMessage').textContent = message;
            document.getElementById('successModal').style.display = 'flex';
        }

        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
        }

        function showErrorModal(message) {
            document.getElementById('errorModalMessage').textContent = message;
            document.getElementById('errorModal').style.display = 'flex';
        }

        function closeErrorModal() {
            document.getElementById('errorModal').style.display = 'none';
        }

        // Auto show modals on page load
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showSuccessModal("{{ session('success') }}");
            @endif

            @if($errors->has('import'))
                showErrorModal("{{ $errors->first('import') }}");
            @endif
        });

        // Close modal on outside click
        window.onclick = function(event) {
            if (event.target.classList.contains('result-modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>

    {{-- SUCCESS MODAL --}}
    <div id="successModal" class="result-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; z-index: 99999; backdrop-filter: blur(4px);">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; max-width: 450px; animation: modalBounce 0.5s ease;">
            {{-- Checkmark Animation --}}
            <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center; animation: scaleIn 0.5s ease;">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" style="animation: checkDraw 0.5s ease 0.3s both;">
                    <path d="M5 13l4 4L19 7" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 style="color: #065f46; font-size: 24px; margin-bottom: 10px; font-weight: 700;">Import Berhasil!</h3>
            <p id="successModalMessage" style="color: #64748b; font-size: 15px; margin-bottom: 25px; line-height: 1.6;"></p>
            <button onclick="closeSuccessModal()" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 14px 40px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-check"></i> OK, Mengerti
            </button>
        </div>
    </div>

    {{-- ERROR MODAL --}}
    <div id="errorModal" class="result-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; z-index: 99999; backdrop-filter: blur(4px);">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; max-width: 450px; animation: modalBounce 0.5s ease;">
            {{-- Error X Animation --}}
            <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #ef4444, #dc2626); margin: 0 auto 25px; display: flex; align-items: center; justify-content: center; animation: scaleIn 0.5s ease;">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" style="animation: shakeSlight 0.5s ease 0.3s;">
                    <path d="M6 6l12 12M6 18L18 6" stroke="white" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
            <h3 style="color: #991b1b; font-size: 24px; margin-bottom: 10px; font-weight: 700;">Import Gagal!</h3>
            <p id="errorModalMessage" style="color: #64748b; font-size: 15px; margin-bottom: 25px; line-height: 1.6;"></p>
            <button onclick="closeErrorModal()" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 14px 40px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>
    </div>

    <style>
        @keyframes modalBounce {
            0% { transform: scale(0.5); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes scaleIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes checkDraw {
            0% { stroke-dasharray: 50; stroke-dashoffset: 50; }
            100% { stroke-dashoffset: 0; }
        }

        @keyframes shakeSlight {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>

@endsection
