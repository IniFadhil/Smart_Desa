<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    @stack('scripts')

    <div class="relative flex-grow md:flex" x-data="{ isSidebarOpen: window.innerWidth > 768 ? true : false }"
        @resize.window="isSidebarOpen = window.innerWidth > 768 ? true : false"
        :class="{ 'overflow-hidden': isSidebarOpen && window.innerWidth < 768 }">

        {{-- Tombol Hamburger untuk Mobile --}}
        <div class="md:hidden flex justify-between items-center bg-green-800 text-white p-4 shadow-lg">
            <div class="font-bold text-lg">Menu Navigasi</div>
            <button @click="isSidebarOpen = !isSidebarOpen"
                class="focus:outline-none p-2 rounded-md hover:bg-green-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        {{-- SIDEBAR --}}
        <aside
            class="fixed inset-y-0 left-0 bg-green-800 text-white w-64 p-4 flex flex-col justify-between shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30 overflow-y-auto"
            :class="{ 'translate-x-0': isSidebarOpen }">
            <nav x-data="{ openMenu: '' }">
                {{-- Logo dan Nama Desa di Sidebar --}}
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12">
                    <div class="font-bold text-sm">
                        <div>PEMERINTAH DAERAH</div>
                        <div>KABUPATEN SUBANG</div>
                    </div>
                </div>

                {{-- Daftar Menu Sidebar (LENGKAP) --}}
                <ul class="space-y-2">
                    {{-- Dropdown PROFIL DESA --}}
                    <li>
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
                        <div x-show="openMenu === 'profil'" x-transition
                            class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('sejarah-desa') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">SEJARAH DESA</a>
                            <a href="{{ route('visi-misi') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">VISI DAN MISI</a>
                            <a href="{{ route('gambaran-umum-desa') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">GAMBARAN UMUM DESA</a>
                            <a href="{{ route('kondisi-geografis') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KONDISI GEOGRAFIS</a>
                        </div>
                    </li>

                    {{-- Dropdown POTENSI DESA --}}
                    <li>
                        <button @click="openMenu = (openMenu === 'potensi' ? '' : 'potensi')"
                            class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>POTENSI DESA</span>
                            <svg class="h-5 w-5 transform transition-transform"
                                :class="{ 'rotate-180': openMenu === 'potensi' }" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="openMenu === 'potensi'" x-transition
                            class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('potensi.kuliner') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                KULINER
                            </a>
                            <a href="{{ route('potensi.wisata') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                WISATA
                            </a>
                        </div>
                    </li>

                    {{-- Dropdown BUMDes --}}
                    <li>
                        <button @click="openMenu = (openMenu === 'bumdes' ? '' : 'bumdes')"
                            class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>BUMDES</span>
                            <svg class="h-5 w-5 transform transition-transform"
                                :class="{ 'rotate-180': openMenu === 'bumdes' }" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="openMenu === 'bumdes'" x-transition
                            class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('bumdes.profil') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PROFIL BUMDES</a>
                            <a href="{{ route('bumdes.produk') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PRODUK BUMDES</a>
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
                        <div x-show="openMenu === 'pemerintahan'" x-transition
                            class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('pemerintah.kepala_desa') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                KEPALA DESA
                            </a>
                            <a href="{{ route('pemerintah.perangkat_desa') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                PERANGKAT DESA
                            </a>
                            <a href="{{ route('profil.kantor-desa') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                KANTOR DESA
                            </a>
                            <a href="{{ route('pemerintah.struktur_organisasi') }}"
                                class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">
                                STRUKTUR ORGANISASI
                            </a>
                        </div>
                    </li>

                    {{-- Menu tunggal PROGRAM DESA --}}
                    <li><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">PROGRAM DESA</a></li>
                </ul>
            </nav>
            
            {{-- Bagian Login/Logout di bawah sidebar (hanya untuk mobile) --}}
            <div class="mt-6 md:hidden">
                @auth('masyarakat')
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>LOGOUT</span>
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-green-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span>LOGIN</span>
                    </a>
                @endauth
            </div>
        </aside>

        {{-- Overlay untuk mobile --}}
        <div x-show="isSidebarOpen && window.innerWidth < 768" @click="isSidebarOpen = false"
            class="fixed inset-0 bg-black opacity-50 z-20 md:hidden"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64 transition-all duration-300 ease-in-out">
            {{-- HEADER / NAVBAR ATAS (LENGKAP) --}}
            <header class="bg-white shadow z-10">
                <div class="container mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
                    {{-- Sisi Kiri Header: Navigasi Utama --}}
                    <nav class="hidden md:flex space-x-8">
                        {{-- Dropdown Layanan --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>LAYANAN</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute mt-2 w-64 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50 origin-top-right">
                                <a href="{{ route('suket.sk-kematian') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Kematian</a>
                                <a href="{{ route('suket.sk-usaha') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Usaha</a>
                                <a href="{{ route('suket.sk-beda-nama') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Beda Nama</a>
                                <a href="{{ route('suket.sk-tidak-mampu') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Tidak Mampu</a>
                                <a href="{{ route('suket.sk-penghasilan') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Penghasilan</a>
                                <a href="{{ route('suket.sk-status-pernikahan') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Status
                                    Pernikahan</a>
                                <a href="{{ route('suket.sk-riwayat-tanah') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Riwayat
                                    Tanah</a>
                                <a href="{{ route('suket.sk-kelahiran') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Kelahiran</a>
                                <a href="{{ route('suket.sk-ahli-waris') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Ahli Waris</a>
                                <a href="{{ route('suket.sk-lain') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Lain</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Lihat Progres
                                    Pemohon</a>
                            </div>
                        </div>

                        <a href="{{ url('/berita') }}" class="text-gray-600 hover:text-green-700">BERITA</a>
                        <a href="{{ route('kondisi-geografis') }}" class="text-gray-600 hover:text-green-700">INFO
                            GRAFIS</a>

                        {{-- Dropdown Galeri --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>GALERI</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50 origin-top-right">
                                <a href="{{ route('galeri-foto') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Foto</a>
                                <a href="{{ route('galeri-video') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100">Video</a>
                            </div>
                        </div>
                        <a href="{{ route('hubungi-kami') }}" class="text-gray-600 hover:text-green-700">HUBUNGI
                            KAMI</a>
                    </nav>

                    {{-- Sisi Kanan Header: Search & Profil --}}
                    <div class="flex items-center space-x-4 ml-auto">
                        {{-- Kolom Pencarian --}}
                        <div class="relative hidden sm:block">
                            <input type="search" placeholder="Search"
                                class="py-2 pl-10 pr-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 w-full">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- PROFIL PENGGUNA DROPDOWN --}}
                        @auth('masyarakat')
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = ! dropdownOpen"
                                class="flex items-center space-x-2 relative focus:outline-none">
                                {{-- Avatar Pengguna --}}
                                @if (Auth::guard('masyarakat')->user()->profile_photo_url)
                                    <img class="h-9 w-9 rounded-full object-cover" src="{{ Auth::guard('masyarakat')->user()->profile_photo_url }}" alt="Foto Profil">
                                @else
                                    {{-- Tampilkan IKON AVATAR BARU jika tidak ada foto --}}
                                    <div class="h-9 w-9 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                                <h2  class="text-gray-600 hover:text-green-700">{{ Auth::guard('masyarakat')->user()->nama_lengkap }}</h2>
                            </button>
                    
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-50">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Profil Saya</a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-red-600 hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        {{-- Tombol Login jika belum login --}}
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">Login</a>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Isi Halaman (Konten Dinamis) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-4 sm:p-6">
                @if (!Request::routeIs('home') && !Request::routeIs('backend.dashboard'))
                    <div class="mb-6">
                        <button onclick="window.history.back()"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest shadow-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h14"></path>
                            </svg>
                            Kembali
                        </button>
                    </div>
                @endif

                @yield('content')
                
                <footer class="bg-green-800 text-white mt-auto">
                    <div class="container mx-auto px-6 py-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div class="col-span-1">
                                <div class="flex items-center mb-4">
                                    <img src="{{ asset('img/Logo.png') }}" alt="Logo Desa" class="h-12 mr-3">
                                    <span class="font-bold text-lg">Desa Sukamandi</span>
                                </div>
                                <p class="text-sm text-green-200">
                                    Jl. Raya Sagalaherang No. 12,
                                    <br>
                                    Kecamatan Sagalaherang,
                                    <br>
                                    Kabupaten Subang, Jawa Barat 41282
                                </p>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-4">Tautan Penting</h3>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="{{ route('pemerintah.kepala_desa') }}"
                                            class="text-green-200 hover:text-white transition-colors">Profil Kepala
                                            Desa</a></li>
                                    <li><a href="{{ route('pemerintah.struktur_organisasi') }}"
                                            class="text-green-200 hover:text-white transition-colors">Struktur
                                            Organisasi</a></li>
                                    <li><a href="#"
                                            class="text-green-200 hover:text-white transition-colors">Berita Desa</a>
                                    </li>
                                    <li><a href="#"
                                            class="text-green-200 hover:text-white transition-colors">Kebijakan
                                            Privasi</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-4">Potensi Desa</h3>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="{{ route('potensi.kuliner') }}"
                                            class="text-green-200 hover:text-white transition-colors">Kuliner</a></li>
                                    <li><a href="{{ route('potensi.wisata') }}"
                                            class="text-green-200 hover:text-white transition-colors">Wisata</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold mb-4">Ikuti Kami</h3>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-green-200 hover:text-white transition-colors">
                                        <span class="sr-only">Twitter</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-green-200 hover:text-white transition-colors">
                                        <span class="sr-only">Instagram</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.792 2.013 10.146 2 12.315 2zM12 7.044a4.956 4.956 0 100 9.912 4.956 4.956 0 000-9.912zM12 15.26a3.26 3.26 0 110-6.52 3.26 3.26 0 010 6.52zm5.753-8.312a1.162 1.162 0 100-2.324 1.162 1.162 0 000 2.324z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-green-200 hover:text-white transition-colors">
                                        <span class="sr-only">YouTube</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.42 4.814a2.506 2.506 0 01-1.768 1.768c-1.594.42-7.812.42-7.812.42s-6.218 0-7.812-.42a2.506 2.506 0 01-1.768-1.768C2 15.22 2 12 2 12s0-3.22.42-4.814a2.506 2.506 0 011.768-1.768C5.782 5 12 5 12 5s6.218 0 7.812.418zM9.857 14.582V9.418l4.584 2.582-4.584 2.582z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 border-t border-green-700 pt-6">
                            <p class="text-center text-sm text-green-200">
                                &copy; {{ date('Y') }} Pemerintah Desa Sukamandi. Hak Cipta Dilindungi.
                            </p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>
