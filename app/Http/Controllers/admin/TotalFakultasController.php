<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class TotalFakultasController extends Controller
{
    /**
     * Display a listing of all fakultas
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $fakultas = Fakultas::withCount(['prodis'])
            ->when($search, function ($query, $search) {
                return $query->where('nama_fakultas', 'like', "%{$search}%")
                    ->orWhere('dekan', 'like', "%{$search}%");
            })
            ->orderBy('nama_fakultas')
            ->paginate(20);

        return view('admin.total-fakultas.index', compact('fakultas', 'search'));
    }

    /**
     * Display the specified fakultas
     */
    public function show($id)
    {
        $fakultas = Fakultas::with(['prodis'])
            ->withCount(['prodis'])
            ->findOrFail($id);

        return view('admin.total-fakultas.show', compact('fakultas'));
    }

    /**
     * Show the form for creating a new fakultas
     */
    public function create()
    {
        return view('admin.total-fakultas.create');
    }

    /**
     * Store a newly created fakultas in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'dekan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'no_sk' => 'nullable|string|max:255',
        ]);

        try {
            Fakultas::create([
                'nama_fakultas' => $request->nama_fakultas,
                'dekan' => $request->dekan,
                'akreditasi' => $request->akreditasi,
                'no_sk' => $request->no_sk,
            ]);

            return redirect()->route('admin.total-fakultas.index')
                ->with('success', 'Data fakultas berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan data fakultas: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified fakultas
     */
    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('admin.total-fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified fakultas in storage
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'dekan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'no_sk' => 'nullable|string|max:255',
        ]);

        try {
            $fakultas = Fakultas::findOrFail($id);
            $fakultas->update([
                'nama_fakultas' => $request->nama_fakultas,
                'dekan' => $request->dekan,
                'akreditasi' => $request->akreditasi,
                'no_sk' => $request->no_sk,
            ]);

            return redirect()->route('admin.total-fakultas.index')
                ->with('success', 'Data fakultas berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate data fakultas: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified fakultas from storage
     */
    public function destroy($id)
    {
        try {
            $fakultas = Fakultas::findOrFail($id);

            // Cek apakah ada prodi yang terkait
            if ($fakultas->prodis()->count() > 0) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus fakultas yang masih memiliki prodi']);
            }

            $fakultas->delete();

            return redirect()->route('admin.total-fakultas.index')
                ->with('success', 'Data fakultas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data fakultas: ' . $e->getMessage()]);
        }
    }
}
