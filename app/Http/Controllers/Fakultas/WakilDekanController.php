<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WakilDekan;
use Illuminate\Support\Facades\Auth;

class WakilDekanController extends Controller
{
    public function create()
    {
        return view('fakultas.pejabat.wakil-dekan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'bidang' => 'nullable|string|max:100',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);
        $data['fakultas_id'] = Auth::guard('fakultas')->user()->fakultas_id;

        WakilDekan::create($data);

        return redirect()->route('fakultas.pejabat.index')->with('success', 'Data wakil dekan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wakilDekan = WakilDekan::findOrFail($id);
        return view('fakultas.pejabat.wakil-dekan.edit', compact('wakilDekan'));
    }

    public function update(Request $request, $id)
    {
        $wakilDekan = WakilDekan::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'bidang' => 'nullable|string|max:100',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);
        $wakilDekan->update($data);

        return redirect()->route('fakultas.pejabat.index')->with('success', 'Data wakil dekan berhasil diperbarui.');
    }
}
