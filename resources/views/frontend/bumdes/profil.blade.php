@extends('components.layouts.app')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Halaman --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight lg:text-5xl">
                    Profil {{ $profil->nama }}
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                    Mengenal lebih dekat Badan Usaha Milik Desa kami.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-6 md:p-8">
                {{-- Bagian Tentang Kami / Sejarah --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-green-700 mb-4 border-l-4 border-green-500 pl-4">Tentang Kami</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $profil->sejarah }}
                    </p>
                </div>

                {{-- Bagian Visi & Misi --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-green-700 mb-4 border-l-4 border-green-500 pl-4">Visi & Misi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Visi</h3>
                            <p class="text-gray-600 italic">"{{ $profil->visi }}"</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Misi</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                @foreach ($profil->misi as $m)
                                    <li>{{ $m }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Bagian Struktur Organisasi --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-green-700 mb-4 border-l-4 border-green-500 pl-4">Struktur Organisasi
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                        @foreach ($profil->struktur as $jabatan => $nama)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <p class="font-bold text-gray-800">{{ $nama }}</p>
                                <p class="text-sm text-green-600 font-semibold">{{ $jabatan }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol Aksi ke Halaman Produk --}}
                <div class="mt-12 text-center">
                    <a href="{{ route('bumdes.produk') }}"
                        class="inline-block px-8 py-3 bg-green-600 text-white font-bold text-lg rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105">
                        Lihat Produk Kami &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
