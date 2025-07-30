{{-- resources/views/frontend/berita/upload.blade.php --}}

<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Unggah Berita Baru</h1>
                <p class="text-gray-600 text-center mb-8">
                    Isi formulir di bawah ini untuk mengunggah berita Anda.
                </p>

                {{-- Pesan simulasi sukses/gagal (untuk UI saja) --}}
                {{-- Di implementasi backend, pesan ini akan terisi secara otomatis dari Controller --}}
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Formulir Unggah Berita --}}
                {{-- Atribut action mengarah ke rute simulasi POST yang sudah kita buat di routes/web.php --}}
                {{-- enctype="multipart/form-data" penting untuk pengunggahan file (gambar) --}}
                <form action="{{ route('berita.upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf {{-- Token CSRF diperlukan untuk keamanan Laravel form --}}

                    {{-- Judul Berita --}}
                    <div>
                        <x-input-label for="title" value="Judul Berita*" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                        {{-- Contoh placeholder untuk pesan error validasi (akan diaktifkan oleh backend) --}}
                        {{-- <x-input-error :messages="$errors->get('title')" class="mt-2" /> --}}
                        {{-- <p class="text-sm text-red-600 mt-2">Judul berita wajib diisi.</p> --}}
                    </div>

                    {{-- Ringkasan Berita --}}
                    <div>
                        <x-input-label for="short_content" value="Ringkasan Singkat*" />
                        <textarea id="short_content" name="short_content" rows="3" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>{{ old('short_content') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Maksimal 150 karakter.</p>
                        {{-- <x-input-error :messages="$errors->get('short_content')" class="mt-2" /> --}}
                    </div>

                    {{-- Konten Berita Lengkap --}}
                    <div>
                        <x-input-label for="content" value="Konten Berita Lengkap*" />
                        <textarea id="content" name="content" rows="10" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>{{ old('content') }}</textarea>
                        {{-- <x-input-error :messages="$errors->get('content')" class="mt-2" /> --}}
                    </div>

                    {{-- Unggah Gambar --}}
                    <div>
                        <x-input-label for="image" value="Unggah Gambar (Opsional)" />
                        <input type="file" id="image" name="image" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-green-50 file:text-green-700
                            hover:file:bg-green-100" accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        {{-- <x-input-error :messages="$errors->get('image')" class="mt-2" /> --}}
                    </div>

                    {{-- Tombol Unggah --}}
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Unggah Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-layouts.app>