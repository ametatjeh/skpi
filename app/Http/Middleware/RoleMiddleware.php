<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Jika role user tidak termasuk dalam daftar role yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Jika kamu ingin redirect ke dashboard default:
            // return redirect()->route($user->role . '.dashboard')->with('error', 'Anda tidak memiliki izin mengakses halaman ini.');

            // Atau cukup tampilkan error 403 (lebih aman)
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Lanjut ke request berikutnya
        return $next($request);
    }
}
