{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Penghasilan</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini untuk pengajuan Surat Keterangan Penghasilan.
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
                                <x-input-label for="scan_bukti_usaha_slip_gaji" value="Scan/Foto Bukti Usaha/Slip Gaji*" />
                                <input id="scan_bukti_usaha_slip_gaji" name="scan_bukti_usaha_slip_gaji" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_bukti_usaha_slip_gaji')" />
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

                    {{-- Bagian Data Pemohon --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Pemohon</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_pemohon" value="NIK*" />
                                <x-text-input id="nik_pemohon" name="nik_pemohon" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_pemohon" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_pemohon" name="nama_lengkap_pemohon" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Nama Lengkap" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_lahir_pemohon" value="Tempat Lahir*" />
                                <x-text-input id="tempat_lahir_pemohon" name="tempat_lahir_pemohon" type="text" class="mt-1 block w-full" placeholder="Silahkan memasukan kota/kab tempat lahir" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir_pemohon" value="Tanggal Lahir*" />
                                <x-text-input id="tanggal_lahir_pemohon" name="tanggal_lahir_pemohon" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir_pemohon')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="jenis_kelamin_pemohon" value="Jenis Kelamin*" />
                                <div class="mt-2 flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_kelamin_pemohon" value="Laki-laki" class="form-radio text-green-600" checked>
                                        <span class="ml-2 text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_kelamin_pemohon" value="Perempuan" class="form-radio text-green-600">
                                        <span class="ml-2 text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_pemohon" value="Pekerjaan*" />
                                <select id="pekerjaan_pemohon" name="pekerjaan_pemohon" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Salah Satu --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_pemohon')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_lengkap_pemohon" value="Alamat Lengkap*" />
                                <textarea id="alamat_lengkap_pemohon" name="alamat_lengkap_pemohon" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Bugel RT 05 RW 2" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_lengkap_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="jumlah_tanggungan_keluarga" value="Jumlah Tanggungan Keluarga*" />
                                <x-text-input id="jumlah_tanggungan_keluarga" name="jumlah_tanggungan_keluarga" type="number" class="mt-1 block w-full" placeholder="Jumlah orang yang ditanggung dalam keluarga" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jumlah_tanggungan_keluarga')" />
                            </div>
                            <div>
                                <x-input-label for="nominal_penghasilan_perbulan" value="Nominal Penghasilan Perbulan*" />
                                <x-text-input id="nominal_penghasilan_perbulan" name="nominal_penghasilan_perbulan" type="number" class="mt-1 block w-full" placeholder="Nominal angka" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nominal_penghasilan_perbulan')" />
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
