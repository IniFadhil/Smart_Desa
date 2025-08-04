{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        {{-- Header Halaman --}}
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 mb-8">
            <h1 class="text-3xl font-bold text-gray-800 text-center">Struktur Pemerintah Desa</h1>
            <p class="text-gray-600 mt-2 text-center">Hierarki dan tatanan kerja aparatur Pemerintah Desa Sukamandi.</p>
        </div>

        {{-- Kepala Desa --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6 border-b-2 border-green-500 pb-2">Kepala Desa</h2>
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kepala Desa">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-green-600 font-semibold">Kepala Desa</div>
                        <h3 class="mt-1 block text-2xl leading-tight font-bold text-black">H. Asep Subagja, S.Pd.</h3>
                        <p class="mt-4 text-gray-500">Memimpin penyelenggaraan Pemerintahan Desa, melaksanakan pembangunan, pembinaan kemasyarakatan, dan pemberdayaan masyarakat Desa.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sekretaris Desa --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6 border-b-2 border-green-500 pb-2">Sekretariat Desa</h2>
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl">
                 <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Sekretaris Desa">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-green-600 font-semibold">Sekretaris Desa</div>
                        <h3 class="mt-1 block text-2xl leading-tight font-bold text-black">Siti Rohmah, S.Kom.</h3>
                        <p class="mt-4 text-gray-500">Membantu Kepala Desa dalam bidang administrasi pemerintahan dan memberikan pelayanan teknis administrasi kepada seluruh perangkat desa.</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Perangkat Pelaksana Teknis (Kaur & Kasi) --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6 border-b-2 border-green-500 pb-2">Pelaksana Teknis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- Contoh Kartu Perangkat --}}
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="uppercase tracking-wide text-xs text-green-500 font-semibold mb-2">Kepala Urusan Keuangan</div>
                    <h4 class="text-lg font-bold text-gray-900">Budi Santoso</h4>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="uppercase tracking-wide text-xs text-green-500 font-semibold mb-2">Kepala Seksi Pelayanan</div>
                    <h4 class="text-lg font-bold text-gray-900">Rina Handayani</h4>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="uppercase tracking-wide text-xs text-green-500 font-semibold mb-2">Kepala Urusan Perencanaan</div>
                    <h4 class="text-lg font-bold text-gray-900">Agus Setiawan</h4>
                </div>

            </div>
        </div>

        {{-- Perangkat Pelaksana Kewilayahan (Kepala Dusun) --}}
        <div>
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6 border-b-2 border-green-500 pb-2">Pelaksana Kewilayahan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Contoh Kartu Kepala Dusun --}}
                 <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="uppercase tracking-wide text-xs text-green-500 font-semibold mb-2">Kepala Dusun I</div>
                    <h4 class="text-lg font-bold text-gray-900">Jajang Mulyana</h4>
                </div>
                 <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="uppercase tracking-wide text-xs text-green-500 font-semibold mb-2">Kepala Dusun II</div>
                    <h4 class="text-lg font-bold text-gray-900">Endang Suryana</h4>
                </div>
                {{-- Tambahkan kartu lain jika perlu --}}
            </div>
        </div>

    </div>
    @endsection

</x-layouts.app>