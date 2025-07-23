{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Sejarah Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mari kita telusuri jejak langkah perjalanan dan perkembangan Desa [Nama Desa Anda] dari masa ke masa.
                </p>

                {{-- Bagian Sejarah Singkat Desa --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Sejarah Singkat Desa</h2>
                    <div class="flex flex-col md:flex-row items-center md:space-x-6">
                        <div class="md:w-1/2 mb-4 md:mb-0">
                            {{-- Foto Desa --}}
                            {{-- Ganti URL placeholder ini dengan path gambar desa Anda --}}
                            <img src="{{ asset('img/subang1.webp') }}" alt="Foto Desa" class="w-full h-auto rounded-lg shadow-md">
                            <p class="text-center text-sm text-gray-500 mt-2">Pemandangan Umum Desa [Nama Desa Anda]</p>
                        </div>
                        <div class="md:w-1/2">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Desa [Nama Desa Anda] memiliki sejarah panjang yang kaya, dimulai sejak tahun [Tahun Awal] dengan mayoritas penduduk bermata pencaharian sebagai petani. Seiring berjalannya waktu, desa ini terus berkembang, menghadapi berbagai tantangan dan meraih banyak pencapaian.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                Banyak tokoh masyarakat yang berperan penting dalam pembangunan desa, bahu-membahu membangun infrastruktur, meningkatkan kesejahteraan, dan melestarikan adat istiadat. Hingga saat ini, semangat gotong royong dan kebersamaan tetap menjadi pilar utama kemajuan desa.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Daftar Kepala Desa --}}
                <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Kepala Desa</h2>
                    <div class="flex flex-col md:flex-row items-start md:space-x-6">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            {{-- Foto Kepala Desa --}}
                            {{-- Ganti URL placeholder ini dengan path gambar kepala desa Anda --}}
                            <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kepala Desa" class="w-full h-auto rounded-lg shadow-md">
                            <p class="text-center text-sm text-gray-500 mt-2">Bapak/Ibu [Nama Kepala Desa Sekarang]</p>
                        </div>
                        <div class="md:w-2/3">
                            <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                                <li>[Nama Kepala Desa Sekarang] (Tahun [XXXX] - Sekarang)</li>
                                {{-- Tambahkan lebih banyak daftar jika diperlukan --}}
                            </ul>
                            <p class="text-gray-700 leading-relaxed mt-4">
                                Kepemimpinan para kepala desa telah membawa Desa [Nama Desa] menuju kemajuan yang signifikan di berbagai bidang.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
