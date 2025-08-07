<x-backend.layouts.app>
    <x-slot:title>
        Tambah Role Baru
    </x-slot:title>

    <form action="{{ route('backend.manajemen.role.store') }}" method="POST">
        @csrf
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Tambah Role Baru</h1>
                <a href="{{ route('backend.manajemen.role.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
            </div>

            {{-- Informasi Dasar --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Role <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>

            {{-- Hak Akses --}}
            <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4 border-t pt-6">Hak Akses Menu</h3>
            <div class="space-y-6">
                @foreach ($moduls as $modul)
                    <div class="p-4 border rounded-md">
                        <p class="font-semibold text-gray-800">{{ $modul->name }}</p>
                        <div class="space-y-2 mt-2">
                            @foreach ($modul->menus as $menu)
                                <div class="grid grid-cols-6 gap-4 items-center">
                                    <div class="col-span-2">{{ $menu->name }}</div>
                                    <div class="col-span-4 flex items-center space-x-4">
                                        <label class="flex items-center space-x-2"><input type="checkbox"
                                                name="permissions[{{ $menu->id }}][]" value="c"
                                                class="rounded"> <span>Create</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox"
                                                name="permissions[{{ $menu->id }}][]" value="r"
                                                class="rounded"> <span>Read</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox"
                                                name="permissions[{{ $menu->id }}][]" value="u"
                                                class="rounded"> <span>Update</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox"
                                                name="permissions[{{ $menu->id }}][]" value="d"
                                                class="rounded"> <span>Delete</span></label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                <a href="{{ route('backend.manajemen.role.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
            </div>
        </div>
    </form>
</x-backend.layouts.app>
