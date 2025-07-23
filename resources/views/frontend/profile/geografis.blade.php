{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Kondisi Geografis Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Informasi detail mengenai letak, bentang alam, iklim, dan penggunaan lahan di Desa [Nama Desa Anda].
                </p>

                {{-- Bagian Lokasi Geografis --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Lokasi Geografis</h2>
                    <div class="flex flex-col md:flex-row items-center md:space-x-6">
                        <div class="md:w-1/2 mb-4 md:mb-0">
                            {{-- Placeholder untuk Peta atau Gambar Lokasi --}}
                            <img src="https://placehold.co/600x400/E0F2F7/000000?text=Peta+Desa" alt="Peta Lokasi Desa" class="w-full h-auto rounded-lg shadow-md">
                            <p class="text-center text-sm text-gray-500 mt-2">Peta Lokasi Desa [Nama Desa Anda]</p>
                        </div>
                        <div class="md:w-1/2">
                            <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                                <li>Koordinat: [Contoh: -6.12345, 106.78901]</li>
                                <li>Terletak di [Contoh: bagian utara/selatan] Kabupaten [Nama Kabupaten].</li>
                                <li>Batas Wilayah:
                                    <ul class="list-circle list-inside ml-4">
                                        <li>Utara: Desa [Nama Desa Utara] / Kecamatan [Nama Kecamatan Utara]</li>
                                        <li>Selatan: Desa [Nama Desa Selatan] / Kecamatan [Nama Kecamatan Selatan]</li>
                                        <li>Timur: Desa [Nama Desa Timur] / Kecamatan [Nama Kecamatan Timur]</li>
                                        <li>Barat: Desa [Nama Desa Barat] / Kecamatan [Nama Kecamatan Barat]</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Bagian Topografi dan Bentang Alam --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Topografi dan Bentang Alam</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Bentuk Permukaan Tanah: [Contoh: Dataran rendah, bergelombang, perbukitan]</li>
                        <li>Ketinggian: Rata-rata [Jumlah] meter di atas permukaan laut.</li>
                        <li>Fitur Geografis: Terdapat [Contoh: sungai, danau, area persawahan luas, hutan]</li>
                    </ul>
                </div>

                {{-- Bagian Iklim --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Iklim</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Tipe Iklim: Tropis</li>
                        <li>Suhu Rata-rata: Sekitar [Jumlah]°C - [Jumlah]°C.</li>
                        <li>Curah Hujan: Rata-rata [Jumlah] mm/tahun, dengan musim hujan dari [Bulan] hingga [Bulan].</li>
                    </ul>
                </div>

                {{-- Bagian Penggunaan Lahan --}}
                <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Penggunaan Lahan</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Lahan Pertanian: [Persentase]% (Sawah, Ladang, Kebun)</li>
                        <li>Pemukiman: [Persentase]%</li>
                        <li>Hutan/Lahan Kosong: [Persentase]%</li>
                        <li>Perairan: [Persentase]%</li>
                        <li>Jenis Tanah Utama: [Contoh: Aluvial, Latosol]</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
