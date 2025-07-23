<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Make sure Alpine.js is included via app.js or here --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-green-800 text-white p-4 flex flex-col justify-between" x-data="{ openMenu: '' }">
            <nav>
                <ul>
                    <li class="mb-2">
                        <button @click="openMenu = (openMenu === 'profil' ? '' : 'profil')"
                            class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>PROFIL DESA</span>
                            <svg class="h-5 w-5 transform transition-transform"
                                :class="{ 'rotate-180': openMenu === 'profil' }" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="openMenu === 'profil'" class="pl-4 mt-2 space-y-2" style="display: none;">
                            <a href="#" class="block text-sm hover:text-green-200">SEJARAH DESA</a>
                            <a href="#" class="block text-sm hover:text-green-200">VISI DAN MISI</a>
                            {{-- Add other profile links here --}}
                        </div>
                    </li>
                    <li class="mb-2"><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">POTENSI
                            DESA</a></li>
                    {{-- Add other main links here --}}
                </ul>
            </nav>
            <div>
                {{-- FIXED: Route points to the correct backend login name --}}
                <a href="{{ route('backend.auth.login') }}"
                    class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-green-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>LOGIN</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow">
                <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12">
                        <div class="font-bold text-sm text-green-800">
                            <div>PEMERINTAH DAERAH</div>
                            <div>KABUPATEN SUBANG</div>
                        </div>
                    </div>
                    {{-- Top navigation can go here --}}
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                {{-- FIXED: Changed from {{ $slot }} to @yield('content') --}}
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
