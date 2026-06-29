<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dekan;
use Illuminate\Support\Facades\Auth;

class DekanController extends Controller
{
    public function create()
    {
        return view('fakultas.pejabat.dekan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);
        $data['fakultas_id'] = Auth::guard('fakultas')->user()->fakultas_id;

        Dekan::create($data);

        return redirect()->route('fakultas.pejabat.index')->with('success', 'Data dekan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dekan = Dekan::findOrFail($id);
        return view('fakultas.pejabat.dekan.edit', compact('dekan'));
    }

    public function update(Request $request, $id)
    {
        $dekan = Dekan::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);
        $dekan->update($data);

        return redirect()->route('fakultas.pejabat.index')->with('success', 'Data dekan berhasil diperbarui.');
    }
}
