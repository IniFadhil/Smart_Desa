<x-backend.layouts.app>
    <x-slot:title>
        Detail Modul
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Detail Modul</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Nama</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $modul->name ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Icon</div>
                <div class="text-sm text-gray-900 col-span-3">{!! $modul->icon ?? '-' !!}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $modul->description ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($modul->status == 1)
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

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.manajemen.modul.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.manajemen.modul.edit', $modul) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
