@extends('admin.layouts.app')

@section('title', 'Detail Sertifikasi')
@section('page_title', 'Detail Sertifikasi')

@section('content')
<div class="content-wrapper" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
    <div class="header-actions" style="margin-bottom: 25px;">
        <h2><i class="fas fa-certificate" style="color: #10b981;"></i> Detail Sertifikasi Mahasiswa</h2>
        <a href="{{ route('admin.sertifikasi.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 10px; background: #e2e8f0; color: #334155; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 14px;">
        <div>
            <p><strong>Nama Mahasiswa:</strong> {{ $sertifikasi->mahasiswa->nama ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $sertifikasi->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $sertifikasi->mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            <p><strong>Nama Sertifikasi:</strong> {{ $sertifikasi->nama_sertifikasi ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Lembaga Penerbit:</strong> {{ $sertifikasi->lembaga_penerbit ?? '-' }}</p>
            <p><strong>Tanggal Penerbitan:</strong> {{ $sertifikasi->tanggal_penerbitan ? \Carbon\Carbon::parse($sertifikasi->tanggal_penerbitan)->format('d M Y') : '-' }}</p>
            <p><strong>Tanggal Kedaluwarsa:</strong> {{ $sertifikasi->tanggal_kadaluarsa ? \Carbon\Carbon::parse($sertifikasi->tanggal_kadaluarsa)->format('d M Y') : '-' }}</p>
            <p><strong>Bukti:</strong> 
                @if($sertifikasi->file_path)
                    <a href="{{ asset('storage/' . $sertifikasi->file_path) }}" target="_blank" style="color: #10b981; text-decoration: underline;">Lihat Bukti</a>
                @else
                    -
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
