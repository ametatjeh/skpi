@extends('admin.layouts.app')

@section('title', 'Template SKPI')
@section('page_title', 'Template SKPI')
@section('page_icon', 'file-code')

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
            transition: color 0.2s ease;
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

        .page-header p {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 0;
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

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .form-section {
            margin-top: 25px;
            padding: 20px 20px 10px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .form-section-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .form-section-title i {
            color: #10b981;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px 24px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-group small {
            display: block;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 13px;
            transition: all 0.2s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }

        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }

        .btn-save {
            margin-top: 20px;
            padding: 11px 24px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.35);
        }

        .btn-save:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, #059669, #047857);
            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.45);
        }

        .btn-save:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(16, 185, 129, 0.35);
        }

        @media (max-width: 900px) {
            /* Fix box sizing for all elements */
            * {
                box-sizing: border-box;
            }

            .content-wrapper {
                padding: 20px 15px;
            }

            .form-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            /* Ensure inputs don't overflow */
            .form-control {
                max-width: 100%;
                width: 100%;
            }

            .form-section {
                padding: 15px;
            }
        }
    </style>

    <div class="content-wrapper">

        {{-- ALERTS --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p style="margin:0;">{{ $error }}</p>
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
            <span>
                <i class="fas fa-cog"></i> Pengaturan
            </span>
            <span class="separator">›</span>
            <span class="current">Template SKPI</span>
        </div>

        {{-- HEADER --}}
        <div class="page-header">
            <h2>
                <i class="fas fa-file-code"></i>
                Template SKPI
            </h2>
            <p>
                Atur informasi identitas perguruan tinggi dan pengaturan standar yang akan muncul di setiap dokumen SKPI.
            </p>
        </div>

        <form action="{{ route('admin.template-skpi.update') }}" method="POST">
            @csrf

            {{-- SECTION 1: Identitas Perguruan Tinggi --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-university"></i>
                    Identitas Perguruan Tinggi
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Perguruan Tinggi</label>
                        <input type="text" name="nama_pt" class="form-control"
                            value="{{ old('nama_pt', $template->nama_pt) }}"
                            placeholder="Contoh: Universitas Muhammadiyah Parepare">
                    </div>

                    <div class="form-group">
                        <label>Bahasa Pengantar Kuliah</label>
                        <input type="text" name="bahasa_pengantar" class="form-control"
                            value="{{ old('bahasa_pengantar', $template->bahasa_pengantar) }}"
                            placeholder="Contoh: Indonesia / Indonesia & English">
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Alamat Perguruan Tinggi</label>
                        <textarea name="alamat_pt" class="form-control" placeholder="Alamat lengkap kampus utama">{{ old('alamat_pt', $template->alamat_pt) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: Legalitas & Akreditasi --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-file-signature"></i>
                    Legalitas & Akreditasi
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>SK Pendirian Perguruan Tinggi</label>
                        <input type="text" name="sk_pendirian" class="form-control"
                            value="{{ old('sk_pendirian', $template->sk_pendirian) }}"
                            placeholder="Contoh: SK Mendikbud No. xxx/yyy/tahun">
                        <small>Ditampilkan pada bagian “SK Pendirian Perguruan Tinggi”.</small>
                    </div>

                    <div class="form-group">
                        <label>Status Akreditasi Perguruan Tinggi</label>
                        <input type="text" name="status_akreditasi" class="form-control"
                            value="{{ old('status_akreditasi', $template->status_akreditasi) }}"
                            placeholder="Contoh: Terakreditasi Unggul / Baik Sekali">
                    </div>

                    <div class="form-group">
                        <label>Nomor SK Akreditasi Perguruan Tinggi</label>
                        <input type="text" name="nomor_sk_akreditasi" class="form-control"
                            value="{{ old('nomor_sk_akreditasi', $template->nomor_sk_akreditasi) }}"
                            placeholder="Contoh: SK BAN-PT No. xxx/yyy/tahun">
                    </div>

                    <div class="form-group">
                        <label>Nomor SK Institusi (Opsional)</label>
                        <input type="text" name="nomor_sk_pt" class="form-control"
                            value="{{ old('nomor_sk_pt', $template->nomor_sk_pt) }}"
                            placeholder="Nomor SK lain jika ingin ditampilkan">
                    </div>
                </div>
            </div>

            {{-- SECTION 3: Informasi Akademik --}}
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-graduation-cap"></i>
                    Informasi Akademik
                </div>

                <div class="form-grid">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Persyaratan Penerimaan (Entry Requirements)</label>
                        <textarea name="persyaratan_penerimaan" class="form-control"
                            placeholder="Contoh: Lulusan SMA/MA/SMK sederajat atau yang setara.">{{ old('persyaratan_penerimaan', $template->persyaratan_penerimaan) }}</textarea>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Sistem Penilaian (Grading System)</label>
                        <textarea name="sistem_penilaian" class="form-control" placeholder="Contoh: Skala 1–4; A=4, B=3, C=2, D=1.">{{ old('sistem_penilaian', $template->sistem_penilaian) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Lama Studi Reguler</label>
                        <input type="text" name="lama_studi_reguler" class="form-control"
                            value="{{ old('lama_studi_reguler', $template->lama_studi_reguler) }}"
                            placeholder="Contoh: 4 tahun (8 semester)">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i>
                Simpan Template SKPI
            </button>
        </form>

    </div>

@endsection
