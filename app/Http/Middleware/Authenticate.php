<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Mengarahkan pengguna yang tidak terautentikasi.
     */
    protected function redirectTo(Request $request): ?string
    {
        // ATURAN SEDERHANA: Jika ada yang mencoba masuk ke area terlarang
        // dan dia belum login, satu-satunya pintu masuk yang kita punya
        // adalah pintu masuk admin. Selalu arahkan ke sana.
        return $request->expectsJson() ? null : route('backend.auth.login');
    }
}
