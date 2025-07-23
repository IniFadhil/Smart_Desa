{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Gambaran Umum Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Berikut adalah data dan informasi umum mengenai Desa [Nama Desa Anda] yang mencakup aspek demografi, geografis, dan infrastruktur.
                </p>

                {{-- Bagian Data Demografi --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Data Demografi</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Jumlah Penduduk: [Jumlah Total] jiwa (Laki-laki: [Jumlah Laki-laki], Perempuan: [Jumlah Perempuan])</li>
                        <li>Mata Pencarian Utama: [Contoh: Pertanian, Perdagangan, Buruh]</li>
                        <li>Tingkat Pendidikan:
                            <ul class="list-circle list-inside ml-4">
                                <li>SD/Sederajat: [Persentase]%</li>
                                <li>SMP/Sederajat: [Persentase]%</li>
                                <li>SMA/Sederajat: [Persentase]%</li>
                                <li>Perguruan Tinggi: [Persentase]%</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                {{-- Bagian Data Geografis --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Data Geografis</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Luas Wilayah: [Jumlah] hektar</li>
                        <li>Batas Wilayah:
                            <ul class="list-circle list-inside ml-4">
                                <li>Utara: [Nama Desa/Kecamatan]</li>
                                <li>Selatan: [Nama Desa/Kecamatan]</li>
                                <li>Timur: [Nama Desa/Kecamatan]</li>
                                <li>Barat: [Nama Desa/Kecamatan]</li>
                            </ul>
                        </li>
                        <li>Topografi: [Contoh: Dataran Rendah / Perbukitan]</li>
                        <li>Iklim: Tropis dengan dua musim (hujan dan kemarau)</li>
                    </ul>
                </div>

                {{-- Bagian Data Infrastruktur & Fasilitas --}}
                <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Data Infrastruktur & Fasilitas</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Akses Jalan Utama: [Contoh: Baik, Aspal]</li>
                        <li>Fasilitas Pendidikan:
                            <ul class="list-circle list-inside ml-4">
                                <li>PAUD: [Jumlah] unit</li>
                                <li>SD/MI: [Jumlah] unit</li>
                                <li>SMP/MTs: [Jumlah] unit</li>
                            </ul>
                        </li>
                        <li>Fasilitas Kesehatan: [Jumlah] Puskesmas Pembantu, [Jumlah] Posyandu</li>
                        <li>Fasilitas Ibadah: [Jumlah] Masjid, [Jumlah] Gereja</li>
                        <li>Akses Listrik: [Persentase]% rumah tangga teraliri listrik</li>
                        <li>Akses Air Bersih: [Persentase]% rumah tangga memiliki akses air bersih</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
