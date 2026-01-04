<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use App\Models\{DraftSkpi, VerifikasiSkpi};
use App\Services\SkpiPdfService; // ← IMPORT SERVICE
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    protected $skpiPdfService;

    // ✅ INJECT SERVICE VIA CONSTRUCTOR
    public function __construct(SkpiPdfService $skpiPdfService)
    {
        $this->skpiPdfService = $skpiPdfService;
    }

    /**
     * List arsip SKPI (status final_issued)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $arsipSkpi = DraftSkpi::with(['mahasiswa.prodi'])
            ->where('status', 'final_issued')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nomor_skpi', 'like', "%{$search}%");
            })
            ->orderByDesc('updated_at')
            ->paginate(20); // ← TAMBAHKAN PAGINATION

        return view('pusat.arsip.index', compact('arsipSkpi', 'search'));
    }

    /**
     * Detail satu SKPI (show blade)
     */
    public function show($id)
    {
        $arsip = DraftSkpi::with([
            'mahasiswa.prodi.fakultas',
        ])->findOrFail($id);

        // Validasi: hanya final_issued yang bisa dilihat
        if ($arsip->status !== 'final_issued') {
            abort(403, 'SKPI ini belum final');
        }

        // ✅ AMBIL DATA DARI SERVICE (opsional untuk show)
        $data = $this->skpiPdfService->getSkpiData($id);

        return view('pusat.arsip.show', array_merge(['arsip' => $arsip], $data));
    }

    /**
     * ✅ Download PDF - PAKAI SERVICE
     */
    public function downloadPdf($id)
    {
        // Validasi: hanya final_issued yang bisa didownload
        $draftSkpi = DraftSkpi::findOrFail($id);

        if ($draftSkpi->status !== 'final_issued') {
            return back()->withErrors(['error' => 'Hanya SKPI final yang bisa didownload']);
        }

        // ✅ PAKAI SERVICE
        return $this->skpiPdfService->downloadPdf($id);
    }

    /**
     * ✅ Preview/Stream PDF di browser - PAKAI SERVICE
     */
    public function streamPdf($id)
    {
        $draftSkpi = DraftSkpi::findOrFail($id);

        if ($draftSkpi->status !== 'final_issued') {
            abort(403, 'Hanya SKPI final yang bisa dibuka');
        }

        // ✅ PAKAI SERVICE
        return $this->skpiPdfService->streamPdf($id);
    }

    /**
     * Export daftar arsip ke Excel (opsional)
     */
    public function exportExcel(Request $request)
    {
        // TODO: Implement Excel export
        return back()->with('info', 'Fitur export Excel dalam pengembangan');
    }

    /**
     * Statistik arsip SKPI
     */
    public function statistik()
    {
        $totalArsip = DraftSkpi::where('status', 'final_issued')->count();

        $perProdi = DraftSkpi::where('status', 'final_issued')
            ->with('prodi')
            ->selectRaw('prodi_id, count(*) as total')
            ->groupBy('prodi_id')
            ->get();

        $perTahun = DraftSkpi::where('status', 'final_issued')
            ->selectRaw('tahun_lulus, count(*) as total')
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->get();

        return view('pusat.arsip.statistik', compact('totalArsip', 'perProdi', 'perTahun'));
    }
}
