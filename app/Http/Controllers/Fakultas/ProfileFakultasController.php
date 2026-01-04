<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Fakultas;

class ProfileFakultasController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;

        return view('fakultas.profile.edit', compact('fakultas'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('fakultas')->user();
        $fakultas = $user->fakultas;

        $data = $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'dekan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:10',
            'no_sk' => 'nullable|string|max:50',
            'logo' => 'nullable|image'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $fakultas->update($data);

        return redirect()->back()->with('success', 'Profil fakultas berhasil diperbarui.');
    }
}
