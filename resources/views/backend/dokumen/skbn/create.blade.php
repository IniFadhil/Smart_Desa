@extends('backend.layouts.app')

@section('title') Surat Keterangan Beda Nama @endsection

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

    $('.dok_1').change(function () {
        var id = $(this).val();
        $('.value_dok_1').val(id);
    })

    $('.dok_2').change(function () {
        var id = $(this).val();
        $('.value_dok_2').val(id);
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
        <h1>Surat Keterangan Beda Nama</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skbn')}}"> Surat Keterangan Beda Nama</a></div>
            <div class="breadcrumb-item active">Tambah</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Pengajuan Surat Keterangan Beda Nama</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="">
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
                                <label for="" class="col-sm-3 col-form-label">Jenis Dokumen 1</label>
                                <div class="col-sm-9">
                                    <select class="dok_1 form-control select2 {{($errors->has('jenis_dok[0]'))?'is-invalid':''}}"
                                        name="jenis_dok[]">
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        <option value="ktp" {{ ( old('jenis_dok[0]') == 'ktp') ? 'selected' : '' }}>KTP
                                        </option>
                                        <option value="kk" {{ ( old('jenis_dok[0]') == 'kk') ? 'selected' : '' }}>
                                            Kartu Keluarga
                                        </option>
                                        <option value="akta nikah" {{ ( old('jenis_dok[0]') == 'akta nikah') ? 'selected' : '' }}>Akta Nikah
                                        </option>
                                        <option value="sim" {{ ( old('jenis_dok[0]') == 'sim') ? 'selected' : '' }}>SIM
                                        </option>
                                        <option value="ijazah" {{ ( old('jenis_dok[0]') == 'ijazah') ? 'selected' : '' }}>
                                            Ijazah
                                        </option>
                                    </select>
                                    @if($errors->has('jenis_dok[0]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jenis_dok[0]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Dokumen 1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nomor_dok[0]'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Dokumen 1 Anda" name="nomor_dok[0]" value="{{old('nomor_dok[0]')}}">
                                    @if($errors->has('nomor_dok[0]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nomor_dok[0]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Dokumen 1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_dok[0]'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Dokumen 1 Anda" name="nama_dok[0]" value="{{old('nama_dok[0]')}}">
                                    @if($errors->has('nama_dok[0]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_dok[0]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Dokumen 2</label>
                                <div class="col-sm-9">
                                    <select class="dok_2 form-control select2 {{($errors->has('jenis_dok[1]'))?'is-invalid':''}}"
                                        name="jenis_dok[]">
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        <option value="ktp" {{ ( old('jenis_dok[1]') == 'ktp') ? 'selected' : '' }}>KTP
                                        </option>
                                        <option value="kk" {{ ( old('jenis_dok[1]') == 'kk') ? 'selected' : '' }}>
                                            Kartu Keluarga
                                        </option>
                                        <option value="akta nikah" {{ ( old('jenis_dok[1]') == 'akta nikah') ? 'selected' : '' }}>Akta Nikah
                                        </option>
                                        <option value="sim" {{ ( old('jenis_dok[1]') == 'sim') ? 'selected' : '' }}>SIM
                                        </option>
                                        <option value="ijazah" {{ ( old('jenis_dok[1]') == 'ijazah') ? 'selected' : '' }}>
                                            Ijazah
                                        </option>
                                    </select>
                                    @if($errors->has('jenis_dok[1]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jenis_dok[1]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Dokumen 1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nomor_dok[1]'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Dokumen 2 Anda" name="nomor_dok[1]" value="{{old('nomor_dok[1]')}}">
                                    @if($errors->has('nomor_dok[1]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nomor_dok[1]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Dokumen 1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_dok[1]'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Dokumen 2 Anda" name="nama_dok[1]" value="{{old('nama_dok[1]')}}">
                                    @if($errors->has('nama_dok[1]'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_dok[1]')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Dokumen Yang Benar</label>
                                <div class="col-sm-9">
                                    <input type="radio" class="value_dok_1 {{($errors->has('data_dok_benar'))?'is-invalid':''}}" name="data_dok_benar" value=""> Dokumen 1 <br>    
                                    <input type="radio" class="value_dok_2 {{($errors->has('data_dok_benar'))?'is-invalid':''}}" name="data_dok_benar" value=""> Dokumen 2
                                    @if($errors->has('data_dok_benar'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('data_dok_benar')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                                <div class="col-sm-9">
                                    <img src="{{asset('backend/images/default.jpg')}}" id="preview-rtrw" alt=""
                                        width="200px">
                                    <input type="file" class="form-control {{($errors->has('rtrw'))?'is-invalid':''}}" id="rtrw" name="rtrw" value="{{old('rtrw')}}"
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
                                <a href="{{route('backend.dokumen.skbn')}}" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary">Buat</button>
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
    window.location.href = "{{route('backend.dokumen.skbn')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
