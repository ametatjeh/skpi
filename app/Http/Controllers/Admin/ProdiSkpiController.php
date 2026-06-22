<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiSkpiController extends Controller
{
    /**
     * Halaman utama pengaturan SKPI per Prodi.
     */
    public function index(Request $request)
    {
        $prodiList = Prodi::orderBy('nama_prodi')->get();

        // prodi yang dipilih (default: yang pertama)
        $selectedProdiId = $request->input('prodi_id', $prodiList->first()->id ?? null);
        $selectedProdi   = $selectedProdiId
            ? Prodi::find($selectedProdiId)
            : null;

        return view('admin.prodi.skpi', compact('prodiList', 'selectedProdi', 'selectedProdiId'));
    }

    /**
     * Simpan update pengaturan SKPI untuk prodi tertentu.
     */
    public function update(Request $request, $prodi_id)
    {
        $prodi = Prodi::findOrFail($prodi_id);

        $data = $request->validate([
            'status_akreditasi'   => 'nullable|string|max:100',
            'nomor_sk_akreditasi' => 'nullable|string|max:255',
            'akses_lanjut'        => 'nullable|string|max:255',
            'status_profesi'      => 'nullable|string|max:255',
            'jenis_jenjang'       => 'nullable|string|max:255',
            'nama_prodi_en'       => 'nullable|string|max:255',
            'kkni_level'          => 'nullable|string|max:50',
        ]);

        $prodi->update($data);

        return redirect()
            ->route('admin.prodi.skpi.index', ['prodi_id' => $prodi_id])
            ->with('success', 'Pengaturan SKPI untuk prodi berhasil diperbarui.');
    }
}
