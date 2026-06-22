@extends('prodi.layouts.app')

@section('title', 'Pengaturan Akun - Prodi')
@section('page_title', 'Pengaturan Akun')

@push('styles')
<style>
    /* ============ PREMIUM SETTINGS STYLES ============ */
    .settings-container * {
        box-sizing: border-box;
    }
    
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .header-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        backdrop-filter: blur(4px);
    }
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Alert Messages */
    .alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
        border: 1px solid #f87171;
    }
    
    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.7;
    }
    
    /* Layout Grid */
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    /* Section Card */
    .section-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .section-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .section-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .section-subtitle {
        margin: 4px 0 0 0;
        font-size: 13px;
        color: #6b7280;
    }
    
    .section-body {
        padding: 24px;
    }
    
    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group:last-child {
        margin-bottom: 0;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #0891b2;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.1);
    }
    
    .form-input.error {
        border-color: #ef4444;
        background: #fef2f2;
    }
    
    .error-text {
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 20px;
        margin-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-save {
        padding: 12px 24px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-icon {
            margin-bottom: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="settings-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div>
            <h1>Pengaturan Akun</h1>
            <p>Kelola profil dan keamanan akun Prodi Anda</p>
        </div>
    </div>
    
    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>Terdapat kesalahan pada input Anda. Silakan periksa kembali.</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    <div class="settings-grid">
        {{-- Update Profile --}}
        <div class="section-card">
            <div class="section-header">
                <i class="fas fa-id-card"></i>
                <div>
                    <h3 class="section-title">Informasi Profil</h3>
                    <p class="section-subtitle">Perbarui nama dan alamat email Anda</p>
                </div>
            </div>
            
            <div class="section-body">
                <form action="{{ route('prodi.pengaturan.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}" 
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}" 
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Update Password --}}
        <div class="section-card">
            <div class="section-header">
                <i class="fas fa-lock"></i>
                <div>
                    <h3 class="section-title">Keamanan Password</h3>
                    <p class="section-subtitle">Pastikan akun Anda menggunakan password yang kuat</p>
                </div>
            </div>
            
            <div class="section-body">
                <form action="{{ route('prodi.pengaturan.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-input {{ $errors->has('current_password') ? 'error' : '' }}" required>
                        @error('current_password')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-input {{ $errors->has('new_password') ? 'error' : '' }}" required>
                        @error('new_password')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-input" required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-key"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
