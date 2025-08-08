<x-backend.layouts.app>
    <x-slot:title>
        Balas Komentar
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Balas Komentar</h1>
                <a href="{{ route('backend.informasi.komentar.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
            </div>

            {{-- Menampilkan Komentar Asli --}}
            <div class="mb-6 p-4 bg-gray-50 rounded-lg border">
                <p class="font-semibold text-gray-800">{{ $komentar->nama }}</p>
                <p class="text-sm text-gray-500 mb-2">
                    {{ \Carbon\Carbon::parse($komentar->created_at)->translatedFormat('d F Y, H:i') }}</p>
                <p class="text-gray-700 italic">"{{ $komentar->komentar }}"</p>
            </div>

            <form action="{{ route('backend.informasi.komentar.updateReply', $komentar) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="balas" class="block text-sm font-medium text-gray-700 mb-1">Balasan Anda</label>
                        <textarea name="balas" id="balas" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required>{{ old('balas', $komentar->balas) }}</textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.informasi.komentar.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Kirim Balasan</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
