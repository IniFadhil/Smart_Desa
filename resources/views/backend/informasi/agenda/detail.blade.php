<x-backend.layouts.app>
    <x-slot:title>
        Detail Agenda
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Agenda</h2>
            <a href="{{ route('backend.informasi.agenda.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
        </div>

        {{-- BODY --}}
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Judul</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $agenda->title ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Tanggal Mulai</div>
                <div class="text-sm text-gray-900 col-span-3">
                    {{ \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d F Y, H:i') }}</div>

                <div class="text-sm font-medium text-gray-500">Tanggal Selesai</div>
                <div class="text-sm text-gray-900 col-span-3">
                    {{ \Carbon\Carbon::parse($agenda->end_date)->translatedFormat('d F Y, H:i') }}</div>

                <div class="text-sm font-medium text-gray-500">Tempat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $agenda->address ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi Singkat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $agenda->short_description ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Deskripsi Lengkap</div>
                <div class="text-sm text-gray-900 col-span-3">{!! $agenda->description ?? '-' !!}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($agenda->status == 'show')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak
                            Aktif</span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Dibuat Oleh</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $agenda->created_by ?? '-' }}</div>
            </div>
        </div>

        {{-- FOOTER TOMBOL AKSI --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.informasi.agenda.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.informasi.agenda.edit', $agenda) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
