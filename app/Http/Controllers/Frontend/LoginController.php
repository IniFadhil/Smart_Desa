<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Desa;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.login_frontend');
    }

    public function login(Request $request)
    {
        try {
            $rules = [
                'nik'      => 'required|string|min:16|max:16',
                'password' => 'required|string|min:6',
            ];

            // $this->validate($request, $rules);

            $credentials = [
                'nik'         => $request->nik,
                'password'    => $request->password,
                'is_verified' => 1
            ];

            if (Auth::guard('masyarakat')->attempt($credentials)) {
                $request->session()->regenerate();
                toastr()->success('Login Berhasil, Selamat Datang!', 'Sukses');
                return redirect()->intended(route('home'));
            } else {
                toastr()->error('NIK atau Password salah, atau akun belum terverifikasi.', 'Gagal');
                return redirect()->route('login')->withInput();
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            toastr()->error('Terjadi kesalahan pada server.', 'Error');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->success('Anda telah berhasil logout.', 'Sukses');
        return redirect('/');
    }
}