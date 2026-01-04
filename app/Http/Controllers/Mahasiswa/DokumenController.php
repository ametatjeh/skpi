<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, DokumenPendukung};

class DokumenController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $dokumen = DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->orderBy('created_at', 'desc')->get();
        return view('mahasiswa.dokumen.index', compact('dokumen'));
    }

    public function uploadForm()
    {
        return view('mahasiswa.dokumen.upload');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'jenis_dokumen' => 'required|string|max:100',
            'file_path' => 'required|file|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('dokumen_pendukung', 'public');
            DokumenPendukung::create([
                'mahasiswa_id' => $mahasiswa->id,
                'nama_dokumen' => $validated['nama_dokumen'],
                'jenis_dokumen' => $validated['jenis_dokumen'],
                'file_path' => $path,
                'ukuran_file' => $file->getSize(),
                'tipe_file' => $file->getMimeType(),
                'status' => 'uploaded'
            ]);
        }

        return redirect()->route('mahasiswa.dokumen.index')->with('success', 'Dokumen berhasil diupload!');
    }

    public function download($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $dokumen = DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->findOrFail($id);
        return response()->download(storage_path('app/public/' . $dokumen->file_path));
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $dokumen = DokumenPendukung::where('mahasiswa_id', $mahasiswa->id)->findOrFail($id);
        if (file_exists(storage_path('app/public/' . $dokumen->file_path))) unlink(storage_path('app/public/' . $dokumen->file_path));
        $dokumen->delete();
        return redirect()->route('mahasiswa.dokumen.index')->with('success', 'Dokumen berhasil dihapus!');
    }
}
