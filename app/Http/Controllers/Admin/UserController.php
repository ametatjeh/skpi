<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProdiUser;
use App\Models\FakultasUser;
use App\Models\PusatBahasaUser;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * ============================================
     * HALAMAN UTAMA - ALL USERS
     * ============================================
     */
    public function index(Request $request)
    {
        $search = $request->input('search', null);

        $mahasiswa = Mahasiswa::select(
            'mahasiswa.id',
            DB::raw("mahasiswa.nama COLLATE utf8mb4_unicode_ci as name"),
            DB::raw("COALESCE(users.email, mahasiswa.email) COLLATE utf8mb4_unicode_ci as email"),
            'mahasiswa.nim as identifier',
            DB::raw("'mahasiswa' COLLATE utf8mb4_unicode_ci as user_type"),
            DB::raw("COALESCE(users.role, 'mahasiswa') COLLATE utf8mb4_unicode_ci as role")
        )
            ->leftJoin('users', 'users.id', '=', 'mahasiswa.user_id')
            ->when($search, function ($q) use ($search) {
                $q->where('mahasiswa.nama', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('mahasiswa.email', 'like', "%{$search}%")
                    ->orWhere('mahasiswa.nim', 'like', "%{$search}%");
            });

        $otherUsers = DB::table('users')->select(
            'users.id',
            DB::raw("users.name COLLATE utf8mb4_unicode_ci as name"),
            DB::raw("users.email COLLATE utf8mb4_unicode_ci as email"),
            DB::raw("COALESCE(users.prodi_id, users.fakultas_id) as identifier"),
            DB::raw("users.role COLLATE utf8mb4_unicode_ci as user_type"),
            DB::raw("users.role COLLATE utf8mb4_unicode_ci as role")
        )
            ->whereIn('users.role', ['prodi', 'fakultas', 'pusat_bahasa'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('users.name', 'like', "%{$search}%")
                        ->orWhere('users.email', 'like', "%{$search}%");
                });
            });

        $unionQuery = $mahasiswa->unionAll($otherUsers);

        $paginatedUsers = $unionQuery->paginate(10);

        return view('admin.users.index', compact('paginatedUsers', 'search'));
    }

    /**
     * ============================================
     * MAHASISWA
     * ============================================
     */
    public function mahasiswa()
    {
        $users = Mahasiswa::select(
            'mahasiswa.*',
            DB::raw('COALESCE(users.email, mahasiswa.email) as email')
        )
            ->with('prodi')
            ->leftJoin('users', 'users.id', '=', 'mahasiswa.user_id')
            ->orderBy('mahasiswa.created_at', 'desc')
            ->get();

        $title = "Mahasiswa";

        return view('admin.users.mahasiswa', compact('users', 'title'));
    }
    /**
     * ============================================
     * UNIVERSAL UPDATE (Support All User Types)
     * ============================================
     */
    public function update(Request $request, $id)
    {
        $userType = $request->input('user_type');

        switch ($userType) {
            case 'prodi':
                return $this->updateProdi($request, $id);

            case 'fakultas':
                return $this->updateFakultas($request, $id);

            case 'pusat_bahasa':
                return $this->updatePusatBahasa($request, $id);

            default:
                return back()->withErrors(['error' => 'Tipe user tidak valid']);
        }
    }

    /**
     * Update prodi user
     */
    public function updateProdi(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'prodi_id' => 'required|exists:prodi,id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            $prodiUser = ProdiUser::findOrFail($id);

            $prodiUser->name = $request->name;
            $prodiUser->email = $request->email;
            $prodiUser->prodi_id = $request->prodi_id;

            // Update password jika diisi
            if ($request->filled('password')) {
                $prodiUser->password = Hash::make($request->password);
            }

            $prodiUser->save();

            return redirect()->route('admin.users.prodi')
                ->with('success', 'User prodi berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate user prodi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Update fakultas user
     */
    public function updateFakultas(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'fakultas_id' => 'required|exists:fakultas,id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            $fakultasUser = FakultasUser::findOrFail($id);

            $fakultasUser->name = $request->name;
            $fakultasUser->email = $request->email;
            $fakultasUser->fakultas_id = $request->fakultas_id;

            // Update password jika diisi
            if ($request->filled('password')) {
                $fakultasUser->password = Hash::make($request->password);
            }

            $fakultasUser->save();

            return redirect()->route('admin.users.fakultas')
                ->with('success', 'User fakultas berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate user fakultas: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Update pusat bahasa user
     */
    public function updatePusatBahasa(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            $pusatBahasaUser = PusatBahasaUser::findOrFail($id);

            $pusatBahasaUser->name = $request->name;
            $pusatBahasaUser->email = $request->email;

            // Update password jika diisi
            if ($request->filled('password')) {
                $pusatBahasaUser->password = Hash::make($request->password);
            }

            $pusatBahasaUser->save();

            return redirect()->route('admin.users.pusat-bahasa')
                ->with('success', 'User pusat bahasa berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate user pusat bahasa: ' . $e->getMessage()])
                ->withInput();
        }
    }


    /**
     * ============================================
     * PRODI
     * ============================================
     */
    public function prodi()
    {
        $users = ProdiUser::with('prodi.fakultas')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $title = "Prodi";

        return view('admin.users.prodi', compact('users', 'title'));
    }

    /**
     * Form create prodi user
     */
    public function createProdi()
    {
        $fakultasList = Fakultas::orderBy('nama_fakultas')->get();
        return view('admin.users.create-prodi', compact('fakultasList'));
    }

    /**
     * Store prodi user (hanya insert ke prodi_users, prodi sudah ada)
     */
    public function storeProdi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        try {
            ProdiUser::create([
                'prodi_id' => $request->prodi_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'prodi',
                'is_activated' => 1,
            ]);

            return redirect()->route('admin.users.prodi')
                ->with('success', 'User prodi berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan user prodi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show detail prodi user
     */
    public function showProdi($id)
    {
        $prodiUser = ProdiUser::with('prodi.fakultas')->findOrFail($id);
        return view('admin.users.show-prodi', compact('prodiUser'));
    }

    /**
     * Edit prodi user form
     */
    public function editProdi($id)
    {
        $prodiUser = ProdiUser::with('prodi.fakultas')->findOrFail($id);
        $fakultasList = Fakultas::with('prodis')->orderBy('nama_fakultas')->get();
        return view('admin.users.edit-prodi', compact('prodiUser', 'fakultasList'));
    }

    /**
     * Delete prodi user
     */
    public function destroyProdi($id)
    {
        try {
            $prodiUser = ProdiUser::findOrFail($id);
            $prodiUser->delete();

            return redirect()->route('admin.users.prodi')
                ->with('success', 'User prodi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus user prodi: ' . $e->getMessage()]);
        }
    }

    /**
     * ============================================
     * FAKULTAS
     * ============================================
     */
    public function fakultas()
    {
        $users = FakultasUser::with('fakultas')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $title = "Fakultas";

        return view('admin.users.fakultas', compact('users', 'title'));
    }

    /**
     * Form create fakultas user
     */
    public function createFakultas()
    {
        $fakultasList = DB::table('fakultas')
            ->select('id', 'nama_fakultas', 'dekan', 'akreditasi')
            ->orderBy('nama_fakultas')
            ->get();

        return view('admin.users.create-fakultas', compact('fakultasList'));
    }

    /**
     * Store fakultas user
     */
    public function storeFakultas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        try {
            FakultasUser::create([
                'fakultas_id' => $request->fakultas_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'fakultas',
                'is_activated' => 1,
            ]);

            return redirect()->route('admin.users.fakultas')
                ->with('success', 'User fakultas berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan user fakultas: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show detail fakultas user
     */
    public function showFakultas($id)
    {
        $fakultasUser = FakultasUser::with('fakultas')->findOrFail($id);
        return view('admin.users.show-fakultas', compact('fakultasUser'));
    }

    /**
     * Edit fakultas user form
     */
    public function editFakultas($id)
    {
        $fakultasUser = FakultasUser::with('fakultas')->findOrFail($id);
        $fakultasList = Fakultas::orderBy('nama_fakultas')->get();
        return view('admin.users.edit-fakultas', compact('fakultasUser', 'fakultasList'));
    }

    /**
     * Delete fakultas user
     */
    public function destroyFakultas($id)
    {
        try {
            $fakultasUser = FakultasUser::findOrFail($id);
            $fakultasUser->delete();

            return redirect()->route('admin.users.fakultas')
                ->with('success', 'User fakultas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus user fakultas: ' . $e->getMessage()]);
        }
    }

    /**
     * ============================================
     * PUSAT BAHASA
     * ============================================
     */
    public function pusatBahasa()
    {
        $users = PusatBahasaUser::orderBy('created_at', 'desc')
            ->paginate(15);

        $title = "Pusat Bahasa";

        return view('admin.users.pusat-bahasa', compact('users', 'title'));
    }

    /**
     * Form create pusat bahasa user
     */
    public function createPusatBahasa()
    {
        return view('admin.users.create-pusat-bahasa');
    }

    /**
     * Store pusat bahasa user
     */
    public function storePusatBahasa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        try {
            PusatBahasaUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pusat_bahasa',
                'is_activated' => 1,
            ]);

            return redirect()->route('admin.users.pusat-bahasa')
                ->with('success', 'User pusat bahasa berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan user pusat bahasa: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show detail pusat bahasa user
     */
    public function showPusatBahasa($id)
    {
        $pusatBahasaUser = PusatBahasaUser::findOrFail($id);
        return view('admin.users.show-pusat-bahasa', compact('pusatBahasaUser'));
    }

    /**
     * Edit pusat bahasa user form
     */
    public function editPusatBahasa($id)
    {
        $pusatBahasaUser = PusatBahasaUser::findOrFail($id);
        return view('admin.users.edit-pusat-bahasa', compact('pusatBahasaUser'));
    }

    /**
     * Delete pusat bahasa user
     */
    public function destroyPusatBahasa($id)
    {
        try {
            $pusatBahasaUser = PusatBahasaUser::findOrFail($id);
            $pusatBahasaUser->delete();

            return redirect()->route('admin.users.pusat-bahasa')
                ->with('success', 'User pusat bahasa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus user pusat bahasa: ' . $e->getMessage()]);
        }
    }

    /**
     * ============================================
     * UNIVERSAL DESTROY (FALLBACK)
     * ============================================
     */
    public function destroy(Request $request, $id)
    {
        $type = $request->query('type');

        switch ($type) {
            case 'prodi':
                return $this->destroyProdi($id);

            case 'fakultas':
                return $this->destroyFakultas($id);

            case 'pusat_bahasa':
                return $this->destroyPusatBahasa($id);

            default:
                return back()->withErrors(['error' => 'Tipe user tidak valid']);
        }
    }
}
