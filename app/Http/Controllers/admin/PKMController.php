<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengabdianMasyarakat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PKMController extends Controller
{
    /**
     * Display a listing of PKM (No Pagination, Scrollable)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $skema = $request->input('skema');
        $perPage = $request->input('per_page', 100); // Default 100

        $query = PengabdianMasyarakat::with(['mahasiswa.prodi'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('judul_pkm', 'like', "%{$search}%") // ✅ Field yang benar
                    ->orWhere('pendanaan', 'like', "%{$search}%") // ✅ Bonus: Bisa cari pendanaan
                    ->orWhere('deskripsi', 'like', "%{$search}%"); // ✅ Bonus: Bisa cari deskripsi
            })
            ->when($skema, function ($q) use ($skema) {
                $q->where('skema', $skema);
            })
            ->orderBy('created_at', 'desc');

        // ✅ Ambil data tanpa pagination (untuk scrollable table)
        if ($perPage == 'all') {
            $pkmList = $query->get();
        } else {
            $pkmList = $query->limit((int)$perPage)->get();
        }

        return view('admin.pkm.index', compact('pkmList', 'search', 'skema'));
    }

    /**
     * Display the specified PKM
     */
    public function show($id)
    {
        $pkm = PengabdianMasyarakat::with(['mahasiswa.prodi'])->findOrFail($id);
        return view('admin.pkm.show', compact('pkm'));
    }

    /**
     * Remove the specified PKM from storage
     */
    public function destroy($id)
    {
        try {
            $pkm = PengabdianMasyarakat::findOrFail($id);

            // ✅ Hapus file proposal jika ada (support 2 field names)
            $filePath = $pkm->file_path ?? $pkm->file_proposal;

            if ($filePath && file_exists(storage_path('app/public/' . $filePath))) {
                unlink(storage_path('app/public/' . $filePath));
            }

            $pkm->delete();

            return redirect()->route('admin.pkm.index')
                ->with('success', 'Data PKM berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data PKM: ' . $e->getMessage()]);
        }
    }
}
