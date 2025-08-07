<?php

namespace App\Http\Controllers\Backend\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('backend.manajemen.menu.list', compact('menus'));
    }

    public function create()
    {
        return view('backend.manajemen.menu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:255|unique:ds_menus,id',
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        Menu::create($validated);
        return redirect()->route('backend.manajemen.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function show(Menu $menu)
    {
        return view('backend.manajemen.menu.detail', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('backend.manajemen.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $menu->update($validated);
        return redirect()->route('backend.manajemen.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('backend.manajemen.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function toggleStatus(Menu $menu)
    {
        $menu->status = !$menu->status;
        $menu->save();
        return back()->with('success', 'Status menu berhasil diubah.');
    }
}