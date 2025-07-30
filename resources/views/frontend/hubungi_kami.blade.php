{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Hubungi Kami</h1>
                <p class="text-gray-600 text-center mb-8">
                    Kami senang mendengar dari Anda. Silakan gunakan informasi di bawah ini untuk menghubungi kami, atau kirimkan pesan melalui formulir.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    {{-- Bagian Informasi Kontak --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold text-green-700 mb-2">Alamat Kantor</h3>
                            <p class="text-gray-700">Jl. Mayjen Sutoyo No.46, Karanganyar, Kec. Subang, Kabupaten Subang, Jawa Barat 41211</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-green-700 mb-2">Telepon & Email</h3>
                            <p class="text-gray-700">Telepon: (0260) 123-4567</p>
                            <p class="text-gray-700">Email: <a href="mailto:kontak@desamajujaya.go.id" class="text-blue-600 hover:underline">kontak@desamajujaya.go.id</a></p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-green-700 mb-2">Jam Pelayanan</h3>
                            <p class="text-gray-700">Senin - Jumat: 08:00 - 16:00 WIB</p>
                            <p class="text-gray-700">Sabtu & Minggu: Libur</p>
                        </div>
                    </div>

                    {{-- Bagian Formulir Kontak --}}
                    <div>
                        {{-- Ganti action="#" dengan route yang akan memproses form --}}
                        <form action="#" method="POST" class="space-y-4">
                            @csrf 

                            <div>
                                <x-input-label for="nama_lengkap" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" placeholder="Nama Anda" required />
                            </div>

                            <div>
                                <x-input-label for="email_pengirim" value="Alamat Email*" />
                                <x-text-input id="email_pengirim" name="email_pengirim" type="email" class="mt-1 block w-full" placeholder="email@contoh.com" required />
                            </div>

                            <div>
                                <x-input-label for="subjek_pesan" value="Subjek*" />
                                <x-text-input id="subjek_pesan" name="subjek_pesan" type="text" class="mt-1 block w-full" placeholder="Subjek pesan Anda" required />
                            </div>

                            <div>
                                <x-input-label for="isi_pesan" value="Pesan Anda*" />
                                <textarea id="isi_pesan" name="isi_pesan" rows="4" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-6 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700">
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                 {{-- Bagian Peta --}}
               {{-- resources/views/frontend/hubungi_kami.blade.php --}}

{{-- ... Bagian atas halaman ... --}}

{{-- Bagian Peta --}}
<div class="mt-12">
    <h2 class="text-2xl font-semibold text-green-700 mb-4 text-center">Lokasi Kami di Peta</h2>
    {{-- Container untuk peta dan animasi --}}
    <div class="map-container h-80">
        {{-- Elemen untuk animasi denyut (pulse) --}}
        <div class="pulse-animation"></div>

        {{-- Peta Lokasi Kantor Desa dari Google Maps --}}
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.555891258289!2d107.75979577500139!3d-6.577586693412551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b7b2f7c0c4d%3A0x86845579b2b291a!2sJl.%20Mayjen%20Sutoyo%20No.46%2C%20Karanganyar%2C%20Kec.%20Subang%2C%20Kabupaten%20Subang%2C%20Jawa%20Barat%2041211!5e0!3m2!1sid!2sid!4v1694676878496!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

{{-- ... Bagian bawah halaman ... --}}
            </div>
        </div>
    @endsection
</x-layouts.app>