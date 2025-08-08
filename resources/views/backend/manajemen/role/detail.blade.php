<x-backend.layouts.app>
    <x-slot:title>
        Detail Role
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Role: {{ $role->name }}</h2>
            <a href="{{ route('backend.manajemen.role.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr;
                Kembali ke Daftar</a>
        </div>

        {{-- BODY --}}
        <div class="p-6">
            {{-- INFORMASI DASAR --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-y-2">
                    <div class="text-sm font-medium text-gray-500">Nama Role</div>
                    <div class="text-sm text-gray-900 col-span-3">{{ $role->name ?? '-' }}</div>

                    <div class="text-sm font-medium text-gray-500">Deskripsi</div>
                    <div class="text-sm text-gray-900 col-span-3">{{ $role->description ?? '-' }}</div>
                </div>
            </div>

            {{-- TABEL HAK AKSES --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Hak Akses (Permissions)</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Modul</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Menu</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Create
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Read</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Update
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $groupedPermissions = $role->permissions->groupBy('modul.name');
                            @endphp

                            @forelse($groupedPermissions as $modulName => $permissions)
                                @foreach ($permissions as $permission)
                                    <tr>
                                        @if ($loop->first)
                                            <td
                                                class="px-4 py-2 align-top row-span-{{ count($permissions) }} font-medium text-gray-900">
                                                {{ $modulName }}</td>
                                        @endif
                                        <td class="px-4 py-2">{{ $permission->menu->name ?? 'N/A' }}</td>

                                        {{-- Looping untuk C, R, U, D --}}
                                        @foreach (['c', 'r', 'u', 'd'] as $action)
                                            <td class="px-4 py-2 text-center">
                                                @if ($permission->$action == 1)
                                                    <span
                                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-800">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-100 text-red-800">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Role ini tidak memiliki hak akses.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- FOOTER TOMBOL AKSI --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.manajemen.role.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.manajemen.role.edit', $role) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit Hak Akses</a>
        </div>
    </div>
</x-backend.layouts.app>
