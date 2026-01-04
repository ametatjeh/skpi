<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('fakultas')->user();

        // Notifikasi milik operator fakultas
        $notifikasi = Notifikasi::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('fakultas.notifikasi.index', compact('notifikasi'));
    }

    public function markAsRead($id)
    {
        $user = Auth::guard('fakultas')->user();
        $notif = Notifikasi::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $notif->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}
