{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Kelahiran</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini dengan benar.
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
                                <x-input-label for="scan_foto_kk_orangtua_bayi" value="Scan/Foto KK Orangtua Bayi*" />
                                <input id="scan_foto_kk_orangtua_bayi" name="scan_foto_kk_orangtua_bayi" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_kk_orangtua_bayi')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_ktp_ibu" value="Scan/Foto KTP Ibu*" />
                                <input id="scan_foto_ktp_ibu" name="scan_foto_ktp_ibu" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_ktp_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_ktp_ayah" value="Scan/Foto KTP Ayah*" />
                                <input id="scan_foto_ktp_ayah" name="scan_foto_ktp_ayah" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_ktp_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="scan_foto_surat_akta_nikah" value="Scan/Foto Surat/Akta Nikah*" />
                                <input id="scan_foto_surat_akta_nikah" name="scan_foto_surat_akta_nikah" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_akta_nikah')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="scan_foto_surat_keterangan_kelahiran" value="Scan/Foto Surat Keterangan Kelahiran dari dokter/bidan/lainnya kelahiran*" />
                                <input id="scan_foto_surat_keterangan_kelahiran" name="scan_foto_surat_keterangan_kelahiran" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_foto_surat_keterangan_kelahiran')" />
                            </div>
                            <div>
                                <x-input-label for="nomor_kk" value="Nomor KK*" />
                                <x-text-input id="nomor_kk" name="nomor_kk" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nomor kk" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_kk')" />
                            </div>
                            <div>
                                <x-input-label for="nama_kepala_keluarga" value="Nama Kepala Keluarga*" />
                                <x-text-input id="nama_kepala_keluarga" name="nama_kepala_keluarga" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama kepala keluarga" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_kepala_keluarga')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Anak/Bayi --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Anak/Bayi</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_lengkap_bayi" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_bayi" name="nama_lengkap_bayi" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_bayi')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="jenis_kelamin_bayi" value="Jenis Kelamin*" />
                                <div class="mt-2 flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_kelamin_bayi" value="Laki-laki" class="form-radio text-green-600" checked>
                                        <span class="ml-2 text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_kelamin_bayi" value="Perempuan" class="form-radio text-green-600">
                                        <span class="ml-2 text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_bayi')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_dilahirkan" value="Tempat Dilahirkan*" />
                                <select id="tempat_dilahirkan" name="tempat_dilahirkan" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Tempat Dilahirkan</option>
                                    <option value="RS">Rumah Sakit</option>
                                    <option value="Puskesmas">Puskesmas</option>
                                    <option value="Rumah Bersalin">Rumah Bersalin</option>
                                    <option value="Rumah">Rumah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_dilahirkan')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_kelahiran_bayi" value="Tempat Kelahiran*" />
                                <x-text-input id="tempat_kelahiran_bayi" name="tempat_kelahiran_bayi" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan tempat lahir" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_kelahiran_bayi')" />
                            </div>
                            <div>
                                <x-input-label for="hari_kelahiran" value="Hari Kelahiran*" />
                                <select id="hari_kelahiran" name="hari_kelahiran" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Minggu">Minggu</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('hari_kelahiran')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_kelahiran_bayi" value="Tanggal Kelahiran*" />
                                <x-text-input id="tanggal_kelahiran_bayi" name="tanggal_kelahiran_bayi" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_kelahiran_bayi')" />
                            </div>
                            <div>
                                <x-input-label for="waktu_kelahiran" value="Waktu Kelahiran*" />
                                <x-text-input id="waktu_kelahiran" name="waktu_kelahiran" type="time" class="mt-1 block w-full" placeholder="--:--" required />
                                <x-input-error class="mt-2" :messages="$errors->get('waktu_kelahiran')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelahiran" value="Jenis Kelahiran*" />
                                <select id="jenis_kelahiran" name="jenis_kelahiran" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Jenis Kelahiran</option>
                                    <option value="Tunggal">Tunggal</option>
                                    <option value="Kembar 2">Kembar 2</option>
                                    <option value="Kembar 3">Kembar 3</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelahiran')" />
                            </div>
                            <div>
                                <x-input-label for="kelahiran_ke" value="Kelahiran ke*" />
                                <x-text-input id="kelahiran_ke" name="kelahiran_ke" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan kelahiran ke" required />
                                <x-input-error class="mt-2" :messages="$errors->get('kelahiran_ke')" />
                            </div>
                            <div>
                                <x-input-label for="penolong_kelahiran" value="Penolong Kelahiran*" />
                                <select id="penolong_kelahiran" name="penolong_kelahiran" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Penolong Kelahiran--</option>
                                    <option value="Dokter">Dokter</option>
                                    <option value="Bidan">Bidan</option>
                                    <option value="Dukun">Dukun</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('penolong_kelahiran')" />
                            </div>
                            <div>
                                <x-input-label for="berat_bayi" value="Berat Bayi*" />
                                <x-text-input id="berat_bayi" name="berat_bayi" type="number" step="0.01" class="mt-1 block w-full" placeholder="ukuran dalam skala kg" required />
                                <x-input-error class="mt-2" :messages="$errors->get('berat_bayi')" />
                            </div>
                            <div>
                                <x-input-label for="panjang_bayi" value="Panjang Bayi*" />
                                <x-text-input id="panjang_bayi" name="panjang_bayi" type="number" step="0.01" class="mt-1 block w-full" placeholder="ukuran dalam skala cm" required />
                                <x-input-error class="mt-2" :messages="$errors->get('panjang_bayi')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Ibu --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Ibu</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_ibu" value="NIK*" />
                                <x-text-input id="nik_ibu" name="nik_ibu" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nik" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_ibu" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_ibu" name="nama_lengkap_ibu" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir_ibu" value="Tanggal Lahir*" />
                                <x-text-input id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_ibu" value="Pekerjaan*" />
                                <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_ibu')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_ibu" value="Alamat*" />
                                <textarea id="alamat_ibu" name="alamat_ibu" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat lengkap" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_ibu" value="Provinsi*" />
                                <select id="provinsi_ibu" name="provinsi_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="kota_kabupaten_ibu" value="Kota/Kabupaten*" />
                                <select id="kota_kabupaten_ibu" name="kota_kabupaten_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kota_kabupaten_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_ibu" value="Kecamatan*" />
                                <select id="kecamatan_ibu" name="kecamatan_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_ibu" value="Desa/Kelurahan*" />
                                <select id="desa_kelurahan_ibu" name="desa_kelurahan_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_ibu')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Ayah --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Ayah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_ayah" value="NIK*" />
                                <x-text-input id="nik_ayah" name="nik_ayah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nik" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_ayah" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_ayah" name="nama_lengkap_ayah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir_ayah" value="Tanggal Lahir*" />
                                <x-text-input id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_ayah" value="Pekerjaan*" />
                                <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_ayah')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_ayah" value="Alamat*" />
                                <textarea id="alamat_ayah" name="alamat_ayah" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat lengkap" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_ayah" value="Provinsi*" />
                                <select id="provinsi_ayah" name="provinsi_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="kota_kabupaten_ayah" value="Kota/Kabupaten*" />
                                <select id="kota_kabupaten_ayah" name="kota_kabupaten_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kota_kabupaten_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_ayah" value="Kecamatan*" />
                                <select id="kecamatan_ayah" name="kecamatan_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_ayah" value="Desa/Kelurahan*" />
                                <select id="desa_kelurahan_ayah" name="desa_kelurahan_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_ayah')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Pelapor --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Pelapor</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_pelapor" value="NIK*" />
                                <x-text-input id="nik_pelapor" name="nik_pelapor" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nik" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_pelapor" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_pelapor" name="nama_lengkap_pelapor" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="umur_pelapor" value="Umur*" />
                                <x-text-input id="umur_pelapor" name="umur_pelapor" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin_pelapor" value="Jenis Kelamin*" />
                                <select id="jenis_kelamin_pelapor" name="jenis_kelamin_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_pelapor" value="Pekerjaan*" />
                                <select id="pekerjaan_pelapor" name="pekerjaan_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_pelapor')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_pelapor" value="Alamat*" />
                                <textarea id="alamat_pelapor" name="alamat_pelapor" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_pelapor" value="Provinsi*" />
                                <select id="provinsi_pelapor" name="provinsi_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="kota_kabupaten_pelapor" value="Kota/Kabupaten*" />
                                <select id="kota_kabupaten_pelapor" name="kota_kabupaten_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kota_kabupaten_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_pelapor" value="Kecamatan*" />
                                <select id="kecamatan_pelapor" name="kecamatan_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_pelapor" value="Desa/Kelurahan*" />
                                <select id="desa_kelurahan_pelapor" name="desa_kelurahan_pelapor" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_pelapor')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 1 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 1</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_saksi1" value="NIK*" />
                                <x-text-input id="nik_saksi1" name="nik_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nik" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi1" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi1" name="nama_lengkap_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="umur_saksi1" value="Umur*" />
                                <x-text-input id="umur_saksi1" name="umur_saksi1" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin_saksi1" value="Jenis Kelamin*" />
                                <select id="jenis_kelamin_saksi1" name="jenis_kelamin_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_saksi1" value="Pekerjaan*" />
                                <select id="pekerjaan_saksi1" name="pekerjaan_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_saksi1')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_saksi1" value="Alamat*" />
                                <textarea id="alamat_saksi1" name="alamat_saksi1" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_saksi1" value="Provinsi*" />
                                <select id="provinsi_saksi1" name="provinsi_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="kota_kabupaten_saksi1" value="Kota/Kabupaten*" />
                                <select id="kota_kabupaten_saksi1" name="kota_kabupaten_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kota_kabupaten_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_saksi1" value="Kecamatan*" />
                                <select id="kecamatan_saksi1" name="kecamatan_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_saksi1" value="Desa/Kelurahan*" />
                                <select id="desa_kelurahan_saksi1" name="desa_kelurahan_saksi1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_saksi1')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 2 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 2</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_saksi2" value="NIK*" />
                                <x-text-input id="nik_saksi2" name="nik_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nik" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi2" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi2" name="nama_lengkap_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="umur_saksi2" value="Umur*" />
                                <x-text-input id="umur_saksi2" name="umur_saksi2" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin_saksi2" value="Jenis Kelamin*" />
                                <select id="jenis_kelamin_saksi2" name="jenis_kelamin_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_saksi2" value="Pekerjaan*" />
                                <select id="pekerjaan_saksi2" name="pekerjaan_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_saksi2')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat_saksi2" value="Alamat*" />
                                <textarea id="alamat_saksi2" name="alamat_saksi2" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_saksi2" value="Provinsi*" />
                                <select id="provinsi_saksi2" name="provinsi_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="kota_kabupaten_saksi2" value="Kota/Kabupaten*" />
                                <select id="kota_kabupaten_saksi2" name="kota_kabupaten_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kota_kabupaten_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_saksi2" value="Kecamatan*" />
                                <select id="kecamatan_saksi2" name="kecamatan_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_saksi2" value="Desa/Kelurahan*" />
                                <select id="desa_kelurahan_saksi2" name="desa_kelurahan_saksi2" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_saksi2')" />
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
