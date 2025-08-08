<?php

namespace App\Http\Controllers\Backend\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::latest()->get();
        return view('backend.informasi.agenda.list', compact('agendas'));
    }

    public function create()
    {
        return view('backend.informasi.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:ds_agenda,title',
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'address' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['slug'] = Str::slug($request->title);
        $validated['created_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        // Anda perlu menambahkan logika untuk menangani upload gambar di sini

        Agenda::create($validated);
        return redirect()->route('backend.informasi.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show(Agenda $agenda)
    {
        return view('backend.informasi.agenda.detail', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        return view('backend.informasi.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('ds_agenda')->ignore($agenda->id)],
            'short_description' => 'required|string|max:191',
            'description' => 'required|string',
            'address' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['updated_by'] = auth()->guard('admin')->user()->name;

        $agenda->update($validated);
        return redirect()->route('backend.informasi.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        // Anda perlu menambahkan logika untuk menghapus gambar dari server di sini
        $agenda->delete();
        return redirect()->route('backend.informasi.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function toggleStatus(Agenda $agenda)
    {
        $agenda->status = ($agenda->status == 'show') ? 'hide' : 'show';
        $agenda->save();
        return back()->with('success', 'Status agenda berhasil diubah.');
    }
}
