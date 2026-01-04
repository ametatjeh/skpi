<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\VerifikasiSkpi;

class ApprovalHistoryController extends Controller
{
    /**
     * Tampilkan semua riwayat approval untuk mahasiswa yang login
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $approvalHistory = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->with(['verifiable', 'approvalLogs'])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('mahasiswa.approval.index', compact('approvalHistory'));
    }

    /**
     * Tampilkan detail approval untuk satu pengajuan (verifikasi)
     */
    public function detail($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $approval = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->with(['verifiable', 'approvalLogs'])
            ->firstOrFail();

        return view('mahasiswa.approval.detail', compact('approval'));
    }
}
