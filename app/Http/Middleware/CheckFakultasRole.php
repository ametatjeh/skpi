<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFakultasRole
{
    /**
     * Handle an incoming request.
     * Memastikan user sudah login via guard 'fakultas' dan memiliki role 'fakultas'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek user login via guard fakultas dan rolenya sesuai
        if (auth('fakultas')->check() && auth('fakultas')->user()->role === 'fakultas') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses ditolak! Hanya untuk Operator Fakultas.');
    }
}
