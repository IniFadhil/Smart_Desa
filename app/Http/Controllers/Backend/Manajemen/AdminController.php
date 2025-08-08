<?php

namespace App\Http\Controllers\Backend\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua admin kecuali yang sedang login
        $admins = Admin::where('id', '!=', auth()->guard('admin')->id())
            ->with('roles')
            ->latest()
            ->get();
        return view('backend.manajemen.admin.list', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.manajemen.admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:ds_admins,nik',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:ds_admins,username',
            'email' => 'required|string|email|max:255|unique:ds_admins,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:ds_roles,id',
            'status' => 'required|boolean',
        ]);

        $validated['password'] = Hash::make($request->password);

        // Anda perlu menambahkan logika untuk menangani upload gambar di sini jika diperlukan

        $admin = Admin::create($validated);
        $admin->roles()->sync($request->role);

        return redirect()->route('backend.manajemen.admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show(Admin $admin)
    {
        return view('backend.manajemen.admin.detail', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('backend.manajemen.admin.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:16', Rule::unique('ds_admins')->ignore($admin->id)],
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('ds_admins')->ignore($admin->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('ds_admins')->ignore($admin->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:ds_roles,id',
            'status' => 'required|boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);
        $admin->roles()->sync($request->role);

        return redirect()->route('backend.manajemen.admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function toggleStatus(Admin $admin)
    {
        try {
            $admin->status = $admin->status === '1' ? '0' : '1';
            $admin->save();
            return back()->with('success', 'Status admin berhasil diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
