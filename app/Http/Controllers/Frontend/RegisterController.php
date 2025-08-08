<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('frontend.register_frontend');
    }

    public function register(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'name'        => ['required', 'string', 'max:150'],
            'nik'         => ['required', 'string', 'min:16', 'max:16', 'unique:ds_users,nik'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:ds_users,email'],
            'no_telepon'  => ['required', 'string', 'min:10', 'max:15'],
            'alamat'      => ['required', 'string'],
            'password'    => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // 2. Buat data baru
        $user = User::create([
            'id'             => $this->generateAutoNumber('ds_users'),
            'desa_id'        => Session::get('desa_id'),
            'nama_lengkap'   => $validatedData['name'],
            'nik'            => $validatedData['nik'],
            'email'          => $validatedData['email'],
            'password'       => Hash::make($validatedData['password']),
            'no_telpon'      => $validatedData['no_telepon'],
            'alamat'         => $validatedData['alamat'],
            'api_token'      => Str::random(50),
            'is_verified'    => 1, // Anggap langsung terverifikasi
        ]);

        // 3. Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
