{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Galeri Foto Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Jelajahi keindahan dan berbagai kegiatan di Desa [Nama Desa Anda] melalui koleksi foto-foto kami.
                </p>

                {{-- Bagian Unggah Foto --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Unggah Foto Baru</h2>
                    {{-- PERHATIAN: Atribut 'action' saat ini adalah '#'. Anda perlu menggantinya dengan URL endpoint backend yang akan memproses unggahan file ini. --}}
                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf {{-- Token CSRF untuk keamanan Laravel --}}
                        <div>
                            <x-input-label for="foto_upload" value="Pilih Foto untuk Diunggah*" />
                            <input id="foto_upload" name="foto_upload" type="file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-100 file:text-green-700
                                hover:file:bg-green-200" required accept="image/jpeg,image/png,image/jpg" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG | Max size: 2MB</p>
                            <x-input-error class="mt-2" :messages="$errors->get('foto_upload')" />
                        </div>
                        <div>
                            <x-input-label for="judul_foto" value="Judul Foto (Opsional)" />
                            <x-text-input id="judul_foto" name="judul_foto" type="text" class="mt-1 block w-full" placeholder="Masukkan judul foto" />
                            <x-input-error class="mt-2" :messages="$errors->get('judul_foto')" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Unggah
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Bagian Galeri Foto --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    {{-- Contoh Foto 1 --}}
                    <div class="relative overflow-hidden rounded-lg shadow-md group">
                        <img src="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+1" alt="Deskripsi Foto 1" class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-lg font-semibold mb-2">Judul Foto 1</p>
                            {{-- Tombol Download --}}
                            <a href="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+1" download="foto_desa_1.jpg" class="px-3 py-1 bg-white text-green-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors">
                                Unduh
                            </a>
                        </div>
                    </div>
                    {{-- Contoh Foto 2 --}}
                    <div class="relative overflow-hidden rounded-lg shadow-md group">
                        <img src="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+2" alt="Deskripsi Foto 2" class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-lg font-semibold mb-2">Judul Foto 2</p>
                            <a href="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+2" download="foto_desa_2.jpg" class="px-3 py-1 bg-white text-green-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors">
                                Unduh
                            </a>
                        </div>
                    </div>
                    {{-- Contoh Foto 3 --}}
                    <div class="relative overflow-hidden rounded-lg shadow-md group">
                        <img src="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+3" alt="Deskripsi Foto 3" class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-lg font-semibold mb-2">Judul Foto 3</p>
                            <a href="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+3" download="foto_desa_3.jpg" class="px-3 py-1 bg-white text-green-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors">
                                Unduh
                            </a>
                        </div>
                    </div>
                    {{-- Contoh Foto 4 --}}
                    <div class="relative overflow-hidden rounded-lg shadow-md group">
                        <img src="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+4" alt="Deskripsi Foto 4" class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-lg font-semibold mb-2">Judul Foto 4</p>
                            <a href="https://placehold.co/600x400/E0F2F7/000000?text=Foto+Desa+4" download="foto_desa_4.jpg" class="px-3 py-1 bg-white text-green-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors">
                                Unduh
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Bagian Paginasi (Opsional) --}}
                {{-- ... (tetap dikomentari jika belum diaktifkan) ... --}}
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
