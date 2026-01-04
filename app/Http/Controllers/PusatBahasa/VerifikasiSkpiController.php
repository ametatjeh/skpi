<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;
use App\Models\ApprovalLog;
use App\Models\VerifikasiSkpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiSkpiController extends Controller
{
    // List draft menunggu keputusan pusat bahasa
    public function index(Request $request)
    {
        $status = $request->get('status');

        // Alur baru: Pusat Bahasa menerima dari Prodi dengan status 'valid_pusat_bahasa'
        $query = DraftSkpi::with(['mahasiswa.prodi'])
            ->where('status', 'valid_pusat_bahasa');

        if ($status) {
            $query->where('status', $status);
        }

        $drafts = $query->orderByDesc('created_at')->paginate(12);

        return view('pusat.verifikasi.index', [
            'drafts' => $drafts,
            'status' => $status,
        ]);
    }

    // Detail 1 draft untuk diputuskan pusat bahasa
    public function show($id)
    {
        $draft = DraftSkpi::with([
            'mahasiswa.prodi.fakultas',
            'verifikasiSkpi',
            'approvalLogs' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
        ])->findOrFail($id);

        // Alur baru: hanya bisa akses jika status 'valid_pusat_bahasa'
        if ($draft->status !== 'valid_pusat_bahasa') {
            abort(404);
        }

        return view('pusat.verifikasi.show', compact('draft'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $draft = DraftSkpi::findOrFail($id);

        if ($draft->status !== 'valid_pusat_bahasa') {
            abort(404);
        }

        DB::transaction(function () use ($request, $draft) {
            $oldStatus = $draft->status;

            // Alur baru: Forward ke Fakultas (bukan final)
            $draft->status = 'valid_fakultas';
            $draft->save();

            // Update level verifikasi ke fakultas
            VerifikasiSkpi::where('mahasiswa_id', $draft->mahasiswa_id)
                ->where('level_verifikasi', 'pusat_bahasa')
                ->where('status', 'pending')
                ->update([
                    'level_verifikasi' => 'fakultas',
                    'status' => 'approved'
                ]);

            // Log approval
            ApprovalLog::create([
                'draft_skpi_id' => $draft->id,
                'approver_id'   => auth()->id(),
                'approver_role' => 'pusat_bahasa',
                'action'        => 'approve',
                'status_from'   => $oldStatus,
                'status_to'     => $draft->status,
                'catatan'       => $request->catatan,
            ]);
        });

        return redirect()
            ->route('pusat.verifikasi.index')
            ->with('success', 'Draft SKPI berhasil disetujui dan diteruskan ke Fakultas!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ]);

        $draft = DraftSkpi::findOrFail($id);

        if ($draft->status !== 'valid_pusat_bahasa') {
            abort(404);
        }

        DB::transaction(function () use ($request, $draft) {
            $oldStatus = $draft->status;

            // Alur baru: Reject kembali ke Prodi
            $draft->status  = 'revisi_prodi';
            $draft->catatan = $request->catatan;
            $draft->save();

            // Update level verifikasi kembali ke prodi
            VerifikasiSkpi::where('mahasiswa_id', $draft->mahasiswa_id)
                ->where('level_verifikasi', 'pusat_bahasa')
                ->update([
                    'level_verifikasi' => 'prodi',
                    'status' => 'revision_required'
                ]);

            ApprovalLog::create([
                'draft_skpi_id' => $draft->id,
                'approver_id'   => auth()->id(),
                'approver_role' => 'pusat_bahasa',
                'action'        => 'reject',
                'status_from'   => $oldStatus,
                'status_to'     => $draft->status,
                'catatan'       => $request->catatan,
            ]);
        });

        return redirect()
            ->route('pusat.verifikasi.index')
            ->with('success', 'Draft SKPI dikembalikan (revisi) ke Prodi.');
    }

    /**
     * Update ringkasan bilingual - Pusat Bahasa bisa edit/koreksi
     */
    public function updateRingkasan(Request $request, $id)
    {
        $request->validate([
            'ringkasan_id' => 'nullable|string|max:5000',
            'ringkasan_en' => 'nullable|string|max:5000',
        ]);

        $draft = DraftSkpi::findOrFail($id);

        if ($draft->status !== 'valid_pusat_bahasa') {
            abort(404);
        }

        $draft->update([
            'ringkasan_id' => $request->ringkasan_id,
            'ringkasan_en' => $request->ringkasan_en,
        ]);

        return redirect()
            ->route('pusat.verifikasi.show', $draft->id)
            ->with('success', 'Ringkasan bilingual berhasil diperbarui!');
    }
}
