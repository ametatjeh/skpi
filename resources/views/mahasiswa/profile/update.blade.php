{{-- resources/views/mahasiswa/profile/update.blade.php --}}
{{-- This view redirects to the profile index which already has the edit form --}}
@extends('mahasiswa.layouts.app')
@section('title', 'Update Profil')
@section('page_title', 'Update Profil')
@section('page_icon', 'user-edit')

@section('content')
<style>
    .redirect-card {
        max-width: 500px;
        margin: 60px auto;
        text-align: center;
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    }
    .redirect-icon {
        width: 80px; height: 80px;
        margin: 0 auto 20px;
        border-radius: 20px;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; color: #fff;
        box-shadow: 0 8px 24px rgba(8, 145, 178, 0.3);
    }
    .redirect-card h2 { font-size: 20px; font-weight: 700; color: #111827; margin: 0 0 10px 0; }
    .redirect-card p { font-size: 14px; color: #6b7280; margin-bottom: 20px; }
    .btn-go {
        padding: 12px 28px;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        color: #fff; border: none; border-radius: 12px;
        font-size: 15px; font-weight: 600; text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(8, 145, 178, 0.35);
    }
    .btn-go:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(8, 145, 178, 0.45); }
</style>

<div class="redirect-card">
    <div class="redirect-icon"><i class="fas fa-user-edit"></i></div>
    <h2>Update Profil</h2>
    <p>Halaman update profil sudah tersedia di halaman Profil Saya. Klik tombol di bawah untuk menuju ke sana.</p>
    <a href="{{ route('mahasiswa.profile') }}" class="btn-go">
        <i class="fas fa-arrow-right"></i> Ke Halaman Profil
    </a>
</div>
@endsection
