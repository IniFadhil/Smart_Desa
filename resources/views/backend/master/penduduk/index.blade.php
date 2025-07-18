<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Data Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Data Penduduk</h1>
            <a href="#" class="btn btn-primary">Tambah Penduduk Baru</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penduduks as $index => $penduduk)
                    <tr>
                        <td>{{ $penduduks->firstItem() + $index }}</td>
                        <td>{{ $penduduk->nik }}</td>
                        <td>{{ $penduduk->nama_lengkap }}</td>
                        <td>{{ $penduduk->alamat_sekarang }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $penduduks->links() }}
        </div>
    </div>
</body>

</html>
