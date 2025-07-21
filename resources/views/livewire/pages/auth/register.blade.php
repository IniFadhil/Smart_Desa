<x-layouts.guest>
    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" class="h-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Buat Akun</h1>
            <p class="text-gray-500 mt-1">Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a></p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="nik" required placeholder="NIK" />
            </div>

            <div class="mt-4">
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="name" required placeholder="Nama Lengkap" />
            </div>

            <div class="mt-4">
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" required placeholder="Email" />
            </div>

            <div class="mt-4">
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
            </div>

            <div class="mt-4">
                <input class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" />
            </div>

            <div class="mt-6">
                <button class="w-full justify-center rounded-md bg-green-600 py-3 text-white font-semibold hover:bg-green-700">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>