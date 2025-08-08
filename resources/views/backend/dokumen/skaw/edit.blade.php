@extends('backend.layouts.app')

@section('title') Surat Keterangan Ahli Waris @endsection

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
@if(Session::get('permission')->update == 1 && $skaw->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Ahli Waris</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skaw')}}"> Surat Keterangan Ahli Waris</a>
            </div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Ahli Waris</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Almarhum</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$skaw->id}}">
                                    <input type="text"
                                        class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nomor Surat" name="no_surat"
                                        value="{{old('no_surat',$skaw->no_surat)}}">
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
                                        <option value="{{$data->id}}"
                                            {{ ( old('user_id',$skaw->user_id) == $data->id) ? 'selected' : '' }}>
                                            {{$data->nama_lengkap}}
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
                            <h5>Data Almarhum</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_alm'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Almarhum" name="nama_alm"
                                        value="{{old('nama_alm',$skaw->nama_alm)}}">
                                    @if($errors->has('nama_alm'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_alm')}}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Meninggal</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_kematian'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Kematian" name="tgl_kematian"
                                        value="{{old('tgl_kematian',$skaw->tgl_kematian)}}">
                                    @if($errors->has('tgl_kematian'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_kematian')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('jk_alm'))?'is-invalid':''}}"
                                        name="jk_alm">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki"
                                            {{ ( old('jk_alm',$skaw->jk_alm) == 'laki-laki') ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="perempuan"
                                            {{ ( old('jk_alm',$skaw->jk_alm) == 'perempuan') ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    @if($errors->has('jk_alm'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jk_alm')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="" cols="30" rows="10"
                                        class="form-control {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat',$skaw->alamat)}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Pasangan</h5><br>
                            <div class="table-responsive">
                                <table id="tableData1" class="table table-striped table-1">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Pekerjaan</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @if(count($skaw->pasangan) > 0)
                                        @foreach($skaw->pasangan as $pasangan)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="pasangan_id[]" value="{{$pasangan->id}}">
                                                <input type="text" name="nama_pasangan[]" class="form-control"
                                                    value="{!!old('nama_pasangan.'.$i,$pasangan->nama)!!}">
                                            </td>
                                            <td><input type="text" name="tempat_lahir_pasangan[]" class="form-control"
                                                    value="{!!old('tempat_lahir_pasangan.'.$i,$pasangan->tempat_lahir)!!}">
                                            </td>
                                            <td><input type="text" name="tgl_lahir_pasangan[]"
                                                    class="form-control datepicker"
                                                    value="{!!old('tgl_lahir_pasangan.'.$i,$pasangan->tgl_lahir)!!}">
                                            </td>
                                            <td><select name="jk_pasangan[]" id="" class="form-control">
                                                    <option value="laki-laki"
                                                        {{(old('jk_pasangan.'.$i,$pasangan->jk)=='laki-laki')}}>
                                                        Laki-laki</option>
                                                    <option value="perempuan"
                                                        {{(old('jk_pasangan.'.$i,$pasangan->jk)=='perempuan')}}>
                                                        Perempuan</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="pekerjaan_id[]" id="" class="form-control select2">
                                                    @foreach($pekerjaan as $data)
                                                    <option value="{{$data->id}}"
                                                        {{(old('pekerjaan_id.'.$i,$pasangan->pekerjaan_id)==$data->id)}}>
                                                        {{$data->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <!-- <td>
                                                <div onClick="deleteRow1(this)">
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                            </td> -->
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <!-- <button onClick="addRow1()" type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#functionInfoModal">
                                    Tambah
                                </button> -->

                            </div><br>
                            <h5>Data Anak</h5><br>
                            <div class="table-responsive">
                                <table id="tableData" class="table table-striped table-1">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Kewarganegaraan</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @if(count($skaw->anak) > 0)
                                        @foreach($skaw->anak as $anak)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="anak_id[]" value="{{$anak->id}}"><input type="text"
                                                    name="nama_anak[]" class="form-control"
                                                    value="{!!old('nama_anak.'.$i,$anak->nama)!!}"></td>
                                            <td><input type="text" name="tempat_lahir_anak[]" class="form-control"
                                                    value="{!!old('tempat_lahir_anak.'.$i,$anak->tempat_lahir)!!}">
                                            </td>
                                            <td><input type="text" name="tgl_lahir_anak[]"
                                                    class="form-control datepicker"
                                                    value="{!!old('tgl_lahir_anak.'.$i,$anak->tgl_lahir)!!}">
                                            </td>
                                            <td><select name="kewarganegaraan[]" id="" class="form-control">
                                                    <option value="indonesia"
                                                        {{(old('kewarganegaraan.'.$i,$anak->kewarganegaraan)=='indonesia')}}>
                                                        Indonesia</option>
                                                    <option value="wna"
                                                    {{(old('kewarganegaraan.'.$i,$anak->kewarganegaraan)=='wna')}}>
                                                        WNA</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="alamat_anak[]" class="form-control"
                                                    value="{!!old('alamat_anak.'.$i,$anak->alamat)!!}"></td>

                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div><br>
                            <h5>Data Saksi 1</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('nama_saksi1'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Saksi 1" name="nama_saksi1"
                                        value="{{old('nama_saksi1',$skaw->nama_saksi1)}}">
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
                                        placeholder="Masukan NIK saksi 1" name="nik_saksi1"
                                        value="{{old('nik_saksi1',$skaw->nik_saksi1)}}">
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
                                        value="{{old('nama_saksi2',$skaw->nama_saksi2)}}">
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
                                        placeholder="Masukan NIK Saksi 2" name="nik_saksi2"
                                        value="{{old('nik_saksi2',$skaw->nik_saksi2)}}">
                                    @if($errors->has('nik_saksi2'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nik_saksi2')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Dokumen Penunjang</h5><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Permohonan</label>
                                <div class="col-sm-9">
                                    <input type="file"
                                        class="form-control {{($errors->has('surat_permohonan'))?'is-invalid':''}}"
                                        id="surat_permohonan" name="surat_permohonan"
                                        value="{{old('surat_permohonan')}}" accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('surat_permohonan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('surat_permohonan')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Silsilah</label>
                                <div class="col-sm-9">
                                    <input type="file"
                                        class="form-control {{($errors->has('silsilah'))?'is-invalid':''}}"
                                        id="silsilah" name="silsilah" value="{{old('silsilah')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('silsilah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('silsilah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Akta Lahir Ahli Waris</label>
                                <div class="col-sm-9">
                                    <input type="file"
                                        class="form-control {{($errors->has('akta_lahir'))?'is-invalid':''}}"
                                        id="akta_lahir" name="akta_lahir" value="{{old('akta_lahir')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('akta_lahir'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('akta_lahir')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Buku Nikah</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skaw->file_buku_nikah) ? $img . '/dokumen/skaw/buku_nikah/' . $skaw->file_buku_nikah : $img . '/default.jpg') ?>"
                                        id="preview-buku_nikah" style="width: 200px">
                                    <input type="file"
                                        class="form-control {{($errors->has('buku_nikah'))?'is-invalid':''}}"
                                        id="buku_nikah" name="buku_nikah" value="{{old('buku_nikah')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('buku_nikah'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('buku_nikah')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File Surat Keterangan Kematian</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skaw->file_sk_kematian) ? $img . '/dokumen/skaw/sk_kematian/' . $skaw->file_sk_kematian : $img . '/default.jpg') ?>"
                                        id="preview-sk_kematian" style="width: 200px">
                                    <input type="file"
                                        class="form-control {{($errors->has('sk_kematian'))?'is-invalid':''}}"
                                        id="sk_kematian" name="sk_kematian" value="{{old('sk_kematian')}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('sk_kematian'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('sk_kematian')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">File KTP</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($skaw->file_ktp) ? $img . '/dokumen/skaw/ktp/' . $skaw->file_ktp : $img . '/default.jpg') ?>"
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
                                    <img src="<?php echo (!empty($skaw->file_kk) ? $img . '/dokumen/skaw/kk/' . $skaw->file_kk : $img . '/default.jpg') ?>"
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
                                    <img src="<?php echo (!empty($skaw->file_surat_pernyataan) ? $img . '/dokumen/skaw/surat_pernyataan/' . $skaw->file_surat_pernyataan : $img . '/default.jpg') ?>"
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
                            <div class="card-footer text-right">
                                <a href="{{route('backend.dokumen.skaw')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($skaw->no_surat))
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
    window.location.href = "{{route('backend.dokumen.skaw')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
