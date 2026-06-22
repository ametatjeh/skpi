@extends('fakultas.layouts.app')
@section('title', 'Pengaturan Profil Fakultas')
@section('page_title', 'Profil Fakultas')
@section('page_icon', 'cog')

@push('styles')
<style>
    .profile-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .profile-logo {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
    }
    
    .profile-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 16px;
    }

    .profile-title h2 {
        margin: 0 0 5px 0;
        font-size: 20px;
        font-weight: 700;
        color: #111827;
    }

    .profile-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }
    
    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #b91c1c;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 24px;
        font-weight: 500;
    }
    
    .alert-error ul {
        margin: 5px 0 0;
        padding-left: 20px;
    }
</style>
@endpush

@section('content')
    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Terdapat kesalahan:</strong>
            </div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-logo">
                @if($fakultas && $fakultas->logo)
                    <img src="{{ asset('storage/' . $fakultas->logo) }}" alt="Logo Fakultas">
                @else
                    <i class="fas fa-university"></i>
                @endif
            </div>
            <div class="profile-title">
                <h2>{{ $fakultas->nama_fakultas ?? 'Fakultas Belum Diatur' }}</h2>
                <p>Kelola informasi detail mengenai fakultas Anda</p>
            </div>
        </div>

        <form action="{{ route('fakultas.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Fakultas <span style="color: red;">*</span></label>
                <input type="text" name="nama_fakultas" class="form-control" value="{{ old('nama_fakultas', $fakultas->nama_fakultas ?? '') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nama Dekan</label>
                <input type="text" name="dekan" class="form-control" value="{{ old('dekan', $fakultas->dekan ?? '') }}">
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Akreditasi</label>
                    <input type="text" name="akreditasi" class="form-control" value="{{ old('akreditasi', $fakultas->akreditasi ?? '') }}" placeholder="Contoh: A, B, Unggul">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nomor SK Pendirian</label>
                    <input type="text" name="no_sk" class="form-control" value="{{ old('no_sk', $fakultas->no_sk ?? '') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Logo Fakultas</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <small style="color: #6b7280; display: block; margin-top: 6px;">Format yang didukung: JPG, PNG. Ukuran maksimal: 2MB.</small>
            </div>
            
            <div style="margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
