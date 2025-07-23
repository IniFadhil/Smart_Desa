<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Jika tidak ada penjaga spesifik, anggap saja penjaga 'web' (default)
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Cek apakah pengguna sudah login dengan penjaga ini
            if (Auth::guard($guard)->check()) {

                // ATURAN PENTING: Jika yang login adalah 'admin',
                // maka arahkan ke dashboard admin.
                if ($guard === 'admin') {
                    return redirect()->route('backend.dashboard');
                }

                // Jika yang login adalah penjaga lain (bukan admin),
                // maka arahkan ke halaman utama frontend.
                return redirect()->route('home');
            }
        }

        // Jika belum login, izinkan lewat ke halaman login.
        return $next($request);
    }
}
