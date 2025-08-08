<x-backend.layouts.app>
    <x-slot:title>
        Edit Info Grafis
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Edit Info Grafis</h1>
                <a href="{{ route('backend.informasi.infoGrafis.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
            </div>

            <form action="{{ route('backend.informasi.infoGrafis.update', $infoGrafis) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('title', $infoGrafis->title) }}" required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $infoGrafis->description) }}</textarea>
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Gambar (Kosongkan
                            jika tidak diubah)</label>
                        <input type="file" name="img" id="img" class="mt-1 block w-full text-sm">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="show" @selected(old('status', $infoGrafis->status) == 'show')>Aktif (Show)</option>
                            <option value="hide" @selected(old('status', $infoGrafis->status) == 'hide')>Tidak Aktif (Hide)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.informasi.infoGrafis.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
