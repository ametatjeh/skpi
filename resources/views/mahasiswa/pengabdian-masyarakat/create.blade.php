@extends('mahasiswa.layouts.app')

@section('title', 'Tambah PKM')
@section('page_title', 'Tambah Program Pengabdian Masyarakat')
@section('page_icon', 'plus')

@section('content')

    <style>
        .form-wrapper {
            max-width: 820px;
            margin: 0 auto;
        }

        .form-card {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        .form-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 700;
            font-size: 15px;
            color: #111827;
        }

        .form-card-body {
            padding: 22px 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: .9rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
        }

        .form-label span {
            color: #ef4444;
        }

        .form-control-skpi {
            width: 100%;
            padding: 9px 11px;
            border-radius: 8px;
            border: 1px solid #cbd5f5;
            font-size: .9rem;
            font-family: inherit;
            background: #f9fafb;
            color: #111827;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .form-control-skpi:focus {
            outline: none;
            border-color: #0d47a1;
            background: #ffffff;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .25);
        }

        .form-error {
            color: #b91c1c;
            font-size: .78rem;
            margin-top: 3px;
            display: block;
        }

        .upload-box {
            border: 2px dashed #cbd5f5;
            border-radius: 8px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            background: #f9fafb;
            transition: border-color .18s, background .18s;
        }

        .upload-box:hover {
            border-color: #0d47a1;
            background: #eff6ff;
        }

        .upload-icon {
            font-size: 30px;
            color: #0d47a1;
            margin-bottom: 6px;
            display: block;
        }

        .upload-text {
            font-size: .9rem;
            color: #4b5563;
            margin: 0;
        }

        .upload-note {
            font-size: .78rem;
            color: #6b7280;
            display: block;
            margin-top: 2px;
        }

        .upload-filename {
            color: #0d47a1;
            font-size: .8rem;
            margin-top: 6px;
            display: block;
            word-break: break-all;
        }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 14px 12px;
            border-radius: 8px;
            font-size: .85rem;
            color: #1e40af;
            margin: 10px 0 20px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .btn-skpi {
            flex: 1;
            padding: 10px 0;
            border-radius: 8px;
            border: none;
            font-size: .9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            text-align: center;
            transition: background .16s, transform .1s, box-shadow .1s;
        }

        .btn-draft {
            background: #6b7280;
        }

        .btn-draft:hover {
            background: #4b5563;
            transform: translateY(-1px);
        }

        .btn-submit {
            background: #10b981;
        }

        .btn-submit:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-cancel {
            flex: 0.6;
            background: #9ca3af;
        }

        .btn-cancel:hover {
            background: #6b7280;
            transform: translateY(-1px);
        }

        @media(max-width:640px) {
            .form-card-body {
                padding: 18px 14px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel {
                flex: 1;
            }
        }
    </style>

    <div class="form-wrapper">
        <div class="form-card">
            <div class="form-card-header">
                Form Input PKM
            </div>

            <form action="{{ route('mahasiswa.pkm.store') }}" method="POST" enctype="multipart/form-data"
                class="form-card-body">
                @csrf

                <div class="form-group">
                    <label class="form-label">
                        Judul PKM <span>*</span>
                    </label>
                    <input type="text" name="judul_pkm" class="form-control-skpi"
                        placeholder="Contoh: Pelatihan Kewirausahaan untuk UMKM Desa Sukamaju"
                        value="{{ old('judul_pkm') }}" required>
                    @error('judul_pkm')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Sumber Pendanaan (Opsional)
                    </label>
                    <input type="text" name="pendanaan" class="form-control-skpi"
                        placeholder="Contoh: Mandiri / Hibah Kemendikbud / Kerjasama" value="{{ old('pendanaan') }}">
                    @error('pendanaan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Tahun Pelaksanaan <span>*</span>
                    </label>
                    <input type="number" name="tahun_pelaksanaan" class="form-control-skpi" placeholder="Contoh: 2024"
                        value="{{ old('tahun_pelaksanaan') }}" min="1900" max="{{ date('Y') }}" required>
                    @error('tahun_pelaksanaan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Jumlah Anggota Tim (Opsional)
                    </label>
                    <input type="number" name="anggota_tim" class="form-control-skpi" placeholder="Contoh: 5"
                        value="{{ old('anggota_tim') }}" min="1">
                    @error('anggota_tim')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4" class="form-control-skpi"
                        placeholder="Jelaskan tentang kegiatan PKM, tujuan, dan dampak yang dihasilkan...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Upload Bukti (Opsional)
                    </label>
                    <div class="upload-box" onclick="document.getElementById('file_input').click()">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Klik untuk upload file</p>
                        <span class="upload-note">Max 5MB (PDF, DOC, DOCX, JPG, PNG)</span>
                    </div>
                    <input type="file" id="file_input" name="file_path" style="display:none;"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <span id="file_name" class="upload-filename"></span>
                    @error('file_path')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="info-box">
                    <strong><i class="fas fa-info-circle"></i> Informasi:</strong><br>
                    • <strong>Simpan sebagai Draft:</strong> Data tersimpan dan bisa Anda edit kapan saja sebelum
                    disubmit.<br>
                    • <strong>Submit untuk Verifikasi:</strong> Data akan masuk ke proses verifikasi dan tidak bisa diedit
                    lagi.
                </div>

                <div class="form-actions">
                    <button type="submit" name="action" value="draft" class="btn-skpi btn-draft">
                        <i class="fas fa-save"></i> Simpan sebagai Draft
                    </button>

                    <button type="submit" name="action" value="submit" class="btn-skpi btn-submit">
                        <i class="fas fa-paper-plane"></i> Submit untuk Verifikasi
                    </button>

                    <a href="{{ route('mahasiswa.pkm.list') }}" class="btn-skpi btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const fileInputPkm = document.getElementById('file_input');
        const fileNamePkm = document.getElementById('file_name');
        if (fileInputPkm) {
            fileInputPkm.addEventListener('change', function(e) {
                const name = e.target.files[0]?.name || '';
                fileNamePkm.textContent = name ? '✓ ' + name : '';
            });
        }
    </script>
@endsection
