<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-green-800 text-white p-4 flex flex-col justify-between" x-data="{ openMenu: '' }">
    <nav>
        <ul>
            <li class="mb-2">
                <button @click="openMenu = (openMenu === 'profil' ? '' : 'profil')" class="w-full flex justify-between items-center py-2 px-3 rounded hover:bg-green-700 focus:outline-none">
                    <span>PROFIL DESA</span>
                    <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openMenu === 'profil'}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="openMenu === 'profil'" class="pl-4 mt-2 space-y-2" style="display: none;">
                    <a href="#" class="block text-sm hover:text-green-200">SEJARAH DESA</a>
                    <a href="#" class="block text-sm hover:text-green-200">VISI DAN MISI</a>
                    <a href="#" class="block text-sm hover:text-green-200">GAMBARAN UMUM DESA</a>
                    <a href="#" class="block text-sm hover:text-green-200">KONDISI GEOGRAFIS</a>
                </div>
            </li>

            <li class="mb-2"><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">POTENSI DESA</a></li>
            <li class="mb-2"><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">BUMDES</a></li>
            <li class="mb-2"><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">PEMERINTAH DESA</a></li>
            <li class="mb-2"><a href="#" class="block py-2 px-3 rounded hover:bg-green-700">PROGRAM DESA</a></li>
        </ul>
    </nav>

    <div>
        <a href="{{ route('login') }}" class="flex items-center space-x-2 block py-2 px-3 rounded hover:bg-green-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
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
                    
                    <nav class="hidden md:flex items-center space-x-6 font-semibold text-gray-600">
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none hover:text-green-600">
                                <span>Layanan</span>
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Kematian</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Usaha</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Beda Nama</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Tidak Mampu</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Penghasilan</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Status Pernikahan</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Riwayat Tanah</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Kelahiran</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Ahli Waris</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat Keterangan Lain</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat Progres Permohonan</a>
                            </div>
                        </div>

                        <a href="#" class="hover:text-green-600">Berita</a>
                        <a href="#" class="hover:text-green-600">Info Grafis</a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none hover:text-green-600">
                         <span>Galeri</span>
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Foto</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Vidio</a>
                        </div>
                    </div>
                        <a href="#" class="hover:text-green-600">Hubungi Kami</a>
                    </nav>
                    <div class="relative">
                        <input type="text" placeholder="Search" class="px-4 py-2 border rounded-md">
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>