<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\VerifikasiSkpi;

class VerifikasiStatusController extends Controller
{
    /**
     * Display all verification status for logged-in mahasiswa
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $verifikasi = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->with(['verifiable', 'prodi'])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        // Akan mencari resources/views/mahasiswa/verifikasi/index.blade.php
        return view('mahasiswa.verifikasi.index', compact('verifikasi'));
    }

    /**
     * Show detail of specific verification
     * 
     * @param int $id
     */
    public function detail($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $verifikasi = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->with(['verifiable', 'prodi', 'approvalLogs'])
            ->firstOrFail();

        // Akan mencari resources/views/mahasiswa/verifikasi/detail.blade.php
        return view('mahasiswa.verifikasi.detail', compact('verifikasi'));
    }
}
