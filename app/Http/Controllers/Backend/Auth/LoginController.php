<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Tambahkan ini

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password,
            'status' => 1,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();
            $role = $admin->roles()->first(); // Ambil role pertama dari admin

            if (!$role) {
                Auth::guard('admin')->logout();
                return back()->with('error', 'Akun Anda tidak memiliki hak akses.');
            }

            // ======================================================
            // BAGIAN PENTING: Simpan hak akses ke session
            // ======================================================
            $permissions = $role->permissions()->pluck('menu_id')->toArray();
            Session::put('user_permissions', $permissions);
            // ======================================================

            return redirect()->intended(route('backend.dashboard'))
                ->with('success', 'Selamat Datang, ' . $admin->name);
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.auth.login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}