@extends('admin.layouts.app')

@section('title', 'Semua Verifikasi')
@section('page_title', 'Semua Verifikasi')
@section('page_icon', 'list-check')

@section('content')

    <style>
        /* ========================================
           SEMUA VERIFIKASI - TEMA HIJAU
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

        .search-input,
        .filter-select {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-select {
            width: 180px;
        }

        .search-input {
            width: 280px;
        }

        .search-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

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

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-revision {
            background: #ffedd5;
            color: #9a3412;
        }

        .badge-prodi {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-fakultas {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-dekan {
            background: #fce7f3;
            color: #9f1239;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
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
                gap: 10px;
            }

            /* Force search form to stack */
            .header-actions form {
                flex-direction: column !important;
                width: 100%;
            }

            .search-input,
            .filter-select {
                width: 100% !important;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            /* Force filter tabs to stack */
            .filter-tabs {
                flex-direction: column;
                gap: 10px;
            }

            .filter-tab {
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

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span>
                <i class="fas fa-check-circle"></i> Verifikasi
            </span>
            <span class="separator">›</span>
            <span class="current">Semua Verifikasi</span>
        </div>

        {{-- HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-list-check"></i>
                    Semua Verifikasi
                </h2>
                <p>
                    Riwayat semua verifikasi kegiatan mahasiswa
                </p>
            </div>

            <div class="action-group">
                <form action="{{ route('admin.verifikasi.semua') }}" method="GET"
                    style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="hidden" name="level" value="{{ request('level') }}">

                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="revision_required" {{ request('status') == 'revision_required' ? 'selected' : '' }}>
                            Revisi</option>
                    </select>

                    <input type="text" name="search" class="search-input" placeholder="Cari nama atau NIM..."
                        value="{{ request('search') }}">

                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- FILTER TABS KATEGORI --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.verifikasi.semua') }}"
                class="filter-tab {{ !request('kategori') && !request('level') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['kategori' => 'Prestasi']) }}"
                class="filter-tab {{ request('kategori') == 'Prestasi' ? 'active' : '' }}">
                <i class="fas fa-trophy"></i> Prestasi
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['kategori' => 'SertifikasiKompetensi']) }}"
                class="filter-tab {{ request('kategori') == 'SertifikasiKompetensi' ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Sertifikasi
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['kategori' => 'Organisasi']) }}"
                class="filter-tab {{ request('kategori') == 'Organisasi' ? 'active' : '' }}">
                <i class="fas fa-users"></i> Organisasi
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['kategori' => 'PengabdianMasyarakat']) }}"
                class="filter-tab {{ request('kategori') == 'PengabdianMasyarakat' ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i> PKM
            </a>
        </div>

        {{-- FILTER TABS LEVEL --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.verifikasi.semua', ['level' => 'prodi']) }}"
                class="filter-tab {{ request('level') == 'prodi' ? 'active' : '' }}">
                <i class="fas fa-building"></i> Level Prodi
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['level' => 'fakultas']) }}"
                class="filter-tab {{ request('level') == 'fakultas' ? 'active' : '' }}">
                <i class="fas fa-university"></i> Level Fakultas
            </a>
            <a href="{{ route('admin.verifikasi.semua', ['level' => 'pusat_bahasa']) }}"
                class="filter-tab {{ request('level') == 'pusat_bahasa' ? 'active' : '' }}">
                <i class="fas fa-language"></i> Level Dekan
            </a>
        </div>

        {{-- TABLE --}}
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Kategori</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Judul Kegiatan</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($verifikasiList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    @php
                                        $kategori = class_basename($item->verifiable_type);
                                    @endphp
                                    @if ($kategori == 'Prestasi')
                                        <span class="badge badge-prestasi">
                                            <i class="fas fa-trophy"></i> Prestasi
                                        </span>
                                    @elseif($kategori == 'SertifikasiKompetensi')
                                        <span class="badge badge-sertifikasi">
                                            <i class="fas fa-certificate"></i> Sertifikasi
                                        </span>
                                    @elseif($kategori == 'Organisasi')
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
                                    <span class="badge badge-info">
                                        {{ $item->mahasiswa->nim ?? '-' }}
                                    </span>
                                </td>
                                <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->verifiable)
                                        @if ($kategori == 'Prestasi')
                                            {{ $item->verifiable->judul_prestasi ?? '-' }}
                                        @elseif($kategori == 'SertifikasiKompetensi')
                                            {{ $item->verifiable->nama_sertifikasi ?? '-' }}
                                        @elseif($kategori == 'Organisasi')
                                            {{ $item->verifiable->nama_organisasi ?? '-' }}
                                        @elseif($kategori == 'PengabdianMasyarakat')
                                            {{ $item->verifiable->judul_pkm ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        <span style="color: #ef4444;">Data dihapus</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->level_verifikasi == 'prodi')
                                        <span class="badge badge-prodi">
                                            <i class="fas fa-building"></i> Prodi
                                        </span>
                                    @elseif($item->level_verifikasi == 'fakultas')
                                        <span class="badge badge-fakultas">
                                            <i class="fas fa-university"></i> Fakultas
                                        </span>
                                    @else
                                        <span class="badge badge-dekan">
                                            <i class="fas fa-user-tie"></i> {{ ucfirst($item->level_verifikasi) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <span class="badge badge-pending">
                                            <i class="fas fa-clock"></i> Pending
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge badge-approved">
                                            <i class="fas fa-check"></i> Approved
                                        </span>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge badge-rejected">
                                            <i class="fas fa-times"></i> Rejected
                                        </span>
                                    @elseif($item->status == 'revision_required')
                                        <span class="badge badge-revision">
                                            <i class="fas fa-edit"></i> Revisi
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->tanggal_verifikasi)
                                        {{ $item->tanggal_verifikasi->format('d M Y') }}
                                    @else
                                        {{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d M Y') : '-' }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->catatan)
                                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                            title="{{ $item->catatan }}">
                                            {{ $item->catatan }}
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Tidak ada data verifikasi</p>
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

            @if ($verifikasiList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $verifikasiList->count() }}</strong> data verifikasi
                </div>
            @endif
        </div>

    </div>

@endsection
