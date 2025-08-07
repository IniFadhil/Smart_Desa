<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        // TAMBAHKAN VALIDASI UNTUK CAPTCHA
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha' // Aturan validasi captcha
        ]);


        try {
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [
                $fieldType => $request->username,
                'password' => $request->password,
                'status' => 1,
            ];

            if (Auth::guard('admin')->attempt($credentials)) {
                $user = Auth::guard('admin')->user();
                $userRole = $user->roles()->first();

                if (!$userRole) {
                    Auth::guard('admin')->logout(); // Logout jika tidak punya role
                    return back()->with('toastr', [
                        'type' => 'error',
                        'message' => 'Konfigurasi hak akses untuk akun Anda tidak ditemukan.'
                    ])->withInput();
                }

                $request->session()->regenerate();

                $permissions = Permission::where('role_id', $userRole->id)->pluck('menu_id')->toArray();
                Session::put('user_permissions', $permissions);

                return redirect()->route('backend.dashboard')->with('success', 'Selamat Datang, ' . $user->name);
            }

            // Jika otentikasi gagal
            return back()->with('toastr', [
                'type' => 'error',
                'message' => 'Username atau password salah.'
            ])->withInput();
        } catch (ValidationException $e) {
            // Tangani error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Tangani error lainnya
            return back()->with('toastr', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan pada sistem.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.auth.login');
    }

    // TAMBAHKAN FUNGSI INI UNTUK RELOAD CAPTCHA
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
