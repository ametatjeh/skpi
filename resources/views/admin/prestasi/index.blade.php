@extends('admin.layouts.app')

@section('title', 'Prestasi Mahasiswa')
@section('page_title', 'Prestasi')
@section('page_icon', 'trophy')

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
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
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

        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center;
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
        }
    </style>

    <div class="content-wrapper">

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-trophy"></i> Prestasi
            </span>
        </div>

        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-trophy"></i>
                    Prestasi Mahasiswa
                </h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Kelola data prestasi dan penghargaan mahasiswa
                </p>
            </div>

            <div class="action-group">
                <form action="{{ route('admin.prestasi.index') }}" method="GET" class="search-form" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input"
                        placeholder="Cari nama mahasiswa atau prestasi..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Nama Kegiatan</th>
                        <th>Tingkat</th>
                        <th>Pencapaian</th>
                        <th>Tanggal</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prestasi as $i => $item)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><span class="badge badge-info">{{ $item->mahasiswa->nim ?? '-' }}</span></td>
                            <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                                </span>
                            </td>
                            <td><strong>{{ $item->judul_prestasi ?? '-' }}</strong></td>
                            <td>
                                @if ($item->tingkat == 'Internasional')
                                    <span class="badge badge-purple">{{ $item->tingkat }}</span>
                                @elseif($item->tingkat == 'Nasional')
                                    <span class="badge badge-info">{{ $item->tingkat }}</span>
                                @elseif($item->tingkat == 'Regional')
                                    <span class="badge badge-warning">{{ $item->tingkat }}</span>
                                @else
                                    <span class="badge badge-success">{{ $item->tingkat ?? 'Lokal' }}</span>
                                @endif
                            </td>
                            <td>{{ $item->penyelenggara ?? '-' }}</td>
                            <td>
                                {{ $item->tanggal_perolehan ? $item->tanggal_perolehan->format('d M Y') : '-' }}
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('admin.prestasi.show', $item->id) }}" class="btn btn-info btn-sm"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Yakin hapus data prestasi ini?')">
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
                            <td colspan="9" class="empty-state">
                                <i class="fas fa-trophy"></i>
                                <p>Tidak ada data prestasi</p>
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

        {{-- <div class="pagination-wrapper">
            {{ $prestasi->links() }}
        </div> --}}

    </div>

@endsection
