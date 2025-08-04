{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Destinasi Wisata Desa</h1>
            <p class="text-gray-600 mt-2">Jelajahi pesona alam yang memukau dan beragam tujuan wisata menarik di desa kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Item Wisata 1 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                <img class="w-full h-48 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Curug Cigangsa">
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Curug Cigangsa</h2>
                    <p class="text-gray-600 text-sm mb-4 flex-grow">
                        Nikmati kesegaran air terjun dengan pemandangan tebing batu yang eksotis dan suasana alam yang asri.
                    </p>
                    <div class="mt-auto">
                        {{-- LINK SUDAH DIPERBARUI --}}
                        <a href="{{ route('potensi.wisata.detail', ['slug' => 'curug-cigangsa']) }}" class="inline-block w-full text-center bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

            {{-- Item Wisata 2 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                <img class="w-full h-48 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Bukit Pamoyanan">
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Bukit Pamoyanan</h2>
                    <p class="text-gray-600 text-sm mb-4 flex-grow">
                        Spot terbaik untuk menikmati matahari terbit dengan lautan awan yang memukau. Sangat cocok untuk berkemah.
                    </p>
                    <div class="mt-auto">
                        {{-- LINK SUDAH DIPERBARUI --}}
                        <a href="{{ route('potensi.wisata.detail', ['slug' => 'bukit-pamoyanan']) }}" class="inline-block w-full text-center bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
    @endsection

</x-layouts.app>