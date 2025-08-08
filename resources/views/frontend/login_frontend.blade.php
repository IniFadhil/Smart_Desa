<x-layouts.guest>
    @section('top-resource')
        <style>
            html.dark,
            body.dark,
            .dark {
                background-color: white !important;
                color: black !important;
            }

            .dark .bg-gray-900,
            .dark .bg-gray-800,
            .dark .text-gray-200 {
                background-color: white !important;
                color: black !important;
            }
        </style>
    @endsection

    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" class="h-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Halaman Login Pengguna</h1>
            <p class="text-gray-500 mt-1">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar Sekarang</a>
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="nik" value="NIK" class="sr-only" />
                <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')"
                    required autofocus placeholder="Masukkan NIK Anda (16 digit)" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Kata Sandi" class="sr-only" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="Masukkan kata sandi Anda" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full justify-center rounded-md bg-green-600 py-3 text-white font-semibold hover:bg-green-700">
                    Masuk
                </button>
            </div>
        </form>

        @if (session('success'))
            <div class="mt-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-layouts.guest>
