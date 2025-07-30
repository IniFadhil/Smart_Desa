@extends('components.layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        {{-- SLIDESHOW --}}
        <div x-data="{
                images: [
                    '{{ asset('img/subang1.webp') }}',
                    '{{ asset('img/subang2.png') }}',
                    '{{ asset('img/subang3.jpg') }}'
                ],
                activeIndex: 0,
                next() {
                    this.activeIndex = this.activeIndex === this.images.length - 1 ? 0 : this.activeIndex + 1;
                },
                previous() {
                    this.activeIndex = this.activeIndex === 0 ? this.images.length - 1 : this.activeIndex - 1;
                }
            }" x-init="setInterval(() => { next() }, 5000)"
            class="relative w-full h-80 rounded-lg shadow-md mb-6 overflow-hidden">

            <img :src="images[activeIndex]" alt="Slideshow Desa"
                class="w-full h-full object-cover transition-opacity duration-500">

            <button @click="previous()"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                &#10094;
            </button>
            <button @click="next()"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                &#10095;
            </button>

                        <div class="absolute bottom-0 left-0 p-6 sm:p-8 text-white z-10">
                <h1 class="text-4xl md:text-5xl font-banner font-bold drop-shadow-lg">
                    Website Desa Sukamandi
                </h1>
                <p class="mt-2 text-lg text-gray-200 drop-shadow-md">
                    Kecamatan Sagalaherang, Kabupaten Subang
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            {{-- BAGIAN BERITA (TIDAK DIUBAH) --}}
            <div class="bg-white p-4 rounded-lg shadow-md h-full flex flex-col">
                <h3 class="font-bold text-lg mb-4 text-gray-700">BERITA</h3>
                <div class="space-y-4 flex-grow">
                    @for ($i = 1; $i <= 2; $i++)
                        <div class="bg-gray-100 rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row p-3 items-start md:items-center">
                            <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Berita Home {{ $i }}" class="w-full md:w-24 h-auto md:h-16 object-cover rounded-md mb-2 md:mb-0 md:mr-3">
                            <div class="flex-grow">
                                <h4 class="font-semibold text-gray-800 text-base mb-1">Judul Berita Home - {{ $i }}</h4>
                                <p class="text-gray-600 text-xs mb-2">Ringkasan singkat berita home nomor {{ $i }}. Lorem ipsum dolor sit amet.</p>
                                <a href="{{ url('/berita/judul-berita-halaman-1-no-' . $i) }}" class="text-green-600 hover:underline text-xs font-semibold">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('berita.index') }}" class="text-green-600 hover:underline text-sm font-semibold">
                        Lihat Semua Berita &rarr;
                    </a>
                </div>
            </div>

            {{-- ====================================================== --}}
            {{-- PERBAIKAN IKON DIMULAI DARI SINI --}}
            {{-- ====================================================== --}}
            <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">AGENDA</h2>
                <div class="space-y-4 flex-grow">

                    {{-- Agenda 1 (Dengan Ikon Baru) --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="bg-gray-100 rounded-lg p-4 shadow-sm border border-gray-200 w-full flex items-center justify-between text-left focus:outline-none focus:ring-2 focus:ring-green-500">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-300 text-gray-800 font-bold text-xl px-4 py-2 rounded-md">1</div>
                                <h3 class="text-lg font-semibold text-green-700">LOREM IPSUM</h3>
                            </div>
                            <svg class="h-5 w-5 transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-xl border border-gray-200 p-4">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="text-sm">Lorem Ipsum</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">12:00 - 15:00</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                                    </svg>
                                    <span class="text-sm">01 Juli 2025 - 14 Juli 2025</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3h7.5m-1.5-9h5.25m-5.25 3h5.25M5.25 21V3.75a2.25 2.25 0 012.25-2.25h6.375c.621 0 1.223.24 1.697.668l3.868 3.868c.428.428.668 1.076.668 1.697v8.625a2.25 2.25 0 01-2.25 2.25H5.25z" />
                                    </svg>
                                    <span class="text-sm">Amet saepe ut fugit</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Agenda 2 (Dengan Ikon Baru) --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="bg-gray-100 rounded-lg p-4 shadow-sm border border-gray-200 w-full flex items-center justify-between text-left focus:outline-none focus:ring-2 focus:ring-green-500">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-300 text-gray-800 font-bold text-xl px-4 py-2 rounded-md">2</div>
                                <h3 class="text-lg font-semibold text-green-700">JUDUL AGENDA LAIN</h3>
                            </div>
                            <svg class="h-5 w-5 transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-xl border border-gray-200 p-4">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="text-sm">Lokasi Acara</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">09:00 - 10:00</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                                    </svg>
                                    <span class="text-sm">20 Agustus 2025</span>
                                </div>
                                <div class="flex items-center space-x-3 text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 flex-shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3h7.5m-1.5-9h5.25m-5.25 3h5.25M5.25 21V3.75a2.25 2.25 0 012.25-2.25h6.375c.621 0 1.223.24 1.697.668l3.868 3.868c.428.428.668 1.076.668 1.697v8.625a2.25 2.25 0 01-2.25 2.25H5.25z" />
                                    </svg>
                                    <span class="text-sm">Deskripsi Singkat Agenda</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end mt-4">
                </div>
            </div>
            {{-- ====================================================== --}}
            {{-- PERBAIKAN SELESAI DI SINI --}}
            {{-- ====================================================== --}}

            {{-- BAGIAN PENGUMUMAN (TIDAK DIUBAH) --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4 text-gray-700">PENGUMUMAN</h3>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    @php
                        $pengumumanTerbaru = (object) [
                            'isi' => 'Diberitahukan kepada seluruh warga desa, kegiatan Posyandu untuk balita dan lansia akan dilaksanakan pada tanggal 15 Agustus 2025. Mohon kehadirannya.',
                        ];
                    @endphp

                    @if ($pengumumanTerbaru)
                        <p class="text-gray-600">
                            {{ $pengumumanTerbaru->isi }}
                        </p>
                    @else
                        <p class="text-gray-500 text-center">Belum ada pengumuman.</p>
                    @endif
                </div>
                <div class="text-right mt-4">
                    <a href="{{ route('pengumuman.index') }}" class="text-sm font-medium text-green-600 hover:text-green-800">
                        Lihat Semua Pengumuman &rarr;
                    </a>
                </div>
            </div>

            {{-- BAGIAN FOTO (TIDAK DIUBAH) --}}
            <div class="bg-white p-4 rounded-lg shadow-md h-full flex flex-col">
                <h3 class="font-bold text-lg mb-2 text-gray-700">FOTO</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500 flex-grow">
                    BELUM ADA DATA
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('galeri-foto') }}" class="text-green-600 hover:underline text-sm font-semibold">
                        Lihat Semua Foto &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
