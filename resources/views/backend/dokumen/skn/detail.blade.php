@extends('backend.layouts.app')

@section('title') Surat Keterangan Nikah @endsection

@section('top-resource')
@endsection

@section('bottom-resource')
<script>
$('.operator').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })
    $('.kades').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })

    $('.sekdes').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })

    $('.kasi').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })
</script>
@if($errors->has('no_surat') || $errors->has('kasi_id'))
    <script>
        $(window).on('load',function(){
            $('#acceptedOperator').modal('show')
        })
        </script>
@endif
@if($errors->has('pesan'))
    <script>
        $(window).on('load',function(){
            $('#rejectedOperator').modal('show')
        })
        </script>
@endif
@if($errors->has('passphrase'))
    <script>
        $(window).on('load',function(){
            $('#verifikasiKades').modal('show')
        })
        </script>
@elseif(Session::has('error'))
    <script>
        $(window).on('load',function(){
            $('#verifikasiKades').modal('show')
        })
        </script>
@endif
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Nikah</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.dokumen.skn')}}"> Surat Keterangan Nikah</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    @if(empty($skn->no_surat) && Auth::user()->roles()->first()->id != 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Operator</code>
        </div>
    </div>
    @elseif($skn->verifikasi_kasi == '0' &&$skn->verifikasi_sekdes == '0' &&  !empty($skn->no_surat) && Auth::user()->roles()->first()->id != 'kasi')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kasi</code>
        </div>
    </div>
    @elseif($skn->verifikasi_sekdes == '0' && $skn->verifikasi_kasi == '1' && Auth::user()->roles()->first()->id != 'sekretaris_desa')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Sekretaris Desa</code>
        </div>
    </div>
    @elseif($skn->verifikasi_sekdes == '1' && $skn->verifikasi_kades == '0' && Auth::user()->roles()->first()->id == 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kepala Desa</code>
        </div>
    </div>
    @endif
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Surat Keterangan Nikah</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                {{($skn->no_surat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skn->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skn->nik)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                {{($skn->tempat_lahir)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skn->tgl_lahir)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                {{ucfirst($skn->jk)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warga Negara</label>
                            <div class="col-sm-9">
                                {{ucfirst($skn->warga_negara)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                {{ucfirst($skn->status_perkawinan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                {{ucwords(strtolower($skn->agama))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skn->alamat)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keperluan</label>
                            <div class="col-sm-9">
                                {!!($skn->keperluan)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skn->kota->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skn->kecamatan->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skn->area->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw)}}" target="_blank" >
                                <img src="{{asset('storage/backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw)}}" width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/uploads/'.$skn->file_ktp)}}" target="_blank"><img src="{{asset('storage/backend/images/uploads/'.$skn->file_ktp)}}" width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/uploads/'.$skn->file_kk)}}" target="_blank" width="200px"><img src="{{asset('storage/backend/images/uploads/'.$skn->file_kk)}}" width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Akta Cerai</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai)}}" target="_blank" width="200px"><img src="{{asset('storage/backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai)}}" width="200px"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.dokumen.skn')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1 && $skn->status == '1' && empty($skn->no_surat) &&
                        Auth::user()->roles()->first()->id == 'operator')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rejectedOperator"
                            data-id="{{$skn->encodeHash($skn->id)}}" class="operator btn btn-md btn-danger btn-icon"
                            title="Tolak">Tolak</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#acceptedOperator"
                            data-id="{{$skn->encodeHash($skn->id)}}" class="operator btn btn-md btn-success btn-icon"
                            title="Terima">Terima</a>
                        @elseif(!empty($skn->no_surat) && Auth::user()->roles()->first()->id == 'kasi'&& $skn->kasi_id == Auth::guard('admin')->user()->id)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKasi"
                            data-id="{{$skn->encodeHash($skn->id)}}" class="kasi btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skn->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' &&
                        $skn->verifikasi_kasi == '1'&&
                        $skn->verifikasi_sekdes == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiSekdes"
                            data-id="{{$skn->encodeHash($skn->id)}}" class="sekdes btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skn->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' &&
                        $skn->verifikasi_kasi
                        == '1' && $skn->verifikasi_sekdes == '1' && $skn->verifikasi_kades == '0') 
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKades"
                            data-id="{{$skn->encodeHash($skn->id)}}" class="kades btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skn.reject')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id')}}" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="rejectedOperator">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menolak data ini?</p>
                    <input type="text" class="form-control {{($errors->has('pesan'))?'is-invalid':''}}" name="pesan" placeholder="masukan pesan penolakan">
                    @if($errors->has('pesan'))
                        <div class="invalid-feedback">
                            {{$errors->first('pesan')}}
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.dokumen.skn.accept')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id')}}" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="acceptedOperator">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menerima dan verifikasi data ini?</p>
                    <label for="">Masukan No Surat</label>
                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}" name="no_surat" placeholder="masukan no surat">
                    @if($errors->has('no_surat'))
                        <div class="invalid-feedback">
                            {{$errors->first('no_surat')}}
                        </div>
                    @endif
                    <br>
                    <label for="">Kasi</label>
                    <select name="kasi_id" id="" class="select2 form-control">
                        @foreach($kasi as $data)
                        <option value="{{$data->admin_id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('kasi_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('kasi_id')}}
                        </div>
                    @endif

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.dokumen.skn.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id',$skn->encodeHash($skn->id))}}" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="verifikasiKades">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan verifikasi data ini?</p>
                    <label for="">Masukan Passphrase</label>
                    <input type="password" class="form-control {{($errors->has('passphrase') || Session::get('error'))?'is-invalid':''}}" name="passphrase" placeholder="Masukan Passphrase">
                    @if($errors->has('passphrase'))
                        <div class="invalid-feedback">
                            {{$errors->first('passphrase')}}
                        </div>
                    @endif
                    @if(session::has('error'))
                    <div class="invalid-feedback">
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.dokumen.skn.sekdes')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="verifikasiSekdes">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan verifikasi data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.dokumen.skn.kasi')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="verifikasiKasi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan verifikasi data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
