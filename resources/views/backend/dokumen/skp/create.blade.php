@extends('backend.layouts.app')

@section('title') Surat Keterangan Penghasilan @endsection

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

    $("button").click(function(){
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
@if(Session::get('permission')->create == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Penghasilan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skn')}}"> Surat Keterangan Penghasilan</a></div>
            <div class="breadcrumb-item active">Tambah</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Pengajuan Surat Keterangan Penghasilan</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Pribadi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
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
                                        <option value="{{$data->id}}" {{ ( old('user_id') == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
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
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Anda" name="nama" value="{{old('nama')}}" >
                                    @if($errors->has('nama'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Anda" name="nik"
                                        value="{{old('nik')}}" >
                                    @if($errors->has('nik'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('tempat_lahir'))?'is-invalid':''}}"
                                        placeholder="Masukan Tempat Lahir Anda" name="tempat_lahir"
                                        value="{{old('tempat_lahir')}}" >
                                    @if($errors->has('tempat_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_lahir'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Lahir Anda" name="tgl_lahir"
                                        value="{{old('tgl_lahir')}}" >
                                    @if($errors->has('tgl_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jk" id="" class="form-control {{($errors->has('jk'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{(old('jk')=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk')=='perempuan')?'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id" id="" class="form-control select2 {{($errors->has('pekerjaan_id'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id')==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jumlah Gaji</label>
                                <div class="col-sm-9">
                                    <input type="number" min='0'
                                        class="form-control {{($errors->has('gaji'))?'is-invalid':''}}"
                                        placeholder="Masukan Jumlah Gaji Anda" name="gaji"
                                        value="{{old('gaji')}}" >
                                    @if($errors->has('gaji'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('gaji')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jumlah Orang yang di Tanggung</label>
                                <div class="col-sm-9">
                                    <input type="number" min='0'
                                        class="form-control {{($errors->has('jumlah_tanggungan'))?'is-invalid':''}}"
                                        placeholder="Masukan Jumlah Tanggungan Anda" name="jumlah_tanggungan"
                                        value="{{old('jumlah_tanggungan')}}" >
                                    @if($errors->has('jumlah_tanggungan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jumlah_tanggungan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat"
                                        class="form-control {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat')}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Slip Gaji</label>
                                <div class="col-sm-9">
                                    <img src="{{asset('backend/images/default.jpg')}}" id="preview-slip_gaji" alt=""
                                        width="200px">
                                    <input type="file" class="form-control {{($errors->has('slip_gaji'))?'is-invalid':''}}" id="slip_gaji" name="slip_gaji" value="{{old('slip_gaji')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('slip_gaji'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('slip_gaji')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP</label>
                                <div class="col-sm-9">
                                    <img src="{{asset('backend/images/default.jpg')}}" id="preview-ktp" alt=""
                                        width="200px">
                                    <input type="file" class="form-control {{($errors->has('ktp'))?'is-invalid':''}}" id="ktp" name="ktp" value="{{old('ktp')}}"
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
                                    <img src="{{asset('backend/images/default.jpg')}}" id="preview-kk" alt=""
                                        width="200px">
                                    <input type="file" class="form-control {{($errors->has('kk'))?'is-invalid':''}}" id="kk" name="kk" value="{{old('kk')}}"
                                        accept="image/jpg,image/jpeg,image/png">
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
                                    <img src="{{asset('backend/images/default.jpg')}}" id="preview-surat_pernyataan" alt=""
                                        width="200px">
                                    <input type="file" class="form-control {{($errors->has('surat_pernyataan'))?'is-invalid':''}}" id="surat_pernyataan" name="surat_pernyataan" value="{{old('surat_pernyataan')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('surat_pernyataan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('surat_pernyataan')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skn')}}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Buat</button>
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
    window.location.href = "{{route('backend.dokumen.skn')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
