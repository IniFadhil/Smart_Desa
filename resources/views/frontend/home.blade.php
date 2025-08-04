@extends('components.layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 font-banner">
             Desa Sukamandi
            </h1>
            <p class="text-gray-600 mt-2 text-lg">
                Kecamatan Sagalaherang, Kabupaten Subang
            </p>
        </div>
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

            
            <div class="bg-white p-4 rounded-lg shadow-md h-full flex flex-col">
    <h3 class="font-bold text-lg mb-4 text-gray-700">AGENDA</h3>
    
    <div class="space-y-3 flex-grow">

        {{-- Contoh Agenda 1 (Bisa dibuka-tutup) --}}
        <div x-data="{ open: false }" class="bg-gray-100 rounded-lg shadow-sm">
            {{-- Bagian yang selalu terlihat dan bisa diklik --}}
            <button @click="open = !open" class="w-full flex justify-between items-center text-left p-3">
                <h4 class="font-semibold text-gray-800 text-base">Kerja Bakti Lingkungan RW 03</h4>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            {{-- Bagian detail yang akan muncul --}}
            <div x-show="open" x-transition class="px-3 pb-3">
                <p class="text-gray-600 text-xs mb-2">Pembersihan selokan dan area taman bersama warga.</p>
            </div>
        </div>

        {{-- Contoh Agenda 2 (Bisa dibuka-tutup, default terbuka) --}}
        <div x-data="{ open: true }" class="bg-gray-100 rounded-lg shadow-sm">
            {{-- Bagian yang selalu terlihat dan bisa diklik --}}
            <button @click="open = !open" class="w-full flex justify-between items-center text-left p-3">
                <h4 class="font-semibold text-gray-800 text-base">Penyuluhan Kesehatan Stunting</h4>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            {{-- Bagian detail yang akan muncul --}}
            <div x-show="open" x-transition class="px-3 pb-3">
                <p class="text-gray-600 text-xs mb-2">Program dari Puskesmas untuk ibu dan anak.</p>
            </div>
        </div>

    </div>
    <div class="flex justify-end mt-4">
        <a href="{{ route('agenda.index') }}" class="text-green-600 hover:underline text-sm font-semibold">
            Lihat Semua Agenda &rarr;
        </a>
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
