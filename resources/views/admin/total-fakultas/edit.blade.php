@extends('admin.layouts.app')

@section('title', 'Edit Fakultas')

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
        <h5 class="page-title">Edit Fakultas</h5>
        <a href="{{ route('admin.total-fakultas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.total-fakultas.update', $fakultas->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Fakultas --}}
        <div class="form-group">
            <label class="form-label">Nama Fakultas <span class="text-danger">*</span></label>
            <input type="text" name="nama_fakultas" class="form-control @error('nama_fakultas') is-invalid @enderror" 
                   value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}" required>
            @error('nama_fakultas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Dekan --}}
        <div class="form-group">
            <label class="form-label">Nama Dekan</label>
            <input type="text" name="dekan" class="form-control @error('dekan') is-invalid @enderror" 
                   value="{{ old('dekan', $fakultas->dekan) }}">
            @error('dekan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            {{-- Akreditasi --}}
            <div class="col-half">
                <label class="form-label">Akreditasi</label>
                <select name="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach(['Unggul', 'Baik Sekali', 'Baik', 'A', 'B', 'C'] as $akr)
                        <option value="{{ $akr }}" {{ old('akreditasi', $fakultas->akreditasi) == $akr ? 'selected' : '' }}>{{ $akr }}</option>
                    @endforeach
                </select>
                @error('akreditasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- No SK --}}
            <div class="col-half">
                <label class="form-label">Nomor SK Akreditasi</label>
                <input type="text" name="no_sk" class="form-control @error('no_sk') is-invalid @enderror" 
                       value="{{ old('no_sk', $fakultas->no_sk) }}">
                @error('no_sk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Data Fakultas
            </button>
        </div>
    </form>
</div>
@endsection
