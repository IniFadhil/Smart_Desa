{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Visi dan Misi Desa [Nama Desa Anda]</h1>
                <p class="text-gray-600 text-center mb-8">
                    Visi dan misi ini menjadi landasan bagi setiap langkah pembangunan dan pelayanan di desa kami.
                    Kami berkomitmen untuk mewujudkan setiap poin demi kemajuan bersama.
                </p>

                {{-- Bagian Visi --}}
                <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Visi</h2>
                    <p class="text-gray-700 leading-relaxed">
                        "Terwujudnya Desa yang Mandiri, Sejahtera, Berbudaya, dan Berkelanjutan dengan Tata Kelola Pemerintahan yang Baik."
                    </p>
                </div>

                {{-- Bagian Misi --}}
                <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <h2 class="text-2xl font-semibold text-green-700 mb-3 border-b-2 border-green-300 pb-2">Misi</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 leading-relaxed">
                        <li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.</li>
                        <li>Mengembangkan potensi ekonomi lokal berbasis pertanian, UMKM, dan pariwis.</li>
                        <li>Mewujudkan infrastruktur desa yang memadai dan merata.</li>
                        <li>Melestarikan nilai-nilai budaya dan kearifan lokal.</li>
                        <li>Menciptakan lingkungan hidup yang bersih, sehat, dan lestari.</li>
                        <li>Meningkatkan partisipasi masyarakat dalam pembangunan desa.</li>
                        <li>Mewujudkan pelayanan publik yang prima dan transparan.</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
