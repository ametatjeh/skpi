<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalProdiController extends Controller
{
    /**
     * Display a listing of all prodi
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $prodi = Prodi::with('fakultas')
            ->withCount('mahasiswas')
            ->when($search, function ($query, $search) {
                return $query->where('nama_prodi', 'like', "%{$search}%")
                    ->orWhereHas('fakultas', function ($q) use ($search) {
                        $q->where('nama_fakultas', 'like', "%{$search}%");
                    });
            })
            ->orderBy('nama_prodi')
            ->paginate(20);

        return view('admin.total-prodi.index', compact('prodi', 'search'));
    }

    /**
     * Display the specified prodi
     */
    public function show($id)
    {
        $prodi = Prodi::with(['fakultas', 'mahasiswas'])
            ->withCount('mahasiswas')
            ->findOrFail($id);

        return view('admin.total-prodi.show', compact('prodi'));
    }

    /**
     * Show the form for creating a new prodi
     */
    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('admin.total-prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created prodi in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'kaprodi' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'no_sk' => 'nullable|string|max:255',
            'jenjang' => 'nullable|string|max:50',
            'kk_prodi' => 'nullable|string|max:50',
            'bahasa_pengantar' => 'nullable|string|max:100',
        ]);

        try {
            Prodi::create([
                'fakultas_id' => $request->fakultas_id,
                'nama_prodi' => $request->nama_prodi,
                'kaprodi' => $request->kaprodi,
                'akreditasi' => $request->akreditasi,
                'no_sk' => $request->no_sk,
                'jenjang' => $request->jenjang ?? 'S1',
                'kk_prodi' => $request->kk_prodi,
                'bahasa_pengantar' => $request->bahasa_pengantar ?? 'Indonesia',
            ]);

            return redirect()->route('admin.total-prodi.index')
                ->with('success', 'Data prodi berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan data prodi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified prodi
     */
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('admin.total-prodi.edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified prodi in storage
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'kaprodi' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'no_sk' => 'nullable|string|max:255',
            'jenjang' => 'nullable|string|max:50',
            'kk_prodi' => 'nullable|string|max:50',
            'bahasa_pengantar' => 'nullable|string|max:100',
        ]);

        try {
            $prodi = Prodi::findOrFail($id);
            $prodi->update([
                'fakultas_id' => $request->fakultas_id,
                'nama_prodi' => $request->nama_prodi,
                'kaprodi' => $request->kaprodi,
                'akreditasi' => $request->akreditasi,
                'no_sk' => $request->no_sk,
                'jenjang' => $request->jenjang,
                'kk_prodi' => $request->kk_prodi,
                'bahasa_pengantar' => $request->bahasa_pengantar,
            ]);

            return redirect()->route('admin.total-prodi.index')
                ->with('success', 'Data prodi berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate data prodi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified prodi from storage
     */
    public function destroy($id)
    {
        try {
            $prodi = Prodi::findOrFail($id);

            // Cek apakah ada mahasiswa yang terkait
            if ($prodi->mahasiswas()->count() > 0) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus prodi yang masih memiliki mahasiswa']);
            }

            $prodi->delete();

            return redirect()->route('admin.total-prodi.index')
                ->with('success', 'Data prodi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data prodi: ' . $e->getMessage()]);
        }
    }
}
