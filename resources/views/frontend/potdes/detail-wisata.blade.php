{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Gambar Utama --}}
            <img class="w-full h-64 md:h-80 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Gambar Detail Wisata">

            <div class="p-6 md:p-8">
                {{-- Judul Wisata --}}
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    {{-- Judul akan diisi oleh backend --}}
                    Curug Cigangsa 
                </h1>

                {{-- Informasi Tambahan (Lokasi, Jam Buka, dll) --}}
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-600 mb-6 border-b pb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Lokasi: Dusun Lembah
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 10.586V6z" clip-rule="evenodd" />
                        </svg>
                        Jam Buka: 08:00 - 17:00 WIB
                    </div>
                </div>
                
                {{-- Deskripsi Lengkap --}}
                <div class="prose max-w-none">
                    <p>
                        Ini adalah deskripsi lengkap dari Curug Cigangsa. Curug ini memiliki tiga tingkatan air terjun yang unik, dikelilingi oleh bebatuan eksotis dan pepohonan yang rindang. Suasana alamnya sangat asri dan udaranya sejuk, cocok untuk melepaskan penat dari rutinitas sehari-hari.
                    </p>
                    <p>
                        Pengunjung bisa bermain air di kolam alami yang ada di bawah air terjun, namun tetap harus berhati-hati karena bebatuan yang licin. Disarankan untuk membawa bekal makanan dan minuman sendiri karena warung di sekitar lokasi masih terbatas.
                    </p>
                    <h3>Fasilitas</h3>
                    <ul>
                        <li>Area Parkir</li>
                        <li>Toilet Umum</li>
                        <li>Warung Kecil</li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
    @endsection

</x-layouts.app>