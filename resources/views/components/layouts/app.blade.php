<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    @stack('scripts')
    
    <div class="relative min-h-screen md:flex" x-data="{ isSidebarOpen: window.innerWidth > 768 ? true : false }" @resize.window="isSidebarOpen = window.innerWidth > 768 ? true : false" :class="{ 'overflow-hidden': isSidebarOpen && window.innerWidth < 768 }">
        
        {{-- Tombol Hamburger untuk Mobile --}}
        <div class="md:hidden flex justify-between items-center bg-green-800 text-white p-4 shadow-lg">
            <div class="font-bold text-lg">Menu Navigasi</div>
            <button @click="isSidebarOpen = !isSidebarOpen" class="focus:outline-none p-2 rounded-md hover:bg-green-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 left-0 bg-green-800 text-white w-64 p-4 flex flex-col justify-between shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30 overflow-y-auto"
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
                        <button @click="openMenu = (openMenu === 'profil' ? '' : 'profil')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>PROFIL DESA</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'profil' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="openMenu === 'profil'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('sejarah-desa') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">SEJARAH DESA</a>
                            <a href="{{ route('visi-misi') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">VISI DAN MISI</a>
                            <a href="{{ route('gambaran-umum-desa') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">GAMBARAN UMUM DESA</a>
                            <a href="{{ route('kondisi-geografis') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KONDISI GEOGRAFIS</a>
                        </div>
                    </li>

                    {{-- Dropdown POTENSI DESA --}}
                    <li>
                        <button @click="openMenu = (openMenu === 'potensi' ? '' : 'potensi')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>POTENSI DESA</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'potensi' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="openMenu === 'potensi'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">ABEL RAY</a>
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">JOY MCDANIEL</a>
                        </div>
                    </li>

                    {{-- Dropdown BUMDes --}}
                    <li>
                        <button @click="openMenu = (openMenu === 'bumdes' ? '' : 'bumdes')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>BUMDES</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'bumdes' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="openMenu === 'bumdes'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="{{ route('bumdes.profil') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PROFIL BUMDES</a>
                            <a href="{{ route('bumdes.produk') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PRODUK BUMDES</a>
                        </div>
                    </li>
                    
                    {{-- Dropdown PEMERINTAH DESA --}}
                    <li>
                        <button @click="openMenu = (openMenu === 'pemerintahan' ? '' : 'pemerintahan')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                            <span>PEMERINTAH DESA</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'pemerintahan' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="openMenu === 'pemerintahan'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KEPALA DESA</a>
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">PERANGKAT DESA</a>
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">KANTOR DESA</a>
                            <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">STRUKTUR ORGANISASI</a>
                        </div>
                    </li>

                    {{-- Menu tunggal PROGRAM DESA --}}
                    <li><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">PROGRAM DESA</a></li>

                    {{-- Navigasi Cepat (Hanya Mobile) --}}
                    <div class="md:hidden">
                        <li class="pt-4 mt-4 border-t border-green-700">
                            <span class="px-3 text-xs font-semibold uppercase text-green-300">Navigasi</span>
                        </li>

                        {{-- Dropdown Layanan (Mobile) --}}
                        <li>
                            <button @click="openMenu = (openMenu === 'layanan' ? '' : 'layanan')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                                <span>LAYANAN</span>
                                <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'layanan' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div x-show="openMenu === 'layanan'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                                <a href="{{ route('suket.sk-kematian') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Kematian</a>
                                <a href="{{ route('suket.sk-usaha') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Usaha</a>
                                <a href="{{ route('suket.sk-beda-nama') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Beda Nama</a>
                                <a href="{{ route('suket.sk-tidak-mampu') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Tidak Mampu</a>
                                <a href="{{ route('suket.sk-penghasilan') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Penghasilan</a>
                                <a href="{{ route('suket.sk-status-pernikahan') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Ket. Status Pernikahan</a>
                                <a href="{{ route('suket.sk-riwayat-tanah') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Ket. Riwayat Tanah</a>
                                <a href="{{ route('suket.sk-kelahiran') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Kelahiran</a>
                                <a href="{{ route('suket.sk-ahli-waris') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Ahli Waris</a>
                                <a href="{{ route('suket.sk-lain') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Surat Keterangan Lain</a>
                                <div class="border-t border-green-600 my-1"></div>
                                <a href="#" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Lihat Progres Pemohon</a>
                            </div>
                        </li>

                        <li><a href="{{ url('/berita') }}" class="block py-2 px-3 rounded hover:bg-green-700">BERITA</a></li>
                        <li><a href="{{ route('kondisi-geografis') }}" class="block py-2 px-3 rounded hover:bg-green-700">INFO GRAFIS</a></li>

                        {{-- Dropdown Galeri (Mobile) --}}
                        <li>
                            <button @click="openMenu = (openMenu === 'galeri' ? '' : 'galeri')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                                <span>GALERI</span>
                                <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': openMenu === 'galeri' }" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div x-show="openMenu === 'galeri'" x-transition class="pl-4 mt-2 space-y-2 bg-green-700 rounded-md overflow-hidden">
                                <a href="{{ route('galeri-foto') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Foto</a>
                                <a href="{{ route('galeri-video') }}" class="block text-sm py-2 px-3 hover:bg-green-600 rounded-md">Video</a>
                            </div>
                        </li>

                        <li><a href="{{ route('hubungi-kami') }}" class="block py-2 px-3 rounded hover:bg-green-700">HUBUNGI KAMI</a></li>
                    </div>
                </ul>
            </nav>
            {{-- ====================================================== --}}
            {{-- PERBAIKAN DI SINI: Tombol Login/Logout dikembalikan --}}
            {{-- ====================================================== --}}
            <div class="mt-6">
                @guest('admin')
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-green-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>LOGIN</span>
                    </a>
                @endguest
                @auth('admin')
                    <form method="POST" action="{{ route('backend.auth.logout') }}">
                        @csrf
                        <a href="{{ route('backend.auth.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>LOGOUT</span>
                        </a>
                    </form>
                @endauth
            </div>
        </aside>

        {{-- Overlay untuk mobile --}}
        <div x-show="isSidebarOpen && window.innerWidth < 768" @click="isSidebarOpen = false" class="fixed inset-0 bg-black opacity-50 z-20 md:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64 transition-all duration-300 ease-in-out">
            {{-- HEADER / NAVBAR ATAS (LENGKAP) --}}
            <header class="bg-white shadow z-10">
                <div class="container mx-auto px-4 sm:px-6 py-3 flex justify-end items-center">
                    <nav class="hidden md:flex space-x-8">
                        {{-- Dropdown Layanan --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>LAYANAN</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute mt-2 w-64 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50 origin-top-right">
                                <a href="{{ route('suket.sk-kematian') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Kematian</a>
                                <a href="{{ route('suket.sk-usaha') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Usaha</a>
                                <a href="{{ route('suket.sk-beda-nama') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Beda Nama</a>
                                <a href="{{ route('suket.sk-tidak-mampu') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Tidak Mampu</a>
                                <a href="{{ route('suket.sk-penghasilan') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Penghasilan</a>
                                <a href="{{ route('suket.sk-status-pernikahan') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Status Pernikahan</a>
                                <a href="{{ route('suket.sk-riwayat-tanah') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Riwayat Tanah</a>
                                <a href="{{ route('suket.sk-kelahiran') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Kelahiran</a>
                                <a href="{{ route('suket.sk-ahli-waris') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Ahli Waris</a>
                                <a href="{{ route('suket.sk-lain') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Surat Keterangan Lain</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Lihat Progres Pemohon</a>
                            </div>
                        </div>

                        <a href="{{ url('/berita') }}" class="text-gray-600 hover:text-green-700">BERITA</a>
                        <a href="{{ route('kondisi-geografis') }}" class="text-gray-600 hover:text-green-700">INFO GRAFIS</a>

                        {{-- Dropdown Galeri --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-gray-600 hover:text-green-700 flex items-center">
                                <span>GALERI</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg py-1 z-50 origin-top-right">
                                <a href="{{ route('galeri-foto') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Foto</a>
                                <a href="{{ route('galeri-video') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Video</a>
                            </div>
                        </div>
                        <a href="{{ route('hubungi-kami') }}" class="text-gray-600 hover:text-green-700">HUBUNGI KAMI</a>
                    </nav>

                    {{-- Kolom Pencarian --}}
                    <div class="relative ml-6">
                        <input type="search" placeholder="Search" class="py-2 pl-10 pr-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </div>
            </header>
            
            {{-- Isi Halaman (Konten Dinamis) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-4 sm:p-6">
                @if (!Request::routeIs('home') && !Request::routeIs('backend.dashboard'))
                    <div class="mb-6">
                        <button onclick="window.history.back()" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest shadow-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h14"></path></svg>
                            Kembali
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
