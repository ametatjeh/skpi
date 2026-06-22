<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokBlanko;
use Illuminate\Http\Request;

class BlankoController extends Controller
{
    public function index()
    {
        $data = StokBlanko::latest()->get();
        // Calculate total summary
        $totalMasuk = StokBlanko::sum('jumlah_masuk');
        $totalKeluar = StokBlanko::sum('jumlah_keluar');
        $stokTersedia = $totalMasuk - $totalKeluar;

        return view('admin.pengaturan.blanko.index', compact('data', 'totalMasuk', 'totalKeluar', 'stokTersedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pengadaan' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:0',
            'jumlah_keluar' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $stok_tersisa = $request->jumlah_masuk - $request->jumlah_keluar;

        StokBlanko::create([
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'stok_tersisa' => $stok_tersisa,
            'keterangan' => $request->keterangan,
            'petugas_id' => auth()->id(),
        ]);

        return back()->with('success', 'Data stok blanko berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pengadaan' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:0',
            'jumlah_keluar' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $stok = StokBlanko::findOrFail($id);
        $stok_tersisa = $request->jumlah_masuk - $request->jumlah_keluar;

        $stok->update([
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'stok_tersisa' => $stok_tersisa,
            'keterangan' => $request->keterangan,
            'petugas_id' => auth()->id(),
        ]);

        return back()->with('success', 'Data stok blanko berhasil diperbarui');
    }

    public function destroy($id)
    {
        StokBlanko::findOrFail($id)->delete();
        return back()->with('success', 'Data stok blanko berhasil dihapus');
    }
}
