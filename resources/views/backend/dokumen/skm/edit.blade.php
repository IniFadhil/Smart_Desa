@extends('backend.layouts.app')

@section('title') Surat Keterangan Kematian @endsection

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

$('.provinsi_jenazah').change(function(){
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
            var kota_jenazah = $('#kota_jenazah')
            kota_jenazah.html('<option value="">Pilih Kota</option');
            $.each(data, function(i, value){
                kota_jenazah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kota_jenazah').change(function(){
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
            var kecamatan_jenazah = $('#kecamatan_jenazah')
            kecamatan_jenazah.html('<option value="">Pilih Kecamatan</option');
            $.each(data, function(i, value){
                kecamatan_jenazah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

    $('.kecamatan_jenazah').change(function(){
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
            var desa_jenazah = $('#desa_jenazah')
            desa_jenazah.html('<option value="">Pilih Desa/Kelurahan</option');
            $.each(data, function(i, value){
                desa_jenazah.append('<option value=' + value.id + '>' + value.nama + '</option>');
            });
        }
        })
    })

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

</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->update == 1 && $skm->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Kematian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skm')}}"> Surat Keterangan Kematian</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Kematian</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Jenazah</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$skm->id}}">
                                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat" value="{{old('no_surat',$skm->no_surat)}}">
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
                                        <option value="{{$data->id}}" {{ ( old('user_id',$skm->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
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
                                        placeholder="Masukan Nama Kepala Keluarga Anda" name="nama_kepala_keluarga" value="{{old('nama_kepala_keluarga',$skm->nama_kepala_keluarga)}}" >
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
                                        placeholder="Masukan No Kartu Keluarga Anda" name="no_kk" value="{{old('no_kk',$skm->no_kk)}}" >
                                    @if($errors->has('no_kk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_kk')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('nik_jenazah'))?'is-invalid':''}}"
                                        placeholder="Masukan NIK Jenazah" name="nik_jenazah"
                                        value="{{old('nik_jenazah',$skm->nik_jenazah)}}" >
                                    @if($errors->has('nik_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_jenazah'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Jenazah" name="nama_jenazah"
                                        value="{{old('nama_jenazah',$skm->nama_jenazah)}}" >
                                    @if($errors->has('nama_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jk_jenazah" id="" class="form-control {{($errors->has('jk_jenazah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" {{(old('jk_jenazah',$skm->jk_jenazah)=='laki-laki')?
                                        'selected':''}}>Laki-laki</option>
                                        <option value="perempuan" {{(old('jk_jenazah',$skm->jk_jenazah)=='perempuan')?'selected':''}}>Perempuan</option>
                                    </select>
                                    @if($errors->has('jk_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_lahir_jenazah'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Lahir" name="tgl_lahir_jenazah"
                                        value="{{old('tgl_lahir_jenazah',$skm->tgl_lahir_jenazah)}}" >
                                    @if($errors->has('tgl_lahir_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_lahir_jenazah')}}
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
                                        value="{{old('tempat_lahir',$skm->tempat_lahir)}}" >
                                    @if($errors->has('tempat_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <select name="agama" id="" class="form-control {{($errors->has('agama'))?'is-invalid':''}}" >
                                        <option value="">Pilih Agaman</option>
                                        <option value="islam" {{(old('agama',$skm->agama)=='islam')?
                                        'selected':''}}>Islam</option>
                                        <option value="kristen" {{(old('agama',$skm->agama)=='kristen')?'selected':''}}>Kristen</option>
                                        <option value="katolik" {{(old('agama',$skm->agama)=='katolik')?'selected':''}}>Katolik</option>
                                        <option value="hindu" {{(old('agama',$skm->agama)=='hindu')?'selected':''}}>Hindu</option>
                                        <option value="budha" {{(old('agama',$skm->agama)=='budha')?'selected':''}}>Budha</option>
                                    </select>
                                    @if($errors->has('agama'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('agama')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_jenazah" id="" class="form-control select2 {{($errors->has('pekerjaan_id_jenazah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_jenazah',$skm->pekerjaan_id_jenazah)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach
                                            
                                    </select>
                                    @if($errors->has('pekerjaan_id_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pekerjaan_id_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_jenazah"
                                        class="form-control {{($errors->has('alamat_jenazah'))?'is-invalid':''}}">{{old('alamat_jenazah',$skm->alamat_jenazah)}}</textarea>
                                    @if($errors->has('alamat_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select name="provinsi_id_jenazah" id="" class="provinsi_jenazah form-control select2 {{($errors->has('provinsi_id_jenazah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $data)
                                        <option value="{{$data->id}}" {{(old('provinsi_id_jenazah',$skm->provinsi_id_jenazah)==$data->id)?
                                        'selected':''}}>{{$data->nama}}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('provinsi_id_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('provinsi_id_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select name="kota_id_jenazah" id="kota_jenazah" class="kota_jenazah form-control select2 {{($errors->has('kota_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kota/Kabupaten</option>  
                                        @foreach($kota->where('provinsi_id',$skm->provinsi_id_jenazah) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_jenazah',$skm->kota_id_jenazah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach 
                                    </select>
                                    @if($errors->has('kota_id_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kota_id_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select name="kecamatan_id_jenazah" id="kecamatan_jenazah" class="kecamatan_jenazah form-control select2 {{($errors->has('kecamatan_id_jenazah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kecamatan</option>  
                                        @foreach($kecamatan->where('kota_id',$skm->kota_id_jenazah) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_jenazah',$skm->kecamatan_id_jenazah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach 
                                    </select>
                                    @if($errors->has('kecamatan_id_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kecamatan_id_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-9">
                                    <select name="area_id_jenazah" id="desa_jenazah" class="desa_jenazah form-control select2 {{($errors->has('area_id_jenazah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Desa</option> 
                                        @foreach($area->where('kecamatan_id',$skm->kecamatan_id_jenazah) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_jenazah',$skm->area_id_jenazah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('area_id_jenazah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_jenazah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-9">
                                    <select name="kewarganegaraan" id="" class="form-control select2 {{($errors->has('kewarganegaraan'))?'is-invalid':''}}" >
                                        <option value="">Pilih Kewarganegaraan</option>  
                                        <option value="wni" {{(old('kewarganegaraan',$skm->kewarganegaraan)=='wni')?
                                        'selected':''}}>WNI</option>
                                        <option value="wna" {{(old('kewarganegaraan',$skm->kewarganegaraan)=='wna')?
                                        'selected':''}}>WNA</option>
                                    </select>
                                    @if($errors->has('kewarganegaraan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kewarganegaraan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Keturunan</label>
                                <div class="col-sm-9">
                                    <select name="keturunan" id="" class="form-control select2 {{($errors->has('keturunan'))?'is-invalid':''}}" >
                                        <option value="">Pilih Keturunan</option>  
                                        <option value="eropa" {{(old('keturunan',$skm->keturunan)=='eropa')?
                                        'selected':''}}>Eropa</option>
                                        <option value="cina/timur asing lainnya" {{(old('keturunan',$skm->keturunan)=='cina/timur asing lainnya')?
                                        'selected':''}}>Cina/timur asing lainnya</option>
                                        <option value="indonesia" {{(old('keturunan',$skm->keturunan)=='indonesia')?
                                        'selected':''}}>Indonesia</option>
                                        <option value="indonesia nasrani" {{(old('keturunan',$skm->keturunan)=='indonesia nasrani')?
                                        'selected':''}}>Indonesia Nasrani</option>
                                        <option value="lainnya" {{(old('keturunan',$skm->keturunan)=='lainnya')?
                                        'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('keturunan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('keturunan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kebangsaan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('kebangsaan'))?'is-invalid':''}}"
                                        placeholder="Masukan Kebangsaan" name="kebangsaan"
                                        value="{{old('kebangsaan',$skm->kebangsaan)}}" >
                                    @if($errors->has('kebangsaan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('kebangsaan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Anak Ke</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('anak_ke'))?'is-invalid':''}}"
                                        placeholder="Masukan Anak Ke" name="anak_ke"
                                        value="{{old('anak_ke',$skm->anak_ke)}}" >
                                    @if($errors->has('anak_ke'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('anak_ke')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Kematian</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_kematian'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Kematian" name="tgl_kematian"
                                        value="{{old('tgl_kematian',$skm->tgl_kematian)}}" >
                                    @if($errors->has('tgl_kematian'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_kematian')}}
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
                                        value="{{old('pukul',$skm->pukul)}}" >
                                    @if($errors->has('pukul'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pukul')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Sebab Kematian</label>
                                <div class="col-sm-9">
                                    <select name="sebab_kematian" id="" class="form-control {{($errors->has('sebab_kematian'))?'is-invalid':''}}" >
                                        <option value="">Pilih Sebab Kematian</option>
                                        <option value="sakit biasa" {{(old('sebab_kematian',$skm->sebab_kematian)=='sakit biasa')?
                                        'selected':''}}>Sakit Biasa</option>
                                        <option value="tua" {{(old('sebab_kematian',$skm->sebab_kematian)=='tua')?'selected':''}}>Tua</option>
                                        <option value="wabah penyakit" {{(old('sebab_kematian',$skm->sebab_kematian)=='wabah penyakit')?'selected':''}}>Wabah Penyakit</option>
                                        <option value="kecelakaan" {{(old('sebab_kematian',$skm->sebab_kematian)=='kecelakaan')?'selected':''}}>Kecelakaan</option>
                                        <option value="kriminalitas" {{(old('sebab_kematian',$skm->sebab_kematian)=='kriminalitas')?'selected':''}}>Kriminalitas</option>
                                        <option value="bunuh diri" {{(old('sebab_kematian',$skm->sebab_kematian)=='bunuh diri')?'selected':''}}>Bunuh Diri</option>
                                        <option value="lainnya" {{(old('sebab_kematian',$skm->sebab_kematian)=='lainnya')?'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('sebab_kematian'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sebab_kematian')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tempat Kematian</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('tempat_kematian'))?'is-invalid':''}}"
                                        placeholder="Masukan Tempat Kematian " name="tempat_kematian"
                                        value="{{old('tempat_kematian',$skm->tempat_kematian)}}" >
                                    @if($errors->has('tempat_kematian'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tempat_kematian')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Yang menerangkan</label>
                                <div class="col-sm-9">
                                    <select name="yang_menerangkan" id="" class="form-control {{($errors->has('yang_menerangkan'))?'is-invalid':''}}" >
                                        <option value="">Pilih Sebab Kematian</option>
                                        <option value="dokter" {{(old('yang_menerangkan',$skm->yang_menerangkan)=='dokter')?
                                        'selected':''}}>Dokter</option>
                                        <option value="tenaga kesehatan" {{(old('yang_menerangkan',$skm->yang_menerangkan)=='tenaga kesehatan')?'selected':''}}>Tenaga Kesehatan</option>
                                        <option value="kepolisian" {{(old('yang_menerangkan',$skm->yang_menerangkan)=='wabah penyakit')?'selected':''}}>Wabah Penyakit</option>
                                        <option value="lainnya" {{(old('yang_menerangkan',$skm->yang_menerangkan)=='lainnya')?'selected':''}}>Lainnya</option>
                                    </select>
                                    @if($errors->has('yang_menerangkan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('yang_menerangkan')}}
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
                                        placeholder="Masukan NIK Ibu" name="nik_ibu" value="{{old('nik_ibu',$skm->nik_ibu)}}" >
                                    @if($errors->has('nik_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ibu" name="nama_ibu"
                                        value="{{old('nama_ibu',$skm->nama_ibu)}}" >
                                    @if($errors->has('nama_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('umur_ibu'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Ibu" name="umur_ibu"
                                        value="{{old('umur_ibu',$skm->umur_ibu)}}" >
                                    @if($errors->has('umur_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_ibu')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_ibu" id="" class="form-control select2 {{($errors->has('pekerjaan_id_ibu'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_ibu',$skm->pekerjaan_id_ibu)==$data->id)?
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
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_ibu"
                                        class="form-control {{($errors->has('alamat_ibu'))?'is-invalid':''}}">{{old('alamat_ibu',$skm->alamat_ibu)}}</textarea>
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
                                        <option value="{{$data->id}}" {{(old('provinsi_id_ibu',$skm->provinsi_id_ibu)==$data->id)?
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
                                        @foreach($kota->where('provinsi_id',$skm->provinsi_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_ibu',$skm->kota_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
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
                                        @foreach($kecamatan->where('kota_id',$skm->kota_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_ibu',$skm->kecamatan_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
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
                                        @foreach($area->where('kecamatan_id',$skm->kecamatan_id_ibu) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_ibu',$skm->area_id_ibu) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('area_id_ibu'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_ibu')}}
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
                                        placeholder="Masukan NIK Ayah" name="nik_ayah" value="{{old('nik_ayah',$skm->nik_ayah)}}" >
                                    @if($errors->has('nik_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Ayah" name="nama_ayah"
                                        value="{{old('nama_ayah',$skm->nama_ayah)}}" >
                                    @if($errors->has('nama_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('umur_ayah'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Ayah" name="umur_ayah"
                                        value="{{old('umur_ayah',$skm->umur_ayah)}}" >
                                    @if($errors->has('umur_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_ayah')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_ayah" id="" class="form-control select2 {{($errors->has('pekerjaan_id_ayah'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_ayah',$skm->pekerjaan_id_ayah)==$data->id)?
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
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_ayah"
                                        class="form-control {{($errors->has('alamat_ayah'))?'is-invalid':''}}">{{old('alamat_ayah',$skm->alamat_ayah)}}</textarea>
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
                                        <option value="{{$data->id}}" {{(old('provinsi_id_ayah',$skm->provinsi_id_ayah)==$data->id)?
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
                                        @foreach($kota->where('provinsi_id',$skm->provinsi_id_ayah) as $data)
                                        <option value="{{$data->id}}" {{(old('kota_id_ayah',$skm->kota_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
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
                                        @foreach($kecamatan->where('kota_id',$skm->kota_id_ayah) as $data)
                                        <option value="{{$data->id}}" {{(old('kecamatan_id_ayah',$skm->kecamatan_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
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
                                        @foreach($area->where('kecamatan_id',$skm->kecamatan_id_jayah) as $data)
                                        <option value="{{$data->id}}" {{(old('area_id_ayah',$skm->area_id_ayah) == $data->id)?'selected':''}}>{{$data->nama}}</option>
                                        @endforeach  
                                    </select>
                                    @if($errors->has('area_id_ayah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('area_id_ayah')}}
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
                                        placeholder="Masukan NIK Pelapor" name="nik_pelapor" value="{{old('nik_pelapor',$skm->nik_pelapor)}}" >
                                    @if($errors->has('nik_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_pelapor'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Pelapor" name="nama_pelapor"
                                        value="{{old('nama_pelapor',$skm->nama_pelapor)}}" >
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
                                    <input type="number" min="0"
                                        class="form-control {{($errors->has('umur_pelapor'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur Pelapor" name="umur_pelapor"
                                        value="{{old('umur_pelapor',$skm->umur_pelapor)}}" >
                                    @if($errors->has('umur_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan_id_pelapor" id="" class="form-control select2 {{($errors->has('pekerjaan_id_pelapor'))?'is-invalid':''}}" >
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{(old('pekerjaan_id_pelapor',$skm->pekerjaan_id_pelapor)==$data->id)?
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
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_pelapor"
                                        class="form-control {{($errors->has('alamat_pelapor'))?'is-invalid':''}}">{{old('alamat_pelapor',$skm->alamat_pelapor)}}</textarea>
                                    @if($errors->has('alamat_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Hubungan dengan yang meninggal</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('hubungan'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Hubungan" name="hubungan"
                                        value="{{old('hubungan',$skm->hubungan)}}" >
                                    @if($errors->has('hubungan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('hubungan')}}
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
                                        placeholder="Masukan NIK Saksi 1" name="nik_saksi1" value="{{old('nik_saksi1',$skm->nik_saksi1)}}" >
                                    @if($errors->has('nik_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi1')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 1" name="nama_saksi1"
                                        value="{{old('nama_saksi1',$skm->nama_saksi1)}}" >
                                    @if($errors->has('nama_saksi1'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi1')}}
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
                                        placeholder="Masukan NIK Saksi 2" name="nik_saksi2" value="{{old('nik_saksi2',$skm->nik_saksi2)}}" >
                                    @if($errors->has('nik_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi2'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 2" name="nama_saksi2"
                                        value="{{old('nama_saksi2',$skm->nama_saksi2)}}" >
                                    @if($errors->has('nama_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Keterangan Rumah Sakit</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skm->file_sk_rs) ? $img . '/dokumen/skm/sk_rs/' . $skm->file_sk_rs : $img . '/default.jpg') ?>"
                                        id="preview-file_sk_rs" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_sk_rs'))?'is-invalid':''}}" id="file_sk_rs" name="file_sk_rs" value="{{old('file_sk_rs',$skm->file_sk_rs)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_sk_rs'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_sk_rs')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP Alm</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skm->file_ktp_alm) ? $img . '/dokumen/skm/ktp_alm/' . $skm->file_ktp_alm : $img . '/default.jpg') ?>"
                                        id="preview-file_ktp_alm" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_ktp_alm'))?'is-invalid':''}}" id="file_ktp_alm" name="file_ktp_alm" value="{{old('file_ktp_alm',$skm->file_ktp_alm)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_ktp_alm'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_ktp_alm')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP Pelapor</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skm->file_ktp_pelapor) ? $img . '/dokumen/skm/ktp_pelapor/' . $skm->file_ktp_pelapor : $img . '/default.jpg') ?>"
                                        id="preview-file_ktp_pelapor" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_ktp_pelapor'))?'is-invalid':''}}" id="file_ktp_pelapor" name="file_ktp_pelapor" value="{{old('file_ktp_pelapor',$skm->file_ktp_pelapor)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_ktp_pelapor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_ktp_pelapor')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP Saksi</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skm->file_ktp_saksi) ? $img . '/dokumen/skm/ktp_saksi/' . $skm->file_ktp_saksi : $img . '/default.jpg') ?>"
                                        id="preview-file_ktp_saksi" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('file_ktp_saksi'))?'is-invalid':''}}" id="file_ktp_saksi" name="file_ktp_saksi" value="{{old('file_ktp_saksi',$skm->file_ktp_saksi)}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                        @if($errors->has('file_ktp_saksi'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('file_ktp_saksi')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>

                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skm')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($skm->no_surat))
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
    window.location.href = "{{route('backend.dokumen.skm')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
