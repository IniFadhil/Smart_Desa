<x-layouts.app>

<div
    x-data="{
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
    }"
    x-init="setInterval(() => { next() }, 5000)"
    class="relative w-full h-80 rounded-lg shadow-md mb-6 overflow-hidden">

    <div class="absolute inset-0 bg-gray-200"></div>

    <template x-for="(image, index) in images" :key="index">
        <div
            x-show="activeIndex === index"
            x-transition:enter="transition ease-in-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 w-full h-full"
        >
            <img
                :src="image"
                alt="Slideshow Desa"
                class="w-full h-full object-cover"
                {{-- Di baris inilah perubahannya --}}
                :class="{ 'object-center': index === 1 }"
            >
        </div>
    </template>

    <button @click="previous()" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full z-10">
        &#10094;
    </button>
    <button @click="next()" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full z-10">
        &#10095;
    </button>

    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
        <template x-for="(image, index) in images">
            <button @click="activeIndex = index"
                    :class="{'bg-white': activeIndex === index, 'bg-gray-400': activeIndex !== index}"
                    class="w-3 h-3 rounded-full"></button>
        </template>
    </div>
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

</x-layouts.app>