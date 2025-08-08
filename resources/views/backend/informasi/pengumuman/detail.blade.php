<x-backend.layouts.app>
    <x-slot:title>
        Detail Pengumuman
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Pengumuman</h2>
            <a href="{{ route('backend.informasi.pengumuman.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Judul</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $pengumuman->title ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi Singkat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $pengumuman->short_description ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi Lengkap</div>
                <div class="text-sm text-gray-900 col-span-3">{!! $pengumuman->description ?? '-' !!}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($pengumuman->status == 'show')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak
                            Aktif</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-4">
            <a href="{{ route('backend.informasi.pengumuman.index') }}"
                class="px-4 py-2 bg-gray-200 rounded-md">Kembali</a>
            <a href="{{ route('backend.informasi.pengumuman.edit', $pengumuman) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
