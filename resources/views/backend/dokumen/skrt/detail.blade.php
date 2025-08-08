@extends('backend.layouts.app')

@section('title') Surat Keterangan Riwayat Tanah @endsection

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
    $(window).on('load', function () {
        $('#acceptedOperator').modal('show')
    })

</script>
@endif
@if($errors->has('pesan'))
<script>
    $(window).on('load', function () {
        $('#rejectedOperator').modal('show')
    })

</script>
@endif
@if($errors->has('passphrase'))
<script>
    $(window).on('load', function () {
        $('#verifikasiKades').modal('show')
    })

</script>
@elseif(Session::has('error'))
<script>
    $(window).on('load', function () {
        $('#verifikasiKades').modal('show')
    })

</script>
@endif
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Riwayat Tanah</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.dokumen.skrt')}}"> Surat Keterangan Riwayat
                    Tanah</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    @if(empty($skrt->no_surat) && Auth::user()->roles()->first()->id != 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Operator</code>
        </div>
    </div>
    @elseif($skrt->verifikasi_kasi == '0' &&$skrt->verifikasi_sekdes == '0' && !empty($skrt->no_surat) &&
    Auth::user()->roles()->first()->id != 'kasi')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kasi</code>
        </div>
    </div>
    @elseif($skrt->verifikasi_sekdes == '0' && $skrt->verifikasi_kasi == '1' && Auth::user()->roles()->first()->id !=
    'sekretaris_desa')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Sekretaris Desa</code>
        </div>
    </div>
    @elseif($skrt->verifikasi_sekdes == '1' && $skrt->verifikasi_kades == '0' && Auth::user()->roles()->first()->id ==
    'operator')
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
                        <h4>Detail Surat Keterangan Riwayat Tanah</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                {{($skrt->no_surat)??'-'}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pemilik</label>
                            <div class="col-sm-9">
                                {{($skrt->nama_pemilik)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK Pemilik</label>
                            <div class="col-sm-9">
                                {{($skrt->nik_pemilik)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Sertifikat</label>
                            <div class="col-sm-9">
                                {{($skrt->no_sertifikat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Riwayat 1</label>
                            <div class="col-sm-9">
                                {{(\Carbon\Carbon::parse($skrt->tgl_riwayat1)->translatedFormat('d F Y'))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Atas Nama 1</label>
                            <div class="col-sm-9">
                                {{($skrt->atas_nama1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Riwayat 2</label>
                            <div class="col-sm-9">
                                {{(\Carbon\Carbon::parse($skrt->tgl_riwayat2)->translatedFormat('d F Y'))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Atas Nama 2</label>
                            <div class="col-sm-9">
                                {{($skrt->atas_nama2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Berdasarkan 2</label>
                            <div class="col-sm-9">
                                {{($skrt->berdasarkan2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Riwayat 3</label>
                            <div class="col-sm-9">
                                {{(\Carbon\Carbon::parse($skrt->tgl_riwayat3)->translatedFormat('d F Y'))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Atas Nama 3</label>
                            <div class="col-sm-9">
                                {{($skrt->atas_nama3)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Berdasarkan 3</label>
                            <div class="col-sm-9">
                                {{($skrt->berdasarkan3)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Riwayat 4</label>
                            <div class="col-sm-9">
                                {{(\Carbon\Carbon::parse($skrt->tgl_riwayat4)->translatedFormat('d F Y'))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Atas Nama 4</label>
                            <div class="col-sm-9">
                                {{($skrt->atas_nama4)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Berdasarkan 4</label>
                            <div class="col-sm-9">
                                {{($skrt->berdasarkan4)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No SPPT</label>
                            <div class="col-sm-9">
                                {{($skrt->no_sppt)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Blok</label>
                            <div class="col-sm-9">
                                {{($skrt->blok)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Persil</label>
                            <div class="col-sm-9">
                                {{($skrt->persil)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Kihir</label>
                            <div class="col-sm-9">
                                {{($skrt->no_kihir)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Luas</label>
                            <div class="col-sm-9">
                                {{($skrt->luas)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {{($skrt->alamat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sebelah Utara</label>
                            <div class="col-sm-9">
                                {{($skrt->sebelah_utara)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sebelah Timur</label>
                            <div class="col-sm-9">
                                {{($skrt->sebelah_timur)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sebelah Selatan</label>
                            <div class="col-sm-9">
                                {{($skrt->sebelah_selatan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sebelah Barat</label>
                            <div class="col-sm-9">
                                {{($skrt->sebelah_barat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Saksi 1</label>
                            <div class="col-sm-9">
                                {{($skrt->nama_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK Saksi 1</label>
                            <div class="col-sm-9">
                                {{($skrt->nik_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Saksi 2</label>
                            <div class="col-sm-9">
                                {{($skrt->nama_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK Saksi 2</label>
                            <div class="col-sm-9">
                                {{($skrt->nik_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Pengantar RTRW</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw)}}"
                                    target="_blank">
                                    <img src="{{asset('storage/backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/uploads/'.$skrt->file_ktp)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/uploads/'.$skrt->file_ktp)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/uploads/'.$skrt->file_kk)}}" target="_blank"
                                    width="200px"><img src="{{asset('storage/backend/images/uploads/'.$skrt->file_kk)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Pernyataan</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Tanah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Pajak Tanah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.dokumen.skrt')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1 && $skrt->status == '1' && empty($skrt->no_surat) &&
                        Auth::user()->roles()->first()->id == 'operator')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rejectedOperator"
                            data-id="{{$skrt->encodeHash($skrt->id)}}" class="operator btn btn-md btn-danger btn-icon"
                            title="Tolak">Tolak</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#acceptedOperator"
                            data-id="{{$skrt->encodeHash($skrt->id)}}" class="operator btn btn-md btn-success btn-icon"
                            title="Terima">Terima</a>
                        @elseif(!empty($skrt->no_surat) && Auth::user()->roles()->first()->id == 'kasi' &&
                        $skrt->kasi_id == Auth::guard('admin')->user()->id)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKasi"
                            data-id="{{$skrt->encodeHash($skrt->id)}}" class="kasi btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skrt->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' &&
                        $skrt->verifikasi_kasi == '1'&&
                        $skrt->verifikasi_sekdes == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiSekdes"
                            data-id="{{$skrt->encodeHash($skrt->id)}}" class="sekdes btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skrt->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' &&
                        $skrt->verifikasi_kasi
                        == '1' && $skrt->verifikasi_sekdes == '1' && $skrt->verifikasi_kades == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKades"
                            data-id="{{$skrt->encodeHash($skrt->id)}}" class="kades btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skrt.reject')}}" method="post">
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
                    <input type="text" class="form-control {{($errors->has('pesan'))?'is-invalid':''}}" name="pesan"
                        placeholder="masukan pesan penolakan">
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
<form action="{{route('backend.dokumen.skrt.accept')}}" method="post">
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
                    <input type="text" class="form-control {{($errors->has('no_surat'))?'is-invalid':''}}"
                        name="no_surat" placeholder="masukan no surat">
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
<form action="{{route('backend.dokumen.skrt.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id',$skrt->encodeHash($skrt->id))}}" name="id">
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
                    <input type="password"
                        class="form-control {{($errors->has('passphrase') || Session::get('error'))?'is-invalid':''}}"
                        name="passphrase" placeholder="Masukan Passphrase">
                    @if($errors->has('passphrase'))
                    <div class="invalid-feedback">
                        {{$errors->first('passphrase')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
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
<form action="{{route('backend.dokumen.skrt.sekdes')}}" method="post">
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
<form action="{{route('backend.dokumen.skrt.kasi')}}" method="post">
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
