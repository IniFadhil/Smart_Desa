<x-backend.layouts.app>
    <x-slot:title>
        Edit Agenda
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit Agenda</h1>
            <form action="{{ route('backend.informasi.agenda.update', $agenda) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Agenda</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md"
                            value="{{ old('title', $agenda->title) }}" required>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Mulai</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                class="mt-1 block w-full rounded-md"
                                value="{{ old('start_date', $agenda->start_date) }}" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Selesai</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                class="mt-1 block w-full rounded-md" value="{{ old('end_date', $agenda->end_date) }}"
                                required>
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                        <input type="text" name="address" id="address" class="mt-1 block w-full rounded-md"
                            value="{{ old('address', $agenda->address) }}" required>
                    </div>
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            Singkat</label>
                        <textarea name="short_description" id="short_description" rows="2" class="mt-1 block w-full rounded-md">{{ old('short_description', $agenda->short_description) }}</textarea>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            Lengkap</label>
                        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md">{{ old('description', $agenda->description) }}</textarea>
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="img" id="img" class="mt-1 block w-full text-sm">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md">
                            <option value="show" @selected(old('status', $agenda->status) == 'show')>Aktif (Show)</option>
                            <option value="hide" @selected(old('status', $agenda->status) == 'hide')>Tidak Aktif (Hide)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.informasi.agenda.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
