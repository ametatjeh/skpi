@extends('admin.layouts.app')

@section('title', 'Detail Organisasi')
@section('page_title', 'Detail Organisasi')

@section('content')
<div class="content-wrapper" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
    <div class="header-actions" style="margin-bottom: 25px;">
        <h2><i class="fas fa-users" style="color: #10b981;"></i> Detail Organisasi Mahasiswa</h2>
        <a href="{{ route('admin.organisasi.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 10px; background: #e2e8f0; color: #334155; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 14px;">
        <div>
            <p><strong>Nama Mahasiswa:</strong> {{ $organisasi->mahasiswa->nama ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $organisasi->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $organisasi->mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            <p><strong>Nama Organisasi:</strong> {{ $organisasi->nama_organisasi ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Jabatan:</strong> {{ $organisasi->jabatan ?? '-' }}</p>
            <p><strong>Masa Jabatan:</strong> {{ $organisasi->masa_jabatan ?? '-' }}</p>
            <p><strong>Tingkat:</strong> {{ $organisasi->tingkat ?? '-' }}</p>
            <p><strong>Bukti:</strong> 
                @if($organisasi->file_path)
                    <a href="{{ asset('storage/' . $organisasi->file_path) }}" target="_blank" style="color: #10b981; text-decoration: underline;">Lihat Bukti</a>
                @else
                    -
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
