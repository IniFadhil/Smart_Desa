{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    {{-- Mendefinisikan bagian konten --}}
    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        {{-- Header Halaman --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Kuliner Khas Desa</h1>
            <p class="text-gray-600 mt-2">Jelajahi cita rasa otentik dan kuliner unggulan yang ada di desa kami.</p>
        </div>

        {{-- Daftar Kuliner --}}
        {{-- Backend developer nanti akan mengganti ini dengan loop data dari database --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Contoh Item Kuliner 1 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                {{-- Ganti dengan URL gambar kuliner dari database --}}
                <img class="w-full h-48 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Nasi Timbel Komplit">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Nasi Timbel Komplit</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        Disajikan dengan ayam goreng, tahu, tempe, sambal terasi, dan lalapan segar. Pilihan tepat untuk makan siang.
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Lokasi: Warung Ibu Acih
                    </div>
                </div>
            </div>

            {{-- Contoh Item Kuliner 2 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Sate Maranggi">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Sate Maranggi</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        Sate daging sapi dengan bumbu khas yang meresap sempurna, disajikan dengan sambal oncom atau sambal tomat.
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Lokasi: Saung Sate Pak Jaya
                    </div>
                </div>
            </div>

            {{-- Contoh Item Kuliner 3 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Karedok">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Karedok Leunca</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        Salad sayuran mentah khas Sunda dengan bumbu kacang yang pedas, manis, dan segar. Cocok untuk vegetarian.
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Lokasi: Warung Ceu Popon
                    </div>
                </div>
            </div>

        </div>
        
    </div>
    @endsection

</x-layouts.app>