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

            {{-- Input Nama Lengkap --}}
            <div>
                <x-input-label for="name" value="Nama Lengkap" class="sr-only" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan Nama Lengkap Anda" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Input NIK --}}
            <div class="mt-4">
                <x-input-label for="nik" value="NIK" class="sr-only" />
                <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required autocomplete="nik" placeholder="Masukkan NIK Anda" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>
            
            {{-- Input Email --}}
            <div class="mt-4">
                <x-input-label for="email" value="Email" class="sr-only" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan Alamat Email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Input No. Telepon --}}
            <div class="mt-4">
                <x-input-label for="no_telepon" value="No. Telepon" class="sr-only" />
                <x-text-input id="no_telepon" class="block mt-1 w-full" type="text" name="no_telepon" :value="old('no_telepon')" required autocomplete="tel" placeholder="Masukkan No. Telepon Anda" />
                <x-input-error :messages="$errors->get('no_telepon')" class="mt-2" />
            </div>

            {{-- Input Alamat --}}
            <div class="mt-4">
                <x-input-label for="alamat" value="Alamat" class="sr-only" />
                <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required placeholder="Masukkan Alamat Lengkap Anda">{{ old('alamat') }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
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
