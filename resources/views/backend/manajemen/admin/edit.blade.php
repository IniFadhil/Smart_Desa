<x-backend.layouts.app>
    <x-slot:title>
        Edit Admin
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('backend.manajemen.admin.update', $admin) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-md rounded-lg p-8">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h1 class="text-2xl font-semibold text-gray-700">Edit Admin: {{ $admin->name }}</h1>
                    <a href="{{ route('backend.manajemen.admin.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" id="nik" class="mt-1 block w-full rounded-md"
                            value="{{ old('nik', $admin->nik) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md"
                            value="{{ old('name', $admin->name) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md"
                            value="{{ old('username', $admin->username) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md"
                            value="{{ old('email', $admin->email) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru
                            (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">No. HP /
                            Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full rounded-md"
                            value="{{ old('phone_number', $admin->phone_number) }}">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" id="role" class="mt-1 block w-full rounded-md" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @selected($admin->roles->first()->id == $role->id)>{{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md">
                            <option value="1" @selected($admin->status == 1)>Aktif</option>
                            <option value="0" @selected($admin->status == 0)>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mb-4 col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md">{{ old('address', $admin->address) }}</textarea>
                    </div>
                    <div class="mb-4 col-span-2">
                        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" name="img" id="img" class="mt-1 block w-full text-sm ...">
                        {{-- Tambahkan preview foto jika ada --}}
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.manajemen.admin.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-backend.layouts.app>
