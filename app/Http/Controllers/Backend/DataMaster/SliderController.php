<?php

namespace App\Http\Controllers\Backend\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Str;
use Auth;
use Session;

class SliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:slider');
    }

    public function index()
    {
        try {
            $data['slider'] = Slider::where('desa_id', Session::get('desa_id'))->get();
            return view('backend.datamaster.slider.list', $data);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
    public function create()
    {
        try {
            return view('backend.datamaster.slider.create');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
    public function createProccess(Request $request)
    {
        try {
            $slider = Slider::where('desa_id', Session::get('desa_id'))->first();

            $rules = [
                'description' => 'required',
                //'img' => 'mimes:jpg,jpeg,png',
            ];

            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'mimes' => 'Format :attribute tidak sesuai',
                'max' => ':attribute maksimal :max kb',
                'unique' => ':attribute sudah digunakan'
            ];

            $label = [
                'description' => 'Deskripsi',
                'img' => 'Gambar Struktur Organisasi',
            ];

            if ($request->file('img')) {
                if (!empty($slider)) {
                    if (\File::exists('backend/images/slider/' . $slider->img)) {
                        \File::delete('backend/images/slider/' . $slider->img);
                    }
                }
                $img = $request->file('img');
                $destinationPath = public_path('backend/images/slider');
                $gambar = 'slider_' . date('YmdHis') . '.' . $img->getClientOriginalExtension();
                $img->move($destinationPath, $gambar);
            } else {
                if (!empty($slider->img)) {
                    $gambar = $slider->img;
                } else {
                    $gambar = null;
                }
            }

            $this->validate($request, $rules, $messages, $label);

            $data = [
                'id' => $this->generateAutoNumber('ds_slider'),
                'desa_id' => Session::get('desa_id'),
                'description' => $request->description,
                'uploaded_by' => Auth::user()->name,
                'img' => $gambar,
            ];

            //insert
            $create = Slider::create($data);
            toastr()->success('Data Berhasil dtambahkan', 'Sukses');
            return redirect()->route('backend.datamaster.slider');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
    public function edit($id)
    {
        try {
            $id = $this->decodeHash($id);
            $data['slider'] = Slider::find($id);
            return view('backend.datamaster.slider.edit', $data);
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
    public function editProccess(Request $request, $id)
    {
        try {
            $id = $this->decodeHash($id);
            $slider = Slider::where('desa_id', Session::get('desa_id'))->where('id', $id)->first();

            $rules = [
                'description' => 'required',
                //   'img' => 'mimes:jpg,jpeg,png',
            ];

            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'mimes' => 'Format :attribute tidak sesuai',
                'max' => ':attribute maksimal :max kb',
                'unique' => ':attribute sudah digunakan'
            ];

            $label = [
                'description' => 'Deskripsi',
                'img' => 'Gambar Struktur Organisasi',
            ];

            if ($request->file('img')) {
                if (!empty($slider)) {
                    if (\File::exists('backend/images/slider/' . $slider->img)) {
                        \File::delete('backend/images/slider/' . $slider->img);
                    }
                }
                $img = $request->file('img');
                $destinationPath = public_path('backend/images/slider');
                $gambar = 'slider_' . date('YmdHis') . '.' . $img->getClientOriginalExtension();
                $img->move($destinationPath, $gambar);
            } else {
                if (!empty($slider->img)) {
                    $gambar = $slider->img;
                } else {
                    $gambar = null;
                }
            }

            $this->validate($request, $rules, $messages, $label);

            $data = [
                'description' => $request->description,
                'uploaded_by' => Auth::user()->name,
                'img' => $gambar,
            ];

            //insert
            $slider->update($data);
            toastr()->success('Data Berhasil Diubah', 'Sukses');
            return redirect()->route('backend.datamaster.slider');
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $this->decodeHash($request->id);
            $gambar = Slider::find($id);
            if (\File::exists('backend/images/slider/' . $gambar->img)) {
                \File::delete('backend/images/slider/' . $gambar->img);
            }
            $gambar->delete();
            toastr()->success('Data Berhasil dihapus', 'Sukses');
            return redirect()->route('backend.datamaster.slider');
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }
}
