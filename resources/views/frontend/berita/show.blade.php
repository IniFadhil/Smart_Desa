{{-- resources/views/frontend/berita/show.blade.php --}}

<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Judul Berita Lengkapnya di Sini</h1>
                <div class="text-sm text-gray-500 mb-6 flex items-center space-x-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        <span>25 Juli 2025</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                        <span>125x dilihat</span>
                    </div>
                </div>

                {{-- Gambar Berita (Placeholder) --}}
                <img src="https://via.placeholder.com/1200x600?text=Gambar+Berita+Utama" alt="Gambar Berita Utama" class="w-full h-96 object-cover rounded-lg mb-8 shadow-md">

                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p>
                        <strong>Sub Judul Penting:</strong> Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus auctor iaculis.
                    </p>
                    <p>
                        Praesent eu diam at sem auctor iaculis. Sed elit quam, iaculis sed, tempor sit amet, euismod in, ac, lorem. Praesent ipsum dolor. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt ultricies mauris.
                    </p>
                    <ul>
                        <li>Poin penting 1</li>
                        <li>Poin penting 2</li>
                        <li>Poin penting 3</li>
                    </ul>
                    <p>
                        Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Nunc commodo. Integer aliquam.
                    </p>
                </div>
            </div>
            {{-- Bagian Komentar telah dihapus dari sini --}}
        </div>
    @endsection
</x-layouts.app>