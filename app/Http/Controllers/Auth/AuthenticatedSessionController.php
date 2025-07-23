<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Mengembalikan view login frontend yang baru Anda buat
        return view('frontend.login_frontend');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi kredensial
        $request->validate([
            'email' => ['required', 'string'], // Bisa 'email' atau 'nik' tergantung validasi Anda
            'password' => ['required', 'string'],
        ]);

        // Coba autentikasi pengguna dengan guard 'web' (default untuk pengguna biasa)
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Jika autentikasi gagal, kembalikan dengan error
            return back()->withErrors([
                'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ])->onlyInput('email');
        }

        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Arahkan pengguna ke halaman yang dituju atau ke HOME default
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna dari guard 'web'
        Auth::guard('web')->logout();

        // Invalidasi sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman utama setelah logout
        return redirect('/');
    }
}
