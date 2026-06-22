<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of organisasi (No Pagination, Scrollable)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 100); // Default 100

        $query = Organisasi::with(['mahasiswa.prodi'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nama_organisasi', 'like', "%{$search}%")
                    ->orWhere('posisi', 'like', "%{$search}%")
                    ->orWhere('deskripsi_peran', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc');

        // ✅ Ambil data tanpa pagination
        if ($perPage == 'all') {
            $organisasiList = $query->get();
        } else {
            $organisasiList = $query->limit((int)$perPage)->get();
        }

        return view('admin.organisasi.index', compact('organisasiList', 'search'));
    }

    /**
     * Display the specified organisasi
     */
    public function show($id)
    {
        $organisasi = Organisasi::with(['mahasiswa.prodi'])->findOrFail($id);
        return view('admin.organisasi.show', compact('organisasi'));
    }

    /**
     * Remove the specified organisasi from storage
     */
    public function destroy($id)
    {
        try {
            $organisasi = Organisasi::findOrFail($id);

            // ✅ Hapus file jika ada
            if ($organisasi->file_path && file_exists(storage_path('app/public/' . $organisasi->file_path))) {
                unlink(storage_path('app/public/' . $organisasi->file_path));
            }

            $organisasi->delete();

            return redirect()->route('admin.organisasi.index')
                ->with('success', 'Data organisasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data organisasi: ' . $e->getMessage()]);
        }
    }
}
