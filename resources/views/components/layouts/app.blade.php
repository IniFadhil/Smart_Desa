<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        {{-- SIDEBAR --}}
        {{-- SIDEBAR --}}
<aside class="w-64 bg-green-800 text-white p-4 flex flex-col justify-between shadow-lg"
    x-data="{ openMenu: '' }"> {{-- openMenu akan menyimpan nama menu yang sedang terbuka --}}
    <nav>
        {{-- Logo dan Nama Desa di Sidebar --}}
        <div class="flex items-center space-x-3 mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12">
            <div class="font-bold text-sm">
                <div>PEMERINTAH DAERAH</div>
                <div>KABUPATEN SUBANG</div>
            </div>
        </div>

        {{-- Daftar Menu Sidebar --}}
        <ul class="space-y-2">
            {{-- Dropdown PROFIL DESA --}}
            <li>
                <button @click="openMenu = (openMenu === 'profil' ? '' : 'profil')"
                    class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                    <span>PROFIL DESA</span>
                    <svg class="h-5 w-5 transform transition-transform"
                        :class="{ 'rotate-180': openMenu === 'profil' }" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="openMenu === 'profil'" class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md" style="display: none;"> {{-- Latar belakang dropdown --}}
                    {{-- Tautan Sejarah Desa --}}
                    <a href="{{ route('sejarah-desa') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">SEJARAH DESA</a>
                    {{-- Tautan Visi dan Misi --}}
                    <a href="{{ route('visi-misi') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">VISI DAN MISI</a>
                    <a href="{{ route('gambaran-umum-desa') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">GAMBARAN UMUM DESA</a>
                    <a href="{{ route('kondisi-geografis') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KONDISI GEOGRAFIS</a>
                </div>
            </li>

            {{-- Dropdown POTENSI DESA --}}
            <li>
                <button @click="openMenu = (openMenu === 'potensi' ? '' : 'potensi')"
                    class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                    <span>POTENSI DESA</span>
                    <svg class="h-5 w-5 transform transition-transform"
                        :class="{ 'rotate-180': openMenu === 'potensi' }" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="openMenu === 'potensi'" class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md" style="display: none;">
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">ABEL RAY</a>
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">JOY MCDANIEL</a>
                </div>
            </li>

            {{-- Dropdown BUMDES --}}
            <li>
                <button @click="openMenu = (openMenu === 'bumdes' ? '' : 'bumdes')"
                    class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                    <span>BUMDES</span>
                    <svg class="h-5 w-5 transform transition-transform"
                        :class="{ 'rotate-180': openMenu === 'bumdes' }" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="openMenu === 'bumdes'" class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md" style="display: none;">
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PROFIL BUMDES</a>
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PRODUK BUMDES</a>
                </div>
            </li>

            {{-- Dropdown PEMERINTAH DESA --}}
            <li>
                <button @click="openMenu = (openMenu === 'pemerintahan' ? '' : 'pemerintahan')"
                    class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                    <span>PEMERINTAH DESA</span>
                    <svg class="h-5 w-5 transform transition-transform"
                        :class="{ 'rotate-180': openMenu === 'pemerintahan' }" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="openMenu === 'pemerintahan'" class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md" style="display: none;">
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KEPALAS DESA</a>
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PERANGKAT DESA</a>
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KANTOR DESA</a>
                    <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">STRUKTUR ORGANISASI</a>
                </div>
            </li>

            {{-- Menu tunggal PROGRAM DESA --}}
            <li><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">PROGRAM DESA</a></li>
        </ul>
    </nav>
    {{-- Bagian Bawah Sidebar untuk Login/Logout --}}
    <div>
        @guest('admin')
            <a href="{{ route('login') }}"
                class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-green-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                </svg>
                <span>LOGIN</span>
            </a>
        @endguest
        @auth('admin')
            <form method="POST" action="{{ route('backend.auth.logout') }}">
                @csrf
                <a href="{{ route('backend.auth.logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>LOGOUT</span>
                </a>
            </form>
        @endauth
    </div>
</aside>


        {{-- KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- HEADER / NAVBAR ATAS --}}
            <header class="bg-white shadow">
                <div class="container mx-auto px-6 py-3 flex justify-end items-center">
                    {{-- Navigasi Atas --}}
                    <nav class="hidden md:flex space-x-8 ml-6 mr-6">

                        {{-- Dropdown Layanan --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>LAYANAN</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute mt-2 w-64 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50"
                                style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan kematian</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan usaha</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan beda nama</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan tidak mampu</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan penghasilan</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan status
                                    pernikahan</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan riwayat tanah</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan kelahiran</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan ahli waris</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat keterangan lain</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Lihat progres pemohon</a>
                            </div>
                        </div>

                        <a href="#" class="text-gray-600 hover:text-green-700">BERITA</a>
                        <a href="#" class="text-gray-600 hover:text-green-700">INFO GRAFIS</a>

                        {{-- Dropdown Galeri --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>GALERI</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50"
                                style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Foto</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Video</a>
                            </div>
                        </div>

                        <a href="#" class="text-gray-600 hover:text-green-700">HUBUNGI KAMI</a>
                    </nav>

                    {{-- Kolom Pencarian --}}
                    <div class="relative">
                        <input type="search" placeholder="Search"
                            class="py-2 pl-10 pr-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </header>
            {{-- Isi Halaman (Konten Dinamis) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                @yield('content') {{-- Ini adalah tempat konten dari child view akan dirender --}}
            </main>
        </div>
    </div>
</body>

</html>
