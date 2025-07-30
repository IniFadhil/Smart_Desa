{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Galeri Video Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Saksikan berbagai momen dan kegiatan penting di Desa [Nama Desa Anda] melalui koleksi video kami.
                </p>

                {{-- Bagian Unggah Video --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Unggah Video Baru</h2>
                    {{-- PERHATIAN: Atribut 'action' saat ini adalah '#'. Anda perlu menggantinya dengan URL endpoint backend yang akan memproses unggahan ini. --}}
                    {{-- PENTING: @csrf telah dihapus. Aplikasi Anda sekarang RENTAN terhadap serangan CSRF. --}}
                    <form action="#" method="POST" class="space-y-4">
                        {{-- @csrf --}} {{-- Baris ini telah dikomentari/dihapus --}}
                        <div>
                            <x-input-label for="video_url" value="URL Video (YouTube/Vimeo Embed Link)*" />
                            <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full" placeholder="Contoh: https://www.youtube.com/embed/VIDEO_ID" required />
                            <p class="text-xs text-gray-500 mt-1">Masukkan URL embed dari YouTube atau Vimeo.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('video_url')" />
                        </div>
                        <div>
                            <x-input-label for="judul_video" value="Judul Video*" />
                            <x-text-input id="judul_video" name="judul_video" type="text" class="mt-1 block w-full" placeholder="Masukkan judul video" required />
                            <x-input-error class="mt-2" :messages="$errors->get('judul_video')" />
                        </div>
                        <div>
                            <x-input-label for="deskripsi_video" value="Deskripsi Video (Opsional)" />
                            <textarea id="deskripsi_video" name="deskripsi_video" rows="3" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Deskripsi singkat tentang video"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi_video')" />
                        </div>
                        {{-- Input untuk URL Unduh (jika berbeda dari URL embed) --}}
                        <div>
                            <x-input-label for="download_url" value="URL Unduh Video (Opsional)" />
                            <x-text-input id="download_url" name="download_url" type="url" class="mt-1 block w-full" placeholder="Masukkan URL untuk mengunduh video (jika ada)" />
                            <p class="text-xs text-gray-500 mt-1">Jika kosong, tombol unduh akan mengarah ke URL embed.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('download_url')" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Unggah Video
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Bagian Galeri Video --}}
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Contoh Video 1 --}}
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <div class="relative" style="padding-bottom: 56.25%;"> {{-- 16:9 Aspect Ratio --}}
                            {{-- Menggunakan iframe untuk pemutaran YouTube/Vimeo --}}
                            <iframe class="absolute top-0 left-0 w-full h-full rounded-t-lg"
                                src="https://www.youtube.com/embed/FdPjTTu1xTU" {{-- ID video yang benar --}}
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 1: Kegiatan Gotong Royong</h3>
                            <p class="text-gray-600 text-sm mb-3">Deskripsi singkat tentang kegiatan gotong royong di desa.</p>
                            {{-- Tombol Unduh Terpisah --}}
                            <a href="https://www.youtube.com/watch?v=FdPjTTu1xTU" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                Unduh Video
                            </a>
                        </div>
                    </div>

                    {{-- Contoh Video 2 --}}
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <div class="relative" style="padding-bottom: 56.25%;">
                            <iframe class="absolute top-0 left-0 w-full h-full rounded-t-lg"
                                src="https://www.youtube.com/embed/Z74YQYW2jvk" {{-- PERBAIKAN DI SINI: Menggunakan ID video yang benar untuk live stream --}}
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 2: Acara Adat Desa</h3>
                            <p class="text-gray-600 text-sm mb-3">Cuplikan acara adat yang diselenggarakan di desa.</p>
                            <a href="https://www.youtube.com/watch?v=Z74YQYW2jvk" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                Unduh Video
                            </a>
                        </div>
                    </div>

                    {{-- Contoh Video 3 --}}
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <div class="relative" style="padding-bottom: 56.25%;">
                            <iframe class="absolute top-0 left-0 w-full h-full rounded-t-lg"
                                src="https://www.youtube.com/embed/nooCyc757DI" {{-- ID video yang benar --}}
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 3: Profil Potensi Desa</h3>
                            <p class="text-gray-600 text-sm mb-3">Video yang menampilkan potensi-potensi unggulan desa.</p>
                            <a href="https://www.youtube.com/watch?v=nooCyc757DI" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                Unduh Video
                            </a>
                        </div>
                    </div>

                    {{-- Duplikasi untuk lebih banyak video --}}
                </div>

                {{-- Bagian Paginasi (Opsional) --}}
                {{-- ... (tetap dikomentari jika belum diaktifkan) ... --}}
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
