<?php

namespace App\Http\Controllers\Backend\Potensi;

use App\Http\Controllers\Controller;
use App\Models\PotensiKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = PotensiKategori::latest()->get();
        return view('backend.potensi.kategori.list', compact('kategoris'));
    }

    public function create()
    {
        return view('backend.potensi.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ds_potensi_kategori,name',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'status' => 'required|in:show,hide',
        ]);

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->name);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        PotensiKategori::create($validated);
        return redirect()->route('backend.potensi.kategori.index')->with('success', 'Kategori Potensi berhasil ditambahkan.');
    }

    public function show(PotensiKategori $kategori)
    {
        return view('backend.potensi.kategori.detail', compact('kategori'));
    }

    public function edit(PotensiKategori $kategori)
    {
        return view('backend.potensi.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, PotensiKategori $kategori)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_potensi_kategori')->ignore($kategori->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'status' => 'required|in:show,hide',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $kategori->update($validated);
        return redirect()->route('backend.potensi.kategori.index')->with('success', 'Kategori Potensi berhasil diperbarui.');
    }

    public function destroy(PotensiKategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('backend.potensi.kategori.index')->with('success', 'Kategori Potensi berhasil dihapus.');
    }

    public function toggleStatus(PotensiKategori $kategori)
    {
        $kategori->status = ($kategori->status == 'show') ? 'hide' : 'show';
        $kategori->save();
        return back()->with('success', 'Status berhasil diubah.');
    }
}