<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    {{-- Sebaiknya gunakan layout utama (x-app-layout) jika ada --}}
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
            margin: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #333;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .card h3 {
            margin: 0;
            color: #555;
            font-size: 1rem;
        }

        .card .count {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-top: 0.5rem;
        }

        .table-container {
            background: white;
            margin-top: 2.5rem;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .table-container h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Dashboard</h1>
        <span>Selamat datang, {{ Auth::guard('admin')->user()->name }}</span>
    </div>

    {{-- Data Summary (Grafis) --}}
    <div class="summary-cards">
        <div class="card">
            <h3>Total Admin Aktif</h3>
            <p class="count">{{ $admin ?? 0 }}</p>
        </div>
        <div class="card">
            <h3>Pengguna Terverifikasi</h3>
            <p class="count">{{ $userVerified ?? 0 }}</p>
        </div>
        <div class="card">
            <h3>Pengguna Belum Verifikasi</h3>
            <p class="count">{{ $userUnverified ?? 0 }}</p>
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

    {{-- Tabel Pengajuan Surat Terbaru --}}
    <div class="table-container">
        <h2>10 Pengajuan Surat Terbaru (Status: Diajukan)</h2>
        <table>
            <thead>
                <tr>
                    <th>Jenis Surat</th>
                    <th>Nama Pemohon</th>
                    <th>Tanggal Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latest_surat as $surat)
                    <tr>
                        {{-- Menampilkan nama surat berdasarkan class model --}}
                        <td>{{ class_basename($surat) }}</td>
                        {{-- Asumsi ada relasi 'user' di setiap model surat --}}
                        <td>{{ $surat->user->name ?? 'Data Pengguna Tidak Ditemukan' }}</td>
                        <td>{{ $surat->created_at->format('d F Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Tidak ada data pengajuan surat baru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
