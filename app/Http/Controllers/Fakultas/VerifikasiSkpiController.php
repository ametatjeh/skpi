<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VerifikasiSkpi;
use App\Models\DraftSkpi;

class VerifikasiSkpiController extends Controller
{
    // List pengajuan kategori SKPI masuk fakultas (FINAL APPROVER dalam alur baru)
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
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
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

    // Detail satu kategori SKPI di fakultas
    public function show($id)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $verifikasi = VerifikasiSkpi::with([
            'mahasiswa.prodi.fakultas',
            'mahasiswa.sertifikasi',
            'mahasiswa.prestasi',
            'mahasiswa.organisasi',
            'mahasiswa.pengabdian',
            'mahasiswa.karya',
            'mahasiswa.penghargaan',
        ])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->findOrFail($id);

        $draft = DraftSkpi::where('mahasiswa_id', $verifikasi->mahasiswa_id)
            ->whereIn('status', ['valid_fakultas', 'revisi_prodi'])
            ->latest()
            ->first();

        return view('fakultas.verifikasi.detail', compact('verifikasi', 'draft'));
    }

    // Approve kategori/achievement oleh fakultas
    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $verifikasi = VerifikasiSkpi::where('id', $id)
                ->where('level_verifikasi', 'fakultas')
                ->firstOrFail();

            $verifikasi->update([
                'status'             => 'approved',
                'verifikator_role'   => 'fakultas',
                'tanggal_verifikasi' => now(),
                'catatan'            => $request->catatan ?? $verifikasi->catatan,
            ]);

            DB::commit();
            return redirect()
                ->route('fakultas.verifikasi.show', $id)
                ->with('success', 'Kategori SKPI berhasil disetujui di level fakultas.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui: ' . $e->getMessage());
        }
    }

    // Reject kategori/achievement oleh fakultas
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ], [
            'catatan.required' => 'Alasan penolakan wajib diisi!',
        ]);

        DB::beginTransaction();
        try {
            $verifikasi = VerifikasiSkpi::where('id', $id)
                ->where('level_verifikasi', 'fakultas')
                ->firstOrFail();

            $verifikasi->update([
                'status'             => 'rejected',
                'verifikator_role'   => 'fakultas',
                'tanggal_verifikasi' => now(),
                'catatan'            => $request->catatan,
            ]);

            DB::commit();
            return redirect()
                ->route('fakultas.verifikasi.show', $id)
                ->with('success', 'Kategori SKPI berhasil ditolak di level fakultas.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak: ' . $e->getMessage());
        }
    }
}
