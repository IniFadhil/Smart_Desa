<x-layouts.app>
    @section('content')
        <div class="container mx-auto p-4 sm:p-6 lg:p-8">
            <div class="bg-white rounded-lg shadow-xl p-6 sm:p-8">
                <div class="text-center mb-10 bg-gradient-to-r from-green-500 to-teal-600 p-8 rounded-lg shadow-lg -mt-16 mx-auto max-w-4xl">
                    <h1 class="text-4xl font-extrabold text-white tracking-tight">Papan Pengumuman Desa</h1>
                    <p class="mt-2 text-lg text-green-100">Informasi resmi terbaru dari pemerintah desa.</p>
                </div>

                <div class="space-y-8">
                    @php
                        $semuaPengumuman = [
                            (object) ['id' => 1, 'judul' => 'Jadwal Posyandu Bulan Agustus 2025', 'isi' => 'Diberitahukan kepada seluruh warga desa, Posyandu untuk balita dan lansia akan dilaksanakan pada tanggal 15 Agustus 2025 di Balai Desa. Mohon untuk membawa buku KIA.', 'tanggal' => '2025-07-28', 'prioritas' => 'Penting'],
                            (object) ['id' => 2, 'judul' => 'Kerja Bakti Membersihkan Saluran Air', 'isi' => 'Dalam rangka menyambut musim hujan dan mencegah banjir, akan diadakan kerja bakti membersihkan saluran air utama desa.', 'tanggal' => '2025-07-25', 'prioritas' => 'Informasi'],
                            (object) ['id' => 3, 'judul' => 'Pemberitahuan Pemadaman Listrik Bergilir', 'isi' => 'Sehubungan dengan adanya pemeliharaan jaringan, akan terjadi pemadaman listrik di wilayah RT 01 dan RT 02.', 'tanggal' => '2025-07-22', 'prioritas' => 'Penting'],
                        ];
                    @endphp

                    @forelse ($semuaPengumuman as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 {{ $item->prioritas === 'Penting' ? 'border-red-500' : 'border-blue-500' }}">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $item->judul }}</h3>
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $item->prioritas === 'Penting' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $item->prioritas }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-3">
                                    Dipublikasikan pada: {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                                </p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $item->isi }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endsection
</x-layouts.app>