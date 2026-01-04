<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DraftSkpi;
use App\Models\VerifikasiSkpi;
use App\Models\TemplateSkpi;
use Barryvdh\DomPDF\Facade\Pdf;


class ApprovalController extends Controller
{
    // List draft menunggu keputusan fakultas (FINAL APPROVER dalam alur baru)
    public function index(Request $request)
    {
        // Ambil fakultas_id dari user yang login
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $query = DraftSkpi::with(['mahasiswa.prodi'])
            // Filter hanya prodi yang ada di fakultas ini
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            // Alur baru: Fakultas menerima dari Pusat Bahasa dengan status 'valid_fakultas'
            ->whereIn('status', [
                'valid_fakultas', // Draft masuk dari Pusat Bahasa, siap final approval
                'revisi_pusat_bahasa', // Draft dikembalikan ke Pusat Bahasa (jika ada)
            ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('nim', 'like', '%' . $request->q . '%')
                    ->orWhere('nama', 'like', '%' . $request->q . '%');
            });
        }
        $drafts = $query->orderByDesc('created_at')->paginate(12);

        $listKategori = VerifikasiSkpi::where('level_verifikasi', 'fakultas')
            ->select('verifiable_type')->distinct()->pluck('verifiable_type')
            ->map(fn($type) => class_basename($type))->filter()->sort()->values()->toArray();

        return view('fakultas.approval.index', compact('drafts', 'listKategori'));
    }

    // Preview/Detail draft SKPI untuk keputusan fakultas.
    public function show($id)
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

        return view('fakultas.approval.show', compact('draft'));
    }

    // Proses approval/revisi draft SKPI oleh fakultas (FINAL APPROVER dalam alur baru)
    public function update(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|in:approve,revisi',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $draft = DraftSkpi::whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })->findOrFail($id);

        if ($request->aksi == 'approve') {
            // Alur baru: Fakultas adalah FINAL APPROVER
            $draft->status = 'final_issued';
            $draft->tanggal_pengesahan = now();
            $draft->save();

            // Semua kategori di level fakultas jadi included_in_summary
            VerifikasiSkpi::where('mahasiswa_id', $draft->mahasiswa_id)
                ->where('level_verifikasi', 'fakultas')
                ->where('status', 'approved')
                ->update([
                    'status' => 'included_in_summary'
                ]);
        } else if ($request->aksi == 'revisi') {
            // Alur baru: Revisi kembali ke Pusat Bahasa
            $draft->status = 'revisi_pusat_bahasa';
            $draft->catatan = $request->catatan;
            $draft->save();

            // Semua kategori kembali ke pusat_bahasa untuk revisi
            VerifikasiSkpi::where('mahasiswa_id', $draft->mahasiswa_id)
                ->where('level_verifikasi', 'fakultas')
                ->update([
                    'level_verifikasi' => 'pusat_bahasa',
                    'status' => 'revision_required'
                ]);
        }

        return redirect()->route('fakultas.approval.show', $id)
            ->with('success', $request->aksi == 'approve' 
                ? 'SKPI berhasil disetujui dan diterbitkan!' 
                : 'Draft berhasil dikembalikan untuk revisi.');
    }

    // Arsip draft SKPI (final)
    public function arsipIndex()
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $arsipDraft = DraftSkpi::with(['mahasiswa.prodi'])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->whereIn('status', ['final_issued'])
            ->latest()->get();
        return view('fakultas.arsip.index', compact('arsipDraft'));
    }

    // Detail satu arsip draft SKPI.
    public function arsipShow($id)
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
        return view('fakultas.arsip.show', compact('draft'));
    }

    // PDF export arsip draft SKPI
    public function arsipDownloadPdf($id)
    {
        $fakultasUser = auth('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        // Verify that draft belongs to this fakultas
        $draftSkpi = DraftSkpi::with(['mahasiswa.prodi.fakultas'])
            ->whereHas('mahasiswa.prodi', function ($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            })
            ->findOrFail($id);

        // Use SkpiPdfService for consistent PDF generation
        $pdfService = new \App\Services\SkpiPdfService();
        return $pdfService->downloadPdf($id);
    }
}
