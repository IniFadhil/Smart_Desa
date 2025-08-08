<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Berita Terbaru dari Desa</h1>
                <p class="text-gray-600 text-center mb-8">
                    Ikuti perkembangan terbaru dan informasi penting dari desa kami.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($beritas as $berita)
                        <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden flex flex-col">
                            <img src="{{ asset('backend/images/informasi/berita/' . ($berita->img ?? 'default.jpg')) }}"
                                alt="{{ $berita->title }}" class="w-full h-48 object-cover">
                            <div class="p-4 flex-grow flex flex-col">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $berita->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3 flex-grow">{{ $berita->short_content }}</p>
                                <div class="flex items-center text-gray-500 text-xs mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                                    <span class="mx-2">•</span>
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $berita->hit ?? 0 }} dilihat</span>
                                </div>
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-auto">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 col-span-3">Belum ada berita untuk ditampilkan.</p>
                    @endforelse
                </div>

                {{-- Link Paginasi --}}
                <div class="mt-8">
                    {{ $beritas->links() }}
                </div>

            </div>
        </div>
    @endsection
</x-layouts.app>
