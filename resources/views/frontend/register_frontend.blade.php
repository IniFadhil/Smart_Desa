<x-layouts.guest>
    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" class="h-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Daftar Akun Baru</h1>
            <p class="text-gray-500 mt-1">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-600 hover:underline">Masuk di sini</a>
            </p>
        </div>

        {{-- Session Status (untuk menampilkan pesan jika ada) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Input Nama --}}
            <div>
                <x-input-label for="nik" value="Nik" class="sr-only" />
                <x-text-input id="nik" class="block mt-1 w-full" type="nik" name="nik" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan Nik Anda" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>

            {{-- Input Email --}}
            <div class="mt-4">
                <x-input-label for="email" value="Email" class="sr-only" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan Alamat Email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Input Password --}}
            <div class="mt-4">
                <x-input-label for="password" value="Password" class="sr-only" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Buat Kata Sandi" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Input Konfirmasi Password --}}
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Password" class="sr-only" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full justify-center rounded-md bg-green-600 py-3 text-white font-semibold hover:bg-green-700">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>
