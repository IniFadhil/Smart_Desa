<?php

namespace App\Http\Controllers\Backend\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.datamaster.slider.list', compact('sliders'));
    }

    public function create()
    {
        return view('backend.datamaster.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = 'slider_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/slider'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['id'] = now()->format('YmdHis') . mt_rand(100, 999);
        $validated['uploaded_by'] = auth()->guard('admin')->user()->name;
        $validated['desa_id'] = auth()->guard('admin')->user()->desa_id;

        Slider::create($validated);
        return redirect()->route('backend.datamaster.slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function show(Slider $slider)
    {
        return view('backend.datamaster.slider.detail', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('backend.datamaster.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($request->hasFile('img')) {
            if ($slider->img && File::exists(public_path('backend/images/slider/' . $slider->img))) {
                File::delete(public_path('backend/images/slider/' . $slider->img));
            }
            $file = $request->file('img');
            $fileName = 'slider_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/slider'), $fileName);
            $validated['img'] = $fileName;
        }

        $validated['uploaded_by'] = auth()->guard('admin')->user()->name;

        $slider->update($validated);
        return redirect()->route('backend.datamaster.slider.index')->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->img && File::exists(public_path('backend/images/slider/' . $slider->img))) {
            File::delete(public_path('backend/images/slider/' . $slider->img));
        }
        $slider->delete();
        return redirect()->route('backend.datamaster.slider.index')->with('success', 'Slider berhasil dihapus.');
    }

    public function toggleStatus(Slider $slider)
    {
        $slider->status = ($slider->status == 'show') ? 'hide' : 'show';
        $slider->save();
        return back()->with('success', 'Status slider berhasil diubah.');
    }
}