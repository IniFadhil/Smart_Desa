<x-backend.layouts.app>
    <x-slot:title>
        Detail Admin
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Admin</h2>
            <a href="{{ route('backend.manajemen.admin.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">Foto</div>
                <div class="text-sm text-gray-900 col-span-3">
                    <img src="{{ asset('backend/images/manajemen/admin/' . ($admin->img ?? 'default.png')) }}"
                        alt="Foto Admin" class="h-24 w-24 rounded-full object-cover">
                </div>

                <div class="text-sm font-medium text-gray-500">NIK</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->nik ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Nama</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->name ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Username</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->username ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Email</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->email ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">No. HP / Telepon</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->phone_number ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Role</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->roles->first()->name ?? 'N/A' }}</div>

                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($admin->status == 1)
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak
                            Aktif</span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Alamat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $admin->address ?? '-' }}</div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.manajemen.admin.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.manajemen.admin.edit', $admin) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
