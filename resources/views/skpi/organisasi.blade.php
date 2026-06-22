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

        .organisasi-container {
            min-height: 100vh;
            position: relative;
            padding: 40px 20px;
        }

        .organisasi-container::before {
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

        .organisasi-container>* {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .organisasi-header {
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

        .organisasi-main-title {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px;
        }

        .organisasi-subtitle {
            color: var(--muted);
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        /* Alert */
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

        /* Form Card */
        .organisasi-form-card,
        .organisasi-table-card {
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

        .organisasi-form-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--ink);
            margin: 0 0 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .organisasi-form-title i {
            color: var(--brand);
        }

        /* Form */
        .organisasi-data-form {
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
            .organisasi-container {
                padding: 20px 16px;
            }

            .organisasi-header,
            .organisasi-form-card,
            .organisasi-table-card {
                padding: 24px 20px;
            }

            .organisasi-data-form {
                grid-template-columns: 1fr;
            }

            .data-table {
                font-size: 0.9rem;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
            }

            .organisasi-container::before {
                padding: 80px;
                background-size: 150px auto;
            }
        }
    </style>

    <div class="organisasi-container">
        <div class="organisasi-header">
            <a href="{{ route('mahasiswa.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="organisasi-main-title">Kelola Data SKPI</h1>
            <p class="organisasi-subtitle">Organisasi & Kepanitiaan</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- FORM INPUT -->
        <div class="organisasi-form-card">
            <h2 class="organisasi-form-title">
                <i class="fas fa-plus-circle"></i> Tambah Pengalaman Organisasi
            </h2>

            <form action="{{ route('skpi.organisasi.store') }}" method="POST">
                @csrf
                <div class="organisasi-data-form">
                    <!-- Nama Organisasi -->
                    <div class="form-group">
                        <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                        <input type="text" id="nama_organisasi" name="nama_organisasi" class="form-input"
                            placeholder="Contoh: Himpunan Mahasiswa Informatika" value="{{ old('nama_organisasi') }}"
                            required>
                        @error('nama_organisasi')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="form-group">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-input"
                            placeholder="Contoh: Ketua Umum, Bendahara, Anggota" value="{{ old('jabatan') }}" required>
                        @error('jabatan')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Periode -->
                    <div class="form-group">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="text" id="periode" name="periode" class="form-input"
                            placeholder="Contoh: 2022-2023, 2023-Sekarang" value="{{ old('periode') }}" required>
                        @error('periode')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data Organisasi
                    </button>
                </div>
            </form>
        </div>

        <!-- DATA TABLE -->
        <div class="organisasi-table-card">
            <h2 class="organisasi-form-title">
                <i class="fas fa-list-alt"></i> Data Organisasi yang Sudah Diinput
                <span style="color: var(--brand); font-size: 1.25rem;">({{ $organisasis->count() }})</span>
            </h2>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Organisasi</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($organisasis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $item->nama_organisasi }}</strong></td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->periode }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="action-buttons">
                                    <form action="{{ route('skpi.organisasi.destroy', $item->id) }}" method="POST"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data organisasi ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fas fa-users fa-3x"></i><br><br>
                                    <strong>Belum ada data organisasi yang diinput</strong><br>
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
