@extends('admin.layouts.app')

@section('title', 'Total Program Studi')
@section('page_title', 'Total Program Studi')
@section('page_icon', 'layer-group')

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
            box-sizing: border-box; /* Fix width calculation */
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

        .search-box {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-input {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            width: 100%;
            max-width: 280px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .search-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .btn {
            box-sizing: border-box; /* Fix width calculation */
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

        .btn-warning {
            background: #fbbf24;
            color: #78350f;
        }

        .btn-warning:hover {
            background: #f59e0b;
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
            box-sizing: border-box;
            background: #64748b;
            color: white;
        }

        .btn-search:hover {
            background: #475569;
        }

        .table-container {
            width: 100%; /* Ensure container doesn't overflow */
            overflow-x: auto;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #10b981, #059669);
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

        .info-count {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-top: 15px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px; /* Reduce padding on mobile */
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
                gap: 12px;
            }

            /* Stack Search Form Elements */
            .search-form {
                flex-direction: column !important;
                width: 100%;
                gap: 10px;
            }

            .search-input {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Make all buttons full width and centered */
            .btn, .btn-back, .btn-search {
                width: 100%;
                justify-content: center;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }

            .search-box {
                flex-direction: column;
                width: 100%;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- ✅ BREADCRUMB NAVIGATION --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-layer-group"></i> Total Program Studi
            </span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2><i class="fas fa-layer-group"></i> Data Program Studi</h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Daftar seluruh program studi
                </p>
            </div>

            <div class="action-group">
                {{-- TOMBOL KEMBALI --}}
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                {{-- SEARCH --}}
                <form action="{{ route('admin.total-prodi.index') }}" method="GET" class="search-form" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama prodi atau fakultas..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>

                {{-- TAMBAH --}}
                <a href="{{ route('admin.total-prodi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Prodi
                </a>
            </div>
        </div>

        <div class="table-container">
            @if ($prodi->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Program Studi</th>
                            <th>Fakultas</th>
                            <th>Jenjang</th>
                            <th>Akreditasi</th>
                            <th>Jumlah Mahasiswa</th>
                            <th style="width: 200px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prodi as $i => $pd)
                            <tr>
                                <td style="text-align: center;">{{ $prodi->firstItem() + $i }}</td>
                                <td><strong>{{ $pd->nama_prodi }}</strong></td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $pd->fakultas->nama_fakultas ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $pd->jenjang ?? '-' }}</td>
                                <td>{{ $pd->akreditasi ?? '-' }}</td>
                                <td style="text-align: center;">
                                    <span class="badge badge-info">{{ $pd->mahasiswas_count }} Mahasiswa</span>
                                </td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="{{ route('admin.total-prodi.edit', $pd->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.total-prodi.destroy', $pd->id) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin hapus prodi {{ $pd->nama_prodi }}?')">
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

                <div class="info-count">
                    Total: <strong>{{ $prodi->total() }}</strong> program studi
                </div>

                {{-- <div class="pagination-wrapper" style="margin-top: 20px;">
                    {{ $prodi->links() }}
                </div> --}}
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Tidak ada data program studi</h3>
                    <p>Belum ada program studi terdaftar</p>
                </div>
            @endif
        </div>
    </div>

@endsection
