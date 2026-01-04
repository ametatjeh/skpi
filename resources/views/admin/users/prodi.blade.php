@extends('admin.layouts.app')

@section('title', 'Manajemen Prodi')
@section('page_title', 'Manajemen Prodi')
@section('page_icon', 'layer-group')

@section('content')

    <style>
        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* ✅ Breadcrumb Navigation */
        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .breadcrumb-nav a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .breadcrumb-nav a:hover {
            color: #1e40af;
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

        /* ✅ Tombol Kembali */
        .btn-back {
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
            width: 280px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
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
            background: #64748b;
            color: white;
        }

        .btn-search:hover {
            background: #475569;
        }

        .table-container {
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
            background: linear-gradient(135deg, #1e40af, #3b82f6);
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
            background: #f8fafc;
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

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .modal:target {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .close-modal {
            text-decoration: none;
            font-size: 28px;
            color: #94a3b8;
            transition: color 0.2s ease;
            line-height: 1;
        }

        .close-modal:hover {
            color: #475569;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .info-count {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-top: 15px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box,
            .action-group {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .table-container {
                overflow-x: scroll;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- ✅ BREADCRUMB NAVIGATION --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i> Manajemen User
            </a>
            <span class="separator">›</span>
            <span class="current">
                <i class="fas fa-layer-group"></i> User Prodi
            </span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ HEADER DENGAN TOMBOL KEMBALI --}}
        <div class="header-actions">
            <div class="page-header">
                <h2><i class="fas fa-layer-group"></i> Daftar Operator Prodi</h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Kelola akun operator program studi
                </p>
            </div>

            <div class="action-group">
                {{-- TOMBOL KEMBALI --}}
                <a href="{{ route('admin.users.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                {{-- SEARCH --}}
                <form action="{{ route('admin.users.prodi') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama atau email..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>

                {{-- TAMBAH --}}
                <a href="#addModal" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Prodi
                </a>
            </div>
        </div>

        <div class="table-container">
            @if ($users->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th style="width: 200px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $i }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $prodi = DB::table('prodi')->where('id', $user->prodi_id)->first();
                                    @endphp
                                    @if ($prodi)
                                        <span class="badge badge-primary">{{ $prodi->nama_prodi }}</span>
                                    @else
                                        <span class="badge badge-primary">ID: {{ $user->prodi_id ?? '-' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="#editModal{{ $user->id }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        {{-- ✅ FIX: Ganti route destroy --}}
                                        <form action="{{ route('admin.users.prodi.destroy', $user->id) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                            {{-- Modal Edit --}}
                            <div id="editModal{{ $user->id }}" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3><i class="fas fa-edit"></i> Edit Operator Prodi</h3>
                                        <a href="#" class="close-modal">&times;</a>
                                    </div>

                                    <form action="{{ route('admin.users.prodi.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Nama <span style="color: #ef4444;">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Email <span style="color: #ef4444;">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Program Studi <span style="color: #ef4444;">*</span></label>
                                            <select name="prodi_id" class="form-control" required>
                                                <option value="">Pilih Program Studi</option>
                                                @php
                                                    $prodis = DB::table('prodi')
                                                        ->select('id', 'fakultas_id', 'nama_prodi')
                                                        ->orderBy('nama_prodi')
                                                        ->get();
                                                @endphp
                                                @foreach ($prodis as $prodi)
                                                    <option value="{{ $prodi->id }}"
                                                        {{ $user->prodi_id == $prodi->id ? 'selected' : '' }}>
                                                        {{ $prodi->nama_prodi }} (Fakultas ID: {{ $prodi->fakultas_id }})
                                                    </option>
                                                @endforeach

                                                @if ($user->prodi_id && !$prodis->pluck('id')->contains($user->prodi_id))
                                                    <option value="{{ $user->prodi_id }}" selected>
                                                        Prodi ID: {{ $user->prodi_id }} (Data lama)
                                                    </option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Password Baru (Kosongkan jika tidak diubah)</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Minimal 8 karakter">
                                        </div>

                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Ulangi password baru">
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <div class="info-count">
                    Total: <strong>{{ $users->total() }}</strong> operator prodi
                </div>

                <div class="pagination-wrapper">
                    {{ $users->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Tidak ada data prodi</h3>
                    <p>Belum ada operator prodi terdaftar</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Add --}}
    {{-- Modal Add --}}
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-plus"></i> Tambah Operator Prodi</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>

            <form action="{{ route('admin.users.prodi.store') }}" method="POST">
                @csrf

                {{-- ============================================
                 DATA USER LOGIN (prodi_users table)
                 ============================================ --}}
                <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #1e40af; margin: 0 0 15px 0;">
                        <i class="fas fa-user"></i> Data User Login
                    </h4>

                    <div class="form-group">
                        <label>Nama <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="name" class="form-control"
                            placeholder="Masukkan nama lengkap operator" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email <span style="color: #ef4444;">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@umpar.ac.id"
                            value="{{ old('email') }}" required>
                        <small style="color: #64748b; font-size: 12px; display: block; margin-top: 5px;">
                            Email ini digunakan untuk login ke sistem
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Password <span style="color: #ef4444;">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter"
                            required>
                    </div>
                </div>

                {{-- ============================================
                 PILIH PRODI YANG SUDAH ADA
                 ============================================ --}}
                <div style="background: #ecfdf5; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #059669; margin: 0 0 15px 0;">
                        <i class="fas fa-building-columns"></i> Pilih Program Studi
                    </h4>

                    <div class="form-group">
                        <label>Program Studi <span style="color: #ef4444;">*</span></label>
                        <select name="prodi_id" class="form-control" required style="padding: 12px;">
                            <option value="">-- Pilih Program Studi --</option>
                            @php
                                $prodisGrouped = DB::table('prodi')
                                    ->join('fakultas', 'fakultas.id', '=', 'prodi.fakultas_id')
                                    ->select(
                                        'prodi.id',
                                        'prodi.nama_prodi',
                                        'prodi.fakultas_id',
                                        'fakultas.nama_fakultas',
                                        'fakultas.id as fakultas_id',
                                    )
                                    ->orderBy('fakultas.nama_fakultas')
                                    ->orderBy('prodi.nama_prodi')
                                    ->get()
                                    ->groupBy('nama_fakultas');
                            @endphp

                            @foreach ($prodisGrouped as $fakultasNama => $prodiList)
                                <optgroup label="📚 {{ $fakultasNama }}">
                                    @foreach ($prodiList as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->fakultas_id }} {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <small style="color: #64748b; font-size: 12px; display: block; margin-top: 5px;">
                            Pilih prodi yang sudah ada di database
                        </small>
                    </div>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert"
                        style="background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626; margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi Kesalahan:</strong>
                            <ul style="margin: 5px 0 0 20px; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Simpan Operator Prodi
                </button>
            </form>
        </div>
    </div>

@endsection
