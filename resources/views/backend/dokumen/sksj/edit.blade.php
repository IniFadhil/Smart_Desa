@extends('backend.layouts.app')

@section('title') Surat Keterangan Sapu Jagat @endsection

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
@if(Session::get('permission')->update == 1 && $sksj->status == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Sapu Jagat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.sksj')}}"> Surat Keterangan Sapu Jagat</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Surat Keterangan Sapu Jagat</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" id="mainform">
                            {{csrf_field()}}
                            <h5>Data Pribadi</h5><br>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{$sksj->id}}">
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
                                <label for="" class="col-sm-3 col-form-label">Nama Pengaju</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('user_id'))?'is-invalid':''}}"
                                        name="user_id">
                                        <option value="">-- Pilih Nama Pengaju --</option>
                                        @foreach($users as $data)
                                        <option value="{{$data->id}}" {{ ( old('user_id',$sksj->user_id) == $data->id) ? 'selected' : '' }}>{{$data->nama_lengkap}}
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
                            <h5>Data Pejabat</h5>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_pejabat'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Pejabat" name="nama_pejabat" value="{{old('nama_pejabat',$sksj->nama_pejabat)}}">
                                    @if($errors->has('nama_pejabat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_pejabat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('jabatan'))?'is-invalid':''}}"
                                        placeholder="Masukan Jabatan" name="jabatan" value="{{old('jabatan',$sksj->jabatan)}}">
                                    @if($errors->has('jabatan'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('jabatan')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Kantor</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="" cols="30" rows="10"
                                        class="form-control {{($errors->has('alamat'))?'is-invalid':''}}">{{old('alamat',$sksj->alamat)}}</textarea>
                                    @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h5>Data Pengaju</h5>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('nama_penduduk'))?'is-invalid':''}}"
                                        placeholder="Masukan Nama Penduduk" name="nama_penduduk" value="{{old('nama_penduduk',$sksj->nama_penduduk)}}">
                                    @if($errors->has('nama_penduduk'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nama_penduduk')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">No KTP/SIM</label>
                                <div class="col-sm-9">
                                    <input type="number"
                                        class="form-control {{($errors->has('no_nik'))?'is-invalid':''}}"
                                        placeholder="Masukan No KTP/SIM" name="no_nik" value="{{old('no_nik',$sksj->no_nik)}}">
                                    @if($errors->has('no_nik'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('no_nik')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input type="number" min="1"
                                        class="form-control {{($errors->has('umur'))?'is-invalid':''}}"
                                        placeholder="Masukan Umur" name="umur" value="{{old('umur',$sksj->umur)}}">
                                    @if($errors->has('umur'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('umur')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 {{($errors->has('pekerjaan_id'))?'is-invalid':''}}"
                                        name="pekerjaan_id">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        @foreach($pekerjaan as $data)
                                        <option value="{{$data->id}}" {{ ( old('pekerjaan_id',$sksj->pekerjaan_id) == $data->id) ? 'selected' : '' }}>
                                            {{$data->nama}}
                                        </option>
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
                                <label for="" class="col-sm-3 col-form-label">Alamat Kantor</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_kantor" id="" cols="30" rows="10"
                                        class="form-control {{($errors->has('alamat_kantor'))?'is-invalid':''}}">{{old('alamat_kantor',$sksj->alamat_kantor)}}</textarea>
                                    @if($errors->has('alamat_kantor'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat_kantor')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Mulai Menetap</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control datepicker {{($errors->has('tgl_menetap'))?'is-invalid':''}}"
                                        placeholder="Masukan Tanggal Menetap" name="tgl_menetap"
                                        value="{{old('tgl_menetap',$sksj->tgl_menetap)}}">
                                    @if($errors->has('tgl_menetap'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('tgl_menetap')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Untuk Keperluan</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{($errors->has('keperluan'))?'is-invalid':''}}"
                                        placeholder="Masukan Untuk Keperluan" name="keperluan" value="{{old('keperluan',$sksj->keperluan)}}">
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
                                    <img src="<?php echo (!empty($sksj->file_sp_rtrw) ? $img . '/dokumen/sksj/rtrw/' . $sksj->file_sp_rtrw : $img . '/default.jpg') ?>"
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
                                    <img src="<?php echo (!empty($sksj->file_ktp) ? $img . '/dokumen/sksj/ktp/' . $sksj->file_ktp : $img . '/default.jpg') ?>"
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
                                <label class="col-sm-3 col-form-label">File Surat Pernyataan</label>
                                <div class="col-sm-9">
                                <?php $img = asset('backend/images'); ?>
                                    <img src="<?php echo (!empty($sksj->file_surat_pernyataan) ? $img . '/dokumen/sksj/surat_pernyataan/' . $sksj->file_surat_pernyataan : $img . '/default.jpg') ?>"
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
                                <a href="{{route('backend.dokumen.sksj')}}" class="btn btn-secondary">Kembali</a>
                                @if(empty($sksj->no_surat))
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
    window.location.href = "{{route('backend.dokumen.sksj')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
