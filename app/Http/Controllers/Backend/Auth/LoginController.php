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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        try {
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [
                $fieldType => $request->username,
                'password' => $request->password,
                'status' => 1,
            ];
            $cek = Auth::guard('admin')->attempt($credentials);
            // dd($cek);
            if (Auth::guard('admin')->attempt($credentials)) {
                $user = Auth::guard('admin')->user();
                //
                // dd($user);

                $userRole = $user->roles()->first();
                // dd($userRole);

                if (!$userRole) {
                    // Auth::guard('admin')->logout();
                    return back()->with('error', 'Konfigurasi hak akses untuk akun Anda tidak ditemukan.');
                }
                // dd($user->isSuperUser());
                // if ($user->isSuperUser() || $user->desa_id == Session::get('desa_id')) {
                //     dd('a');
                $request->session()->regenerate();

                $permissions = Permission::where('role_id', $userRole->id)->pluck('menu_id')->toArray();
                Session::put('user_permissions', $permissions);

                // GANTI DENGAN KODE INI
                return redirect()->route('backend.dashboard')->with('success', 'Selamat Datang, ' . $user->name);
                // } else {
                //     dd('b');
                //     //     Auth::guard('admin')->logout();
                //     //     return redirect()->route('backend.auth.login')->with('error', 'Akun Anda tidak terdaftar untuk mengakses desa ini.');
                // }
                // dd('op');
            }

            // throw ValidationException::withMessages([
            //     'username' => ['Username atau Password salah.'],
            // ]);
        }
        // catch (ValidationException $e) {
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
        catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan pada sistem: ' . $e->getMessage());
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.auth.login');
    }
}
