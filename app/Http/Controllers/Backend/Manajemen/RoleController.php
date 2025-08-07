<?php

namespace App\Http\Controllers\Backend\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Modul;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.manajemen.role.list', compact('roles'));
    }

    public function create()
    {
        // BENARKAN: Hapus orderBy('order') dari sini
        $moduls = Modul::with('menus')->where('status', 1)->get();
        return view('backend.manajemen.role.create', compact('moduls'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ds_roles,name',
            'description' => 'nullable|string',
        ]);
        $validated['id'] = str_replace(' ', '_', strtolower($validated['name']));

        $role = Role::create($validated);
        $this->syncPermissions($request, $role);

        return redirect()->route('backend.manajemen.role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        // BENARKAN: Hapus orderBy('order') dari sini juga
        $moduls = Modul::with('menus')->where('status', 1)->get();
        $rolePermissions = $role->permissions->keyBy('menu_id');

        return view('backend.manajemen.role.edit', compact('role', 'moduls', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('ds_roles')->ignore($role->id)],
            'description' => 'nullable|string',
        ]);

        $role->update($validated);
        $this->syncPermissions($request, $role);

        return redirect()->route('backend.manajemen.role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function show(Role $role)
    {
        // Eager load relasi untuk efisiensi
        $role->load('permissions.menu.modul');
        return view('backend.manajemen.role.detail', compact('role'));
    }

    public function destroy(Role $role)
    {
        Permission::where('role_id', $role->id)->delete();
        $role->delete();
        return redirect()->route('backend.manajemen.role.index')->with('success', 'Role berhasil dihapus.');
    }

    private function syncPermissions(Request $request, Role $role)
    {
        Permission::where('role_id', $role->id)->delete();

        if ($request->has('permissions')) {
            $menus = Menu::whereIn('id', array_keys($request->permissions))->get()->keyBy('id');

            foreach ($request->permissions as $menuId => $actions) {
                if (isset($menus[$menuId])) {
                    Permission::create([
                        'id'       => Str::uuid(),
                        'role_id'  => $role->id,
                        'modul_id' => $menus[$menuId]->modul_id,
                        'menu_id'  => $menuId,
                        'create'   => in_array('c', $actions) ? '1' : '0',
                        'read'     => in_array('r', $actions) ? '1' : '0',
                        'update'   => in_array('u', $actions) ? '1' : '0',
                        'delete'   => in_array('d', $actions) ? '1' : '0',
                    ]);
                }
            }
        }
    }
}
