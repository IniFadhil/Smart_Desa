@extends('components.layouts.app')

@section('content')
    <div class="bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header Halaman --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight lg:text-5xl">
                    Produk Unggulan BUMDES
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                    Temukan dan dukung produk-produk terbaik hasil karya warga desa kami.
                </p>
            </div>

            {{-- Fitur Pencarian dan Filter telah dihilangkan --}}

            {{-- Grid Produk --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($produks as $produk)
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col group transform hover:-translate-y-2 transition-transform duration-300">
                        {{-- Gambar Produk --}}
                        <div class="relative">
                            <img class="h-56 w-full object-cover" src="{{ $produk->gambar }}" alt="{{ $produk->nama }}">
                            {{-- Kategori telah dihilangkan --}}
                        </div>

                        {{-- Detail Produk --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $produk->nama }}</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-grow">{{ $produk->deskripsi }}</p>

                            <div class="mt-auto">
                                {{-- Harga telah dihilangkan --}}

                                {{-- Tombol Aksi (Lihat Detail telah dihilangkan) --}}

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination (jika diperlukan nanti) --}}
            <div class="mt-12">
                {{--
            <div class="flex justify-center">
                {{ $produks->links() }}
            </div>
            --}}
            </div>

        </div>
    </div>
@endsection
