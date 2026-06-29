<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fakultas;
use App\Models\Prodi;

class MasterDataFakultasController extends Controller
{
    public function editFakultas()
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;
        return view('fakultas.master-data.fakultas.edit', compact('fakultas'));
    }

    public function updateFakultas(Request $request)
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;

        $data = $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'dekan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:10',
            'no_sk' => 'nullable|string|max:50',
        ]);

        $fakultas->update($data);

        return redirect()->back()->with('success', 'Data fakultas berhasil diperbarui.');
    }

    public function prodiIndex()
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;
        $prodis = Prodi::where('fakultas_id', $fakultas->id)->orderBy('nama_prodi')->get();

        return view('fakultas.master-data.prodi.index', compact('prodis', 'fakultas'));
    }
}
