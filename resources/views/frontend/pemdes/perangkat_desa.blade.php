{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        {{-- Header Halaman --}}
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 mb-8">
            {{-- JUDUL SUDAH DIPERBARUI --}}
            <h1 class="text-3xl font-bold text-gray-800 text-center">Perangkat Desa</h1>
            {{-- DESKRIPSI SUDAH DIPERBARUI --}}
            <p class="text-gray-600 mt-2 text-center">Kenali lebih dekat aparatur yang berdedikasi untuk melayani masyarakat desa.</p>
        </div>

        {{-- Sekretaris Desa --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Sekretaris Desa</h2>
            <div class="max-w-sm mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <img class="w-full h-56 object-cover object-center" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Sekretaris Desa">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-green-700">Siti Rohmah, S.Kom.</h3>
                    <p class="text-gray-500 text-sm">NIPD: 123456789</p>
                </div>
            </div>
        </div>
        
        {{-- Perangkat Desa - Kaur & Kasi --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Kepala Urusan & Kepala Seksi</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Contoh Kartu Perangkat --}}
                <div class="bg-white text-center rounded-lg shadow-md p-5 transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Perangkat">
                    <h4 class="text-lg font-semibold text-gray-800">Budi Santoso</h4>
                    <p class="text-sm text-green-600 font-medium">Kaur Keuangan</p>
                </div>

                <div class="bg-white text-center rounded-lg shadow-md p-5 transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Perangkat">
                    <h4 class="text-lg font-semibold text-gray-800">Rina Handayani</h4>
                    <p class="text-sm text-green-600 font-medium">Kasi Pelayanan</p>
                </div>

                <div class="bg-white text-center rounded-lg shadow-md p-5 transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Perangkat">
                    <h4 class="text-lg font-semibold text-gray-800">Agus Setiawan</h4>
                    <p class="text-sm text-green-600 font-medium">Kaur Perencanaan</p>
                </div>
            </div>
        </div>

        {{-- Kepala Dusun --}}
        <div>
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Kepala Dusun</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white text-center rounded-lg shadow-md p-5 transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kadus">
                    <h4 class="text-lg font-semibold text-gray-800">Jajang Mulyana</h4>
                    <p class="text-sm text-green-600 font-medium">Kepala Dusun I</p>
                </div>

                 <div class="bg-white text-center rounded-lg shadow-md p-5 transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kadus">
                    <h4 class="text-lg font-semibold text-gray-800">Endang Suryana</h4>
                    <p class="text-sm text-green-600 font-medium">Kepala Dusun II</p>
                </div>
            </div>
        </div>

    </div>
    @endsection

</x-layouts.app>