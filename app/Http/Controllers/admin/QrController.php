<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qr;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        $data = Qr::all();
        return view('admin.pengaturan.qr.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Qr::findOrFail($id)->update($request->all());
        return back()->with('success', 'QR Code diperbarui');
    }
}
