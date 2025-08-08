<?php

namespace App\Http\Controllers\Backend\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('backend.manajemen.user.list', compact('users'));
    }

    public function create()
    {
        return view('backend.manajemen.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tgl_lahir' => 'required|date',
            'gender' => 'required|string',
            'no_telpon' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        User::create($request->all());

        return redirect()->route('backend.manajemen.user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return view('backend.manajemen.user.detail', compact('user'));
    }

    public function edit(User $user)
    {
        return view('backend.manajemen.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nik' => ['required', 'string', 'max:16', Rule::unique('users')->ignore($user->id)],
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'tgl_lahir' => 'required|date',
            'gender' => 'required|string',
            'no_telpon' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $user->update($request->all());

        return redirect()->route('backend.manajemen.user.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('backend.manajemen.user.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
