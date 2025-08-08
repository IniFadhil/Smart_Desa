<x-backend.layouts.app>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    {{-- 1. Data Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Admin Aktif</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $admin ?? 0 }}</p>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pengguna Terverifikasi</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $userVerified ?? 0 }}</p>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pengguna Belum Verifikasi</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $userUnverified ?? 0 }}</p>
        </div>
    </div>

    {{-- 2. Tabel Pengajuan Surat Terbaru --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">10 Pengajuan Surat Terbaru </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Surat</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Pemohon</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($latest_surat as $surat)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ class_basename($surat) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $surat->user->name ?? 'Data Pengguna Tidak Ditemukan' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $surat->created_at->format('d F Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Tidak ada data pengajuan surat baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-backend.layouts.app>
