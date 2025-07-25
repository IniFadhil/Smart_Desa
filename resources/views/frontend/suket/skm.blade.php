{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Kematian</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini dengan benar.
                </p>

                {{-- FORMULIR PENGAJUAN --}}
                {{-- PERHATIAN: Atribut 'action' saat ini adalah '#'. Anda perlu menggantinya dengan URL endpoint backend yang akan memproses data formulir ini. --}}
                {{-- PENTING: @csrf telah dihapus. Aplikasi Anda sekarang RENTAN terhadap serangan CSRF. --}}
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                    {{-- @csrf --}} {{-- Token CSRF untuk keamanan Laravel --}}

                    {{-- Bagian Lampiran Persyaratan --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Lampiran Persyaratan</h2>
                        <p class="text-sm text-gray-500 mb-4">* File type: jpeg/jpg/png | max size: 1 MB</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="scan_ktp_almarhum" value="Scan/Foto KTP Almarhum*" />
                                <input id="scan_ktp_almarhum" name="scan_ktp_almarhum" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_ktp_almarhum')" />
                            </div>
                            <div>
                                <x-input-label for="scan_ktp_pelapor" value="Scan/Foto KTP Pelapor*" />
                                <input id="scan_ktp_pelapor" name="scan_ktp_pelapor" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_ktp_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="scan_ktp_saksi" value="Scan/Foto KTP Saksi*" />
                                <input id="scan_ktp_saksi" name="scan_ktp_saksi" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_ktp_saksi')" />
                            </div>
                            <div>
                                <x-input-label for="scan_surat_rs" value="Scan/Foto Surat Keterangan Rumah Sakit*" />
                                <input id="scan_surat_rs" name="scan_surat_rs" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('scan_surat_rs')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Keluarga --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Keluarga</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_kepala_keluarga" value="Nama Kepala Keluarga*" />
                                <x-text-input id="nama_kepala_keluarga" name="nama_kepala_keluarga" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama kepala keluarga" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_kepala_keluarga')" />
                            </div>
                            <div>
                                <x-input-label for="nomor_kartu_keluarga" value="Nomor Kartu Keluarga*" />
                                <x-text-input id="nomor_kartu_keluarga" name="nomor_kartu_keluarga" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nomor kartu keluarga" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_kartu_keluarga')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Jenazah --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Jenazah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_jenazah" value="NIK*" />
                                <x-text-input id="nik_jenazah" name="nik_jenazah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="nama_jenazah" value="Nama Lengkap*" />
                                <x-text-input id="nama_jenazah" name="nama_jenazah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Nama Lengkap" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir_jenazah" value="Tanggal Lahir*" />
                                <x-text-input id="tanggal_lahir_jenazah" name="tanggal_lahir_jenazah" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_lahir_jenazah" value="Tempat Lahir*" />
                                <x-text-input id="tempat_lahir_jenazah" name="tempat_lahir_jenazah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Tempat Lahir" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin_jenazah" value="Jenis Kelamin*" />
                                <select id="jenis_kelamin_jenazah" name="jenis_kelamin_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="agama_jenazah" value="Agama*" />
                                <select id="agama_jenazah" name="agama_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('agama_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_jenazah" value="Pekerjaan*" />
                                <select id="pekerjaan_jenazah" name="pekerjaan_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="alamat_jenazah" value="Alamat*" />
                                <textarea id="alamat_jenazah" name="alamat_jenazah" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat lengkap" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi_jenazah" value="Provinsi*" />
                                <select id="provinsi_jenazah" name="provinsi_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('provinsi_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="kabupaten_kota_jenazah" value="Kabupaten/Kota*" />
                                <select id="kabupaten_kota_jenazah" name="kabupaten_kota_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kabupaten_kota_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan_jenazah" value="Kecamatan*" />
                                <select id="kecamatan_jenazah" name="kecamatan_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="desa_kelurahan_jenazah" value="Desa/Dusun/Kelurahan*" />
                                <select id="desa_kelurahan_jenazah" name="desa_kelurahan_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Dusun/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_jenazah')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="kewarganegaraan_jenazah" value="Kewarganegaraan*" />
                                <div class="mt-2 flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="kewarganegaraan_jenazah" value="WNI" class="form-radio text-green-600" checked>
                                        <span class="ml-2 text-gray-700">WNI</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="kewarganegaraan_jenazah" value="WNA" class="form-radio text-green-600">
                                        <span class="ml-2 text-gray-700">WNA</span>
                                    </label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('kewarganegaraan_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="keturunan_jenazah" value="Keturunan*" />
                                <select id="keturunan_jenazah" name="keturunan_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Keturunan --</option>
                                    <option value="Bukan WNI">Bukan WNI</option>
                                    <option value="WNI Asli">WNI Asli</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('keturunan_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="kebangsaan_jenazah" value="Kebangsaan*" />
                                <x-text-input id="kebangsaan_jenazah" name="kebangsaan_jenazah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan kebangsaan" required />
                                <x-input-error class="mt-2" :messages="$errors->get('kebangsaan_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="anak_ke_jenazah" value="Anak Ke*" />
                                <x-text-input id="anak_ke_jenazah" name="anak_ke_jenazah" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Anak ke berapa dalam keluarga" required />
                                <x-input-error class="mt-2" :messages="$errors->get('anak_ke_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_kematian_jenazah" value="Tanggal Kematian*" />
                                <x-text-input id="tanggal_kematian_jenazah" name="tanggal_kematian_jenazah" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_kematian_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="pukul_kematian_jenazah" value="Pukul*" />
                                <x-text-input id="pukul_kematian_jenazah" name="pukul_kematian_jenazah" type="time" class="mt-1 block w-full" placeholder="--:--" required />
                                <x-input-error class="mt-2" :messages="$errors->get('pukul_kematian_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="sebab_kematian_jenazah" value="Sebab Kematian*" />
                                <select id="sebab_kematian_jenazah" name="sebab_kematian_jenazah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Sebab Kematian --</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Kecelakaan">Kecelakaan</option>
                                    <option value="Bencana Alam">Bencana Alam</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('sebab_kematian_jenazah')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_kematian_jenazah" value="Tempat Kematian*" />
                                <x-text-input id="tempat_kematian_jenazah" name="tempat_kematian_jenazah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan tempat kematian" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_kematian_jenazah')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Ayah --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Ayah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_ayah" value="NIK*" />
                                <x-text-input id="nik_ayah" name="nik_ayah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_ayah" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_ayah" name="nama_lengkap_ayah" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Nama lengkap" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_ayah')" />
                            </div>
                            <div>
                                <x-input-label for="umur_ayah" value="Umur*" />
                                <x-text-input id="umur_ayah" name="umur_ayah" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_ayah')" />
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
                                <x-input-label for="kabupaten_kota_ayah" value="Kabupaten/Kota*" />
                                <select id="kabupaten_kota_ayah" name="kabupaten_kota_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kabupaten_kota_ayah')" />
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
                                <x-input-label for="desa_kelurahan_ayah" value="Desa/Dusun/Kelurahan*" />
                                <select id="desa_kelurahan_ayah" name="desa_kelurahan_ayah" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Dusun/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_ayah')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Ibu --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Ibu</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_ibu" value="NIK*" />
                                <x-text-input id="nik_ibu" name="nik_ibu" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_ibu" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_ibu" name="nama_lengkap_ibu" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Nama Lengkap" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_ibu')" />
                            </div>
                            <div>
                                <x-input-label for="umur_ibu" value="Umur*" />
                                <x-text-input id="umur_ibu" name="umur_ibu" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan Umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_ibu')" />
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
                                <x-input-label for="kabupaten_kota_ibu" value="Kabupaten/Kota*" />
                                <select id="kabupaten_kota_ibu" name="kabupaten_kota_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kabupaten_kota_ibu')" />
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
                                <x-input-label for="desa_kelurahan_ibu" value="Desa/Dusun/Kelurahan*" />
                                <select id="desa_kelurahan_ibu" name="desa_kelurahan_ibu" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Desa/Dusun/Kelurahan --</option>
                                    {{-- Opsi akan diisi via JavaScript atau dari database --}}
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('desa_kelurahan_ibu')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Pelapor --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Pelapor</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_pelapor" value="NIK*" />
                                <x-text-input id="nik_pelapor" name="nik_pelapor" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_pelapor" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_pelapor" name="nama_lengkap_pelapor" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama lengkap" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="umur_pelapor" value="Umur*" />
                                <x-text-input id="umur_pelapor" name="umur_pelapor" type="number" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan umur" required />
                                <x-input-error class="mt-2" :messages="$errors->get('umur_pelapor')" />
                            </div>
                            <div>
                                <x-input-label for="hubungan_pelapor_almarhum" value="Hubungan Dengan Almarhum*" />
                                <x-text-input id="hubungan_pelapor_almarhum" name="hubungan_pelapor_almarhum" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan hubungan dengan almarhum" required />
                                <x-input-error class="mt-2" :messages="$errors->get('hubungan_pelapor_almarhum')" />
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
                                <x-input-label for="alamat_pelapor" value="Alamat Lengkap*" />
                                <textarea id="alamat_pelapor" name="alamat_pelapor" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Silahkan untuk memasukan alamat lengkap" required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_pelapor')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 1 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 1</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nik_saksi1" value="NIK*" />
                                <x-text-input id="nik_saksi1" name="nik_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi1" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi1" name="nama_lengkap_saksi1" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama lengkap" required />
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
                                <x-text-input id="nik_saksi2" name="nik_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan NIK" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="nama_lengkap_saksi2" value="Nama Lengkap*" />
                                <x-text-input id="nama_lengkap_saksi2" name="nama_lengkap_saksi2" type="text" class="mt-1 block w-full" placeholder="Silahkan untuk memasukan nama lengkap" required />
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
