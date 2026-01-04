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

        .prestasi-container {
            min-height: 100vh;
            position: relative;
            padding: 40px 20px;
        }

        .prestasi-container::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('{{ asset('images/logo_umpar.jpg') }}');
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

        .prestasi-container>* {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .prestasi-header {
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

        .prestasi-main-title {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px;
        }

        .prestasi-subtitle {
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
        .prestasi-form-card,
        .prestasi-table-card {
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

        .prestasi-form-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--ink);
            margin: 0 0 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .prestasi-form-title i {
            color: var(--brand);
        }

        /* Form */
        .prestasi-data-form {
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

        .form-input,
        select.form-input {
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

        /* Tingkat Badges */
        .tingkat-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .tingkat-lokal {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .tingkat-nasional {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde047;
        }

        .tingkat-internasional {
            background: #fce7f3;
            color: #9f1239;
            border: 1px solid #fbcfe8;
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
            .prestasi-container {
                padding: 20px 16px;
            }

            .prestasi-header,
            .prestasi-form-card,
            .prestasi-table-card {
                padding: 24px 20px;
            }

            .prestasi-data-form {
                grid-template-columns: 1fr;
            }

            .data-table {
                font-size: 0.9rem;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
            }

            .prestasi-container::before {
                padding: 80px;
                background-size: 150px auto;
            }
        }
    </style>

    <div class="prestasi-container">
        <div class="prestasi-header">
            <a href="{{ route('mahasiswa.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="prestasi-main-title">Kelola Data SKPI</h1>
            <p class="prestasi-subtitle">Prestasi Akademik & Non-Akademik</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- FORM INPUT -->
        <div class="prestasi-form-card">
            <h2 class="prestasi-form-title">
                <i class="fas fa-plus-circle"></i> Tambah Prestasi Baru
            </h2>

            <form action="{{ route('skpi.prestasi.store') }}" method="POST">
                @csrf
                <div class="prestasi-data-form">
                    <!-- Nama Kegiatan -->
                    <div class="form-group">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan / Lomba</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-input"
                            placeholder="Contoh: Lomba Coding Nasional" value="{{ old('nama_kegiatan') }}" required>
                        @error('nama_kegiatan')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tingkat -->
                    <div class="form-group">
                        <label for="tingkat" class="form-label">Tingkat Prestasi</label>
                        <select id="tingkat" name="tingkat" class="form-input" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="lokal" {{ old('tingkat') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                            <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>
                                Internasional</option>
                        </select>
                        @error('tingkat')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div class="form-group">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" id="tahun" name="tahun" class="form-input" placeholder="Contoh: 2024"
                            min="2000" max="{{ date('Y') }}" value="{{ old('tahun') }}" required>
                        @error('tahun')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Prestasi
                    </button>
                </div>
            </form>
        </div>

        <!-- DATA TABLE -->
        <div class="prestasi-table-card">
            <h2 class="prestasi-form-title">
                <i class="fas fa-list-alt"></i> Data Prestasi yang Sudah Diinput
                <span style="color: var(--brand); font-size: 1.25rem;">({{ $prestasis->count() }})</span>
            </h2>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tingkat</th>
                            <th>Tahun</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $item->nama_kegiatan }}</strong></td>
                                <td>
                                    <span class="tingkat-badge tingkat-{{ $item->tingkat }}">
                                        {{ ucfirst($item->tingkat) }}
                                    </span>
                                </td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="action-buttons">
                                    <form action="{{ route('skpi.prestasi.destroy', $item->id) }}" method="POST"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fas fa-trophy fa-3x"></i><br><br>
                                    <strong>Belum ada data prestasi yang diinput</strong><br>
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
