<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.login_frontend');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik'      => ['required', 'string', 'min:16', 'max:16'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'nik'         => $request->nik,
            'password'    => $request->password,
            'is_verified' => 1
        ];

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Login Berhasil, Selamat Datang!');
        }

        return back()->with('error', 'NIK atau Password salah, atau akun belum terverifikasi.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}