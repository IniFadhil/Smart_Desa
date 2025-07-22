<x-layouts.guest>
    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <!-- Logo Desa Anda -->
        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" class="h-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Selamat datang</h1>
            <p class="text-gray-500 mt-1">Belum daftar? <a href="{{ route('register') }}"
                    class="text-green-600 hover:underline">Daftar</a></p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- NIK -->
            <div>
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="email"
                    required autofocus placeholder="NIK" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password"
                    required autocomplete="new-password" placeholder="Password" />
            </div>

            <!-- Tombol Masuk -->
            <div class="mt-6">
                <button
                    class="w-full justify-center rounded-md bg-green-600 py-3 text-white font-semibold hover:bg-green-700">
                    Masuk
                </button>
            </div>

            <!-- Lupa Kata Sandi -->
            <div class="text-center mt-4">
                <a class="text-sm text-gray-600 hover:underline" href="#">
                    Lupa kata sandi?
                </a>
            </div>
        </form>
    </div>
</x-layouts.guest>
