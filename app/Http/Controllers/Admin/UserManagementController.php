<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProdiUser;
use App\Models\FakultasUser;
use App\Models\PusatBahasaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        // Tampilkan semua user utama (table users)
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Form create user admin / operator umum
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|string', // misal: admin, superadmin
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Jika nanti pakai table role_assignments, bisa diset di sini

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // AMANKAN DATA MAHASISWA
        // Cek apakah user ini terhubung ke data mahasiswa
        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();
        
        if ($mahasiswa) {
            // Putuskan hubungan (Set user_id jadi NULL)
            $mahasiswa->update(['user_id' => null]);
            $msg = 'User berhasil dihapus. Data Mahasiswa terkait (' . $mahasiswa->nama . ') TETAP AMAN (tidak terhapus).';
        } else {
            $msg = 'User berhasil dihapus.';
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', $msg);
    }
}
