{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Gambar Kantor Desa --}}
            <img class="w-full h-64 md:h-80 object-cover" src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kantor Desa">

            <div class="p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Kantor Desa Sukamandi</h1>
                <p class="text-gray-600">Pusat Pelayanan dan Administrasi Masyarakat Desa</p>

                {{-- Informasi Kontak dan Jam Layanan --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8">
                    {{-- Jam Layanan --}}
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-3 border-l-4 border-green-500 pl-3">Jam Pelayanan</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Senin - Kamis</span>
                                <span class="text-gray-800">08:00 - 16:00 WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Jum'at</span>
                                <span class="text-gray-800">08:00 - 15:00 WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Istirahat</span>
                                <span class="text-gray-800">12:00 - 13:00 WIB</span>
                            </div>
                             <div class="flex justify-between">
                                <span class="font-medium text-red-500">Sabtu & Minggu</span>
                                <span class="text-red-500 font-semibold">Tutup</span>
                            </div>
                        </div>
                    </div>
                    {{-- Info Kontak --}}
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-3 border-l-4 border-green-500 pl-3">Informasi Kontak</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                <span>Jl. Raya Sagalaherang No. 12, Kecamatan Sagalaherang, Kabupaten Subang, Jawa Barat 41282</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                                <span>(0260) 123-4567</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 2.006l7.997 3.878A2 2 0 0119 7.616V16a2 2 0 01-2 2H3a2 2 0 01-2-2V7.616a2 2 0 011.003-1.732zM10 4.218L3 7.616V16h14V7.616L10 4.218z" /></svg>
                                <span>kontak@sukamandi.desa.id</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Peta Lokasi --}}
                <div class="border-t pt-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Peta Lokasi</h3>
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                        {{-- Ganti src dengan link embed Google Maps yang benar --}}
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.218137350104!2d107.7208506153098!3d-6.619864966579042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6921e528574a75%3A0x333f276c7c4e5c83!2sKantor%20Kepala%20Desa%20Sukamandi!5e0!3m2!1sen!2sid!4v1662012345678" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection

</x-layouts.app>