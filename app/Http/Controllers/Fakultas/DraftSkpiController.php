<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DraftSkpi;

class DraftSkpiController extends Controller
{
    /**
     * List draft SKPI yang masuk ke fakultas (FINAL APPROVER dalam alur baru).
     */
    public function index(Request $request)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $query = DraftSkpi::with('mahasiswa.prodi')
            // Filter hanya prodi yang ada di fakultas ini
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            // Alur baru: Fakultas menerima dari Pusat Bahasa dengan status 'valid_fakultas'
            ->whereIn('status', ['valid_fakultas', 'revisi_pusat_bahasa'])
            // Filter by status (opsional dropdown)
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            // Filter by search query NIM/nama
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = $request->q;
                $q->whereHas('mahasiswa', function ($m) use ($term) {
                    $m->where('nim', 'like', "%$term%")
                        ->orWhere('nama', 'like', "%$term%");
                });
            })
            ->orderByDesc('created_at');

        $drafts = $query->paginate(12);


        return view('fakultas.verifikasi.index', compact('drafts'));
    }

    /**
     * Preview/detail draft SKPI untuk aksi approve/revisi.
     */
    public function preview($id)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $draft = DraftSkpi::with([
            'mahasiswa.prodi',
            'verifikasiSkpi.verifiable'
        ])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->findOrFail($id);

        return view('fakultas.draft-skpi.preview', compact('draft'));
    }

    public function arsipShow($id)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $draft = \App\Models\DraftSkpi::with([
            'mahasiswa.prodi',
            'verifikasiSkpi.verifiable'
        ])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->findOrFail($id);

        return view('fakultas.draft-skpi.arsip', compact('draft'));
    }


    /**
     * (Optional) Fitur pencarian khusus
     */
    public function search(Request $request)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $term = $request->q;
        $drafts = DraftSkpi::with(['mahasiswa.prodi'])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->whereIn('status', ['valid_fakultas', 'revisi_pusat_bahasa'])
            ->whereHas('mahasiswa', function ($mq) use ($term) {
                $mq->where('nim', 'like', "%$term%")
                    ->orWhere('nama', 'like', "%$term%");
            })
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('fakultas.verifikasi.index', compact('drafts'));
    }
}
