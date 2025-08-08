<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                {{-- Judul Berita Dinamis --}}
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $berita->title }}</h1>

                {{-- Info Tanggal & Dilihat (Dinamis) --}}
                <div class="text-sm text-gray-500 mb-6 flex items-center space-x-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $berita->hit ?? 0 }}x dilihat</span>
                    </div>
                </div>

                {{-- Gambar Berita (Dinamis) --}}
                <img src="{{ asset('backend/images/informasi/berita/' . ($berita->img ?? 'default.jpg')) }}"
                    alt="{{ $berita->title }}" class="w-full h-96 object-cover rounded-lg mb-8 shadow-md">

                {{-- Konten Berita (Dinamis) --}}
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $berita->content !!}
                </div>
            </div>
        @endsection
</x-layouts.app>
