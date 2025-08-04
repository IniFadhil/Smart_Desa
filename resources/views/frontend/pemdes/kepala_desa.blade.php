{{-- Menggunakan layout utama aplikasi --}}
<x-layouts.app>

    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">Profil Kepala Desa</h1>
                
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                    {{-- Foto Kepala Desa --}}
                    <div class="flex-shrink-0">
                        {{-- Ganti dengan URL foto kepala desa dari database --}}
                        <img src="{{ asset('img/photo_soft.jpeg') }}" alt="Foto Kepala Desa" class="w-48 h-60 object-cover rounded-lg shadow-lg">
                    </div>
                    
                    {{-- Sambutan dan Data Diri --}}
                    <div class="flex-grow text-center md:text-left">
                        <h2 class="text-2xl font-semibold text-green-700">H. Asep Subagja, S.Pd.</h2>
                        <p class="text-gray-500 mb-4">Periode 2022 - 2028</p>
                        
                        <div class="prose max-w-none text-gray-700">
                            <p class="font-semibold italic">"Assalamu'alaikum Warahmatullahi Wabarakatuh,"</p>
                            <p>
                                Puji syukur kita panjatkan kehadirat Allah SWT atas rahmat dan karunia-Nya. Selamat datang di website resmi desa kami. Website ini kami hadirkan sebagai wujud komitmen kami terhadap transparansi informasi dan sebagai jembatan untuk mendekatkan pemerintah desa dengan seluruh lapisan masyarakat. Mari bersama-sama kita bangun desa yang kita cintai ini menjadi lebih maju, mandiri, dan sejahtera.
                            </p>
                            <p class="font-semibold italic">"Wassalamu'alaikum Warahmatullahi Wabarakatuh."</p>
                        </div>
                    </div>
                </div>

                {{-- Data Diri Lengkap --}}
                <div class="border-t mt-8 pt-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Data Diri</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold text-gray-600">Nama Lengkap</span>
                            <span class="text-gray-800">H. Asep Subagja, S.Pd.</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold text-gray-600">Tempat, Tanggal Lahir</span>
                            <span class="text-gray-800">Subang, 15 Januari 1980</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold text-gray-600">Agama</span>
                            <span class="text-gray-800">Islam</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold text-gray-600">Pendidikan Terakhir</span>
                            <span class="text-gray-800">S1 Pendidikan</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    @endsection

</x-layouts.app>