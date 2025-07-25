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
                    {{-- PERHATIAN: Atribut 'action' saat ini adalah '#'. Anda perlu menggantinya dengan URL endpoint backend yang akan memproses unggahan file ini. --}}
                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf {{-- Token CSRF untuk keamanan Laravel --}}
                        <div>
                            <x-input-label for="video_file" value="Pilih File Video untuk Diunggah*" />
                            <input id="video_file" name="video_file" type="file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-100 file:text-green-700
                                hover:file:bg-green-200" required accept="video/mp4,video/webm,video/ogg" />
                            <p class="text-xs text-gray-500 mt-1">Format: MP4, WebM, Ogg | Max size: 50MB (sesuaikan)</p>
                            <x-input-error class="mt-2" :messages="$errors->get('video_file')" />
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
                            {{-- Menggunakan tag <video> untuk pemutaran langsung --}}
                            <video controls class="absolute top-0 left-0 w-full h-full rounded-t-lg">
                                {{-- Ganti URL placeholder ini dengan path video Anda yang sebenarnya --}}
                                <source src="{{ asset('videos/sample_video_1.mp4') }}" type="video/mp4">
                                Maaf, browser Anda tidak mendukung tag video.
                            </video>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 1: Kegiatan Gotong Royong</h3>
                            <p class="text-gray-600 text-sm mb-3">Deskripsi singkat tentang kegiatan gotong royong di desa.</p>
                            {{-- Tombol Unduh Terpisah --}}
                            <a href="{{ asset('videos/sample_video_1.mp4') }}" download="kegiatan_gotong_royong.mp4" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                Unduh Video
                            </a>
                        </div>
                    </div>

                    {{-- Contoh Video 2 --}}
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <div class="relative" style="padding-bottom: 56.25%;">
                            <video controls class="absolute top-0 left-0 w-full h-full rounded-t-lg">
                                <source src="{{ asset('videos/sample_video_2.mp4') }}" type="video/mp4">
                                Maaf, browser Anda tidak mendukung tag video.
                            </video>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 2: Acara Adat Desa</h3>
                            <p class="text-gray-600 text-sm mb-3">Cuplikan acara adat yang diselenggarakan di desa.</p>
                            <a href="{{ asset('videos/sample_video_2.mp4') }}" download="acara_adat_desa.mp4" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                Unduh Video
                            </a>
                        </div>
                    </div>

                    {{-- Contoh Video 3 --}}
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <div class="relative" style="padding-bottom: 56.25%;">
                            <video controls class="absolute top-0 left-0 w-full h-full rounded-t-lg">
                                <source src="{{ asset('videos/sample_video_3.mp4') }}" type="video/mp4">
                                Maaf, browser Anda tidak mendukung tag video.
                            </video>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Judul Video 3: Profil Potensi Desa</h3>
                            <p class="text-gray-600 text-sm mb-3">Video yang menampilkan potensi-potensi unggulan desa.</p>
                            <a href="{{ asset('videos/sample_video_3.mp4') }}" download="profil_potensi_desa.mp4" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
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
