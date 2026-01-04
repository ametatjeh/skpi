<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cpl;

class ProdiCplController extends Controller
{
    public function index(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;

        $cpl = Cpl::where('prodi_id', $prodiId)
            ->ordered()
            ->get();

        return view('prodi.cpl.index', compact('cpl'));
    }

    public function create()
    {
        return view('prodi.cpl.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:50|unique:cpl,kode',
            'kategori' => 'required|string|in:sikap,pengetahuan,keterampilan_umum,keterampilan_khusus',
            'deskripsi' => 'required|string',
            'urutan' => 'nullable|integer|min:1'
        ]);

        try {
            // Get max urutan for this prodi
            $maxUrutan = Cpl::where('prodi_id', auth()->user()->prodi_id)->max('urutan') ?? 0;

            Cpl::create([
                'prodi_id' => auth()->user()->prodi_id,
                'kode' => $request->kode,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'status' => 1,
                'urutan' => $request->urutan ?? ($maxUrutan + 1)
            ]);

            return redirect()
                ->route('prodi.cpl.index')
                ->with('success', 'CPL berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambah CPL: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $cpl = Cpl::where('prodi_id', auth()->user()->prodi_id)->findOrFail($id);
        return view('prodi.cpl.edit', compact('cpl'));
    }

    public function update(Request $request, $id)
    {
        $cpl = Cpl::where('prodi_id', auth()->user()->prodi_id)->findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:50|unique:cpl,kode,' . $id,
            'kategori' => 'required|string|in:sikap,pengetahuan,keterampilan_umum,keterampilan_khusus',
            'deskripsi' => 'required|string',
            'status' => 'required|in:0,1',
            'urutan' => 'nullable|integer|min:1'
        ]);

        try {
            $cpl->update([
                'kode' => $request->kode,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
                'urutan' => $request->urutan ?? $cpl->urutan
            ]);

            return redirect()
                ->route('prodi.cpl.index')
                ->with('success', 'CPL berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal update CPL: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $cpl = Cpl::where('prodi_id', auth()->user()->prodi_id)->findOrFail($id);
            $cpl->delete();

            return redirect()
                ->route('prodi.cpl.index')
                ->with('success', 'CPL berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal hapus CPL: ' . $e->getMessage());
        }
    }
}
