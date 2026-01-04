@extends('admin.layouts.app')

@section('title', 'PKM Mahasiswa')
@section('page_title', 'PKM')
@section('page_icon', 'lightbulb')

@section('content')

    <style>
        /* ========================================
               PKM - TEMA HIJAU
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

        .badge-pink {
            background: #fce7f3;
            color: #9f1239;
        }

        .badge-orange {
            background: #ffedd5;
            color: #9a3412;
        }

        .badge-teal {
            background: #ccfbf1;
            color: #115e59;
        }

        /* ========================================
               FILE BADGE
               ======================================== */

        .file-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .file-badge:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .file-badge.has-file {
            background: #d1fae5;
            color: #065f46;
        }

        .file-badge.has-file:hover {
            background: #a7f3d0;
        }

        /* ========================================
               JUDUL TRUNCATE
               ======================================== */

        .judul-truncate {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

            .judul-truncate {
                max-width: 120px;
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
                <i class="fas fa-lightbulb"></i> PKM
            </span>
        </div>

        {{-- ✅ HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-lightbulb"></i>
                    Program Kreativitas Mahasiswa (PKM)
                </h2>
                <p>
                    Kelola data PKM mahasiswa berbagai skema
                </p>
            </div>

            <div class="action-group">
                {{-- SEARCH --}}
                <form action="{{ route('admin.pkm.index') }}" method="GET" class="search-form" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari judul PKM atau mahasiswa..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- ✅ FILTER TABS BY SKEMA PKM --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.pkm.index') }}" class="filter-tab {{ !request('skema') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.pkm.index', ['skema' => 'PKM-K']) }}"
                class="filter-tab {{ request('skema') == 'PKM-K' ? 'active' : '' }}">
                <i class="fas fa-flask"></i> PKM-K
            </a>
            <a href="{{ route('admin.pkm.index', ['skema' => 'PKM-M']) }}"
                class="filter-tab {{ request('skema') == 'PKM-M' ? 'active' : '' }}">
                <i class="fas fa-industry"></i> PKM-M
            </a>
            <a href="{{ route('admin.pkm.index', ['skema' => 'PKM-T']) }}"
                class="filter-tab {{ request('skema') == 'PKM-T' ? 'active' : '' }}">
                <i class="fas fa-cogs"></i> PKM-T
            </a>
            <a href="{{ route('admin.pkm.index', ['skema' => 'PKM-RE']) }}"
                class="filter-tab {{ request('skema') == 'PKM-RE' ? 'active' : '' }}">
                <i class="fas fa-microscope"></i> PKM-RE
            </a>
            <a href="{{ route('admin.pkm.index', ['skema' => 'PKM-RSH']) }}"
                class="filter-tab {{ request('skema') == 'PKM-RSH' ? 'active' : '' }}">
                <i class="fas fa-users"></i> PKM-RSH
            </a>
        </div>

        {{-- ✅ TABLE --}}
        {{-- ✅ TABLE SCROLLABLE --}}
        <div class="table-container">
            <div class="table-wrapper" style="max-height: 600px; overflow-y: auto; overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul PKM</th>
                            <th>Skema</th>
                            <th>Ketua</th>
                            <th>Anggota</th>
                            <th>Prodi</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Proposal</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pkmList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    <div class="judul-truncate" title="{{ $item->judul_pkm ?? '-' }}">
                                        <strong>{{ $item->judul_pkm ?? '-' }}</strong>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->skema == 'PKM-K')
                                        <span class="badge badge-success">{{ $item->skema }}</span>
                                    @elseif($item->skema == 'PKM-M')
                                        <span class="badge badge-purple">{{ $item->skema }}</span>
                                    @elseif($item->skema == 'PKM-T')
                                        <span class="badge badge-orange">{{ $item->skema }}</span>
                                    @elseif($item->skema == 'PKM-RE')
                                        <span class="badge badge-info">{{ $item->skema }}</span>
                                    @elseif($item->skema == 'PKM-RSH')
                                        <span class="badge badge-pink">{{ $item->skema }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $item->skema ?? '-' }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->mahasiswa->nama ?? ($item->ketua ?? '-') }}</td>
                                <td>{{ $item->anggota_tim ?? ($item->jumlah_anggota ?? 0) }} orang</td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td><span
                                        class="badge badge-warning">{{ $item->tahun_pelaksanaan ?? ($item->tahun ?? '-') }}</span>
                                </td>
                                <td>
                                    @if ($item->status == 'submitted')
                                        <span class="badge badge-info">Submitted</span>
                                    @elseif($item->status == 'Didanai')
                                        <span class="badge badge-success">Didanai</span>
                                    @elseif($item->status == 'Lolos')
                                        <span class="badge badge-teal">Lolos</span>
                                    @elseif($item->status == 'draft')
                                        <span class="badge badge-warning">Draft</span>
                                    @else
                                        <span class="badge badge-warning">{{ ucfirst($item->status ?? 'Proses') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->file_path || $item->file_proposal)
                                        <a href="{{ asset('storage/' . ($item->file_path ?? $item->file_proposal)) }}"
                                            target="_blank" class="file-badge has-file">
                                            <i class="fas fa-file-pdf"></i> Lihat
                                        </a>
                                    @else
                                        <span class="file-badge">
                                            <i class="fas fa-times"></i> Tidak ada
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center;">
                                        <a href="{{ route('admin.pkm.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.pkm.destroy', $item->id) }}" method="POST"
                                            style="display: inline;" onsubmit="return confirm('Yakin hapus data PKM ini?')">
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
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-lightbulb"></i>
                                    <p>Tidak ada data PKM</p>
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

            {{-- ✅ INFO COUNT --}}
            @if ($pkmList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $pkmList->count() }}</strong> data PKM
                    @if (request('skema'))
                        untuk skema <strong>{{ request('skema') }}</strong>
                    @endif
                    @if (request('search'))
                        dari pencarian "<strong>{{ request('search') }}</strong>"
                    @endif
                </div>
            @endif
        </div>

    </div>

    {{-- ✅ CSS TAMBAHAN UNTUK SCROLLBAR --}}
    <style>
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
    </style>

@endsection
