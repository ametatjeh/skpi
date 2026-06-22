<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Prestasi, SertifikasiKompetensi, Organisasi, PengabdianMasyarakat};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    /**
     * Display a listing of all documents
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // ✅ Kumpulkan semua dokumen dari berbagai kategori
        $dokumenList = collect();

        // Prestasi
        $prestasi = Prestasi::with(['mahasiswa.prodi'])
            ->whereNotNull('file_path')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kategori' => 'Prestasi',
                    'judul' => $item->judul_prestasi,
                    'mahasiswa' => $item->mahasiswa,
                    'file_path' => $item->file_path,
                    'created_at' => $item->created_at,
                    'status' => $item->status,
                ];
            });

        // Sertifikasi
        $sertifikasi = SertifikasiKompetensi::with(['mahasiswa.prodi'])
            ->whereNotNull('file_path')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kategori' => 'Sertifikasi',
                    'judul' => $item->nama_sertifikasi,
                    'mahasiswa' => $item->mahasiswa,
                    'file_path' => $item->file_path,
                    'created_at' => $item->created_at,
                    'status' => $item->status,
                ];
            });

        // Organisasi
        $organisasi = Organisasi::with(['mahasiswa.prodi'])
            ->whereNotNull('file_path')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kategori' => 'Organisasi',
                    'judul' => $item->nama_organisasi,
                    'mahasiswa' => $item->mahasiswa,
                    'file_path' => $item->file_path,
                    'created_at' => $item->created_at,
                    'status' => $item->status,
                ];
            });

        // PKM
        $pkm = PengabdianMasyarakat::with(['mahasiswa.prodi'])
            ->whereNotNull('file_path')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kategori' => 'PKM',
                    'judul' => $item->judul_pkm,
                    'mahasiswa' => $item->mahasiswa,
                    'file_path' => $item->file_path,
                    'created_at' => $item->created_at,
                    'status' => $item->status,
                ];
            });

        // ✅ Gabungkan semua
        $dokumenList = $dokumenList->merge($prestasi)
            ->merge($sertifikasi)
            ->merge($organisasi)
            ->merge($pkm);

        // ✅ Filter berdasarkan kategori
        if ($kategori) {
            $dokumenList = $dokumenList->where('kategori', $kategori);
        }

        // ✅ Sort by created_at desc
        $dokumenList = $dokumenList->sortByDesc('created_at')->values();

        return view('admin.dokumen.index', compact('dokumenList', 'search', 'kategori'));
    }

    /**
     * Download dokumen
     */
    public function download($kategori, $id)
    {
        $model = $this->getModel($kategori);
        $item = $model::findOrFail($id);

        if (!$item->file_path || !Storage::disk('public')->exists($item->file_path)) {
            return back()->withErrors(['error' => 'File tidak ditemukan']);
        }

        return Storage::disk('public')->download($item->file_path);
    }

    /**
     * Helper: Get model by kategori
     */
    private function getModel($kategori)
    {
        return match ($kategori) {
            'Prestasi' => Prestasi::class,
            'Sertifikasi' => SertifikasiKompetensi::class,
            'Organisasi' => Organisasi::class,
            'PKM' => PengabdianMasyarakat::class,
            default => abort(404),
        };
    }
}
