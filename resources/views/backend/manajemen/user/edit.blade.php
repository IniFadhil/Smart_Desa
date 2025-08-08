<x-backend.layouts.app>
    <x-slot:title>
        Edit Pengguna
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Edit Pengguna: {{ $user->name }}</h1>
                <a href="{{ route('backend.manajemen.user.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
            </div>

            <form action="{{ route('backend.manajemen.user.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" id="nik"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('nik', $user->nik) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('tgl_lahir', $user->tgl_lahir) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="gender" id="gender"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="Laki-laki" @selected(old('gender', $user->gender) == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('gender', $user->gender) == 'Perempuan')>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="no_telpon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="no_telpon" id="no_telpon"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('no_telpon', $user->no_telpon) }}">
                    </div>
                    <div class="col-span-2 mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('backend.manajemen.user.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-backend.layouts.app>
