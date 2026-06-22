@extends('layouts.app')

@section('content')
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --brand: #16a34a;
            --brand-dark: #15803d;
            --brand-light: #22c55e;
            --card: #ffffff;
            --border: #e2e8f0;
            --ring: rgba(34, 197, 94, .35);
            --bg: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.6;
        }

        .sertifikasi-container {
            min-height: 100vh;
            position: relative;
            padding: 40px 20px;
        }

        .sertifikasi-container::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('{{ asset('images/logo_unida.jpg') }}');
            background-size: 200px auto;
            background-repeat: space;
            background-position: center;
            /* padding: 120px; */
            background-origin: content-box;
            /* filter: blur(4px) grayscale(60%); */
            opacity: 0.08;
            z-index: 0;
            pointer-events: none;
        }

        .sertifikasi-container>* {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .sertifikasi-header {
            max-width: 1200px;
            margin: 0 auto 32px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px 32px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            backdrop-filter: blur(12px);
            animation: fadeInDown .6s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--brand);
            text-decoration: none;
            font-weight: 700;
            margin-bottom: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all .2s ease;
        }

        .back-link:hover {
            background: #f0fdf4;
            transform: translateX(-4px);
        }

        .sertifikasi-main-title {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px;
        }

        .sertifikasi-subtitle {
            color: var(--muted);
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        /* Alerts */
        .alert {
            max-width: 1200px;
            margin: 0 auto 24px;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            animation: slideInRight .5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        /* Form Card */
        .sertifikasi-form-card,
        .sertifikasi-table-card {
            max-width: 1200px;
            margin: 0 auto 32px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            backdrop-filter: blur(12px);
            animation: fadeInUp .6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sertifikasi-form-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--ink);
            margin: 0 0 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sertifikasi-form-title i {
            color: var(--brand);
        }

        /* Form */
        .sertifikasi-data-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--ink);
            font-size: 0.95rem;
        }

        .form-input {
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            outline: none;
            transition: all .3s ease;
            background: #fff;
            color: var(--ink);
            font-size: 0.95rem;
            font-family: inherit;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .form-input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 4px var(--ring);
            transform: translateY(-1px);
        }

        .form-error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 6px;
            font-weight: 600;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .3s ease;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(22, 163, 74, .25);
            grid-column: 1 / -1;
            justify-content: center;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(22, 163, 74, .35);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, .25);
            font-size: 0.85rem;
            padding: 8px 16px;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, .35);
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .data-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .data-table th {
            padding: 16px;
            text-align: left;
            font-weight: 800;
            color: var(--ink);
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-table tbody tr {
            transition: all .2s ease;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            color: var(--muted);
            padding: 48px 16px !important;
        }

        .empty-state i {
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .inline-form {
            display: inline-block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sertifikasi-container {
                padding: 20px 16px;
            }

            .sertifikasi-header,
            .sertifikasi-form-card,
            .sertifikasi-table-card {
                padding: 24px 20px;
            }

            .sertifikasi-data-form {
                grid-template-columns: 1fr;
            }

            .data-table {
                font-size: 0.9rem;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
            }

            .sertifikasi-container::before {
                padding: 80px;
                background-size: 150px auto;
            }
        }
    </style>

    <div class="sertifikasi-container">
        <div class="sertifikasi-header">
            <a href="{{ route('mahasiswa.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="sertifikasi-main-title">Kelola Data SKPI</h1>
            <p class="sertifikasi-subtitle">Sertifikasi Kompetensi</p>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- CARD FORMULIR INPUT -->
        <div class="sertifikasi-form-card">
            <h2 class="sertifikasi-form-title">
                <i class="fas fa-plus-circle"></i> Tambah Sertifikasi Baru
            </h2>

            <form action="{{ route('skpi.sertifikasi.store') }}" method="POST">
                @csrf

                <div class="sertifikasi-data-form">
                    <!-- 1. Nama Sertifikasi -->
                    <div class="form-group">
                        <label for="nama_sertifikasi" class="form-label">Nama Sertifikasi / Pelatihan</label>
                        <input type="text" id="nama_sertifikasi" name="nama_sertifikasi" class="form-input"
                            placeholder="Contoh: Cisco Certified Network Associate" value="{{ old('nama_sertifikasi') }}"
                            required>
                        @error('nama_sertifikasi')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 2. Lembaga Penerbit -->
                    <div class="form-group">
                        <label for="lembaga_penerbit" class="form-label">Lembaga Penerbit / Penyelenggara</label>
                        <input type="text" id="lembaga_penerbit" name="lembaga_penerbit" class="form-input"
                            placeholder="Contoh: BNSP, Microsoft, Lembaga Pelatihan X" value="{{ old('lembaga_penerbit') }}"
                            required>
                        @error('lembaga_penerbit')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 3. Tahun -->
                    <div class="form-group">
                        <label for="tahun" class="form-label">Tahun Pelaksanaan/Perolehan</label>
                        <input type="number" id="tahun" name="tahun" class="form-input" placeholder="Contoh: 2024"
                            min="2000" max="{{ date('Y') }}" value="{{ old('tahun') }}" required>
                        @error('tahun')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Sertifikasi
                    </button>
                </div>
            </form>
        </div>

        <!-- CARD DATA YANG SUDAH DIINPUT -->
        <div class="sertifikasi-table-card">
            <h2 class="sertifikasi-form-title">
                <i class="fas fa-list-alt"></i> Data Sertifikasi yang Sudah Diinput
                <span style="color: var(--brand); font-size: 1.25rem;">({{ $sertifikasis->count() }})</span>
            </h2>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sertifikasi</th>
                            <th>Lembaga</th>
                            <th>Tahun</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sertifikasis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $item->nama_sertifikasi }}</strong></td>
                                <td>{{ $item->lembaga_penerbit }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="action-buttons">
                                    <!-- Form Delete -->
                                    <form action="{{ route('skpi.sertifikasi.destroy', $item->id) }}" method="POST"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus sertifikasi ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fas fa-certificate fa-3x"></i><br><br>
                                    <strong>Belum ada data sertifikasi yang diinput</strong><br>
                                    Silakan tambah data menggunakan form di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
