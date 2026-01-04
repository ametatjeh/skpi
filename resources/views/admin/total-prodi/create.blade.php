@extends('admin.layouts.app')

@section('title', 'Tambah Prodi')

@section('content')
<style>
    .content-wrapper {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        max-width: 800px;
        margin: 0 auto;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #475569;
        font-size: 14px;
    }

    .text-danger {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
    }

    .row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .col-half {
        flex: 1;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        width: 100%;
        justify-content: center;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 20px;
            margin: 10px;
        }

        .row {
            flex-direction: column;
            gap: 0;
            margin-bottom: 0;
        }

        .col-half {
            margin-bottom: 20px;
        }
    }
</style>

<div class="content-wrapper">
    <div class="header-section">
        <h5 class="page-title">Tambah Program Studi</h5>
        <a href="{{ route('admin.total-prodi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.total-prodi.store') }}" method="POST">
        @csrf
        
        {{-- Fakultas --}}
        <div class="form-group">
            <label class="form-label">Fakultas <span class="text-danger">*</span></label>
            <select name="fakultas_id" class="form-control @error('fakultas_id') is-invalid @enderror" required>
                <option value="">-- Pilih Fakultas --</option>
                @foreach($fakultas as $f)
                    <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                        {{ $f->nama_fakultas }}
                    </option>
                @endforeach
            </select>
            @error('fakultas_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama Prodi --}}
        <div class="form-group">
            <label class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
            <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" 
                   value="{{ old('nama_prodi') }}" required placeholder="Contoh: Teknik Informatika">
            @error('nama_prodi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kaprodi --}}
        <div class="form-group">
            <label class="form-label">Kepala Program Studi</label>
            <input type="text" name="kaprodi" class="form-control @error('kaprodi') is-invalid @enderror" 
                   value="{{ old('kaprodi') }}" placeholder="Nama Kaprodi">
            @error('kaprodi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            {{-- Akreditasi --}}
            <div class="col-half">
                <label class="form-label">Akreditasi</label>
                <select name="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="Unggul" {{ old('akreditasi') == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                    <option value="Baik Sekali" {{ old('akreditasi') == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                    <option value="Baik" {{ old('akreditasi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="A" {{ old('akreditasi') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('akreditasi') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('akreditasi') == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>

            {{-- Jenjang --}}
            <div class="col-half">
                <label class="form-label">Jenjang</label>
                <select name="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                    <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('jenjang') == 'S3' ? 'selected' : '' }}>S3</option>
                    <option value="D4" {{ old('jenjang') == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="D3" {{ old('jenjang') == 'D3' ? 'selected' : '' }}>D3</option>
                </select>
            </div>
        </div>

        {{-- No SK --}}
        <div class="form-group">
            <label class="form-label">Nomor SK Akreditasi</label>
            <input type="text" name="no_sk" class="form-control @error('no_sk') is-invalid @enderror" 
                   value="{{ old('no_sk') }}" placeholder="Nomor SK Akreditasi">
        </div>

        <div class="row">
            {{-- KKNI Level --}}
            <div class="col-half">
                <label class="form-label">Level KKNI</label>
                <select name="kk_prodi" class="form-control @error('kk_prodi') is-invalid @enderror">
                    <option value="6" {{ old('kk_prodi') == '6' ? 'selected' : '' }}>Level 6 (S1/D4)</option>
                    <option value="5" {{ old('kk_prodi') == '5' ? 'selected' : '' }}>Level 5 (D3)</option>
                    <option value="7" {{ old('kk_prodi') == '7' ? 'selected' : '' }}>Level 7 (Profesi)</option>
                    <option value="8" {{ old('kk_prodi') == '8' ? 'selected' : '' }}>Level 8 (Magister)</option>
                    <option value="9" {{ old('kk_prodi') == '9' ? 'selected' : '' }}>Level 9 (Doktor)</option>
                </select>
            </div>

            {{-- Bahasa Pengantar --}}
            <div class="col-half">
                <label class="form-label">Bahasa Pengantar</label>
                <input type="text" name="bahasa_pengantar" class="form-control" 
                       value="{{ old('bahasa_pengantar', 'Indonesia') }}">
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Data Prodi
            </button>
        </div>
    </form>
</div>
@endsection

