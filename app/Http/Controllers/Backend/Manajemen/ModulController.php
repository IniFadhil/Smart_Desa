<?php

namespace App\Http\Controllers\Backend\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule; // Tambahkan ini di bagian atas

class ModulController extends Controller
{
    /**
     * Menampilkan daftar semua modul.
     */
    public function index()
    {
        try {
            $data['modul'] = Modul::latest()->get();
            return view('backend.manajemen.modul.list', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk membuat modul baru.
     */
    public function create()
    {
        return view('backend.manajemen.modul.create');
    }

    /**
     * Menyimpan modul baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ds_modules,name',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        try {
            Modul::create($validated);
            return redirect()->route('backend.manajemen.modul.index')->with('success', 'Modul berhasil ditambahkan.');
        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail satu modul.
     * Menggunakan Route Model Binding, Laravel otomatis mencari Modul berdasarkan $id.
     */
    public function show(Modul $modul)
    {
        return view('backend.manajemen.modul.detail', compact('modul'));
    }

    /**
     * Menampilkan form untuk mengedit modul.
     */
    public function edit(Modul $modul)
    {
        return view('backend.manajemen.modul.edit', compact('modul'));
    }

    /**
     * Memperbarui data modul di database.
     */
    public function update(Request $request, Modul $modul)
    {
        $validated = $request->validate([
            // Menggunakan Rule class untuk validasi unique yang lebih aman dan bersih
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_modules')->ignore($modul->id)],
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        try {
            $modul->update($validated);
            return redirect()->route('backend.manajemen.modul.index')->with('success', 'Modul berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data modul dari database.
     */
    public function destroy(Modul $modul)
    {
        try {
            $modul->delete();
            return redirect()->route('backend.manajemen.modul.index')->with('success', 'Modul berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Mengubah status aktif/nonaktif sebuah modul.
     */
    public function toggleStatus(Modul $modul)
    {
        try {
            // Logika untuk membalik status: jika 1 jadi 0, jika 0 jadi 1
            $modul->status = !$modul->status;
            $modul->save();

            return back()->with('success', 'Status modul berhasil diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
