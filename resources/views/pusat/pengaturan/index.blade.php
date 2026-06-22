@extends('pusat.layouts.app')
@section('title', 'Pengaturan Akun Pusat Bahasa')

@section('content')
    <div class="pusat-dashboard-header">
        <div class="pusat-title-main">Pengaturan Akun</div>
        <div class="pusat-title-desc">Perbarui profil dan kata sandi akun Pusat Bahasa Anda.</div>
    </div>

    <div style="background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.04); max-width: 600px;">
        <form action="{{ route('pusat.pengaturan.update') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', auth()->guard('pusat_bahasa')->user()->name) }}" 
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #d1d5db; font-family: inherit; font-size: 14px;" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->guard('pusat_bahasa')->user()->email) }}" 
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #d1d5db; font-family: inherit; font-size: 14px;" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kata Sandi Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah sandi" 
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #d1d5db; font-family: inherit; font-size: 14px;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" 
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #d1d5db; font-family: inherit; font-size: 14px;">
            </div>

            <button type="submit" 
                style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); color: #fff; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);">
                <i class="fas fa-save" style="margin-right: 8px;"></i> Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
