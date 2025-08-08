<?php

namespace App\Http\Controllers\Backend\BUMDES;

use App\Http\Controllers\Controller;
use App\Models\BumdesProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index()
    {
        $profils = BumdesProfil::latest()->get();
        return view('backend.bumdes.profil.list', compact('profils'));
    }

    public function create()
    {
        return view('backend.bumdes.profil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ds_bumdes_profil,name',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/bumdes/profil'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->name);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        BumdesProfil::create($validated);
        return redirect()->route('backend.bumdes.profil.index')->with('success', 'Profil BUMDES berhasil ditambahkan.');
    }

    public function show(BumdesProfil $profil)
    {
        return view('backend.bumdes.profil.detail', compact('profil'));
    }

    public function edit(BumdesProfil $profil)
    {
        return view('backend.bumdes.profil.edit', compact('profil'));
    }

    public function update(Request $request, BumdesProfil $profil)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_bumdes_profil')->ignore($profil->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            if ($profil->img && File::exists(public_path('backend/images/bumdes/profil/' . $profil->img))) {
                File::delete(public_path('backend/images/bumdes/profil/' . $profil->img));
            }
            $file = $request->file('img');
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/bumdes/profil'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $profil->update($validated);
        return redirect()->route('backend.bumdes.profil.index')->with('success', 'Profil BUMDES berhasil diperbarui.');
    }

    public function destroy(BumdesProfil $profil)
    {
        if ($profil->img && File::exists(public_path('backend/images/bumdes/profil/' . $profil->img))) {
            File::delete(public_path('backend/images/bumdes/profil/' . $profil->img));
        }
        $profil->delete();
        return redirect()->route('backend.bumdes.profil.index')->with('success', 'Profil BUMDES berhasil dihapus.');
    }

    public function toggleStatus(BumdesProfil $profil)
    {
        $profil->status = ($profil->status == 'show') ? 'hide' : 'show';
        $profil->save();
        return back()->with('success', 'Status berhasil diubah.');
    }
}