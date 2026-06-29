@extends('fakultas.layouts.app')
@section('title', 'Tambah Operator')
@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }
    .form-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; max-width:600px; }
    .form-card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#faf5ff,#f3e8ff); }
    .form-card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
    .form-card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .form-card-body { padding:24px; }
    .form-group { margin-bottom:18px; }
    .form-group label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
    .form-group label i { margin-right:6px; color:#7c3aed; }
    .form-input { width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111827; background:#fff; transition:all 0.2s; font-family:'Inter',sans-serif; }
    .form-input:focus { outline:none; border-color:#7c3aed; box-shadow:0 0 0 4px rgba(124,58,237,0.1); }
    .form-footer { padding:16px 24px; border-top:1px solid #e5e7eb; display:flex; justify-content:space-between; background:#f8fafc; }
    .btn-save { padding:12px 28px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; transition:all 0.2s; display:inline-flex; align-items:center; gap:8px; }
    .btn-save:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(124,58,237,0.35); }
    .btn-back { padding:12px 22px; background:#fff; color:#6b7280; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
    .btn-back:hover { background:#f1f5f9; }
</style>
@endpush
@section('content')
    <div class="page-header">
        <h1><i class="fas fa-user-plus" style="margin-right:10px"></i> Tambah Operator</h1>
        <p>Buat akun operator baru untuk mengelola dashboard fakultas</p>
    </div>
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-header-icon"><i class="fas fa-user-plus"></i></div>
            <h3>Data Operator Baru</h3>
        </div>
        <form method="POST" action="{{ route('fakultas.operators.store') }}">
            @csrf
            <input type="hidden" name="fakultas_id" value="{{ auth('fakultas')->user()->fakultas_id }}">
            <div class="form-card-body">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-input" required minlength="6">
                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('fakultas.operators.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
@endsection
