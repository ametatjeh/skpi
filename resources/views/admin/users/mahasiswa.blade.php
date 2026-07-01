@extends('admin.layouts.app')

@section('title', 'Manajemen Mahasiswa')
@section('page_title', 'Manajemen Mahasiswa')
@section('page_icon', 'user-graduate')

@section('content')

    <style>
        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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

        .btn-sm {
            padding: 5px 10px;
            font-size: 11px;
        }

        /* ✅ TABLE STYLING - COMPACT & FIT */
        .table-container {
            overflow-x: auto;

            overflow-y: auto;
            max-height: 450px;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;

        }

        thead {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 10px 8px;
            text-align: left;
            font-weight: 700;
            font-size: 10px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            white-space: nowrap;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        /* ✅ Column Width Optimization */
        th:nth-child(1),
        td:nth-child(1) {
            width: 40px;
            text-align: center;
        }

        th:nth-child(2),
        td:nth-child(2) {
            min-width: 100px;
        }

        th:nth-child(3),
        td:nth-child(3) {
            min-width: 150px;
            max-width: 200px;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 40px;
            text-align: center;
        }

        th:nth-child(5),
        td:nth-child(5) {
            min-width: 80px;
        }

        th:nth-child(6),
        td:nth-child(6) {
            min-width: 180px;
            max-width: 220px;
        }

        th:nth-child(7),
        td:nth-child(7) {
            min-width: 120px;
            max-width: 150px;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 70px;
            text-align: center;
        }

        th:nth-child(9),
        td:nth-child(9) {
            min-width: 100px;
        }

        th:nth-child(10),
        td:nth-child(10) {
            width: 100px;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
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
            overflow-y: auto;
        }

        .modal:target {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 90%;
            max-width: 800px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
            margin: 20px 0;
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-group label .required {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10px;
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

        .info-count {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-top: 15px;
            font-weight: 600;
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

        /* ✅ Responsive */
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }

            table {
                font-size: 11px;
            }

            th,
            td {
                padding: 8px 6px;
                font-size: 10px;
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

        {{-- ✅ HEADER DENGAN TOMBOL KEMBALI --}}
        <div class="header-actions">
            <div class="page-header">
                <h2><i class="fas fa-user-graduate"></i> Daftar Mahasiswa</h2>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                    Kelola data mahasiswa sistem SKPI
                </p>
            </div>

            <div class="action-group">
                {{-- TOMBOL KEMBALI --}}
                <a href="{{ route('admin.users.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                {{-- SEARCH --}}
                <form action="{{ route('admin.users.mahasiswa') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama, NIM, atau email..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>

                {{-- TAMBAH --}}
                <a href="#addModal" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>
            </div>
        </div>

        {{-- ✅ TABEL COMPACT & FIT --}}
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Agama</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $user)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><span class="badge badge-info">{{ $user->nim }}</span></td>
                            <td><strong>{{ $user->nama }}</strong></td>
                            <td style="text-align: center;">{{ $user->jenis_kelamin }}</td>
                            <td>{{ $user->agama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->prodi->nama_prodi ?? '-' }}</td>
                            <td style="text-align: center;">{{ $user->angkatan }}</td>
                            <td><span class="badge badge-success">{{ $user->status_mahasiswa }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#editModal{{ $user->id }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit">Edit</i>
                                    </a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $user->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Yakin hapus {{ $user->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash">Hapus</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        @include('admin.users.partials.edit-modal', ['user' => $user])

                    @empty
                        <tr>
                            <td colspan="10" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p style="margin: 10px 0 0 0;">Tidak ada data mahasiswa</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="info-count">
            Total: <strong>{{ $users->count() }}</strong> mahasiswa
        </div>
    </div>

    {{-- Modal Add --}}



    {{-- resources/views/admin/users/partials/add-modal.blade.php --}}
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-plus"></i> Tambah Mahasiswa Baru</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                @csrf

                {{-- SECTION: Data Login --}}
                <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                        <i class="fas fa-lock"></i> Data Login
                    </h4>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@email.com"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password" required>
                    </div>
                </div>

                {{-- SECTION: Data Pribadi --}}
                <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                        <i class="fas fa-user"></i> Data Pribadi
                    </h4>

                    <div class="form-row">
                        <div class="form-group">
                            <label>NIM <span class="required">*</span></label>
                            <input type="text" name="nim" class="form-control" placeholder="123456789" required>
                        </div>

                        <div class="form-group">
                            <label>NIK (KTP)</label>
                            <input type="text" name="nik" class="form-control" placeholder="16 digit NIK"
                                maxlength="16">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap mahasiswa"
                            required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Kelamin <span class="required">*</span></label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Agama <span class="required">*</span></label>
                            <select name="agama" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Tempat, Tanggal Lahir <span class="required">*</span></label>
                        <input type="text" name="tempat_tanggal_lahir" class="form-control"
                            placeholder="Contoh: BANDA ACEH, 31 Desember 1987" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
                    </div>
                </div>

                {{-- SECTION: Data Akademik --}}
                <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                        <i class="fas fa-graduation-cap"></i> Data Akademik
                    </h4>

                    <div class="form-group full-width">
                        <label>Program Studi <span class="required">*</span></label>
                        <select name="prodi_id" class="form-control" required>
                            <option value="">Pilih Program Studi</option>
                            @php
                                $prodis = \App\Models\Prodi::orderBy('nama_prodi')->get();
                            @endphp
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}">
                                    {{ $prodi->nama_prodi }} (Fakultas ID: {{ $prodi->fakultas_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tahun Masuk <span class="required">*</span></label>
                            <input type="number" name="tahun_masuk" class="form-control" placeholder="2023"
                                min="1900" max="{{ date('Y') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Angkatan <span class="required">*</span></label>
                            <input type="number" name="angkatan" class="form-control" placeholder="2023"
                                min="1900" max="{{ date('Y') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tanggal Masuk <span class="required">*</span></label>
                            <input type="date" name="tanggal_masuk" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Status Mahasiswa <span class="required">*</span></label>
                            <select name="status_mahasiswa" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Lulus">Lulus</option>
                                <option value="DO">DO (Drop Out)</option>
                                <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECTION: Data Kelulusan (Optional) --}}
                <div style="background: #fef3c7; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h4 style="font-size: 15px; font-weight: 700; color: #92400e; margin-bottom: 15px;">
                        <i class="fas fa-award"></i> Data Kelulusan (Opsional)
                    </h4>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tanggal Lulus</label>
                            <input type="date" name="tanggal_lulus" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Gelar</label>
                            <input type="text" name="gelar" class="form-control" placeholder="Contoh: S.Kom"
                                maxlength="20">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Nomor Ijazah</label>
                        <input type="text" name="no_ijazah" class="form-control" placeholder="Nomor ijazah"
                            maxlength="100">
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                    <i class="fas fa-save"></i> Simpan Data Mahasiswa
                </button>
            </form>
        </div>
    </div>


@endsection
