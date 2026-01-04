@extends('fakultas.layouts.app')
@section('title', 'Approval SKPI Fakultas')

@section('content')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .page-header h1 {
            font-size: 20px;
            margin: 0;
        }

        .filter-bar {
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 14px;
        }

        .filter-bar select,
        .filter-bar input[type="text"] {
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        .filter-bar button {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            font-size: 13px;
            cursor: pointer;
        }

        .filter-bar button:hover {
            background: #e5e7eb;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.06);
        }

        .card-header,
        .card-footer {
            padding: 10px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .card-footer {
            border-top: 1px solid #e5e7eb;
            border-bottom: none;
        }

        .card-body {
            padding: 0;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #22c55e;
            color: #166534;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table.table th,
        table.table td {
            padding: 9px 12px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        table.table th {
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
        }

        table.table tbody tr.pending {
            background: #fffbea;
        }

        table.table tbody tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-icon {
            margin-right: 4px;
        }

        .empty-state {
            text-align: center;
            padding: 38px 8px;
            color: #64748b;
            font-size: 15px;
        }

        @media(max-width:900px) {
            .filter-bar {
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="page-header">
        <h1>Approval SKPI Fakultas</h1>
        <form method="GET" class="filter-bar">
            <label>Status:</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <label>Kategori:</label>
            <select name="kategori">
                <option value="">Semua</option>
                @foreach ($listKategori as $kategori)
                    <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}</option>
                @endforeach
            </select>
            <label>Cari NIM/Nama:</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="NIM atau Nama">
            <button type="submit">Filter</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span>Daftar Pengajuan SKPI</span>
            <span>Total: {{ $drafts->total() }} pengajuan</span>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tgl Pengajuan</th>
                        <th>Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drafts as $index => $v)
                        <tr class="{{ $v->status === 'pending' ? 'pending' : '' }}">
                            <td>{{ $drafts->firstItem() + $index }}</td>
                            <td>{{ $v->mahasiswa->nim ?? '-' }}</td>
                            <td>{{ $v->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $v->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info">
                                    <i class="fas fa-tag status-icon"></i>
                                    {{ class_basename($v->verifiable_type) ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @if ($v->status === 'pending')
                                    <span class="badge badge-warning"><i
                                            class="fas fa-hourglass status-icon"></i>Pending</span>
                                @elseif ($v->status === 'approved')
                                    <span class="badge badge-success"><i
                                            class="fas fa-check status-icon"></i>Disetujui</span>
                                @elseif ($v->status === 'rejected')
                                    <span class="badge badge-danger" title="{{ $v->catatan }}"><i
                                            class="fas fa-times status-icon"></i>Ditolak</span>
                                @else
                                    <span class="badge">{{ $v->status }}</span>
                                @endif
                            </td>
                            <td>{{ $v->tanggal_pengajuan ? $v->tanggal_pengajuan->format('d/m/Y') : '-' }}</td>
                            <td>{{ $v->tanggal_verifikasi ? $v->tanggal_verifikasi->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('fakultas.verifikasi.show', $v->id) }}"
                                    class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-state">
                                <i class="fas fa-inbox"></i><br>
                                Belum ada pengajuan SKPI di level fakultas.<br>
                                <small>Semua pengajuan terbaru akan tampil di sini otomatis</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $drafts->withQueryString()->links() }}
        </div>
    </div>
@endsection
