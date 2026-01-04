<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\FakultasUser;
use Illuminate\Http\Request;

class OperatorFakultasController extends Controller
{
    public function index()
    {
        $operators = FakultasUser::paginate(15);
        return view('fakultas.operators.index', compact('operators'));
    }

    public function create()
    {
        return view('fakultas.operators.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:fakultas_users',
            'password' => 'required|string|min:6',
            'fakultas_id' => 'required|integer'
        ]);
        $data['password'] = bcrypt($data['password']);

        FakultasUser::create($data);

        return redirect()->route('fakultas.operators.index')->with('success', 'Operator baru ditambahkan.');
    }

    // Tambahkan edit/update/destroy sesuai kebutuhan CRUD
}
