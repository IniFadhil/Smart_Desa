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

        // 1. Jika user tidak login, arahkan ke halaman login
        if (!$user) {
            return redirect()->route('backend.auth.login');
        }

        // 2. Jika user adalah Super User, izinkan semua akses
        if ($user->isSuperUser()) {
            return $next($request);
        }

        // 3. Ambil izin dari session (sudah diset saat login)
        $permissions = Session::get('user_permissions', []);

        // 4. Cek apakah menu yang diakses ada di dalam daftar izin
        if (in_array($menu, $permissions)) {
            return $next($request); // Izinkan
        }

        // 5. Jika tidak punya akses, tolak
        toastr()->error('Anda tidak memiliki hak akses untuk membuka halaman ini.', 'Akses Ditolak');
        return redirect()->route('backend.dashboard');
    }
}
