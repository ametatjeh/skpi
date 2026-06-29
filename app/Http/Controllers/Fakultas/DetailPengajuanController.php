<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Auth;

class DetailPengajuanController extends Controller
{
    public function show($id)
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $verifikasi = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId))
            ->findOrFail($id);

        return view('fakultas.verifikasi.detail', compact('verifikasi'));
    }
}
