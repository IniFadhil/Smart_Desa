{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Beda Nama</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini untuk pengajuan Surat Keterangan Beda Nama.
                </p>

                {{-- FORMULIR PENGAJUAN --}}
                {{-- PERHATIAN: Atribut 'action' saat ini adalah '#'. Anda perlu menggantinya dengan URL endpoint backend yang akan memproses data formulir ini. --}}
                {{-- PENTING: @csrf telah dihapus. Aplikasi Anda sekarang RENTAN terhadap serangan CSRF. --}}
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                    {{-- @csrf --}} {{-- Baris ini telah dikomentari/dihapus --}}

                    {{-- Bagian Lampiran Persyaratan --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Lampiran Persyaratan</h2>
                        <p class="text-sm text-gray-500 mb-4">* File type: jpg/jpeg/png | max size: 1 MB</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="scan_surat_pengantar_rt_rw" value="Scan/Foto Surat Pengantar RT/RW*" />
                                <input id="scan_surat_pengantar_rt_rw" name="scan_surat_pengantar_rt_rw" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_surat_pengantar_rt_rw')" />
                            </div>
                            <div>
                                <x-input-label for="scan_surat_pernyataan" value="Scan/Foto Surat Pernyataan*" />
                                <input id="scan_surat_pernyataan" name="scan_surat_pernyataan" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_surat_pernyataan')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Dokumen --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Dokumen</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Dokumen 1 --}}
                            <div>
                                <x-input-label for="jenis_dokumen1" value="Jenis Dokumen 1*" />
                                <select id="jenis_dokumen1" name="jenis_dokumen1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Dokumen 1</option>
                                    <option value="KTP">KTP</option>
                                    <option value="KK">Kartu Keluarga</option>
                                    <option value="Akta Lahir">Akta Lahir</option>
                                    <option value="Ijazah">Ijazah</option>
                                    <option value="Surat Nikah">Surat Nikah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_dokumen1')" />
                            </div>
                            <div>
                                <x-input-label for="nomor_dokumen1" value="Nomor Dokumen 1*" />
                                <x-text-input id="nomor_dokumen1" name="nomor_dokumen1" type="text" class="mt-1 block w-full" placeholder="Masukkan Nomor Dokumen 1" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_dokumen1')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="nama_dokumen1" value="Nama Dokumen 1*" />
                                <x-text-input id="nama_dokumen1" name="nama_dokumen1" type="text" class="mt-1 block w-full" placeholder="Masukkan Nama dari Jenis Dokumen 1" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_dokumen1')" />
                            </div>

                            {{-- Dokumen 2 --}}
                            <div>
                                <x-input-label for="jenis_dokumen2" value="Jenis Dokumen 2*" />
                                <select id="jenis_dokumen2" name="jenis_dokumen2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Dokumen 2</option>
                                    <option value="KTP">KTP</option>
                                    <option value="KK">Kartu Keluarga</option>
                                    <option value="Akta Lahir">Akta Lahir</option>
                                    <option value="Ijazah">Ijazah</option>
                                    <option value="Surat Nikah">Surat Nikah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_dokumen2')" />
                            </div>
                            <div>
                                <x-input-label for="nomor_dokumen2" value="Nomor Dokumen 2*" />
                                <x-text-input id="nomor_dokumen2" name="nomor_dokumen2" type="text" class="mt-1 block w-full" placeholder="Masukkan Nomor Dokumen 2" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_dokumen2')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="nama_dokumen2" value="Nama Dokumen 2*" />
                                <x-text-input id="nama_dokumen2" name="nama_dokumen2" type="text" class="mt-1 block w-full" placeholder="Masukkan Nama dari Jenis Dokumen 2" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_dokumen2')" />
                            </div>

                            {{-- Nama Yang Diambil Dari --}}
                            <div class="md:col-span-2">
                                <x-input-label for="nama_diambil_dari" value="Nama Yang Diambil Dari*" />
                                <select id="nama_diambil_dari" name="nama_diambil_dari" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Dokumen yang benar</option>
                                    <option value="Dokumen 1">Dokumen 1</option>
                                    <option value="Dokumen 2">Dokumen 2</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('nama_diambil_dari')" />
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-500 text-right mt-4">* input wajib diisi</p>

                    {{-- Tombol Kirim --}}
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection {{-- Mengakhiri section 'content' --}}
</x-layouts.app>
