<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-4 sm:p-6 lg:p-8">
            {{-- Header Halaman --}}
            <div class="bg-white rounded-lg shadow-md p-8 mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Agenda Kegiatan Desa</h1>
                <p class="text-gray-600">Informasi kegiatan dan acara yang diselenggarakan di desa kami.</p>
            </div>

            {{-- BAGIAN AGENDA AKAN DATANG (INTERAKTIF) --}}
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-green-700 mb-6 border-l-4 border-green-500 pl-4">Agenda Akan Datang</h2>

                <div class="space-y-4">
                    @forelse ($agendaAkanDatang as $item)
                        <div x-data="{ open: false }" class="bg-gray-50 border border-gray-200 rounded-lg">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between text-left p-4 focus:outline-none hover:bg-gray-100 transition rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="flex flex-col items-center justify-center bg-green-100 text-green-800 rounded-lg p-3 w-20 text-center">
                                        <span
                                            class="font-bold text-2xl">{{ \Carbon\Carbon::parse($item->start_date)->format('d') }}</span>
                                        <span
                                            class="text-sm uppercase">{{ \Carbon\Carbon::parse($item->start_date)->format('M') }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-green-800">{{ $item->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $item->short_description }}</p>
                                    </div>
                                </div>
                                <svg class="h-6 w-6 transform transition-transform duration-300 text-green-600"
                                    :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="border-t border-gray-200 p-6">
                                <div class="space-y-3 text-gray-700">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 text-green-600 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span>{{ $item->address }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 text-green-600 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($item->start_date)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($item->end_date)->format('H:i') }} WIB</span>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 text-green-600 flex-shrink-0 mt-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3h7.5m-1.5-9h5.25m-5.25 3h5.25M5.25 21V3.75a2.25 2.25 0 012.25-2.25h6.375c.621 0 1.223.24 1.697.668l3.868 3.868c.428.428.668 1.076.668 1.697v8.625a2.25 2.25 0 01-2.25 2.25H5.25z" />
                                        </svg>
                                        <p>{!! $item->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada agenda yang akan datang.</p>
                    @endforelse
                </div>
            </div>

            {{-- BAGIAN ARSIP AGENDA (PAGINASI) --}}
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-500 mb-6 border-l-4 border-gray-400 pl-4">Arsip Agenda</h2>
                <div class="space-y-4">
                    @forelse ($agendaSudahLewat as $item)
                        <div class="bg-gray-100 p-4 rounded-lg flex items-center space-x-4">
                            <div
                                class="flex flex-col items-center justify-center bg-gray-200 text-gray-600 rounded-lg p-3 w-20 text-center">
                                <span
                                    class="font-bold text-2xl">{{ \Carbon\Carbon::parse($item->start_date)->format('d') }}</span>
                                <span
                                    class="text-sm uppercase">{{ \Carbon\Carbon::parse($item->start_date)->format('M \'y') }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-700">{{ $item->title }}</h3>
                                <p class="text-sm text-gray-500">Telah dilaksanakan di: {{ $item->address }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Arsip agenda masih kosong.</p>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $agendaSudahLewat->links() }}
                </div>
            </div>
        </div>
    @endsection
</x-layouts.app>
