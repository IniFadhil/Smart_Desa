<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-4 sm:p-6 lg:p-8">
            <div class="bg-white rounded-lg shadow-xl p-6 sm:p-8">
                <div
                    class="text-center mb-10 bg-gradient-to-r from-green-500 to-teal-600 p-8 rounded-lg shadow-lg -mt-16 mx-auto max-w-4xl">
                    <h1 class="text-4xl font-extrabold text-white tracking-tight">Papan Pengumuman Desa</h1>
                    <p class="mt-2 text-lg text-green-100">Informasi resmi terbaru dari pemerintah desa.</p>
                </div>

                <div class="space-y-8">
                    @forelse ($pengumumans as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-blue-500">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $item->title }}</h3>
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-100 text-blue-800">
                                        Informasi
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-3">
                                    Dipublikasikan pada:
                                    {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                                </p>
                                <div class="text-gray-700 leading-relaxed prose max-w-none">
                                    {!! $item->description !!}
                                </div>

                                {{-- Tambahkan link download jika ada file --}}
                                @if ($item->file)
                                    <div class="mt-4">
                                        <a href="{{ asset('backend/files/informasi/pengumuman/' . $item->file) }}"
                                            target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Unduh Lampiran
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada pengumuman untuk ditampilkan.</p>
                    @endforelse
                </div>

                {{-- Link Paginasi --}}
                <div class="mt-8">
                    {{ $pengumumans->links() }}
                </div>
            </div>
        </div>
    @endsection
</x-layouts.app>
