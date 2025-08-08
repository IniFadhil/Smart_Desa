<x-backend.layouts.app>
    <x-slot:title>
        Tambah Menu Baru
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Tambah Menu Baru</h1>
                <a href="{{ route('backend.manajemen.menu.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
            </div>

            <form action="{{ route('backend.manajemen.menu.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700 mb-1">ID Menu</label>
                        <input type="text" name="id" id="id" value="{{ old('id') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL / Route
                            Name</label>
                        <input type="text" name="url" id="url" value="{{ old('url') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                        <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.manajemen.menu.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
