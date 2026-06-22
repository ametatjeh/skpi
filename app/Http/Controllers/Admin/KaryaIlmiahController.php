<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;

class KaryaIlmiahController extends Controller
{
    public function index()
    {
        $data = KaryaIlmiah::all();
        return view('admin.karyailmiah.index', compact('data'));
    }

    public function edit($id)
    {
        $row = KaryaIlmiah::findOrFail($id);
        return view('admin.karyailmiah.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        KaryaIlmiah::findOrFail($id)->update($request->all());
        return back()->with('success', 'Karya Ilmiah diperbarui');
    }

    public function destroy($id)
    {
        KaryaIlmiah::findOrFail($id)->delete();
        return back()->with('success', 'Karya Ilmiah dihapus');
    }
}
