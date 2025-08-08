<?php

namespace App\Http\Controllers\Backend\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Pastikan ini ada
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('backend.informasi.pengumuman.list', compact('pengumumans'));
    }

    public function create()
    {
        return view('backend.informasi.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:ds_pengumuman,title',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // max 5MB
            'status' => 'required|in:show,hide',
        ]);

        // --- AWAL LOGIKA UPLOAD ---
        if ($request->hasFile('img')) {
            $imageFile = $request->file('img');
            $imageName = Str::slug($request->title) . '_img_' . time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('backend/images/informasi/pengumuman'), $imageName);
            $validated['img'] = $imageName;
        }

        if ($request->hasFile('file')) {
            $docFile = $request->file('file');
            $docName = Str::slug($request->title) . '_file_' . time() . '.' . $docFile->getClientOriginalExtension();
            $docFile->move(public_path('backend/files/informasi/pengumuman'), $docName);
            $validated['file'] = $docName;
        }
        // --- AKHIR LOGIKA UPLOAD ---

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->title);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        Pengumuman::create($validated);
        return redirect()->route('backend.informasi.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('backend.informasi.pengumuman.detail', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('backend.informasi.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('ds_pengumuman')->ignore($pengumuman->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'status' => 'required|in:show,hide',
        ]);

        // --- AWAL LOGIKA UPDATE GAMBAR & FILE ---
        if ($request->hasFile('img')) {
            if ($pengumuman->img && File::exists(public_path('backend/images/informasi/pengumuman/' . $pengumuman->img))) {
                File::delete(public_path('backend/images/informasi/pengumuman/' . $pengumuman->img));
            }
            $imageFile = $request->file('img');
            $imageName = Str::slug($request->title) . '_img_' . time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('backend/images/informasi/pengumuman'), $imageName);
            $validated['img'] = $imageName;
        }

        if ($request->hasFile('file')) {
            if ($pengumuman->file && File::exists(public_path('backend/files/informasi/pengumuman/' . $pengumuman->file))) {
                File::delete(public_path('backend/files/informasi/pengumuman/' . $pengumuman->file));
            }
            $docFile = $request->file('file');
            $docName = Str::slug($request->title) . '_file_' . time() . '.' . $docFile->getClientOriginalExtension();
            $docFile->move(public_path('backend/files/informasi/pengumuman'), $docName);
            $validated['file'] = $docName;
        }
        // --- AKHIR LOGIKA UPDATE GAMBAR & FILE ---

        $validated['slug'] = Str::slug($request->title);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $pengumuman->update($validated);
        return redirect()->route('backend.informasi.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // --- AWAL LOGIKA HAPUS FILE ---
        if ($pengumuman->img && File::exists(public_path('backend/images/informasi/pengumuman/' . $pengumuman->img))) {
            File::delete(public_path('backend/images/informasi/pengumuman/' . $pengumuman->img));
        }
        if ($pengumuman->file && File::exists(public_path('backend/files/informasi/pengumuman/' . $pengumuman->file))) {
            File::delete(public_path('backend/files/informasi/pengumuman/' . $pengumuman->file));
        }
        // --- AKHIR LOGIKA HAPUS FILE ---

        $pengumuman->delete();
        return redirect()->route('backend.informasi.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleStatus(Pengumuman $pengumuman)
    {
        $pengumuman->status = ($pengumuman->status == 'show') ? 'hide' : 'show';
        $pengumuman->save();
        return back()->with('success', 'Status pengumuman berhasil diubah.');
    }
}
