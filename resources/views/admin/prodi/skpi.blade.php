@extends('admin.layouts.app')

@section('title', 'Pengaturan SKPI Prodi')
@section('page_title', 'Pengaturan SKPI Prodi')
@section('page_icon', 'graduation-cap')

@section('content')

    <style>
        .content-wrapper {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
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
            font-weight: 600;
            text-decoration: none
        }

        .breadcrumb-nav a:hover {
            color: #059669;
            text-decoration: underline
        }

        .breadcrumb-nav .separator {
            color: #cbd5e1
        }

        .breadcrumb-nav .current {
            color: #1e293b;
            font-weight: 600
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .page-header h2 i {
            color: #10b981
        }

        .page-header p {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px
        }

        .form-select-prodi {
            padding: 9px 12px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            min-width: 260px;
            font-size: 13px;
        }

        .form-select-prodi:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15)
        }

        .form-section {
            margin-top: 10px;
            padding: 18px 18px 8px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background: #f8fafc
        }

        .form-section-title {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: .04em
        }

        .form-section-title i {
            color: #10b981
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 22px
        }

        .form-group {
            margin-bottom: 8px
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 4px
        }

        .form-group small {
            display: block;
            font-size: 11px;
            color: #94a3b8
        }

        .form-control {
            width: 100%;
            padding: 9px 11px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 13px;
            transition: all .2s;
            background: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12)
        }

        textarea.form-control {
            min-height: 70px;
            resize: vertical
        }

        .btn-save {
            margin-top: 16px;
            padding: 10px 22px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.35);
            transition: all .2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, #059669, #047857);
        }

        .empty-note {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 10px
        }

        @media(max-width:900px) {
            /* Fix box sizing for all elements */
            * {
                box-sizing: border-box;
            }

            .content-wrapper {
                padding: 20px 15px
            }

            .form-grid {
                grid-template-columns: minmax(0, 1fr)
            }

            /* Ensure inputs don't overflow */
            .form-control,
            .form-select-prodi {
                max-width: 100%;
                width: 100%;
            }

            .form-section {
                padding: 15px;
            }

            /* Refine Header & Breadcrumb for mobile */
            .breadcrumb-nav {
                flex-wrap: wrap;
                font-size: 12px;
                gap: 6px;
                line-height: 1.4;
            }

            .page-header h2 {
                font-size: 20px;
                align-items: flex-start;
            }

            .page-header h2 i {
                margin-top: 3px;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- ALERTS --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p style="margin:0">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span>Pengaturan</span>
            <span class="separator">›</span>
            <span class="current">SKPI per Prodi</span>
        </div>

        {{-- HEADER --}}
        <div class="page-header">
            <h2><i class="fas fa-graduation-cap"></i> Pengaturan SKPI per Prodi</h2>
            <p>Pilih program studi lalu atur data akreditasi dan informasi SKPI yang akan tampil di dokumen.</p>
        </div>

        {{-- FILTER BAR: PILIH PRODI --}}
        <form method="GET" action="{{ route('admin.prodi.skpi.index') }}" class="filter-bar">
            <select name="prodi_id" class="form-select-prodi" onchange="this.form.submit()">
                @foreach ($prodiList as $prodi)
                    <option value="{{ $prodi->id }}" {{ $selectedProdiId == $prodi->id ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>

        @if (!$selectedProdi)
            <p class="empty-note">Belum ada data prodi.</p>
        @else
            {{-- FORM DETAIL PRODI --}}
            <form method="POST" action="{{ route('admin.prodi.skpi.update', $selectedProdi->id) }}">
                @csrf

                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-file-signature"></i>
                        Akreditasi & Identitas Program Studi
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Program Studi (ID)</label>
                            <input type="text" class="form-control" value="{{ $selectedProdi->nama_prodi }}" disabled>
                            <small>Nama prodi versi Bahasa Indonesia.</small>
                        </div>

                        <div class="form-group">
                            <label>Nama Program Studi (EN)</label>
                            <input type="text" name="nama_prodi_en" class="form-control"
                                value="{{ old('nama_prodi_en', $selectedProdi->nama_prodi_en) }}">
                            <small>Name of Study Program in English (opsional).</small>
                        </div>

                        <div class="form-group">
                            <label>Status Akreditasi Program Studi</label>
                            <input type="text" name="status_akreditasi" class="form-control"
                                value="{{ old('status_akreditasi', $selectedProdi->status_akreditasi) }}"
                                placeholder="Contoh: Terakreditasi Unggul / Baik Sekali">
                        </div>

                        <div class="form-group">
                            <label>Nomor SK Akreditasi Program Studi</label>
                            <input type="text" name="nomor_sk_akreditasi" class="form-control"
                                value="{{ old('nomor_sk_akreditasi', $selectedProdi->nomor_sk_akreditasi) }}"
                                placeholder="Contoh: SK BAN-PT No. xxx/yyy/2024">
                        </div>

                        <div class="form-group">
                            <label>Level KKNI</label>
                            <input type="text" name="kkni_level" class="form-control"
                                value="{{ old('kkni_level', $selectedProdi->kkni_level) }}" placeholder="Contoh: Level 6">
                        </div>

                        <div class="form-group">
                            <label>Jenis dan Jenjang Pendidikan</label>
                            <input type="text" name="jenis_jenjang" class="form-control"
                                value="{{ old('jenis_jenjang', $selectedProdi->jenis_jenjang) }}"
                                placeholder="Contoh: Akademik dan Sarjana (S1) / Academic and Bachelor Degree">
                        </div>

                        <div class="form-group">
                            <label>Jenis dan Jenjang Pendidikan Lanjutan (bila ada)</label>
                            <input type="text" name="akses_lanjut" class="form-control"
                                value="{{ old('akses_lanjut', $selectedProdi->akses_lanjut) }}"
                                placeholder="Contoh: Dapat melanjutkan ke Program Magister (S2)">
                        </div>

                        <div class="form-group">
                            <label>Status Profesi (bila ada)</label>
                            <input type="text" name="status_profesi" class="form-control"
                                value="{{ old('status_profesi', $selectedProdi->status_profesi) }}"
                                placeholder="Contoh: Insinyur / Engineer">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Pengaturan Prodi
                </button>
            </form>
        @endif

    </div>

@endsection
