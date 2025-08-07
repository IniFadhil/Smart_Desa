@extends('backend.layouts.app')

@section('title') Surat Keterangan Riwayat Tanah @endsection

@section('top-resource')
<link rel="stylesheet" href="{{asset('backend/node_modules/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/node_modules/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/node_modules/selectric/public/selectric.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
<script src="{{asset('backend/editor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('description');

</script>
@endsection

@section('bottom-resource')
<script src="{{asset('backend/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('backend/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}">
</script>
<script src="{{asset('backend/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('backend/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('backend/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('backend/node_modules/selectric/public/jquery.selectric.min.js')}}"></script>
<script src="{{asset('backend/js/page/forms-advanced-forms.js')}}"></script>
<script>
    $('.ubah').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })

    $("button").click(function () {
        $('#verifikasiBtn').html('<button class="btn btn-success btn-progress disabled"></button>')
    });

</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgId = '#preview-' + $(input).attr('id');
                $(imgId).attr('src', e.target.result);
                // $('.uploading1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // CKEDITOR.replace('ckeditor');
    $("form#mainform input[type='file']").change(function () {
        readURL(this);
    });

</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->update == 1 && $skrt->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Riwayat Tanah</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skrt')}}"> Surat Keterangan Riwayat Tanah</a>
            </div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Riwayat Tanah</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Pribadi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$skrt->id}}">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat" value="{{old('no_surat')}}">
                                    @if($errors->has('no_surat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_surat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kirim Ke</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('kasi_id'))?'is-invalid':''}}"
                                        name="kasi_id">
                                        <option value="">-- Pilih Kasi --</option>
                                        @foreach($kasi as $data)
                                        <option value="{{$data->admin_id}}" {{ ( old('kasi_id') == $data->admin_id) ? 'selected' : '' }}>{{$data->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kasi_id'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kasi_id')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Pengaju</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('user_id'))?'is-invalid':''}}"
                                        name="user_id">
                                        <option value="">-- Pilih Nama Pengaju --</option>
                                        @foreach($users as $data)
                                        <option value="{{$data->id}}" {{ ( old('user_id',$skrt->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('user_id'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('user_id')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Pemilik</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_pemilik'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Pemilik" name="nama_pemilik"
                                        value="{{old('nama_pemilik',$skrt->nama_pemilik)}}">
                                    @if($errors->has('nama_pemilik'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_pemilik')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('nik_pemilik'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK pemilik" name="nik_pemilik"
                                        value="{{old('nik_pemilik',$skrt->nik_pemilik)}}">
                                    @if($errors->has('nik_pemilik'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_pemilik')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Sertifikat</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_sertifikat'))?'is-invalid':''}}"
                                        placeholder="Masukan No Sertifikat" name="no_sertifikat"
                                        value="{{old('no_sertifikat',$skrt->no_sertifikat)}}">
                                    @if($errors->has('no_sertifikat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_sertifikat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Riwayat Tanah</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Riwayat 1</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_riwayat1'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Riwayat 1" name="tgl_riwayat1"
                                        value="{{old('tgl_riwayat1',$skrt->tgl_riwayat1)}}">
                                    @if($errors->has('tgl_riwayat1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_riwayat1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Atas Nama 1</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('atas_nama1'))?'is-invalid':''}}"
                                        placeholder="Masukan Atas Nama 1" name="atas_nama1"
                                        value="{{old('atas_nama1',$skrt->atas_nama1)}}">
                                    @if($errors->has('atas_nama1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('atas_nama1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Riwayat 2</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_riwayat2'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Riwayat 2" name="tgl_riwayat2"
                                        value="{{old('tgl_riwayat2',$skrt->tgl_riwayat2)}}">
                                    @if($errors->has('tgl_riwayat2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_riwayat2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Atas Nama 2</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('atas_nama2'))?'is-invalid':''}}"
                                        placeholder="Masukan Atas Nama 2" name="atas_nama2"
                                        value="{{old('atas_nama2',$skrt->atas_nama2)}}">
                                    @if($errors->has('atas_nama2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('atas_nama2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Berdasarkan 2</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 {{($errors->has('berdasarkan2'))?'is-invalid':''}}"
                                        name="berdasarkan2">
                                        <option value="">-- Pilih Berdasarkan --</option>
                                        <option value="jual beli"
                                            {{ ( old('berdasarkan2',$skrt->berdasarkan2) == 'jual beli') ? 'selected' : '' }}>
                                            Jual beli
                                        </option>
                                        <option value="hibah" {{ ( old('berdasarkan2',$skrt->berdasarkan2) == 'hibah') ? 'selected' : '' }}>
                                            Hibah
                                        </option>
                                        <option value="waris" {{ ( old('berdasarkan2',$skrt->berdasarkan2) == 'waris') ? 'selected' : '' }}>
                                            Waris
                                        </option>
                                    </select>
                                    @if($errors->has('berdasarkan2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('berdasarkan2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Riwayat 3</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_riwayat3'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Riwayat 3" name="tgl_riwayat3"
                                        value="{{old('tgl_riwayat3',$skrt->tgl_riwayat3)}}">
                                    @if($errors->has('tgl_riwayat3'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_riwayat3')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Atas Nama 3</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('atas_nama3'))?'is-invalid':''}}"
                                        placeholder="Masukan Atas Nama 3" name="atas_nama3"
                                        value="{{old('atas_nama3',$skrt->atas_nama3)}}">
                                    @if($errors->has('atas_nama3'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('atas_nama3')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Berdasarkan 3</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 {{($errors->has('berdasarkan3'))?'is-invalid':''}}"
                                        name="berdasarkan3">
                                        <option value="">-- Pilih Berdasarkan --</option>
                                        <option value="jual beli"
                                            {{ ( old('berdasarkan3',$skrt->berdasarkan3) == 'jual beli') ? 'selected' : '' }}>
                                            Jual beli
                                        </option>
                                        <option value="hibah" {{ ( old('berdasarkan3',$skrt->berdasarkan3) == 'hibah') ? 'selected' : '' }}>
                                            Hibah
                                        </option>
                                        <option value="waris" {{ ( old('berdasarkan3',$skrt->berdasarkan3) == 'waris') ? 'selected' : '' }}>
                                            Waris
                                        </option>
                                    </select>
                                    @if($errors->has('berdasarkan3'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('berdasarkan3')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Riwayat 4</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_riwayat4'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Riwayat 4" name="tgl_riwayat4"
                                        value="{{old('tgl_riwayat4',$skrt->tgl_riwayat4)}}">
                                    @if($errors->has('tgl_riwayat4'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_riwayat4')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Atas Nama 4</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('atas_nama4'))?'is-invalid':''}}"
                                        placeholder="Masukan Atas Nama 4" name="atas_nama4"
                                        value="{{old('atas_nama4',$skrt->atas_nama4)}}">
                                    @if($errors->has('atas_nama4'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('atas_nama4')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Berdasarkan 4</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 {{($errors->has('berdasarkan4'))?'is-invalid':''}}"
                                        name="berdasarkan4">
                                        <option value="">-- Pilih Berdasarkan --</option>
                                        <option value="jual beli"
                                            {{ ( old('berdasarkan4',$skrt->berdasarkan4) == 'jual beli') ? 'selected' : '' }}>
                                            Jual beli
                                        </option>
                                        <option value="hibah" {{ ( old('berdasarkan4',$skrt->berdasarkan4) == 'hibah') ? 'selected' : '' }}>
                                            Hibah
                                        </option>
                                        <option value="waris" {{ ( old('berdasarkan4',$skrt->berdasarkan4) == 'waris') ? 'selected' : '' }}>
                                            Waris
                                        </option>
                                    </select>
                                    @if($errors->has('berdasarkan4'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('berdasarkan4')}}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <h5>Data Tanah</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor SPPT</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_sppt'))?'is-invalid':''}}"
                                        placeholder="Masukan No SPPT" name="no_sppt" value="{{old('no_sppt',$skrt->no_sppt)}}">
                                    @if($errors->has('no_sppt'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_sppt')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Blok</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('blok'))?'is-invalid':''}}"
                                        placeholder="Masukan Blok" name="blok" value="{{old('blok',$skrt->blok)}}">
                                    @if($errors->has('blok'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('blok')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Persil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('persil'))?'is-invalid':''}}"
                                        placeholder="Masukan persil" name="persil" value="{{old('persil',$skrt->persil)}}">
                                    @if($errors->has('persil'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('persil')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Kihil/Kikitir/Girik</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_kihir'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Kihil/Kikitir/Girik" name="no_kihir"
                                        value="{{old('no_kihir',$skrt->no_kihir)}}">
                                    @if($errors->has('no_kihir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_kihir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Luas (M2)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('luas'))?'is-invalid':''}}"
                                        placeholder="Masukan Luas (m2)" name="luas" value="{{old('luas',$skrt->luas)}}">
                                    @if($errors->has('luas'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('luas')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="" cols="30" rows="10"
                                        class="form-control {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat',$skrt->alamat)}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Batas Tanah</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Sebelah Utara</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('sebelah_utara'))?'is-invalid':''}}"
                                        placeholder="Masukan Sebelah Utara" name="sebelah_utara"
                                        value="{{old('sebelah_utara',$skrt->sebelah_utara)}}">
                                    @if($errors->has('sebelah_utara'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sebelah_utara')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Sebelah Timur</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('sebelah_timur'))?'is-invalid':''}}"
                                        placeholder="Masukan Sebelah Timur" name="sebelah_timur"
                                        value="{{old('sebelah_timur',$skrt->sebelah_timur)}}">
                                    @if($errors->has('sebelah_timur'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sebelah_timur')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Sebelah Selatan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('sebelah_selatan'))?'is-invalid':''}}"
                                        placeholder="Masukan Sebelah selatan" name="sebelah_selatan"
                                        value="{{old('sebelah_selatan',$skrt->sebelah_selatan)}}">
                                    @if($errors->has('sebelah_selatan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sebelah_selatan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Sebelah Barat</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('sebelah_barat'))?'is-invalid':''}}"
                                        placeholder="Masukan Sebelah barat" name="sebelah_barat"
                                        value="{{old('sebelah_barat',$skrt->sebelah_barat)}}">
                                    @if($errors->has('sebelah_barat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sebelah_barat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Saksi 1</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 1" name="nama_saksi1"
                                        value="{{old('nama_saksi1',$skrt->nama_saksi1)}}">
                                    @if($errors->has('nama_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK" name="nik_saksi1" value="{{old('nik_saksi1',$skrt->nik_saksi1)}}">
                                    @if($errors->has('nik_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Saksi 2</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 2" name="nama_saksi2"
                                        value="{{old('nama_saksi2',$skrt->nama_saksi2)}}">
                                    @if($errors->has('nama_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK" name="nik_saksi2" value="{{old('nik_saksi2',$skrt->nik_saksi2)}}">
                                    @if($errors->has('nik_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_sp_rtrw) ? $img . '/dokumen/skrt/rtrw/' . $skrt->file_sp_rtrw : $img . '/default.jpg') ?>"
                                        id="preview-rtrw" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('rtrw'))?'is-invalid':''}}"
                                        id="rtrw" name="rtrw" value="{{old('rtrw')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('rtrw'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('rtrw')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_ktp) ? $img . '/dokumen/skrt/ktp/' . $skrt->file_ktp : $img . '/default.jpg') ?>"
                                        id="preview-ktp" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('ktp'))?'is-invalid':''}}"
                                        id="ktp" name="ktp" value="{{old('ktp')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('ktp'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('ktp')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_kk) ? $img . '/dokumen/skrt/kk/' . $skrt->file_kk : $img . '/default.jpg') ?>"
                                        id="preview-kk" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('kk'))?'is-invalid':''}}"
                                        id="kk" name="kk" value="{{old('kk')}}" accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('kk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kk')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pernyataan</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_surat_pernyataan) ? $img . '/dokumen/skrt/surat_pernyataan/' . $skrt->file_surat_pernyataan : $img . '/default.jpg') ?>"
                                        id="preview-surat_pernyataan" style="width: 200px">
                                    <input type="file"
                                        class="form-control {{($errors->has('surat_pernyataan'))?'is-invalid':''}}"
                                        id="surat_pernyataan" name="surat_pernyataan"
                                        value="{{old('surat_pernyataan')}}" accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('surat_pernyataan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('surat_pernyataan')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Tanah</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_surat_tanah) ? $img . '/dokumen/skrt/surat_tanah/' . $skrt->file_surat_tanah : $img . '/default.jpg') ?>"
                                        id="preview-surat_tanah" style="width: 200px">
                                    <input type="file"
                                        class="form-control {{($errors->has('surat_tanah'))?'is-invalid':''}}"
                                        id="surat_tanah" name="surat_tanah"
                                        value="{{old('surat_tanah')}}" accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('surat_tanah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('surat_tanah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pajak Tanah</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skrt->file_surat_pajak_tanah) ? $img . '/dokumen/skrt/surat_pajak_tanah/' . $skrt->file_surat_pajak_tanah : $img . '/default.jpg') ?>"
                                        id="preview-surat_pajak_tanah" style="width: 200px">
                                    <input type="file"
                                        class="form-control {{($errors->has('surat_pajak_tanah'))?'is-invalid':''}}"
                                        id="surat_pajak_tanah" name="surat_pajak_tanah"
                                        value="{{old('surat_pajak_tanah')}}" accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('surat_pajak_tanah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('surat_pajak_tanah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skrt')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($skrt->no_surat))
                                <button class="btn btn-primary">Verifikasi</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<script>
    window.location.href = "{{route('backend.dokumen.skrt')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
