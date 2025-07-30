{{-- resources/views/frontend/berita/index.blade.php --}}

<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Berita Terbaru dari Desa</h1>
                <p class="text-gray-600 text-center mb-8">
                    Ikuti perkembangan terbaru dan informasi penting dari desa kami.
                </p>

                {{-- Kontainer untuk berita yang bisa berubah --}}
                <div id="news-container">
                    {{-- Halaman 1: 3 Berita Pertama --}}
                    <div class="news-page" id="page-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden flex flex-col">
                                    {{-- Gambar Berita (Sudah Diubah) --}}
                                    <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Berita Halaman 1 No {{ $i }}" class="w-full h-48 object-cover">
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Judul Berita Halaman 1 - {{ $i }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 flex-grow">Ini adalah ringkasan singkat dari berita halaman 1 nomor {{ $i }}. Konten ini akan terlihat di halaman pertama.</p>
                                        <div class="flex items-center text-gray-500 text-xs mb-3">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            <span>25 Juli 2025</span>
                                            <span class="mx-2">•</span>
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                            <span>123 dilihat</span>
                                        </div>
                                        <a href="{{ url('/berita/judul-berita-halaman-1-no-' . $i) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-auto">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Halaman 2 (sembunyikan secara default dengan CSS/JS) --}}
                    <div class="news-page hidden" id="page-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden flex flex-col">
                                    {{-- Gambar Berita (Sudah Diubah) --}}
                                    <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Berita Halaman 2 No {{ $i }}" class="w-full h-48 object-cover">
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Judul Berita Halaman 2 - {{ $i }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 flex-grow">Ringkasan singkat berita halaman 2 nomor {{ $i }}. Ini adalah konten yang berbeda.</p>
                                        <div class="flex items-center text-gray-500 text-xs mb-3">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            <span>24 Juli 2025</span>
                                            <span class="mx-2">•</span>
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                            <span>87 dilihat</span>
                                        </div>
                                        <a href="{{ url('/berita/judul-berita-halaman-2-no-' . $i) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-auto">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Halaman 3 (sembunyikan secara default) --}}
                    <div class="news-page hidden" id="page-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden flex flex-col">
                                    {{-- Gambar Berita (Sudah Diubah) --}}
                                    <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Berita Halaman 3 No {{ $i }}" class="w-full h-48 object-cover">
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Judul Berita Halaman 3 - {{ $i }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 flex-grow">Ringkasan singkat berita halaman 3 nomor {{ $i }}. Ini adalah konten untuk halaman terakhir.</p>
                                        <div class="flex items-center text-gray-500 text-xs mb-3">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            <span>23 Juli 2025</span>
                                            <span class="mx-2">•</span>
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                            <span>55 dilihat</span>
                                        </div>
                                        <a href="{{ url('/berita/judul-berita-halaman-3-no-' . $i) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-auto">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div> {{-- End news-container --}}


                {{-- Paginasi interaktif dengan JS --}}
                <div class="mt-8 flex justify-center">
                    <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" id="prev-page" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="page-link relative inline-flex items-center px-4 py-2 border border-green-500 bg-green-50 text-sm font-medium text-green-600" data-page="1">1</a>
                        <a href="#" class="page-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" data-page="2">2</a>
                        <a href="#" class="page-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" data-page="3">3</a>
                        <a href="#" id="next-page" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>

            {{-- TOMBOL UNGGAH BERITA BARU (LOKASI BARU) --}}
            <div class="flex justify-center mt-8">
                <a href="{{ url('/berita/upload') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white text-sm hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Unggah Berita
                </a>
            </div>
            {{-- AKHIR TOMBOL UNGGAH BERITA BARU --}}
        </div>
    @endsection

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const newsPages = document.querySelectorAll('.news-page');
            const pageLinks = document.querySelectorAll('.page-link');
            const prevPageBtn = document.getElementById('prev-page');
            const nextPageBtn = document.getElementById('next-page');
            let currentPage = 1;
            const totalPages = newsPages.length;

            function showPage(pageNumber) {
                newsPages.forEach(page => page.classList.add('hidden'));
                const targetPage = document.getElementById('page-' + pageNumber);
                if (targetPage) {
                    targetPage.classList.remove('hidden');
                }

                pageLinks.forEach(link => {
                    if (parseInt(link.dataset.page) === pageNumber) {
                        link.classList.add('border-green-500', 'bg-green-50', 'text-green-600');
                        link.classList.remove('border-gray-300', 'bg-white', 'text-gray-700', 'hover:bg-gray-50');
                    } else {
                        link.classList.remove('border-green-500', 'bg-green-50', 'text-green-600');
                        link.classList.add('border-gray-300', 'bg-white', 'text-gray-700', 'hover:bg-gray-50');
                    }
                });

                if (pageNumber === 1) {
                    prevPageBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevPageBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                if (pageNumber === totalPages) {
                    nextPageBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextPageBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                currentPage = pageNumber;
            }

            pageLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const page = parseInt(this.dataset.page);
                    showPage(page);
                });
            });

            prevPageBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });

            nextPageBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            });

            showPage(1);
        });
    </script>
    @endpush
</x-layouts.app>
