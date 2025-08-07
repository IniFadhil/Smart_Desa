<x-layouts.app>
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
                next() { this.activeIndex = this.activeIndex === this.images.length - 1 ? 0 : this.activeIndex + 1; },
                previous() { this.activeIndex = this.activeIndex === 0 ? this.images.length - 1 : this.activeIndex - 1; }
            }" x-init="setInterval(() => { next() }, 5000)"
                class="relative w-full h-80 rounded-lg shadow-md mb-6 overflow-hidden">

                <img :src="images[activeIndex]" alt="Slideshow Desa"
                    class="w-full h-full object-cover transition-opacity duration-500">
                <button @click="previous()"
                    class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10094;</button>
                <button @click="next()"
                    class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10095;</button>

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
                {{-- BAGIAN BERITA (Sudah Dinamis) --}}
                <div class="bg-white p-4 rounded-lg shadow-md h-full flex flex-col">
                    <h3 class="font-bold text-lg mb-4 text-gray-700">BERITA</h3>
                    <div class="space-y-4 flex-grow">
                        @forelse ($beritas as $berita)
                            <div
                                class="bg-gray-100 rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row p-3 items-start md:items-center">
                                <img src="{{ asset('backend/images/informasi/berita/' . ($berita->img ?? 'default.jpg')) }}"
                                    alt="{{ $berita->title }}"
                                    class="w-full md:w-24 h-auto md:h-16 object-cover rounded-md mb-2 md:mb-0 md:mr-3">
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-gray-800 text-base mb-1">
                                        {{ Str::limit($berita->title, 40) }}</h4>
                                    <p class="text-gray-600 text-xs mb-2">{{ Str::limit($berita->short_content, 60) }}</p>
                                    <a href="#" {{-- Ganti dengan route detail berita jika sudah ada --}}
                                        class="text-green-600 hover:underline text-xs font-semibold">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada berita.</p>
                        @endforelse
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('berita.index') }}" class="text-green-600 hover:underline text-sm font-semibold">
                            Lihat Semua Berita &rarr;
                        </a>
                    </div>
                </div>

                {{-- BAGIAN AGENDA (Sudah Dinamis) --}}
                <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">AGENDA</h2>
                    <div class="space-y-4 flex-grow">
                        @forelse ($agendas as $agenda)
                            <div class="relative bg-gray-100 rounded-lg p-4 shadow-sm border border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center bg-gray-200 rounded-md p-2">
                                        <p class="font-bold text-xl text-green-700">
                                            {{ \Carbon\Carbon::parse($agenda->start_date)->format('d') }}</p>
                                        <p class="text-xs text-gray-600">
                                            {{ \Carbon\Carbon::parse($agenda->start_date)->format('M') }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-green-700">{{ $agenda->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $agenda->address }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada agenda terdekat.</p>
                        @endforelse
                    </div>
                </div>

                {{-- BAGIAN PENGUMUMAN (Sudah Dinamis) --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg mb-4 text-gray-700">PENGUMUMAN</h3>
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        @if ($pengumumanTerbaru)
                            <p class="text-gray-600">
                                {{ $pengumumanTerbaru->short_description }}
                            </p>
                        @else
                            <p class="text-gray-500 text-center">Belum ada pengumuman.</p>
                        @endif
                    </div>
                    <div class="text-right mt-4">
                        <a href="{{ route('pengumuman.index') }}"
                            class="text-sm font-medium text-green-600 hover:text-green-800">
                            Lihat Semua Pengumuman &rarr;
                        </a>
                    </div>
                </div>

                {{-- BAGIAN FOTO (Biarkan statis untuk saat ini) --}}
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
</x-layouts.app>
