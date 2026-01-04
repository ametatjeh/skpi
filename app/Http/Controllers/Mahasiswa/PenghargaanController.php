<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Penghargaan};
use Illuminate\Support\Facades\Storage;

class PenghargaanController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $penghargaan = Penghargaan::where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.penghargaan.list', compact('penghargaan'));
    }

    public function create()
    {
        return view('mahasiswa.penghargaan.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,universitas,kampus',
            'pemberi_penghargaan' => 'required|string|max:255',
            'tahun_perolehan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('penghargaan', 'public');
        }

        // ✅ Determine status
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        // Create
        Penghargaan::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);

        if ($status === 'submitted') {
            return redirect()->route('mahasiswa.penghargaan.list')
                ->with('success', '✅ Penghargaan berhasil diajukan untuk verifikasi!');
        } else {
            return redirect()->route('mahasiswa.penghargaan.list')
                ->with('info', '💾 Penghargaan disimpan sebagai draft.');
        }
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $penghargaan = Penghargaan::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'draft')
            ->firstOrFail();

        $penghargaan->status = 'submitted';
        $penghargaan->save();

        return redirect()->route('mahasiswa.penghargaan.list')
            ->with('success', '✅ Penghargaan berhasil diajukan untuk verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $penghargaan = Penghargaan::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        return view('mahasiswa.penghargaan.edit', compact('penghargaan'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $penghargaan = Penghargaan::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        $validated = $request->validate([
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,universitas,kampus',
            'pemberi_penghargaan' => 'required|string|max:255',
            'tahun_perolehan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            if ($penghargaan->file_path && Storage::disk('public')->exists($penghargaan->file_path)) {
                Storage::disk('public')->delete($penghargaan->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('penghargaan', 'public');
        }

        $penghargaan->update($validated);

        return redirect()->route('mahasiswa.penghargaan.list')
            ->with('success', '✅ Penghargaan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $penghargaan = Penghargaan::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();

        // Hapus file jika ada
        if ($penghargaan->file_path && Storage::disk('public')->exists($penghargaan->file_path)) {
            Storage::disk('public')->delete($penghargaan->file_path);
        }

        $penghargaan->delete();

        return redirect()->route('mahasiswa.penghargaan.list')
            ->with('success', '✅ Penghargaan berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $penghargaan = Penghargaan::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('mahasiswa.penghargaan.show', compact('penghargaan'));
    }
}
