<?php

namespace App\Http\Controllers\Backend\BUMDES;

use App\Http\Controllers\Controller;
use App\Models\BumdesProduk;
use App\Models\BumdesProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = BumdesProduk::with('bumdes')->latest()->get();
        return view('backend.bumdes.produk.list', compact('produks'));
    }

    public function create()
    {
        $bumdes = BumdesProfil::where('status', 'show')->get();
        return view('backend.bumdes.produk.create', compact('bumdes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bumdes_id' => 'required|exists:ds_bumdes_profil,id',
            'name' => 'required|string|max:255|unique:ds_bumdes_produk,name',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/bumdes/produk'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->name);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        BumdesProduk::create($validated);
        return redirect()->route('backend.bumdes.produk.index')->with('success', 'Produk BUMDES berhasil ditambahkan.');
    }

    public function show(BumdesProduk $produk)
    {
        return view('backend.bumdes.produk.detail', compact('produk'));
    }

    public function edit(BumdesProduk $produk)
    {
        $bumdes = BumdesProfil::where('status', 'show')->get();
        return view('backend.bumdes.produk.edit', compact('produk', 'bumdes'));
    }

    public function update(Request $request, BumdesProduk $produk)
    {
        $validated = $request->validate([
            'bumdes_id' => 'required|exists:ds_bumdes_profil,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_bumdes_produk')->ignore($produk->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            if ($produk->img && File::exists(public_path('backend/images/bumdes/produk/' . $produk->img))) {
                File::delete(public_path('backend/images/bumdes/produk/' . $produk->img));
            }
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/bumdes/produk'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $produk->update($validated);
        return redirect()->route('backend.bumdes.produk.index')->with('success', 'Produk BUMDES berhasil diperbarui.');
    }

    public function destroy(BumdesProduk $produk)
    {
        if ($produk->img && File::exists(public_path('backend/images/bumdes/produk/' . $produk->img))) {
            File::delete(public_path('backend/images/bumdes/produk/' . $produk->img));
        }
        $produk->delete();
        return redirect()->route('backend.bumdes.produk.index')->with('success', 'Produk BUMDES berhasil dihapus.');
    }

    public function toggleStatus(BumdesProduk $produk)
    {
        $produk->status = ($produk->status == 'show') ? 'hide' : 'show';
        $produk->save();
        return back()->with('success', 'Status berhasil diubah.');
    }
}