@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Judul Halaman -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Pengajuan Surat Keterangan Pendamping Ijazah (SKPI)
        </h1>

        <!-- Informasi Mahasiswa -->
        <div class="bg-white shadow-md rounded-lg p-5 mb-6 border border-gray-200">
            <h2 class="text-lg font-semibold mb-3 text-gray-700">Data Mahasiswa</h2>
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            @if (isset($mahasiswa))
                <p><strong>NIM:</strong> {{ $mahasiswa->nim ?? '-' }}</p>
                <p><strong>Program Studi:</strong> {{ $mahasiswa->prodi->nama_prodi ?? '-' }}</p>
            @endif
        </div>

        <!-- Status Pengajuan -->
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6">
            <h2 class="text-lg font-semibold text-blue-700 mb-2">Status Pengajuan</h2>
            @if ($verifikasi)
                <p>
                    <strong>Status Saat Ini:</strong>
                    <span class="text-blue-600">{{ ucfirst(str_replace('_', ' ', $verifikasi->status)) }}</span>
                </p>
                @if ($verifikasi->catatan)
                    <p class="mt-2 text-sm text-red-600">
                        <strong>Catatan Verifikator:</strong> {{ $verifikasi->catatan }}
                    </p>
                @endif
            @else
                <p>Belum ada pengajuan SKPI. Silakan ajukan untuk diverifikasi oleh prodi.</p>
            @endif
        </div>

        <!-- Tombol Pengajuan -->
        <div class="text-center">
            @if (!$verifikasi || $verifikasi->status === 'ditolak_prodi')
                <!-- INI PERBAIKANNYA: Mengubah skpi.ajukan menjadi mahasiswa.ajukan -->
                <form method="POST" action="{{ route('skpi.ajukan') }}">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg shadow font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i> Ajukan SKPI
                    </button>
                </form>
            @else
                <div class="p-4 bg-green-100 text-green-700 rounded-lg inline-block">
                    <i class="fas fa-check-circle mr-2"></i>
                    Pengajuan sedang diproses oleh Prodi.
                </div>
            @endif
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
            <a href="{{ url('/mahasiswa/dashboard') }}" class="text-gray-600 hover:text-blue-600 underline">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
