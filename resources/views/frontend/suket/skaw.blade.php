{{-- Menggunakan layout utama frontend --}}
<x-layouts.app>
    {{-- Memulai section 'content' --}}
    @section('content')
        {{-- Bagian konten utama halaman --}}
        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Pengajuan Surat Keterangan Ahli Waris</h1>
                <p class="text-gray-600 text-center mb-8">
                    Mohon lengkapi semua informasi yang diperlukan di bawah ini dengan benar.
                </p>

                {{-- FORMULIR PENGAJUAN --}}
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                    {{-- @csrf --}} {{-- Baris ini telah dikomentari/dihapus --}}

                    {{-- Bagian Lampiran Persyaratan --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Lampiran Persyaratan</h2>
                        <p class="text-sm text-gray-500 mb-4">* File type: jpg/jpeg/png | max size: 1 MB</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="file_surat_permohonan" value="File Surat Permohonan*" />
                                <input id="file_surat_permohonan" name="file_surat_permohonan" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_surat_permohonan')" />
                            </div>
                            <div>
                                <x-input-label for="file_ktp_ahli_waris" value="File KTP Ahli Waris (.pdf)*" />
                                <input id="file_ktp_ahli_waris" name="file_ktp_ahli_waris" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_ktp_ahli_waris')" />
                            </div>
                            <div>
                                <x-input-label for="file_kartu_keluarga_almarhum" value="File Kartu Keluarga almarhum*" />
                                <input id="file_kartu_keluarga_almarhum" name="file_kartu_keluarga_almarhum" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_kartu_keluarga_almarhum')" />
                            </div>
                            <div>
                                <x-input-label for="file_surat_buku_nikah" value="File Surat Buku Nikah*" />
                                <input id="file_surat_buku_nikah" name="file_surat_buku_nikah" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_surat_buku_nikah')" />
                            </div>
                            <div>
                                <x-input-label for="file_akta_lahir_seluruh_ahli_waris" value="File Akta Lahir Seluruh Ahli Waris (.pdf)*" />
                                <input id="file_akta_lahir_seluruh_ahli_waris" name="file_akta_lahir_seluruh_ahli_waris" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_akta_lahir_seluruh_ahli_waris')" />
                            </div>
                            <div>
                                <x-input-label for="file_surat_keterangan_kematian" value="File Surat Keterangan Kematian*" />
                                <input id="file_surat_keterangan_kematian" name="file_surat_keterangan_kematian" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_surat_keterangan_kematian')" />
                            </div>
                            <div>
                                <x-input-label for="file_keterangan_silsilah_dari_kelurahan" value="File Keterangan Silsilah Dari Kelurahan*" />
                                <input id="file_keterangan_silsilah_dari_kelurahan" name="file_keterangan_silsilah_dari_kelurahan" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_keterangan_silsilah_dari_kelurahan')" />
                            </div>
                            <div>
                                <x-input-label for="file_surat_pernyataan" value="File Surat Pernyataan*" />
                                <input id="file_surat_pernyataan" name="file_surat_pernyataan" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file_surat_pernyataan')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Almarhum --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Almarhum</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_almarhum" value="Nama*" />
                                <x-text-input id="nama_almarhum" name="nama_almarhum" type="text" class="mt-1 block w-full" placeholder="Masukan Nama Almarhum" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_almarhum')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_meninggal" value="Tanggal Meninggal*" />
                                <x-text-input id="tanggal_meninggal" name="tanggal_meninggal" type="date" class="mt-1 block w-full" placeholder="dd/mm/yyyy" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_meninggal')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="jenis_kelamin_almarhum" value="Jenis Kelamin*" />
                                <select id="jenis_kelamin_almarhum" name="jenis_kelamin_almarhum" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin_almarhum')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Pasangan (Dinamis) --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200" x-data="{ pasangans: [{ nama: '', tempat_lahir: '', tanggal_lahir: '', jenis_kelamin: '', pekerjaan: '' }] }">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Pasangan</h2>
                        <template x-for="(pasangan, index) in pasangans" x-bind:key="index"> {{-- x-bind:key --}}
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end mb-4 border-b border-green-100 pb-4">
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`nama_pasangan_${index}`" value="Nama" /> {{-- x-bind:for --}}
                                    <x-text-input type="text" x-model="pasangan.nama" x-bind:name="`pasangan[${index}][nama]`" x-bind:id="`nama_pasangan_${index}`" class="mt-1 block w-full" placeholder="Nama" /> {{-- x-bind:name, x-bind:id --}}
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`tempat_lahir_pasangan_${index}`" value="Tempat Lahir" />
                                    <x-text-input type="text" x-model="pasangan.tempat_lahir" x-bind:name="`pasangan[${index}][tempat_lahir]`" x-bind:id="`tempat_lahir_pasangan_${index}`" class="mt-1 block w-full" placeholder="Tempat Lahir" />
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`tanggal_lahir_pasangan_${index}`" value="Tanggal Lahir" />
                                    <x-text-input type="date" x-model="pasangan.tanggal_lahir" x-bind:name="`pasangan[${index}][tanggal_lahir]`" x-bind:id="`tanggal_lahir_pasangan_${index}`" class="mt-1 block w-full" placeholder="dd/mm/yyyy" />
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`jenis_kelamin_pasangan_${index}`" value="Jenis Kelamin" />
                                    <select x-model="pasangan.jenis_kelamin" x-bind:name="`pasangan[${index}][jenis_kelamin]`" x-bind:id="`jenis_kelamin_pasangan_${index}`" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`pekerjaan_pasangan_${index}`" value="Pekerjaan" />
                                    <select x-model="pasangan.pekerjaan" x-bind:name="`pasangan[${index}][pekerjaan]`" x-bind:id="`pekerjaan_pasangan_${index}`" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                        <option value="">Pilih Pekerjaan</option>
                                        <option value="PNS">PNS</option>
                                        <option value="Swasta">Swasta</option>
                                        <option value="Wiraswasta">Wiraswasta</option>
                                        <option value="Petani">Petani</option>
                                        <option value="Nelayan">Nelayan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1 flex justify-end">
                                    <button type="button" @click="pasangans.splice(index, 1)" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md" x-show="pasangans.length > 1">
                                        -
                                    </button>
                                    <button type="button" @click="pasangans.push({ nama: '', tempat_lahir: '', tanggal_lahir: '', jenis_kelamin: '', pekerjaan: '' })" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md ml-2">
                                        +
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>


                    {{-- Bagian Data Anak (Dinamis) --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200" x-data="{ anaks: [{ nama: '', tempat_lahir: '', tanggal_lahir: '', kewarganegaraan: '', alamat: '' }] }">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Anak</h2>
                        <template x-for="(anak, index) in anaks" x-bind:key="index"> {{-- x-bind:key --}}
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end mb-4 border-b border-green-100 pb-4">
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`nama_anak_${index}`" value="Nama" /> {{-- x-bind:for --}}
                                    <x-text-input type="text" x-model="anak.nama" x-bind:name="`anaks[${index}][nama]`" x-bind:id="`nama_anak_${index}`" class="mt-1 block w-full" placeholder="Nama" /> {{-- x-bind:name, x-bind:id --}}
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`tempat_lahir_anak_${index}`" value="Tempat Lahir" />
                                    <x-text-input type="text" x-model="anak.tempat_lahir" x-bind:name="`anaks[${index}][tempat_lahir]`" x-bind:id="`tempat_lahir_anak_${index}`" class="mt-1 block w-full" placeholder="Tempat Lahir" />
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`tanggal_lahir_anak_${index}`" value="Tanggal Lahir" />
                                    <x-text-input type="date" x-model="anak.tanggal_lahir" x-bind:name="`anaks[${index}][tanggal_lahir]`" x-bind:id="`tanggal_lahir_anak_${index}`" class="mt-1 block w-full" placeholder="dd/mm/yyyy" />
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`kewarganegaraan_anak_${index}`" value="Kewarganegaraan" />
                                    <select x-model="anak.kewarganegaraan" x-bind:name="`anaks[${index}][kewarganegaraan]`" x-bind:id="`kewarganegaraan_anak_${index}`" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                                        <option value="">Pilih Kewarganegaraan</option>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label x-bind:for="`alamat_anak_${index}`" value="Alamat" />
                                    <textarea x-model="anak.alamat" x-bind:name="`anaks[${index}][alamat]`" x-bind:id="`alamat_anak_${index}`" rows="1" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Alamat"></textarea>
                                </div>
                                <div class="md:col-span-1 flex justify-end">
                                    <button type="button" @click="anaks.splice(index, 1)" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md" x-show="anaks.length > 1">
                                        -
                                    </button>
                                    <button type="button" @click="anaks.push({ nama: '', tempat_lahir: '', tanggal_lahir: '', kewarganegaraan: '', alamat: '' })" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md ml-2">
                                        +
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Bagian Data Saksi 1 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 1</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_saksi1" value="Nama*" />
                                <x-text-input id="nama_saksi1" name="nama_saksi1" type="text" class="mt-1 block w-full" placeholder="Masukan Nama Saksi 1" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_saksi1')" />
                            </div>
                            <div>
                                <x-input-label for="nik_saksi1" value="NIK*" />
                                <x-text-input id="nik_saksi1" name="nik_saksi1" type="text" class="mt-1 block w-full" placeholder="Masukan NIK Saksi 1" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi1')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Data Saksi 2 --}}
                    <div class="p-6 bg-green-50 rounded-lg shadow-sm border border-green-200">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 border-b-2 border-green-300 pb-2">Data Saksi 2</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_saksi2" value="Nama*" />
                                <x-text-input id="nama_saksi2" name="nama_saksi2" type="text" class="mt-1 block w-full" placeholder="Masukan Nama Saksi 2" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_saksi2')" />
                            </div>
                            <div>
                                <x-input-label for="nik_saksi2" value="NIK*" />
                                <x-text-input id="nik_saksi2" name="nik_saksi2" type="text" class="mt-1 block w-full" placeholder="Masukan NIK Saksi 2" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nik_saksi2')" />
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
