<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{DraftSkpi, Mahasiswa};
use App\Services\SkpiPdfService; // ← IMPORT SERVICE
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkpiDraftController extends Controller
{
    protected $skpiPdfService;

    // ✅ INJECT SERVICE
    public function __construct(SkpiPdfService $skpiPdfService)
    {
        $this->skpiPdfService = $skpiPdfService;
    }

    /**
     * Draft SKPI - daftar SKPI yang masih draft/proses.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $draftSkpiList = DraftSkpi::with(['mahasiswa.prodi', 'prodi'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nomor_skpi', 'like', "%{$search}%");
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20); // ← TAMBAHKAN PAGINATION

        return view('admin.draft.index', compact('draftSkpiList', 'search', 'status'));
    }

    /**
     * Generate Draft SKPI untuk mahasiswa.
     */
    public function generate($mahasiswa_id)
    {
        try {
            $mahasiswa = Mahasiswa::with('prodi')->findOrFail($mahasiswa_id);

            // Cek apakah sudah ada draft SKPI
            $existingDraft = DraftSkpi::where('mahasiswa_id', $mahasiswa_id)
                ->whereIn('status', ['draft', 'approved', 'final_issued']) // ← CEK SEMUA STATUS AKTIF
                ->first();

            if ($existingDraft) {
                return back()->withErrors(['error' => 'Draft SKPI untuk mahasiswa ini sudah ada!']);
            }

            // Generate nomor SKPI
            $nomorSkpi = $this->generateNomorSkpi($mahasiswa);

            // Ambil tahun lulus
            $tahunLulus = $mahasiswa->tanggal_lulus
                ? $mahasiswa->tanggal_lulus->format('Y')
                : date('Y');

            // Buat draft SKPI
            DraftSkpi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'prodi_id'     => $mahasiswa->prodi_id,
                'nomor_skpi'   => $nomorSkpi,
                'tahun_lulus'  => $tahunLulus,
                'status'       => 'draft',
            ]);

            return back()->with('success', 'Draft SKPI berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal generate SKPI: ' . $e->getMessage()]);
        }
    }

    /**
     * ✅ Preview SKPI (HTML) - PAKAI SERVICE
     */
    public function preview($id)
    {
        $draftSkpi = DraftSkpi::with(['mahasiswa.prodi.fakultas'])->findOrFail($id);

        // Ambil data dari service
        $data = $this->skpiPdfService->getSkpiData($id);

        return view('admin.draft.preview', array_merge(['draftSkpi' => $draftSkpi], $data));
    }

    /**
     * ✅ Download PDF - PAKAI SERVICE
     */
    public function downloadPdf($id)
    {
        return $this->skpiPdfService->downloadPdf($id);
    }

    /**
     * ✅ Stream PDF (buka di browser) - PAKAI SERVICE
     */
    public function streamPdf($id)
    {
        return $this->skpiPdfService->streamPdf($id);
    }

    /**
     * Finalisasi SKPI (draft/approved → final_issued).
     */
    public function finalize($id)
    {
        try {
            $draftSkpi = DraftSkpi::findOrFail($id);

            // Validasi: hanya draft/approved yang bisa difinalisasi
            if (!in_array($draftSkpi->status, ['draft', 'approved'])) {
                return back()->withErrors(['error' => 'Status SKPI tidak valid untuk difinalisasi']);
            }

            $draftSkpi->update([
                'status' => 'final_issued',
                'tanggal_pengesahan' => Carbon::now(),
            ]);

            return back()->with('success', 'SKPI berhasil difinalisasi!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal finalisasi SKPI: ' . $e->getMessage()]);
        }
    }

    /**
     * Approve draft SKPI.
     */
    public function approve($id)
    {
        try {
            $draftSkpi = DraftSkpi::findOrFail($id);

            if ($draftSkpi->status !== 'draft') {
                return back()->withErrors(['error' => 'Hanya draft yang bisa di-approve']);
            }

            $draftSkpi->update(['status' => 'approved']);

            return back()->with('success', 'Draft SKPI berhasil di-approve!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal approve SKPI: ' . $e->getMessage()]);
        }
    }

    /**
     * Reject draft SKPI.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|min:10',
        ], [
            'catatan.required' => 'Catatan penolakan wajib diisi',
            'catatan.min'      => 'Catatan minimal 10 karakter',
        ]);

        try {
            $draftSkpi = DraftSkpi::findOrFail($id);

            $draftSkpi->update([
                'status'  => 'rejected',
                'catatan' => $request->input('catatan'),
            ]);

            return back()->with('success', 'Draft SKPI ditolak dengan catatan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal reject SKPI: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete draft SKPI.
     */
    public function destroy($id)
    {
        try {
            $draftSkpi = DraftSkpi::findOrFail($id);

            // Validasi: hanya draft/rejected yang bisa dihapus
            if (!in_array($draftSkpi->status, ['draft', 'rejected'])) {
                return back()->withErrors(['error' => 'SKPI dengan status ini tidak dapat dihapus']);
            }

            // Hapus file jika ada
            if ($draftSkpi->file_path && file_exists(storage_path('app/public/' . $draftSkpi->file_path))) {
                @unlink(storage_path('app/public/' . $draftSkpi->file_path));
            }

            $draftSkpi->delete();

            return back()->with('success', 'Draft SKPI berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal hapus SKPI: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper: Generate nomor SKPI.
     * Format: 001/SKPI/TI/UMPAR/2025
     */
    private function generateNomorSkpi($mahasiswa)
    {
        $tahun = date('Y');

        $count = DraftSkpi::where('prodi_id', $mahasiswa->prodi_id)
            ->whereYear('created_at', $tahun)
            ->count() + 1;

        return sprintf(
            '%03d/SKPI/%s/UMPAR/%d',
            $count,
            strtoupper($mahasiswa->prodi->kode_prodi ?? 'XX'),
            $tahun
        );
    }
}
