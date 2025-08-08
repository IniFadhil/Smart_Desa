<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckPermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $menu)
    {
        /** @var \App\Models\Admin|null $user */
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->route('backend.auth.login');
        }

        // Jika user adalah Super User, izinkan semua akses
        if ($user->isSuperUser()) {
            return $next($request);
        }

        // Ambil izin dari session yang sudah diset saat login
        $permissions = Session::get('user_permissions', []);

        // Cek apakah menu yang diakses ada di dalam daftar izin
        if (in_array($menu, $permissions)) {
            return $next($request); // Izinkan akses
        }

        // Jika tidak punya akses, tolak dan kembali ke dashboard
        return redirect()->route('backend.dashboard')
            ->with('error', 'Anda tidak memiliki hak akses untuk membuka halaman ini.');
    }
}