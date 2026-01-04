@extends('fakultas.layouts.app')
@section('title', 'Preview Draft SKPI')

@section('content')
    <style>
        :root {
            --fak-primary: #2563EB;
            --fak-primary-dark: #1E40AF;
            --fak-success: #22c55e;
            --fak-danger: #ef4444;
            --fak-muted: #64748b;
            --fak-border: #e5e7eb;
            --fak-bg: #f8fafc;
        }

        .breadcrumb {
            display: flex;
            gap: 6px;
            font-size: 14px;
            margin-bottom: 18px;
            align-items: center;
            color: var(--fak-muted);
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--fak-primary-dark);
            text-decoration: none;
            transition: color .2s;
        }

        .breadcrumb a:hover {
            color: var(--fak-primary);
        }

        .breadcrumb .divider {
            font-size: 16px;
            font-weight: bold;
            color: var(--fak-border);
        }

        .preview-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--fak-border);
            box-shadow: 0 2px 12px #2563eb09;
            padding: 2rem 2.5rem;
            margin-bottom: 32px;
        }

        .preview-header {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .preview-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--fak-primary-dark);
        }

        .btn-back {
            background: #e5e7eb;
            color: var(--fak-primary-dark);
            border: 1px solid var(--fak-border);
            border-radius: 5px;
            padding: 7px 18px;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 500;
            transition: .15s;
        }

        .btn-back:hover {
            background: var(--fak-primary);
            color: #fff;
        }

        .detail-block {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.12rem;
            font-weight: 600;
            color: var(--fak-primary-dark);
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .status-badge {
            display: inline-block;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            padding: 3px 14px;
            margin-left: 10px;
        }

        .status-valid {
            background: #fef08a;
            color: #854d0e;
        }

        .status-approved {
            background: #bbf7d0;
            color: #15803d;
        }

        .status-revisi {
            background: #fecaca;
            color: #b91c1c;
        }

        .status-other {
            background: #e5e7eb;
            color: #222e3a;
        }

        .desc-table {
            width: 100%;
            max-width: 600px;
            font-size: 14.5px;
            margin-bottom: 1rem;
        }

        .desc-table th,
        .desc-table td {
            text-align: left;
            padding: 6px 4px;
        }

        .achievement-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.4rem;
        }

        .achievement-table th,
        .achievement-table td {
            border-bottom: 1px solid var(--fak-border);
            padding: 8px 10px;
            font-size: 13.5px;
        }

        .achievement-table th {
            background: #f1f5f9;
            color: #223;
            font-weight: 700;
        }

        .achievement-table tbody tr:hover {
            background: #f8fafc;
        }

        @media (max-width:800px) {
            .preview-container {
                padding: 1.3rem 0.7rem;
            }
        }
    </style>

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('fakultas.dashboard') }}">Dashboard</a>
        <span class="divider">›</span>
        <a href="{{ route('fakultas.draft-skpi.index') }}">Draft SKPI</a>
        <span class="divider">›</span>
        <span>Preview</span>
    </nav>

    <div class="preview-container">
        <div class="preview-header">
            <div class="preview-title">
                Preview Draft SKPI Fakultas
                @if ($draft->status === 'valid_fakultas')
                    <span class="status-badge status-valid">Pending</span>
                @elseif ($draft->status === 'approved_fakultas')
                    <span class="status-badge status-approved">Disetujui</span>
                @elseif ($draft->status === 'revisi_prodi')
                    <span class="status-badge status-revisi">Revisi Prodi</span>
                @else
                    <span class="status-badge status-other">{{ Str::title(str_replace('_', ' ', $draft->status)) }}</span>
                @endif
            </div>
            <a class="btn-back" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <!-- Identitas Mahasiswa -->
        <div class="detail-block">
            <div class="section-title">A. Identitas Mahasiswa</div>
            <table class="desc-table">
                <tr>
                    <th>Nama</th>
                    <td>{{ $draft->mahasiswa->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $draft->mahasiswa->nim ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lulus</th>
                    <td>{{ optional($draft->mahasiswa->tanggal_lulus)->format('d-m-Y') ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nomor SKPI</th>
                    <td>{{ $draft->nomor_skpi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Draft</th>
                    <td>
                        @if ($draft->status === 'valid_fakultas')
                            Pending Fakultas
                        @elseif ($draft->status === 'approved_fakultas')
                            Disetujui Fakultas
                        @elseif ($draft->status === 'revisi_prodi')
                            Revisi Prodi
                        @else
                            {{ $draft->status }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Achievement -->
        <div class="detail-block">
            <div class="section-title">B. Aktivitas, Prestasi, & Penghargaan</div>
            <table class="achievement-table">
                <thead>
                    <tr>
                        <th style="width:35px;">No</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th style="width:60px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($draft->verifikasiSkpi as $idx => $v)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ class_basename($v->verifiable_type) }}</td>
                            <td>{{ $v->verifiable->nama ?? ($v->verifiable->judul ?? '-') }}</td>
                            <td>
                                @if ($v->status == 'pending')
                                    <span class="status-badge status-valid">Pending</span>
                                @elseif($v->status == 'approved')
                                    <span class="status-badge status-approved">Valid</span>
                                @elseif($v->status == 'rejected')
                                    <span class="status-badge status-revisi">Ditolak</span>
                                @else
                                    <span class="status-badge status-other">{{ $v->status }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Link ke halaman detail SKPI kategori, sesuaikan ke route yang benar -->
                                <a href="{{ route('fakultas.verifikasi.show', $v->id) }}" class="btn-back"
                                    style="padding:4px 14px;font-size:12px;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center">Tidak ada aktivitas/achievement terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($draft->status === 'valid_fakultas')
            <form method="POST" action="{{ route('fakultas.approval.update', $draft->id) }}"
                style="display: flex; gap: 14px; margin-top: 30px; align-items:center;">
                @csrf
                @method('PUT')
                <input type="hidden" name="aksi" value="approve">
                <button type="submit" class="btn-back"
                    style="background: var(--fak-success); color: #fff; border: none; min-width:120px;">
                    <i class="fas fa-check"></i> Setujui Draft
                </button>
            </form>
            <form method="POST" action="{{ route('fakultas.approval.update', $draft->id) }}"
                style="display: flex; gap: 9px; margin-top: 10px;">
                @csrf
                @method('PUT')
                <input type="hidden" name="aksi" value="revisi">
                <input name="catatan" placeholder="Catatan revisi ke prodi (jika perlu)"
                    style="padding:7px;border-radius:4px;border:1px solid #e5e7eb;min-width:180px;">
                <button type="submit" class="btn-back" style="background: var(--fak-danger); color: #fff; border: none;">
                    <i class="fas fa-undo"></i> Kembalikan ke Prodi
                </button>
            </form>
        @endif


    </div>
@endsection
