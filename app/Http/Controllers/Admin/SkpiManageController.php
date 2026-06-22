<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skpi;

class SkpiManageController extends Controller
{
    public function index()
    {
        $skpi = Skpi::latest()->paginate(20);
        return view('admin.skpi.index', compact('skpi'));
    }

    public function pending()
    {
        $pending = Skpi::where('status', 'pending')->latest()->paginate(20);
        return view('admin.skpi.pending', compact('pending'));
    }

    public function detail($id)
    {
        $skpi = Skpi::findOrFail($id);
        return view('admin.skpi.detail', compact('skpi'));
    }

    public function approve($id)
    {
        $skpi = Skpi::findOrFail($id);
        $skpi->status = 'approved';
        $skpi->save();

        return back()->with('success', 'SKPI berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $skpi = Skpi::findOrFail($id);
        $skpi->status = 'rejected';
        $skpi->alasan = $request->alasan;
        $skpi->save();

        return back()->with('success', 'SKPI ditolak.');
    }
}
