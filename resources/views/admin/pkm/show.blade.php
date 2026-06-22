@extends('admin.layouts.app')

@section('title', 'Detail PKM')
@section('page_title', 'Detail PKM')

@section('content')
<div class="content-wrapper" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
    <div class="header-actions" style="margin-bottom: 25px;">
        <h2><i class="fas fa-hands-helping" style="color: #10b981;"></i> Detail PKM Mahasiswa</h2>
        <a href="{{ route('admin.pkm.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 10px; background: #e2e8f0; color: #334155; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 14px;">
        <div>
            <p><strong>Nama Mahasiswa:</strong> {{ $pkm->mahasiswa->nama ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $pkm->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $pkm->mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            <p><strong>Judul PKM:</strong> {{ $pkm->judul_pkm ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Peran:</strong> {{ $pkm->peran ?? '-' }}</p>
            <p><strong>Tahun Pelaksanaan:</strong> {{ $pkm->tahun_pelaksanaan ?? '-' }}</p>
            <p><strong>Keterangan:</strong> {{ $pkm->keterangan ?? '-' }}</p>
            <p><strong>Bukti:</strong> 
                @if($pkm->file_path)
                    <a href="{{ asset('storage/' . $pkm->file_path) }}" target="_blank" style="color: #10b981; text-decoration: underline;">Lihat Bukti</a>
                @else
                    -
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
