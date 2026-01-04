<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blanko;
use Illuminate\Http\Request;

class BlankoController extends Controller
{
    public function index()
    {
        $data = Blanko::all();
        return view('admin.pengaturan.blanko.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Blanko::findOrFail($id)->update($request->all());
        return back()->with('success', 'Blanko diperbarui');
    }
}
