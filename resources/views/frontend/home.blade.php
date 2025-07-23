@extends('frontend.layouts.app') {{-- Menggunakan layout khusus untuk frontend --}}

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
                    BELUM ADA DATA
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2 text-gray-700">AGENDA</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500">
                    LOREM IPSUM
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2 text-gray-700">PENGUMUMAN</h3>
                <div class="bg-gray-100 p-6 rounded text-center text-gray-500">
                    BELUM ADA DATA
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
