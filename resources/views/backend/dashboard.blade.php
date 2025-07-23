<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Selamat datang, {{ Auth::guard('admin')->user()->name }}
            </span>
        </div>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 1. Data Summary (Grafis) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                {{-- Card Total Admin --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Admin
                        Aktif</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ $admin ?? 0 }}
                    </p>
                </div>
                {{-- Card Pengguna Terverifikasi --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pengguna
                        Terverifikasi</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ $userVerified ?? 0 }}
                    </p>
                </div>
                {{-- Card Pengguna Belum Verifikasi --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pengguna
                        Belum Verifikasi</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ $userUnverified ?? 0 }}
                    </p>
                </div>
            </div>

            @php
                // Menggabungkan semua koleksi surat menjadi satu
                $all_surat = collect([])
                    ->merge($sktm ?? [])
                    ->merge($skbn ?? [])
                    ->merge($skn ?? [])
                    ->merge($skp ?? [])
                    ->merge($sku ?? [])
                    ->merge($skm ?? [])
                    ->merge($skk ?? [])
                    ->merge($sksj ?? [])
                    ->merge($skrt ?? [])
                    ->merge($skaw ?? []);

                // Mengurutkan berdasarkan tanggal terbaru dan mengambil 10 teratas
                $latest_surat = $all_surat->sortByDesc('created_at')->take(10);
            @endphp

            {{-- 2. Tabel Pengajuan Surat Terbaru --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        10 Pengajuan Surat Terbaru (Status: Diajukan)
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jenis Surat</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama Pemohon</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($latest_surat as $surat)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{-- Menampilkan nama surat berdasarkan class model --}}
                                            {{ class_basename($surat) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{-- Asumsi ada relasi 'user' di setiap model surat --}}
                                            {{ $surat->user->name ?? 'Data Pengguna Tidak Ditemukan' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $surat->created_at->format('d F Y H:i') }}
                                        </td>
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

        </div>
    </div>
</x-app-layout>
