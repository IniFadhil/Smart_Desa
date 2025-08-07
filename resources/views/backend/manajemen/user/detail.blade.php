<x-backend.layouts.app>
    <x-slot:title>
        Detail Pengguna
    </x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Pengguna</h2>
            <a href="{{ route('backend.manajemen.user.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr;
                Kembali ke Daftar</a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-4">
                <div class="text-sm font-medium text-gray-500">NIK</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->nik ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Nama</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->name ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Email</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->email ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Tanggal Lahir</div>
                <div class="text-sm text-gray-900 col-span-3">
                    {{ $user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('d F Y') : '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Jenis Kelamin</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->gender ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">No. Telepon</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->no_telpon ?? '-' }}</div>

                <div class="text-sm font-medium text-gray-500">Status Verifikasi</div>
                <div class="text-sm text-gray-900 col-span-3">
                    @if ($user->email_verified_at)
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Terverifikasi</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum
                            Verifikasi</span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Alamat</div>
                <div class="text-sm text-gray-900 col-span-3">{{ $user->address ?? '-' }}</div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('backend.manajemen.user.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Kembali</a>
            <a href="{{ route('backend.manajemen.user.edit', $user) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Edit</a>
        </div>
    </div>
</x-backend.layouts.app>
