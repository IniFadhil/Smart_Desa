@extends('backend.layouts.app')

@section('title') SKTM @endsection

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
@if(Session::get('permission')->update == 1 && $sktm->status == 1)
<section class="section">
    <div class="section-header">
        <h1>SKTM</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.sktm')}}"> SKTM</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit SKTM</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Pribadi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$sktm->id}}">
                                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat" value="{{old('no_surat',$sktm->no_surat)}}">
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
                                        <option value="{{$data->admin_id}}" {{ ( old('kasi_id',$sktm->kasi_id) == $data->admin_id) ? 'selected' : '' }}>{{$data->name}}
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
                                        @if($data->unggahDokumen)
                                        <option value="{{$data->id}}" {{ ( old('user_id',$sktm->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
                                        </option>
                                        @endif
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
                                    <input type="text" class="form-control {{($errors->has('nama'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Anda" name="nama" value="{{old('nama',$sktm->nama)}}">
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
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('nik'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Anda" name="nik" value="{{old('nik',$sktm->nik)}}">
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
                                        value="{{old('tempat_lahir',$sktm->tempat_lahir)}}">
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
                                        value="{{old('tgl_lahir',$sktm->tgl_lahir)}}">
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
                                    <select class="form-control select2 {{($errors->has('jk'))?'is-invalid':''}}"
                                        name="jk">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki" {{ ( old('jk',$sktm->jk) == 'laki-laki') ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="perempuan" {{ ( old('jk',$sktm->jk) == 'perempuan') ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    @if($errors->has('jk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Warga Negara</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 {{($errors->has('warga_negara'))?'is-invalid':''}}"
                                        name="warga_negara">
                                        <option value="">-- Pilih Warga Negara --</option>
                                        <option value="indonesia"
                                            {{ ( old('warga_negara',$sktm->warga_negara) == 'indonesia') ? 'selected' : '' }}>Indonesia
                                        </option>
                                        <option value="wna" {{ ( old('warga_negara',$sktm->warga_negara) == 'wna') ? 'selected' : '' }}>WNA
                                        </option>
                                    </select>
                                    @if($errors->has('warga_negara'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('warga_negara')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('agama'))?'is-invalid':''}}"
                                        name="agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="islam" {{ ( old('agama',$sktm->agama) == 'islam') ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="kristen" {{ ( old('agama',$sktm->agama) == 'kristen') ? 'selected' : '' }}>
                                            Kristen
                                        </option>
                                        <option value="hindu" {{ ( old('agama',$sktm->agama) == 'hindu') ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="budha" {{ ( old('agama',$sktm->agama) == 'budha') ? 'selected' : '' }}>Budha
                                        </option>
                                        <option value="katolik" {{ ( old('agama',$sktm->agama) == 'katolik') ? 'selected' : '' }}>
                                            Katolik
                                        </option>
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
                                        class="form-control {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat',$sktm->alamat)}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Orangtua</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ayah Anda" name="nama_ayah" value="{{old('nama_ayah',$sktm->nama_ayah)}}">
                                    @if($errors->has('nama_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ibu Anda" name="nama_ibu" value="{{old('nama_ibu',$sktm->nama_ibu)}}">
                                    @if($errors->has('nama_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_orangtua" id="" rows="3"
                                        class="form-control {{($errors->has('alamat_orangtua'))?'is-invalid':''}}">{{old('alamat_orangtua',$sktm->alamat_orangtua)}}</textarea>
                                    @if($errors->has('alamat_orangtua'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_orangtua')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('storage/backend/images'); ?>
                                    <img src="<?php echo (!empty($sktm->file_sp_rtrw) ? $img . '/dokumen/sktm/rtrw/' . $sktm->file_sp_rtrw : $img . '/default.jpg') ?>"
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
                                <label class="col-sm-3 col-form-label">File Surat Pernyataan</label>
                                <div class="col-sm-9">
                                <?php $img = asset('storage/backend/images'); ?>
                                    <img src="<?php echo (!empty($sktm->file_surat_pernyataan) ? $img . '/dokumen/sktm/surat_pernyataan/' . $sktm->file_surat_pernyataan : $img . '/default.jpg') ?>"
                                        id="preview-surat_pernyataan" style="width: 200px">
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
                                <a href="{{route('backend.dokumen.sktm')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($sktm->no_surat))
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
    window.location.href = "{{route('backend.dokumen.sktm')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
