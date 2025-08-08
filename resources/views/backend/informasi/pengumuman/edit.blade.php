<x-backend.layouts.app>
    <x-slot:title>
        Edit Pengumuman
    </x-slot:title>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit Pengumuman</h1>
            <form action="{{ route('backend.informasi.pengumuman.update', $pengumuman) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul
                            Pengumuman</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md"
                            value="{{ old('title', $pengumuman->title) }}" required>
                    </div>
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            Singkat</label>
                        <textarea name="short_description" id="short_description" rows="3" class="mt-1 block w-full rounded-md" required>{{ old('short_description', $pengumuman->short_description) }}</textarea>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            Lengkap</label>
                        <textarea name="description" id="description" rows="10" class="mt-1 block w-full rounded-md" required>{{ old('description', $pengumuman->description) }}</textarea>
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Gambar (Kosongkan
                            jika tidak diubah)</label>
                        <input type="file" name="img" id="img" class="mt-1 block w-full text-sm">
                    </div>
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Lampiran File
                            (Kosongkan jika tidak diubah)</label>
                        <input type="file" name="file" id="file" class="mt-1 block w-full text-sm">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md">
                            <option value="show" @selected(old('status', $pengumuman->status) == 'show')>Aktif (Show)</option>
                            <option value="hide" @selected(old('status', $pengumuman->status) == 'hide')>Tidak Aktif (Hide)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.informasi.pengumuman.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
