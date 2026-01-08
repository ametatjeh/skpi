@extends('mahasiswa.layouts.app')

@section('title', 'Edit PKM')
@section('page_title', 'Edit Program Pengabdian Masyarakat')
@section('page_icon', 'edit')

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

        .current-file-box {
            padding: 10px 12px;
            border-radius: 8px;
            background: #f3f4f6;
            font-size: .85rem;
            margin-bottom: 8px;
            color: #4b5563;
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
                Form Edit Program Pengabdian Masyarakat
            </div>

            <form action="{{ route('mahasiswa.pkm.update', $pkm->id) }}" method="POST" enctype="multipart/form-data"
                class="form-card-body">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">
                        Judul PKM <span>*</span>
                    </label>
                    <input type="text" name="judul_pkm" class="form-control-skpi"
                        value="{{ old('judul_pkm', $pkm->judul_pkm) }}">
                    @error('judul_pkm')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tambah field lain persis seperti form Tambah PKM, tapi pakai old(..., $pkm->field) -->

                <div class="form-actions">
                    <button type="submit" class="btn-skpi btn-submit">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('mahasiswa.pkm.list') }}" class="btn-skpi btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

