<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;
use App\Services\SkpiPdfService; // ← IMPORT SERVICE
use Illuminate\Http\Request;

class SkpiFinalController extends Controller
{
    protected $skpiPdfService;

    // ✅ INJECT SERVICE
    public function __construct(SkpiPdfService $skpiPdfService)
    {
        $this->skpiPdfService = $skpiPdfService;
    }

    /**
     * Daftar SKPI yang sudah final.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $finalSkpiList = DraftSkpi::with(['mahasiswa.prodi', 'prodi'])
            ->where('status', 'final_issued')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nomor_skpi', 'like', "%{$search}%");
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(20); // ← TAMBAHKAN PAGINATION

        return view('admin.draft.final', compact('finalSkpiList', 'search'));
    }

    /**
     * ✅ Preview SKPI final - PAKAI SERVICE
     */
    public function preview($id)
    {
        $draftSkpi = DraftSkpi::with(['mahasiswa.prodi.fakultas'])->findOrFail($id);

        // Validasi: hanya final yang bisa di-preview
        if ($draftSkpi->status !== 'final_issued') {
            abort(403, 'SKPI ini belum final');
        }

        $data = $this->skpiPdfService->getSkpiData($id);

        return view('admin.draft.preview', array_merge(['draftSkpi' => $draftSkpi], $data));
    }

    /**
     * ✅ Download PDF - PAKAI SERVICE
     */
    public function downloadPdf($id)
    {
        // Validasi: hanya final yang bisa didownload
        $draftSkpi = DraftSkpi::findOrFail($id);

        if ($draftSkpi->status !== 'final_issued') {
            return back()->withErrors(['error' => 'Hanya SKPI final yang bisa didownload']);
        }

        return $this->skpiPdfService->downloadPdf($id);
    }

    /**
     * ✅ Stream PDF - PAKAI SERVICE
     */
    public function streamPdf($id)
    {
        $draftSkpi = DraftSkpi::findOrFail($id);

        if ($draftSkpi->status !== 'final_issued') {
            abort(403, 'Hanya SKPI final yang bisa dibuka');
        }

        return $this->skpiPdfService->streamPdf($id);
    }

    /**
     * Bulk download PDF (ZIP).
     */
    public function bulkDownload(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->withErrors(['error' => 'Pilih minimal 1 SKPI untuk didownload']);
        }

        // Validasi: semua harus final_issued
        $count = DraftSkpi::whereIn('id', $ids)
            ->where('status', 'final_issued')
            ->count();

        if ($count !== count($ids)) {
            return back()->withErrors(['error' => 'Beberapa SKPI belum final']);
        }

        // TODO: Implement bulk download ZIP
        return back()->with('info', 'Fitur bulk download dalam pengembangan');
    }

    /**
     * Export daftar SKPI ke Excel.
     */
    public function exportExcel(Request $request)
    {
        // TODO: Implement Excel export
        return back()->with('info', 'Fitur export Excel dalam pengembangan');
    }
}
