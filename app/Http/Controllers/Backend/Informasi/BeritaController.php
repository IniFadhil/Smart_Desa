<?php

namespace App\Http\Controllers\Backend\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Tambahkan ini
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('backend.informasi.berita.list', compact('beritas'));
    }

    public function create()
    {
        return view('backend.informasi.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:ds_berita,title',
            'short_content' => 'required|string|max:191',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        // --- AWAL LOGIKA UPLOAD GAMBAR ---
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->title) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/informasi/berita'), $fileName);
            $validated['img'] = $fileName;
        }
        // --- AKHIR LOGIKA UPLOAD GAMBAR --

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->title);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        Berita::create($validated);
        return redirect()->route('backend.informasi.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        return view('backend.informasi.berita.detail', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('backend.informasi.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('ds_berita')->ignore($berita->id)],
            'short_content' => 'required|string|max:191',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        // --- AWAL LOGIKA UPDATE GAMBAR ---
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($berita->img && File::exists(public_path('backend/images/informasi/berita/' . $berita->img))) {
                File::delete(public_path('backend/images/informasi/berita/' . $berita->img));
            }

            $file = $request->file('img');
            $fileName = Str::slug($request->title) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/informasi/berita'), $fileName);
            $validated['img'] = $fileName;
        }
        // --- AKHIR LOGIKA UPDATE GAMBAR ---

        $validated['slug'] = Str::slug($request->title);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $berita->update($validated);
        return redirect()->route('backend.informasi.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        // --- AWAL LOGIKA HAPUS GAMBAR ---
        if ($berita->img && File::exists(public_path('backend/images/informasi/berita/' . $berita->img))) {
            File::delete(public_path('backend/images/informasi/berita/' . $berita->img));
        }
        // --- AKHIR LOGIKA HAPUS GAMBAR ---

        $berita->delete();
        return redirect()->route('backend.informasi.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleStatus(Berita $berita)
    {
        $berita->status = ($berita->status == 'show') ? 'hide' : 'show';
        $berita->save();
        return back()->with('success', 'Status berita berhasil diubah.');
    }
}