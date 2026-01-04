<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, KaryaIlmiah};
use Illuminate\Support\Facades\Storage;

class KaryaIlmiahController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $karya_ilmiah = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.karya-ilmiah.list', compact('karya_ilmiah'));
    }

    public function create()
    {
        return view('mahasiswa.karya-ilmiah.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'judul_karya' => 'required|string|max:255',
            'jenis_publikasi' => 'required|in:jurnal,prosiding,konferensi,seminar,lainnya',
            'nama_jurnal_konferensi' => 'required|string|max:255',
            'tahun_publikasi' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'doi_issn' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('karya_ilmiah', 'public');
        }

        // ✅ Determine status
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        // Create
        KaryaIlmiah::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);

        if ($status === 'submitted') {
            return redirect()->route('mahasiswa.karya.list')
                ->with('success', '✅ Karya ilmiah berhasil diajukan untuk verifikasi!');
        } else {
            return redirect()->route('mahasiswa.karya.list')
                ->with('info', '💾 Karya ilmiah disimpan sebagai draft.');
        }
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $karya = KaryaIlmiah::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'draft')
            ->firstOrFail();

        $karya->status = 'submitted';
        $karya->save();

        return redirect()->route('mahasiswa.karya.list')
            ->with('success', '✅ Karya ilmiah berhasil diajukan untuk verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $karya_ilmiah = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        return view('mahasiswa.karya-ilmiah.edit', compact('karya_ilmiah'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $karya_ilmiah = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        $validated = $request->validate([
            'judul_karya' => 'required|string|max:255',
            'jenis_publikasi' => 'required|in:jurnal,prosiding,konferensi,seminar,lainnya',
            'nama_jurnal_konferensi' => 'required|string|max:255',
            'tahun_publikasi' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'doi_issn' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            if ($karya_ilmiah->file_path && Storage::disk('public')->exists($karya_ilmiah->file_path)) {
                Storage::disk('public')->delete($karya_ilmiah->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('karya_ilmiah', 'public');
        }

        $karya_ilmiah->update($validated);

        return redirect()->route('mahasiswa.karya.list')
            ->with('success', '✅ Karya ilmiah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $karya_ilmiah = KaryaIlmiah::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        // Hapus file jika ada
        if ($karya_ilmiah->file_path && Storage::disk('public')->exists($karya_ilmiah->file_path)) {
            Storage::disk('public')->delete($karya_ilmiah->file_path);
        }

        $karya_ilmiah->delete();

        return redirect()->route('mahasiswa.karya.list')
            ->with('success', '✅ Karya ilmiah berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $karya_ilmiah = KaryaIlmiah::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('mahasiswa.karya-ilmiah.show', compact('karya_ilmiah'));
    }
}
