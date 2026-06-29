<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\TemplateSkpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateSkpi extends Controller
{
    public function index()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $template = \App\Models\TemplateSkpi::first();

        return view('fakultas.template.index', compact('template'));
    }
}
