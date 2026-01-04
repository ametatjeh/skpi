@extends('fakultas.layouts.app')
@section('title', 'Detail Verifikasi SKPI Fakultas')

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

        .btn {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 13px;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-light {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #374151;
        }

        .btn-light:hover {
            background: #e5e7eb;
        }

        .btn-success {
            background: #16a34a;
            border-color: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background: #15803d;
        }

        .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.06);
            margin-bottom: 16px;
        }

        .card-header {
            padding: 10px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
            font-size: 15px;
        }

        .card-body {
            padding: 12px 16px;
            font-size: 14px;
        }

        .card-body p {
            margin: 4px 0;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
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

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .inline-form {
            display: inline-block;
            margin: 0;
        }
    </style>

    <div class="page-header">
        <h1>Detail SKPI Mahasiswa</h1>
        <a href="{{ route('fakultas.draft-skpi.preview', $draft->id) }}">
            Kembali ke Preview Draft
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">Data Mahasiswa</div>
        <div class="card-body">
            <p><strong>NIM:</strong> {{ $verifikasi->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Nama:</strong> {{ $verifikasi->mahasiswa->nama ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $verifikasi->mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            <p><strong>Fakultas:</strong> {{ $verifikasi->mahasiswa->prodi->fakultas->nama_fakultas ?? '-' }}</p>
            <p><strong>Kategori:</strong> {{ class_basename($verifikasi->verifiable_type) ?? '-' }}</p>
            <p><strong>Status di Fakultas:</strong>
                @if ($verifikasi->status === 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif ($verifikasi->status === 'approved')
                    <span class="badge badge-success">Disetujui</span>
                @elseif ($verifikasi->status === 'rejected')
                    <span class="badge badge-danger">Ditolak</span>
                @endif
            </p>
            <p><strong>Catatan Terakhir:</strong> {{ $verifikasi->catatan ?? '-' }}</p>
        </div>
    </div>

    @if ($verifikasi->status === 'pending')
        <div class="card">
            <div class="card-header">Aksi Verifikasi Fakultas</div>
            <div class="card-body action-buttons">
                <form action="{{ route('fakultas.verifikasi.approve', $verifikasi->id) }}" method="POST"
                    class="inline-form">
                    @csrf
                    <button type="submit" class="btn btn-success">Setujui SKPI</button>
                </form>
                <form action="{{ route('fakultas.verifikasi.reject', $verifikasi->id) }}" method="POST"
                    class="inline-form" onsubmit="return confirm('Konfirmasi penolakan?');">
                    @csrf
                    <input type="text" name="catatan" placeholder="Catatan penolakan" required
                        style="padding:4px 8px; font-size:13px; margin-right:7px;">
                    <button type="submit" class="btn btn-danger">Tolak SKPI</button>
                </form>
            </div>
        </div>
    @endif
@endsection
