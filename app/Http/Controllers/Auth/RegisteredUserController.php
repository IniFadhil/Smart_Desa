<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Model User default Laravel untuk login
use App\Models\DsUser; // Model untuk tabel ds_users
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Mengembalikan view register frontend
        return view('frontend.register_frontend');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi semua input dari form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:ds_users,nik'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:ds_users,email'],
            'no_telepon' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Buat entri di tabel 'users' untuk sistem login/autentikasi Laravel
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Buat entri di tabel 'ds_users' untuk data detail pengguna
        // Sesuaikan dengan kolom yang ada di migrasi Anda
        DsUser::create([
            'id_user' => $user->id, // Tautkan dengan id dari tabel users
            'nama_lengkap' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telpon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'tgl_lahir' => now(), // Placeholder, Anda mungkin perlu form input untuk ini
            'jenis_kelamin' => 'laki-laki', // Placeholder, Anda mungkin perlu form input untuk ini
            'api_token' => Str::random(60), // Generate token acak
            'id_desa' => 1, // Placeholder, sesuaikan dengan id desa yang relevan
        ]);

        // 4. Trigger event bahwa user telah terdaftar
        event(new Registered($user));

        // 5. Login-kan user secara otomatis
        Auth::login($user);

        // 6. Arahkan ke halaman home setelah berhasil daftar
        return redirect(RouteServiceProvider::HOME);
    }
}
