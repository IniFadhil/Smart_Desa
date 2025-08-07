@extends('backend.layouts.app')

@section('title') Surat Keterangan Kelahiran @endsection

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
<script>
    $('.provinsi_ibu').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.provinsi')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            console.log(data)
            var kota_ibu = $('#kota_ibu')
            kota_ibu.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_ibu.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_ibu').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kota')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kecamatan_ibu = $('#kecamatan_ibu')
            kecamatan_ibu.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_ibu.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_ibu').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kecamatan')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var desa_ibu = $('#desa_ibu')
            desa_ibu.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_ibu.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.provinsi_ayah').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.provinsi')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kota_ayah = $('#kota_ayah')
            kota_ayah.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_ayah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_ayah').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kota')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kecamatan_ayah = $('#kecamatan_ayah')
            kecamatan_ayah.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_ayah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_ayah').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kecamatan')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var desa_ayah = $('#desa_ayah')
            desa_ayah.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_ayah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.provinsi_pelapor').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.provinsi')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kota_pelapor = $('#kota_pelapor')
            kota_pelapor.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_pelapor.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_pelapor').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kota')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kecamatan_pelapor = $('#kecamatan_pelapor')
            kecamatan_pelapor.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_pelapor.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_pelapor').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kecamatan')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var desa_pelapor = $('#desa_pelapor')
            desa_pelapor.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_pelapor.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.provinsi_saksi1').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.provinsi')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kota_saksi1 = $('#kota_saksi1')
            kota_saksi1.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_saksi1.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_saksi1').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kota')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kecamatan_saksi1 = $('#kecamatan_saksi1')
            kecamatan_saksi1.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_saksi1.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_saksi1').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kecamatan')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var desa_saksi1 = $('#desa_saksi1')
            desa_saksi1.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_saksi1.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.provinsi_saksi2').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.provinsi')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kota_saksi2 = $('#kota_saksi2')
            kota_saksi2.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_saksi2.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_saksi2').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kota')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var kecamatan_saksi2 = $('#kecamatan_saksi2')
            kecamatan_saksi2.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_saksi2.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_saksi2').change(function(){
        var id = $(this).val()
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.kecamatan')}}',
            data: {
                _token : "{{csrf_token()}}",
                id: id
        },
        success: function (data) {
            // the next thing you want to do 
            var desa_saksi2 = $('#desa_saksi2')
            desa_saksi2.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_saksi2.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })
</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->update == 1 && $skk->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Kelahiran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skk')}}"> Surat Keterangan Kelahiran</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Kelahiran</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Bayi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$skk->id}}">
                                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat" value="{{old('no_surat',$skk->no_surat)}}">
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
                                        <option value="{{$data->id}}" {{ ( old('user_id',$skk->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
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
                                <label for="" class="col-sm-3 col-form-label">Nama Kepala Keluarga</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_kepala_keluarga'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Kepala Keluarga Anda" name="nama_kepala_keluarga" value="{{old('nama_kepala_keluarga',$skk->nama_kepala_keluarga)}}" >
                                    @if($errors->has('nama_kepala_keluarga'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_kepala_keluarga')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">No Kartu Keluarga</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_kk'))?'is-invalid':''}}"
                                        placeholder="Masukan No Kartu Keluarga Anda" name="no_kk" value="{{old('no_kk',$skk->no_kk)}}" >
                                    @if($errors->has('no_kk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_kk')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Bayi</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_bayi'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Bayi" name="nama_bayi"
                                        value="{{old('nama_bayi',$skk->nama_bayi)}}" >
                                    @if($errors->has('nama_bayi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_bayi')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin Bayi</label>
                                <div class="col-sm-9">
                                    <select name="jk_bayi" id="" class="form-control {{($errors->has('jk_bayi'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin Bayi</option>
                                        <option value="laki-laki" {{(old('jk_bayi',$skk->jk_bayi)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk_bayi',$skk->jk_bayi)=='perempuan')?'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk_bayi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_bayi')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tempat Dilahirkan</label>
                                <div class="col-sm-9">
                                    <select name="tempat_dilahirkan" id="" class="form-control {{($errors->has('tempat_dilahirkan'))?'is-invalid':''}}" >
                                        <option value="">Pilih Tempat Dilahirkan bayi</option>
                                        <option value="rs/rb" {{(old('tempat_dilahirkan',$skk->tempat_dilahirkan)=='rs/rb')?
                                        'selected':''}}>RS/RB</option>
                                        <option value="puskesmas" {{(old('tempat_dilahirkan',$skk->tempat_dilahirkan)=='puskesmas')?'selected':''}}>Puskesmas</option>
                                        <option value="polindes" {{(old('tempat_dilahirkan',$skk->tempat_dilahirkan)=='polindes')?'selected':''}}>Polindes</option>
                                        <option value="rumah" {{(old('tempat_dilahirkan',$skk->tempat_dilahirkan)=='rumah')?'selected':''}}>Rumah</option>
                                        <option value="lainnya" {{(old('tempat_dilahirkan',$skk->tempat_dilahirkan)=='lainnya')?'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('tempat_dilahirkan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_dilahirkan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('tempat_lahir'))?'is-invalid':''}}"
                                        placeholder="Masukan Tempat Lahir" name="tempat_lahir"
                                        value="{{old('tempat_lahir',$skk->tempat_lahir)}}" >
                                    @if($errors->has('tempat_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select name="hari" id="" class="form-control {{($errors->has('hari'))?'is-invalid':''}}" >
                                        <option value="">Pilih Hari</option>
                                        <option value="senin" {{(old('hari',$skk->hari)=='senin')?
                                        'selected':''}}>Senin</option>
                                        <option value="selasa" {{(old('hari',$skk->hari)=='selasa')?'selected':''}}>Selasa</option>
                                        <option value="rabu" {{(old('hari',$skk->hari)=='rabu')?'selected':''}}>Rabu</option>
                                        <option value="kamis" {{(old('hari',$skk->hari)=='kamis')?'selected':''}}>Kamis</option>
                                        <option value="jumat" {{(old('hari',$skk->hari)=='jumat')?'selected':''}}>Jumat</option>
                                        <option value="sabtu" {{(old('hari',$skk->hari)=='sabtu')?'selected':''}}>Sabtu</option>
                                        <option value="minggu" {{(old('hari',$skk->hari)=='minggu')?'selected':''}}>Minggu</option>
                                    </select>
                                    @if($errors->has('hari'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('hari')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Lahir Bayi</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_lahir_bayi'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Lahir Anda" name="tgl_lahir_bayi"
                                        value="{{old('tgl_lahir_bayi',$skk->tgl_lahir_bayi)}}" >
                                    @if($errors->has('tgl_lahir_bayi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_lahir_bayi')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pukul</label>
                                <div class="col-sm-9">
                                    <input type="time"
                                        class="form-control {{($errors->has('pukul'))?'is-invalid':''}}"
                                        placeholder="Masukan Pukul Lahir" name="pukul"
                                        value="{{old('pukul',$skk->pukul)}}" >
                                    @if($errors->has('pukul'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pukul')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelahiran</label>
                                <div class="col-sm-9">
                                    <select name="jenis_kelahiran" id="" class="form-control {{($errors->has('jenis_kelahiran'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelahiran</option>
                                        <option value="tunggal" {{(old('jenis_kelahiran',$skk->jenis_kelahiran)=='tunggal')?
                                        'selected':''}}>Tunggal</option>
                                        <option value="kembar 2" {{(old('jenis_kelahiran',$skk->jenis_kelahiran)=='kembar 2')?'selected':''}}>Kembar 2</option>
                                        <option value="kembar 3" {{(old('jenis_kelahiran',$skk->jenis_kelahiran)=='kembar 3')?'selected':''}}>Kembar 3</option>
                                        <option value="kembar 4" {{(old('jenis_kelahiran',$skk->jenis_kelahiran)=='kembar 4')?'selected':''}}>Kembar 4</option>
                                        <option value="lainnya" {{(old('jenis_kelahiran',$skk->jenis_kelahiran)=='lainnya')?'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('jenis_kelahiran'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jenis_kelahiran')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kelahiran ke</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('kelahiran_ke'))?'is-invalid':''}}"
                                        placeholder="Masukan Kelahiran ke - " name="kelahiran_ke"
                                        value="{{old('kelahiran_ke',$skk->kelahiran_ke)}}" >
                                    @if($errors->has('kelahiran_ke'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kelahiran_ke')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Penolong Kelahiran</label>
                                <div class="col-sm-9">
                                    <select name="penolong_kelahiran" id="" class="form-control {{($errors->has('penolong_kelahiran'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelahiran</option>
                                        <option value="dokter" {{(old('penolong_kelahiran',$skk->penolong_kelahiran)=='dokter')?
                                        'selected':''}}>Dokter</option>
                                        <option value="bidan/perawat" {{(old('penolong_kelahiran',$skk->penolong_kelahiran)=='bidan/perawat')?'selected':''}}>Bidan/perawat</option>
                                        <option value="dukun" {{(old('penolong_kelahiran',$skk->penolong_kelahiran)=='dukun')?'selected':''}}>Dukun</option>
                                        <option value="lainnya" {{(old('penolong_kelahiran',$skk->penolong_kelahiran)=='lainnya')?'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('penolong_kelahiran'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('penolong_kelahiran')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Berat Bayi</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('berat_bayi'))?'is-invalid':''}}"
                                        placeholder="Masukan Berat Bayi " name="berat_bayi"
                                        value="{{old('berat_bayi',$skk->berat_bayi)}}" >
                                    @if($errors->has('berat_bayi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('berat_bayi')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Panjang Bayi</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('panjang_bayi'))?'is-invalid':''}}"
                                        placeholder="Masukan Berat Bayi " name="panjang_bayi"
                                        value="{{old('panjang_bayi',$skk->panjang_bayi)}}" >
                                    @if($errors->has('panjang_bayi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('panjang_bayi')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Ibu</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Ibu" name="nik_ibu" value="{{old('nik_ibu',$skk->nik_ibu)}}" >
                                    @if($errors->has('nik_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ibu" name="nama_ibu"
                                        value="{{old('nama_ibu',$skk->nama_ibu)}}" >
                                    @if($errors->has('nama_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Lahir Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_lahir_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Lahir Ibu" name="tgl_lahir_ibu"
                                        value="{{old('tgl_lahir_ibu',$skk->tgl_lahir_ibu)}}" >
                                    @if($errors->has('tgl_lahir_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_lahir_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_ibu" id="" class="form-control select2 {{($errors->has('pekerjaan_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan Ibu</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_ibu',$skk->pekerjaan_id_ibu)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Ibu</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_ibu"
                                        class="form-control {{($errors->has('alamat_ibu'))?'is-invalid':''}}">{{old('alamat_ibu',$skk->alamat_ibu)}}</textarea>
                                    @if($errors->has('alamat_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_ibu" id="" class="provinsi_ibu form-control select2 {{($errors->has('provinsi_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_ibu',$skk->provinsi_id_ibu)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_ibu" id="kota_ibu" class="kota_ibu form-control select2 {{($errors->has('kota_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option>  
                                        @foreach($kota->where('provinsi_id',$skk->provinsi_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_ibu',$skk->kota_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kota_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_ibu" id="kecamatan_ibu" class="kecamatan_ibu form-control select2 {{($errors->has('kecamatan_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option>  
                                        @foreach($kecamatan->where('kota_id',$skk->kota_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_ibu',$skk->kecamatan_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kecamatan_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_ibu" id="desa_ibu" class="desa_ibu form-control select2 {{($errors->has('area_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option>  
                                        @foreach($area->where('kecamatan_id',$skk->kecamatan_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_ibu',$skk->area_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('area_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kewarganegaraan Ibu</label>
                                <div class="col-sm-9">
                                    <select name="kewarganegaraan_ibu" id="" class="form-control select2 {{($errors->has('kewarganegaraan_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kewarganegaraan</option>  
                                        <option value="wni" {{(old('kewarganegaraan_ibu',$skk->kewarganegaraan_ibu)=='wni')?
                                        'selected':''}}>WNI</option>
                                        <option value="wna" {{(old('kewarganegaraan_ibu',$skk->kewarganegaraan_ibu)=='wna')?
                                        'selected':''}}>WNA</option>
                                    </select>
                                    @if($errors->has('kewarganegaraan_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kewarganegaraan_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kebangsaan Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('kebangsaan_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Kebangsaan Ibu" name="kebangsaan_ibu" value="{{old('kebangsaan_ibu',$skk->kebangsaan_ibu)}}">
                                    @if($errors->has('kebangsaan_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kebangsaan_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Pencatatan Perkawinan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_pencatatan_perkawinan'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Pencatatan Kawin" name="tgl_pencatatan_perkawinan"
                                        value="{{old('tgl_pencatatan_perkawinan',$skk->tgl_pencatatan_perkawinan)}}" >
                                    @if($errors->has('tgl_pencatatan_perkawinan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_pencatatan_perkawinan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Ayah</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Ayah" name="nik_ayah" value="{{old('nik_ayah',$skk->nik_ayah)}}" >
                                    @if($errors->has('nik_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ayah" name="nama_ayah"
                                        value="{{old('nama_ayah',$skk->nama_ayah)}}" >
                                    @if($errors->has('nama_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Lahir Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_lahir_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Lahir Ayah" name="tgl_lahir_ayah"
                                        value="{{old('tgl_lahir_ayah',$skk->tgl_lahir_ayah)}}" >
                                    @if($errors->has('tgl_lahir_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_lahir_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_ayah" id="" class="form-control select2 {{($errors->has('pekerjaan_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan Ayah</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_ayah',$skk->pekerjaan_id_ayah)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Ayah</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_ayah"
                                        class="form-control {{($errors->has('alamat_ayah'))?'is-invalid':''}}">{{old('alamat_ayah',$skk->alamat_ayah)}}</textarea>
                                    @if($errors->has('alamat_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_ayah" id="" class="provinsi_ayah form-control select2 {{($errors->has('provinsi_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_ayah',$skk->provinsi_id_ayah)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_ayah" id="kota_ayah" class="kota_ayah form-control select2 {{($errors->has('kota_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option>  
                                        @foreach($kota->where('provinsi_id',$skk->provinsi_id_ayah) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_ayah',$skk->kota_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kota_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_ayah" id="kecamatan_ayah" class="kecamatan_ayah form-control select2 {{($errors->has('kecamatan_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option>  
                                        @foreach($kecamatan->where('kota_id',$skk->kota_id_ayah) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_ayah',$skk->kecamatan_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kecamatan_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_ayah" id="desa_ayah" class="desa_ayah form-control select2 {{($errors->has('area_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option>  
                                        @foreach($area->where('kecamatan_id',$skk->kecamatan_id_ayah) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_ayah',$skk->area_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('area_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kewarganegaraan Ayah</label>
                                <div class="col-sm-9">
                                    <select name="kewarganegaraan_ayah" id="" class="form-control select2 {{($errors->has('kewarganegaraan_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kewarganegaraan</option>  
                                        <option value="wni" {{(old('kewarganegaraan_ayah',$skk->kewarganegaraan_ayah)=='wni')?
                                        'selected':''}}>WNI</option>
                                        <option value="wna" {{(old('kewarganegaraan_ayah',$skk->kewarganegaraan_ayah)=='wna')?
                                        'selected':''}}>WNA</option>
                                    </select>
                                    @if($errors->has('kewarganegaraan_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kewarganegaraan_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kebangsaan Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('kebangsaan_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Kebangsaan Ibu" name="kebangsaan_ayah" value="{{old('kebangsaan_ayah',$skk->kebangsaan_ayah)}}">
                                    @if($errors->has('kebangsaan_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kebangsaan_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Pelapor</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_pelapor'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Pelapor" name="nik_pelapor" value="{{old('nik_pelapor',$skk->nik_pelapor)}}" >
                                    @if($errors->has('nik_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Pelapor</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_pelapor'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Pelapor" name="nama_pelapor"
                                        value="{{old('nama_pelapor',$skk->nama_pelapor)}}" >
                                    @if($errors->has('nama_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('umur_pelapor'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Pelapor" name="umur_pelapor"
                                        value="{{old('umur_pelapor',$skk->umur_pelapor)}}" >
                                    @if($errors->has('umur_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jk_pelapor" id="" class="form-control select2 {{($errors->has('jk_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin Pelapor</option>
                                        <option value="laki-laki" {{(old('jk_pelapor',$skk->jk_pelapor)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk_pelapor',$skk->jk_pelapor)=='perempuan')?
                                        'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Pelapor</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_pelapor" id="" class="form-control select2 {{($errors->has('pekerjaan_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan Pelapor</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_pelapor',$skk->pekerjaan_id_pelapor)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Pelapor</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_pelapor"
                                        class="form-control {{($errors->has('alamat_pelapor'))?'is-invalid':''}}">{{old('alamat_pelapor',$skk->alamat_pelapor)}}</textarea>
                                    @if($errors->has('alamat_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_pelapor" id="" class="provinsi_pelapor form-control select2 {{($errors->has('provinsi_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_pelapor',$skk->provinsi_id_pelapor)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_pelapor" id="kota_pelapor" class="kota_pelapor form-control select2 {{($errors->has('kota_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        @foreach($kota->where('provinsi_id',$skk->provinsi_id_pelapor) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_pelapor',$skk->kota_id_pelapor) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('kota_id_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_pelapor" id="kecamatan_pelapor" class="kecamatan_pelapor form-control select2 {{($errors->has('kecamatan_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option> 
                                        @foreach($kecamatan->where('kota_id',$skk->kota_id_pelapor) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_pelapor',$skk->kecamatan_id_pelapor) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach 
                                    </select>
                                    @if($errors->has('kecamatan_id_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_pelapor" id="desa_pelapor" class="desa_pelapor form-control select2 {{($errors->has('area_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option>
                                        @foreach($area->where('kecamatan_id',$skk->kecamatan_id_pelapor) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_pelapor',$skk->area_id_pelapor) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('area_id_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Saksi 1</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Saksi 1" name="nik_saksi1" value="{{old('nik_saksi1',$skk->nik_saksi1)}}" >
                                    @if($errors->has('nik_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Saksi 1</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 1" name="nama_saksi1"
                                        value="{{old('nama_saksi1',$skk->nama_saksi1)}}" >
                                    @if($errors->has('nama_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('umur_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Saksi 1" name="umur_saksi1"
                                        value="{{old('umur_saksi1',$skk->umur_saksi1)}}" >
                                    @if($errors->has('umur_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jk_saksi1" id="" class="form-control select2 {{($errors->has('jk_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{(old('jk_saksi1',$skk->jk_saksi1)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk_saksi1',$skk->jk_saksi1)=='perempuan')?
                                        'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Saksi 1</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_saksi1" id="" class="form-control select2 {{($errors->has('pekerjaan_id_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan Saksi 1</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_saksi1',$skk->pekerjaan_id_saksi1)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Saksi 1</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_saksi1"
                                        class="form-control {{($errors->has('alamat_saksi1'))?'is-invalid':''}}">{{old('alamat_saksi1',$skk->alamat_saksi1)}}</textarea>
                                    @if($errors->has('alamat_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_saksi1" id="" class="provinsi_saksi1 form-control select2 {{($errors->has('provinsi_id_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_saksi1',$skk->provinsi_id_saksi1)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_saksi1" id="kota_saksi1" class="kota_saksi1 form-control select2 {{($errors->has('kota_id_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option> 
                                        @foreach($kota->where('provinsi_id',$skk->provinsi_id_saksi1) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_saksi1',$skk->kota_id_saksi1) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach 
                                    </select>
                                    @if($errors->has('kota_id_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_saksi1" id="kecamatan_saksi1" class="kecamatan_saksi1 form-control select2 {{($errors->has('kecamatan_id_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option>  
                                        @foreach($kecamatan->where('kota_id',$skk->kota_id_saksi1) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_saksi1',$skk->kecamatan_id_saksi1) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kecamatan_id_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_saksi1" id="desa_saksi1" class="desa_saksi1 form-control select2 {{($errors->has('area_id_saksi1'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option> 
                                        @foreach($area->where('kecamatan_id',$skk->kecamatan_id_saksi1) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_saksi1',$skk->area_id_saksi1) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach 
                                    </select>
                                    @if($errors->has('area_id_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Saksi 2</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nik_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Saksi 2" name="nik_saksi2" value="{{old('nik_saksi2',$skk->nik_saksi2)}}" >
                                    @if($errors->has('nik_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Saksi 2</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 2" name="nama_saksi2"
                                        value="{{old('nama_saksi2',$skk->nama_saksi2)}}" >
                                    @if($errors->has('nama_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('umur_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Saksi 2" name="umur_saksi2"
                                        value="{{old('umur_saksi2',$skk->umur_saksi2)}}" >
                                    @if($errors->has('umur_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jk_saksi2" id="" class="form-control select2 {{($errors->has('jk_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{(old('jk_saksi2',$skk->jk_saksi2)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk_saksi2',$skk->jk_saksi2)=='perempuan')?
                                        'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Saksi 2</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_saksi2" id="" class="form-control select2 {{($errors->has('pekerjaan_id_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan Saksi 2</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_saksi2',$skk->pekerjaan_id_saksi2)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Saksi 2</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_saksi2"
                                        class="form-control {{($errors->has('alamat_saksi2'))?'is-invalid':''}}">{{old('alamat_saksi2',$skk->alamat_saksi2)}}</textarea>
                                    @if($errors->has('alamat_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_saksi2" id="" class="provinsi_saksi2 form-control select2 {{($errors->has('provinsi_id_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_saksi2',$skk->provinsi_id_saksi2)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_saksi2" id="kota_saksi2" class="kota_saksi2 form-control select2 {{($errors->has('kota_id_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option>  
                                        @foreach($kota->where('provinsi_id',$skk->provinsi_id_saksi2) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_saksi2',$skk->kota_id_saksi2) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kota_id_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_saksi2" id="kecamatan_saksi2" class="kecamatan_saksi2 form-control select2 {{($errors->has('kecamatan_id_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option>  
                                        @foreach($kecamatan->where('kota_id',$skk->kota_id_saksi2) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_saksi2',$skk->kecamatan_id_saksi2) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('kecamatan_id_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_saksi2" id="desa_saksi2" class="desa_saksi2 form-control select2 {{($errors->has('area_id_saksi2'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option>
                                        @foreach($area->where('kecamatan_id',$skk->kecamatan_id_saksi2) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_saksi2',$skk->area_id_saksi2) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('area_id_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Keterangan Kelahiran</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skk->file_sk_kelahiran) ? $img . '/dokumen/skk/sk_kelahiran/' . $skk->file_sk_kelahiran : $img . '/default.jpg') ?>"
                                        id="preview-file_sk_kelahiran" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_sk_kelahiran'))?'is-invalid':''}}" id="file_sk_kelahiran" name="file_sk_kelahiran" value="{{old('file_sk_kelahiran',$skk->file_sk_kelahiran)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_sk_kelahiran'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_sk_kelahiran')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Nikah</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skk->file_surat_nikah) ? $img . '/dokumen/skk/surat_nikah/' . $skk->file_surat_nikah : $img . '/default.jpg') ?>"
                                        id="preview-file_surat_nikah" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_surat_nikah'))?'is-invalid':''}}" id="file_surat_nikah" name="file_surat_nikah" value="{{old('file_surat_nikah',$skk->file_surat_nikah)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_surat_nikah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_surat_nikah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skk->file_kk) ? $img . '/dokumen/skk/kk/' . $skk->file_kk : $img . '/default.jpg') ?>"
                                        id="preview-file_kk" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_kk'))?'is-invalid':''}}" id="file_kk" name="file_kk" value="{{old('file_kk',$skk->file_kk)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_kk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_kk')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP Ayah</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skk->file_ayah) ? $img . '/dokumen/skk/file_ayah/' . $skk->file_ayah : $img . '/default.jpg') ?>"
                                        id="preview-file_ayah" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_ayah'))?'is-invalid':''}}" id="file_ayah" name="file_ayah" value="{{old('file_ayah',$skk->file_ayah)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP Ibu</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skk->file_ibu) ? $img . '/dokumen/skk/file_ibu/' . $skk->file_ibu : $img . '/default.jpg') ?>"
                                        id="preview-file_ibu" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_ibu'))?'is-invalid':''}}" id="file_ibu" name="file_ibu" value="{{old('file_ibu',$skk->file_ibu)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skk')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($skk->no_surat))
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
    window.location.href = "{{route('backend.dokumen.skk')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
