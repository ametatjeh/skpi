@extends('admin.layouts.app')

@section('title', 'Detail Prestasi')
@section('page_title', 'Detail Prestasi')

@section('content')
<div class="content-wrapper" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
    <div class="header-actions" style="margin-bottom: 25px;">
        <h2><i class="fas fa-trophy" style="color: #10b981;"></i> Detail Prestasi Mahasiswa</h2>
        <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 10px; background: #e2e8f0; color: #334155; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 14px;">
        <div>
            <p><strong>Nama Mahasiswa:</strong> {{ $prestasi->mahasiswa->nama ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $prestasi->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $prestasi->mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            <p><strong>Nama Kegiatan:</strong> {{ $prestasi->judul_prestasi ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Tingkat:</strong> {{ $prestasi->tingkat ?? '-' }}</p>
            <p><strong>Penyelenggara:</strong> {{ $prestasi->penyelenggara ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $prestasi->tanggal_perolehan ? $prestasi->tanggal_perolehan->format('d M Y') : '-' }}</p>
            <p><strong>Bukti:</strong> 
                @if($prestasi->file_path)
                    <a href="{{ asset('storage/' . $prestasi->file_path) }}" target="_blank" style="color: #10b981; text-decoration: underline;">Lihat Bukti</a>
                @else
                    -
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
