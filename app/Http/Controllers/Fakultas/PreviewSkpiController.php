<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;
use Illuminate\Support\Facades\Auth;

class PreviewSkpiController extends Controller
{
    public function show($id)
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $draft = DraftSkpi::with(['mahasiswa.prodi', 'verifikasiSkpi.verifiable'])
            ->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId))
            ->findOrFail($id);

        return view('fakultas.verifikasi.preview-skpi', compact('draft'));
    }
}
