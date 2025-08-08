<?php

namespace App\Http\Controllers\Backend\Informasi;

use App\Http\Controllers\Controller;
use App\Models\InfoGrafis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InfoGrafisController extends Controller
{
    public function index()
    {
        $infoGrafis = InfoGrafis::latest()->get();
        return view('backend.informasi.infoGrafis.list', compact('infoGrafis'));
    }

    public function create()
    {
        return view('backend.informasi.infoGrafis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:ds_infografis,title',
            'description' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->title);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        InfoGrafis::create($validated);
        return redirect()->route('backend.informasi.infoGrafis.index')->with('success', 'Info Grafis berhasil ditambahkan.');
    }

    public function show(InfoGrafis $infoGrafis)
    {
        return view('backend.informasi.infoGrafis.detail', compact('infoGrafis'));
    }

    public function edit(InfoGrafis $infoGrafis)
    {
        return view('backend.informasi.infoGrafis.edit', compact('infoGrafis'));
    }

    public function update(Request $request, InfoGrafis $infoGrafis)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('ds_infografis')->ignore($infoGrafis->id)],
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $infoGrafis->update($validated);
        return redirect()->route('backend.informasi.infoGrafis.index')->with('success', 'Info Grafis berhasil diperbarui.');
    }

    public function destroy(InfoGrafis $infoGrafis)
    {
        $infoGrafis->delete();
        return redirect()->route('backend.informasi.infoGrafis.index')->with('success', 'Info Grafis berhasil dihapus.');
    }

    public function toggleStatus(InfoGrafis $infoGrafis)
    {
        $infoGrafis->status = ($infoGrafis->status == 'show') ? 'hide' : 'show';
        $infoGrafis->save();
        return back()->with('success', 'Status Info Grafis berhasil diubah.');
    }
}