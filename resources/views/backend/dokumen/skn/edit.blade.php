@extends('backend.layouts.app')

@section('title') Surat Keterangan Nikah @endsection

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
@if(Session::get('permission')->update == 1 && $skn->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Nikah</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skn')}}"> Surat Keterangan Nikah</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Nikah</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Pribadi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$skn->id}}">
                                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat" value="{{old('no_surat',$skn->no_surat)}}">
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
                                        <option value="{{$data->id}}" {{ ( old('user_id',$skn->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
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
                                        placeholder="Masukan Nama Anda" name="nama" value="{{old('nama',$skn->nama)}}" >
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
                                        value="{{old('nik',$skn->nik)}}" >
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
                                        value="{{old('tempat_lahir',$skn->tempat_lahir)}}" >
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
                                        value="{{old('tgl_lahir',$skn->tgl_lahir)}}" >
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
                                    <select name="jk" id="" class="form-control {{($errors->has('tgl_lahir'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{(old('jk',$skn->jk)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk',$skn->jk)=='perempuan')?'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk')}}
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
                                        value="{{old('tempat_lahir',$skn->tempat_lahir)}}" >
                                    @if($errors->has('tempat_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Warga Negara</label>
                                <div class="col-sm-9">
                                    <select name="warga_negara" id="" class="form-control {{($errors->has('tgl_lahir'))?'is-invalid':''}}" >
                                        <option value="">Pilih Warga Negara</option>
                                        <option value="indonesia" {{(old('warga_negara',$skn->warga_negara)=='indonesia')?
                                        'selected':''}}>Indonesia</option>
                                        <option value="wna" {{(old('warga_negara',$skn->warga_negara)=='wna')?'selected':''}}>WNA</option>
                                    </select>
                                    @if($errors->has('warga_negara'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('warga_negara')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status_perkawinan" id="" class="form-control {{($errors->has('status_perkawinan'))?'is-invalid':''}}" >
                                        <option value="">Pilih Status</option>
                                        <option value="lajang" {{(old('status_perkawinan',$skn->status_perkawinan)=='lajang')?
                                        'selected':''}}>Belum Menikah</option>
                                        <option value="menikah" {{(old('status_perkawinan',$skn->status_perkawinan)=='menikah')?'selected':''}}>menikah</option>
                                        <option value="janda" {{(old('status_perkawinan',$skn->status_perkawinan)=='janda')?'selected':''}}>Janda</option>
                                        <option value="duda" {{(old('status_perkawinan',$skn->status_perkawinan)=='duda')?'selected':''}}>Duda</option>
                                    </select>
                                    @if($errors->has('status_perkawinan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('status_perkawinan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <select name="agama" id="" class="form-control {{($errors->has('tgl_lahir'))?'is-invalid':''}}" >
                                        <option value="">Pilih Agama</option>
                                        <option value="islam" {{(old('agama',$skn->agama)=='islam')?
                                        'selected':''}}>Islam</option>
                                        <option value="hindu" {{(old('agama',$skn->agama)=='hindu')?'selected':''}}>Hindu</option>
                                        <option value="budha" {{(old('agama',$skn->agama)=='budha')?'selected':''}}>Budha</option>
                                        <option value="kristen" {{(old('agama',$skn->agama)=='kristen')?'selected':''}}>Kristen</option>
                                        <option value="katolik" {{(old('agama',$skn->agama)=='katolik')?'selected':''}}>Katolik</option>
                                    </select>
                                    @if($errors->has('agama'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('agama')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="" cols="30" rows="10"
                                        class="form-control summernote {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat',$skn->alamat)}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Keperluan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('keperluan'))?'is-invalid':''}}"
                                        placeholder="Masukan Untuk Keperluan" name="keperluan" value="{{old('keperluan',$skn->keperluan)}}" >
                                    @if($errors->has('keperluan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('keperluan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skn->file_sp_rtrw) ? $img . '/dokumen/skn/rtrw/' . $skn->file_sp_rtrw : $img . '/default.jpg') ?>"
                                        id="preview-rtrw" style="width: 200px">
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
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skn->file_ktp) ? $img . '/dokumen/skn/ktp/' . $skn->file_ktp : $img . '/default.jpg') ?>"
                                        id="preview-ktp" style="width: 200px">
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
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skn->file_kk) ? $img . '/dokumen/skn/kk/' . $skn->file_kk : $img . '/default.jpg') ?>"
                                        id="preview-kk" style="width: 200px">
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
                                <label class="col-sm-3 col-form-label">File Akta Cerai</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skn->file_akta_cerai) ? $img . '/dokumen/skn/akta_cerai/' . $skn->file_akta_cerai : $img . '/default.jpg') ?>"
                                        id="preview-akta_cerai" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('akta_cerai'))?'is-invalid':''}}" id="akta_cerai" name="akta_cerai" value="{{old('akta_cerai')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('akta_cerai'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('akta_cerai')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skn')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($skn->no_surat))
                                <button type="submit" class="btn btn-primary">Verifikasi</button>
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
    window.location.href = "{{route('backend.dokumen.skn')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
