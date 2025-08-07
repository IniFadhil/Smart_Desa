<x-backend.layouts.app>
    <x-slot:title>
        Detail Berita
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Berita</h2>
            <a href="{{ route('backend.informasi.berita.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Judul</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $berita->title ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Konten Singkat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $berita->short_content ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Konten Lengkap</div>
                <div class="text-sm text-gray-900 col-span-3">{!! $berita->content ?? '-' !!}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($berita->status == 'show')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak
                            Aktif</span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Dibuat Oleh</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $berita->created_by ?? '-' }}</div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.informasi.berita.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.informasi.berita.edit', $berita) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
