<x-backend.layouts.app>
    <x-slot:title>
        Detail Info Grafis
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Info Grafis</h2>
            <a href="{{ route('backend.informasi.infoGrafis.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Judul</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $infoGrafis->title ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi</div>
                <div class="text-sm text-gray-900 col-span-3">{!! $infoGrafis->description ?? '-' !!}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($infoGrafis->status == 'show')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak
                            Aktif</span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Gambar</div>
                <div class="text-sm text-gray-900 col-span-3">
                    {{-- Ganti 'path/ke/folder' dengan path Anda yang sebenarnya --}}
                    <img src="{{ asset('path/ke/folder/' . ($infoGrafis->img ?? 'default.jpg')) }}" alt="Info Grafis"
                        class="max-w-sm rounded-lg">
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-4">
            <a href="{{ route('backend.informasi.infoGrafis.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.informasi.infoGrafis.edit', $infoGrafis) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
