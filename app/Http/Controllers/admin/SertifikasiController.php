<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SertifikasiKompetensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    /**
     * Display a listing of sertifikasi (No Pagination, Scrollable)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 100); // Default 100

        $query = SertifikasiKompetensi::with(['mahasiswa.prodi'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nama_sertifikasi', 'like', "%{$search}%") // ✅ Field yang benar
                    ->orWhere('penerbit', 'like', "%{$search}%") // ✅ Field yang benar
                    ->orWhere('nomor_sertifikat', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc');

        // ✅ Ambil data tanpa pagination
        if ($perPage == 'all') {
            $sertifikasiList = $query->get();
        } else {
            $sertifikasiList = $query->limit((int)$perPage)->get();
        }

        return view('admin.sertifikasi.index', compact('sertifikasiList', 'search'));
    }

    /**
     * Display the specified sertifikasi
     */
    public function show($id)
    {
        $sertifikasi = SertifikasiKompetensi::with(['mahasiswa.prodi'])->findOrFail($id);
        return view('admin.sertifikasi.show', compact('sertifikasi'));
    }

    /**
     * Remove the specified sertifikasi from storage
     */
    public function destroy($id)
    {
        try {
            $sertifikasi = SertifikasiKompetensi::findOrFail($id);

            // ✅ Hapus file sertifikat jika ada (field: file_path)
            if ($sertifikasi->file_path && file_exists(storage_path('app/public/' . $sertifikasi->file_path))) {
                unlink(storage_path('app/public/' . $sertifikasi->file_path));
            }

            $sertifikasi->delete();

            return redirect()->route('admin.sertifikasi.index')
                ->with('success', 'Data sertifikasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data sertifikasi: ' . $e->getMessage()]);
        }
    }
}
