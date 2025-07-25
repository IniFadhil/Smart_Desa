@extends('components.layouts.app') {{-- BENAR --}}

@section('content')
    {{-- Memberitahu layout di mana menempatkan konten ini --}}

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2 text-gray-700">BERITA</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, optio vero beatae perferendis asperiores tenetur explicabo? Error delectus mollitia ullam.
                </div>
            </div>
             <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">AGENDA</h2>
                    <div class="space-y-4">
                        {{-- Contoh Agenda 1 --}}
                        <div x-data="{ open: false }" class="bg-gray-100 rounded-lg p-4 shadow-sm border border-gray-200">
                            <button @click="open = !open" class="w-full flex items-center justify-between focus:outline-none">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-gray-300 text-gray-800 font-bold text-xl px-4 py-2 rounded-md">1</div>
                                    <h3 class="text-lg font-semibold text-green-700">LOREM IPSUM</h3>
                                </div>
                                <svg class="h-5 w-5 transform transition-transform"
                                    :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-screen"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-screen"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="pl-4 pt-4 mt-2 space-y-2 overflow-hidden" style="display: none;">
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Lorem Ipsum</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>12:00 - 15:00</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>01 Juli 2025 - 14 Juli 2025</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Amet saepe ut fugit</span>
                                </div>
                            </div>
                        </div>

                        {{-- Contoh Agenda 2 (Duplikasi untuk menunjukkan beberapa item) --}}
                        <div x-data="{ open: false }" class="bg-gray-100 rounded-lg p-4 shadow-sm border border-gray-200">
                            <button @click="open = !open" class="w-full flex items-center justify-between focus:outline-none">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-gray-300 text-gray-800 font-bold text-xl px-4 py-2 rounded-md">2</div>
                                    <h3 class="text-lg font-semibold text-green-700">JUDUL AGENDA LAIN</h3>
                                </div>
                                <svg class="h-5 w-5 transform transition-transform"
                                    :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-screen"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-screen"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="pl-4 pt-4 mt-2 space-y-2 overflow-hidden" style="display: none;">
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Lokasi Acara</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>09:00 - 10:00</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>20 Agustus 2025</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Deskripsi Singkat Agenda</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2 text-gray-700">PENGUMUMAN</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quo omnis debitis fugit nesciunt esse perspiciatis vel optio tempore minus?
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2 text-gray-700">FOTO</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500">
                    BELUM ADA DATA
                </div>
            </div>
        </div>
    </div>
@endsection
