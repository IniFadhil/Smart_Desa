{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Riwayat Tanah</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini untuk pengajuan Surat Keterangan Riwayat Tanah.
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
                                <x-input-label for="scan_foto_surat_tanah" value="Scan/Foto Surat Tanah*" />
                                <input id="scan_foto_surat_tanah" name="scan_foto_surat_tanah" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_surat_pajak_tanah" value="Scan/Foto Surat Pajak Tanah*" />
                                <input id="scan_foto_surat_pajak_tanah" name="scan_foto_surat_pajak_tanah" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_pajak_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_surat_pengantar_rt_rw" value="Scan/Foto Surat Pengantar RT/RW*" />
                                <input id="scan_foto_surat_pengantar_rt_rw" name="scan_foto_surat_pengantar_rt_rw" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_pengantar_rt_rw')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_surat_pernyataan" value="Scan/Foto Surat Pernyataan*" />
                                <input id="scan_foto_surat_pernyataan" name="scan_foto_surat_pernyataan" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_pernyataan')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Pemilik --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Pemilik</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_pemilik" value="NIK*" />
                                <x-text-input id="nik_pemilik" name="nik_pemilik" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nik pemilik tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_pemilik')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_pemilik" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_pemilik" name="nama_lengkap_pemilik" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nama lengkap pemilik tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_pemilik')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Riwayat 1 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Riwayat 1</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="tanggal_riwayat1" value="Tanggal*" />
                                <x-text-input id="tanggal_riwayat1" name="tanggal_riwayat1" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_riwayat1')" />
                            </div>
                            <div>
                                <x-input-label for="balik_nama_kepada_riwayat1" value="Balik Nama Kepada*" />
                                <x-text-input id="balik_nama_kepada_riwayat1" name="balik_nama_kepada_riwayat1" type="text" class="mt-1 block w-full" placeholder="Balik nama kepada" required />
                                <x-input-error class="mt-2" :messages="$errors->get('balik_nama_kepada_riwayat1')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="berdasarkan_riwayat1" value="Berdasarkan*" />
                                <select id="berdasarkan_riwayat1" name="berdasarkan_riwayat1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Jual Beli">Jual Beli</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Waris">Waris</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('berdasarkan_riwayat1')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Riwayat 2 (Opsional, bisa diulang jika perlu lebih banyak) --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Riwayat 2</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="tanggal_riwayat2" value="Tanggal*" />
                                <x-text-input id="tanggal_riwayat2" name="tanggal_riwayat2" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_riwayat2')" />
                            </div>
                            <div>
                                <x-input-label for="balik_nama_kepada_riwayat2" value="Balik Nama Kepada*" />
                                <x-text-input id="balik_nama_kepada_riwayat2" name="balik_nama_kepada_riwayat2" type="text" class="mt-1 block w-full" placeholder="Balik nama kepada" />
                                <x-input-error class="mt-2" :messages="$errors->get('balik_nama_kepada_riwayat2')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="berdasarkan_riwayat2" value="Berdasarkan*" />
                                <select id="berdasarkan_riwayat2" name="berdasarkan_riwayat2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Jual Beli">Jual Beli</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Waris">Waris</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('berdasarkan_riwayat2')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Riwayat 3 (Opsional, bisa diulang jika perlu lebih banyak) --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Riwayat 3</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="tanggal_riwayat3" value="Tanggal*" />
                                <x-text-input id="tanggal_riwayat3" name="tanggal_riwayat3" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_riwayat3')" />
                            </div>
                            <div>
                                <x-input-label for="balik_nama_kepada_riwayat3" value="Balik Nama Kepada*" />
                                <x-text-input id="balik_nama_kepada_riwayat3" name="balik_nama_kepada_riwayat3" type="text" class="mt-1 block w-full" placeholder="Balik nama kepada" />
                                <x-input-error class="mt-2" :messages="$errors->get('balik_nama_kepada_riwayat3')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="berdasarkan_riwayat3" value="Berdasarkan*" />
                                <select id="berdasarkan_riwayat3" name="berdasarkan_riwayat3" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Jual Beli">Jual Beli</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Waris">Waris</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('berdasarkan_riwayat3')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Riwayat 4 (Opsional, bisa diulang jika perlu lebih banyak) --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Riwayat 4</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="tanggal_riwayat4" value="Tanggal*" />
                                <x-text-input id="tanggal_riwayat4" name="tanggal_riwayat4" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_riwayat4')" />
                            </div>
                            <div>
                                <x-input-label for="balik_nama_kepada_riwayat4" value="Balik Nama Kepada*" />
                                <x-text-input id="balik_nama_kepada_riwayat4" name="balik_nama_kepada_riwayat4" type="text" class="mt-1 block w-full" placeholder="Balik nama kepada" />
                                <x-input-error class="mt-2" :messages="$errors->get('balik_nama_kepada_riwayat4')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="berdasarkan_riwayat4" value="Berdasarkan*" />
                                <select id="berdasarkan_riwayat4" name="berdasarkan_riwayat4" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Jual Beli">Jual Beli</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Waris">Waris</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('berdasarkan_riwayat4')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Tanah --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Tanah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nomor_sertifikat_tanah" value="Nomor Sertifikat*" />
                                <x-text-input id="nomor_sertifikat_tanah" name="nomor_sertifikat_tanah" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nomor sertifikat tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_sertifikat_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="nomor_sppt_tanah" value="Nomor SPPT*" />
                                <x-text-input id="nomor_sppt_tanah" name="nomor_sppt_tanah" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nomor sppt tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_sppt_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="blok_tanah" value="Blok*" />
                                <x-text-input id="blok_tanah" name="blok_tanah" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan blok tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('blok_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="persil_tanah" value="Persil*" />
                                <x-text-input id="persil_tanah" name="persil_tanah" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan persil tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('persil_tanah')" />
                            </div>
                            <div>
                                <x-input-label for="no_kohir_kikitir_girik" value="No. Kohir/Kikitir/Girik*" />
                                <x-text-input id="no_kohir_kikitir_girik" name="no_kohir_kikitir_girik" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nomor kohir/kikitir/girik tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('no_kohir_kikitir_girik')" />
                            </div>
                            <div>
                                <x-input-label for="luas_tanah" value="Luas*" />
                                <x-text-input id="luas_tanah" name="luas_tanah" type="text" class="mt-1 block w-full" placeholder="ukuran dalam skala m²" required />
                                <x-input-error class="mt-2" :messages="$errors->get('luas_tanah')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_lokasi_tanah" value="Alamat*" />
                                <textarea id="alamat_lokasi_tanah" name="alamat_lokasi_tanah" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan masukan alamat lokasi tanah" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_lokasi_tanah')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Batasan-Batasan --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Batasan-Batasan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="batas_utara" value="Sebelah Utara*" />
                                <x-text-input id="batas_utara" name="batas_utara" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan batas utara tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('batas_utara')" />
                            </div>
                            <div>
                                <x-input-label for="batas_timur" value="Sebelah Timur*" />
                                <x-text-input id="batas_timur" name="batas_timur" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan batas timur tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('batas_timur')" />
                            </div>
                            <div>
                                <x-input-label for="batas_selatan" value="Sebelah Selatan*" />
                                <x-text-input id="batas_selatan" name="batas_selatan" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan batas selatan tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('batas_selatan')" />
                            </div>
                            <div>
                                <x-input-label for="batas_barat" value="Sebelah Barat*" />
                                <x-text-input id="batas_barat" name="batas_barat" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan batas barat tanah" required />
                                <x-input-error class="mt-2" :messages="$errors->get('batas_barat')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 1 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 1</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_saksi1" value="NIK*" />
                                <x-text-input id="nik_saksi1" name="nik_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nik data saksi" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi1" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi1" name="nama_lengkap_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nama data saksi" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_saksi1')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 2 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 2</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_saksi2" value="NIK*" />
                                <x-text-input id="nik_saksi2" name="nik_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nik data saksi" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi2" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi2" name="nama_lengkap_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan masukan nama data saksi" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_saksi2')" />
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
