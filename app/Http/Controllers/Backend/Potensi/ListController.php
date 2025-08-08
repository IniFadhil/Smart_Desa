<?php

namespace App\Http\Controllers\Backend\Potensi;

use App\Http\Controllers\Controller;
use App\Models\PotensiList;
use App\Models\PotensiKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ListController extends Controller
{
    public function index()
    {
        $potensis = PotensiList::with('kategori')->latest()->get();
        return view('backend.potensi.list.list', compact('potensis'));
    }

    public function create()
    {
        $kategoris = PotensiKategori::where('status', 'show')->get();
        return view('backend.potensi.list.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:ds_potensi_kategori,id',
            'name' => 'required|string|max:255|unique:ds_potensi_list,name',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/potensi'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->name);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        PotensiList::create($validated);
        return redirect()->route('backend.potensi.list.index')->with('success', 'Potensi berhasil ditambahkan.');
    }

    public function show(PotensiList $list)
    {
        return view('backend.potensi.list.detail', ['potensi' => $list]);
    }

    public function edit(PotensiList $list)
    {
        $kategoris = PotensiKategori::where('status', 'show')->get();
        return view('backend.potensi.list.edit', ['potensi' => $list, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, PotensiList $list)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:ds_potensi_kategori,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_potensi_list')->ignore($list->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            if ($list->img && File::exists(public_path('backend/images/potensi/' . $list->img))) {
                File::delete(public_path('backend/images/potensi/' . $list->img));
            }
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/potensi'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $list->update($validated);
        return redirect()->route('backend.potensi.list.index')->with('success', 'Potensi berhasil diperbarui.');
    }

    public function destroy(PotensiList $list)
    {
        if ($list->img && File::exists(public_path('backend/images/potensi/' . $list->img))) {
            File::delete(public_path('backend/images/potensi/' . $list->img));
        }
        $list->delete();
        return redirect()->route('backend.potensi.list.index')->with('success', 'Potensi berhasil dihapus.');
    }

    public function toggleStatus(PotensiList $list)
    {
        $list->status = ($list->status == 'show') ? 'hide' : 'show';
        $list->save();
        return back()->with('success', 'Status berhasil diubah.');
    }
}