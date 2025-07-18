<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\Penduduk; // Pastikan ini ada
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Menampilkan daftar semua penduduk. (Read)
     */
    public function index()
    {
        $dataPenduduk = Penduduk::latest()->paginate(15);
        return view('backend.master.penduduk.index', ['penduduks' => $dataPenduduk]);
    }

    /**
     * Menampilkan form untuk membuat penduduk baru. (Create)
     */
    public function create()
    {
        return view('backend.master.penduduk.create');
    }

    /**
     * Menyimpan data penduduk baru ke database. (Create)
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|string|max:50|unique:ds_penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'no_kk' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|string',
            'alamat_sekarang' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:ds_penduduk,email',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        Penduduk::create($validatedData);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu data penduduk. (Read)
     */
    public function show(Penduduk $penduduk)
    {
        return view('backend.master.penduduk.show', ['penduduk' => $penduduk]);
    }

    /**
     * Menampilkan form untuk mengedit data penduduk. (Update)
     */
    public function edit(Penduduk $penduduk)
    {
        return view('backend.master.penduduk.edit', ['penduduk' => $penduduk]);
    }

    /**
     * Memperbarui data penduduk di database. (Update)
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|string|max:50|unique:ds_penduduk,nik,' . $penduduk->id,
            'nama_lengkap' => 'required|string|max:255',
            'no_kk' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|string',
            'alamat_sekarang' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:ds_penduduk,email,' . $penduduk->id,
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $penduduk->update($validatedData);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    /**
     * Menghapus data penduduk dari database. (Delete)
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }
}
