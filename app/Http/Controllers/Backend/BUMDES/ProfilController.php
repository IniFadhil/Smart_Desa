<?php

namespace App\Http\Controllers\Backend\BUMDES;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BumdesProfil;
use Str;
use Auth;
use Session;

class ProfilController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:profil');
    }

    public function index()
    {
        try {
            $data['profil'] = BumdesProfil::where('desa_id', Session::get('desa_id'))->get();
            return view('backend.bumdes.profil.list', $data);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function create()
    {
        try {
            return view('backend.bumdes.profil.create');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function createProccess(Request $request)
    {
        try {
            $this->validasiForm($request);
            $data = $this->bindData($request);
            $data['id'] = $this->generateAutoNumber('ds_bumdes_profil');
            $data['created_by'] = Auth::user()->name;
            $data['desa_id'] = empty(Auth::user()->desa_id) ? Session::get('desa_id') : Auth::user()->desa_id;

            $profil = BumdesProfil::create($data);
            toastr()->success('Data Berhasil Ditambahkan', 'Sukses');
            return redirect()->route('backend.bumdes.profil');
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function edit($id)
    {
        try {
            $id = $this->decodeHash($id);
            $data['profil'] = BumdesProfil::find($id);
            return view('backend.bumdes.profil.edit', $data);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function editProccess(Request $request, $id)
    {
        try {
            $id = $this->decodeHash($id);
            $request['id'] = $id;
            $this->validasiForm($request);
            $data = $this->bindData($request);
            $data['updated_by'] = Auth::user()->name;
            $profil = BumdesProfil::find($id);
            $profil->update($data);
            toastr()->success('Data Berhasil Diubah', 'Sukses');
            return redirect()->route('backend.bumdes.profil.detail', ['id' => $profil->encodeHash($profil->id)]);
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function detail($id)
    {
        try {
            $id = $this->decodeHash($id);
            $data['profil'] = BumdesProfil::find($id);
            return view('backend.bumdes.profil.detail', $data);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function active(Request $request)
    {
        try {
            $id = $this->decodeHash($request->id);
            $profil = BumdesProfil::find($id);
            $profil->update(['status' => 'show']);
            toastr()->success('Data Berhasil diaktifkan', 'Sukses');
            return redirect()->route('backend.bumdes.profil');
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    public function inactive(Request $request)
    {
        try {
            $id = $this->decodeHash($request->id);
            $profil = BumdesProfil::find($id);
            $profil->update(['status' => 'hide']);
            toastr()->success('Data Berhasil dinonaktifkan', 'Sukses');
            return redirect()->route('backend.bumdes.profil');
        } catch (\QueryBuilder $e) {
            toastr()->error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {
        if (!empty($request->id)) {
            $profil = BumdesProfil::find($request->id);
            if ($profil->noImg()) {
                $rules = ['img' => 'mimes:png,jpg,jpeg|max:2048'];
            }
        }

        $rules = [
            'name' => 'required|max:191|unique:ds_bumdes_profil,name,' . $request->id,
            'short_description' => 'required|max:150',
            'description' => 'required',
            'img' => 'mimes:png,jpeg,jpg',
            'status' => 'required',
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'mimes' => 'Format :attribute tidak sesuai',
            'max' => ':attribute maksimal :max karakter/kb',
            'unique' => ':attribute sudah digunakan'
        ];

        $label = [
            'name' => 'Nama BUMDES',
            'short_description' => 'Deskripsi Singkat',
            'description' => 'Deskripsi',
            'img' => 'Foto',
            'status' => 'Status',
        ];

        $this->validate($request, $rules, $messages, $label);
    }

    public function bindData($request)
    {
        if (!empty($request->id)) {
            $profil = BumdesProfil::find($request->id);
        }

        if ($request->file('img')) {
            if (!empty($request->id)) {
                $profil = BumdesProfil::find($request->id);
                if (\File::exists('backend/images/bumdes/profil/' . $profil->img)) {
                    \File::delete('backend/images/bumdes/profil/' . $profil->img);
                }
            }
            $image = $request->file('img');
            $destinationPath = public_path('backend/images/bumdes/profil');
            $namaImg = strtolower(str_replace(' ', '_', $request->name)) . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $namaImg);
        } else {
            if ($request->id) {
                $namaImg = $profil->img;
            } else {
                $namaImg = null;
            }
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'img' => $namaImg,
        ];

        return $data;
    }
}
