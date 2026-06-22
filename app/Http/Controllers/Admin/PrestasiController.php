<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of prestasi (No Pagination, Scrollable)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 100); // Default 100

        $query = Prestasi::with(['mahasiswa.prodi'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('judul_prestasi', 'like', "%{$search}%")
                    ->orWhere('penyelenggara', 'like', "%{$search}%")
                    ->orWhere('tingkat', 'like', "%{$search}%"); // ✅ Bonus: Bisa cari tingkat
            })
            ->orderBy('created_at', 'desc');

        // ✅ Ambil data tanpa pagination
        if ($perPage == 'all') {
            $prestasi = $query->get();
        } else {
            $prestasi = $query->limit((int)$perPage)->get();
        }

        return view('admin.prestasi.index', compact('prestasi', 'search'));
    }

    /**
     * Display the specified prestasi
     */
    public function show($id)
    {
        $prestasi = Prestasi::with(['mahasiswa.prodi'])->findOrFail($id);
        return view('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Remove the specified prestasi from storage
     */
    public function destroy($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            // ✅ Hapus file jika ada
            if ($prestasi->file_path && file_exists(storage_path('app/public/' . $prestasi->file_path))) {
                unlink(storage_path('app/public/' . $prestasi->file_path));
            }

            $prestasi->delete();

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Data prestasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data prestasi: ' . $e->getMessage()]);
        }
    }
}
