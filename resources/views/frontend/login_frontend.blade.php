<x-layouts.guest>
    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" class="h-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Halaman Login Pengguna</h1>
            <p class="text-gray-500 mt-1">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar Sekarang</a>
            </p>
        </div>

        {{-- Session Status (untuk menampilkan pesan jika ada, misalnya setelah reset password) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-input-label for="nik_or_email" value="NIK atau Email" class="sr-only" />
                <x-text-input id="nik_or_email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan NIK atau Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Kata Sandi" class="sr-only" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi kamu" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Bagian "Lupa kata sandi?" telah dihapus dari sini --}}

            <div class="mt-6">
                <button type="submit" class="w-full justify-center rounded-md bg-green-600 py-3 text-white font-semibold hover:bg-green-700">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>
