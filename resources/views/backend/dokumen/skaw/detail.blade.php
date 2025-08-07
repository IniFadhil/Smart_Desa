@extends('backend.layouts.app')

@section('title') Surat Keterangan Ahli Waris @endsection

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
        <h1>Surat Keterangan Ahli Waris</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.dokumen.skaw')}}"> Surat Keterangan Ahli Waris</a>
            </div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    @if(empty($skaw->no_surat) && Auth::user()->roles()->first()->id != 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Operator</code>
        </div>
    </div>
    @elseif($skaw->verifikasi_kasi == '0' &&$skaw->verifikasi_sekdes == '0' && !empty($skaw->no_surat) &&
    Auth::user()->roles()->first()->id != 'kasi')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kasi</code>
        </div>
    </div>
    @elseif($skaw->verifikasi_sekdes == '0' && $skaw->verifikasi_kasi == '1' && Auth::user()->roles()->first()->id !=
    'sekretaris_desa')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Sekretaris Desa</code>
        </div>
    </div>
    @elseif($skaw->verifikasi_sekdes == '1' && $skaw->verifikasi_kades == '0' && Auth::user()->roles()->first()->id ==
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
                        <h4>Detail Surat Keterangan Ahli Waris</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                {{($skaw->no_surat)??'-'}}
                            </div>
                        </div>
                        <h5>Data Almarhum</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skaw->nama_alm)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                {{($skaw->jk_alm)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Meninggal</label>
                            <div class="col-sm-9">
                                {{(\Carbon\Carbon::parse($skaw->tgl_kematian)->translatedFormat('d F Y'))??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skaw->alamat)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skaw->kota->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skaw->kecamatan->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skaw->area->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Data Pasangan</h5><br>
                        <table class="table table-striped">
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
                                @foreach($skaw->pasangan as $pasangan)
                                <tr>
                                    <td>{{$pasangan->nama}}</td>
                                    <td>{{$pasangan->tempat_lahir}}</td>
                                    <td>{{\Carbon\Carbon::parse($pasangan->tgl_lahir)->translatedFormat('d M Y')}}</td>
                                    <td>{{$pasangan->jk}}</td>
                                    <td>{{$pasangan->pekerjaan->nama}}</td>
                                </tr>
                                @endforeach
                            <tbody>
                        </table>
                        <h5>Data Anak</h5><br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Kwarganegaraan</th>
                                    <th>ALamat</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skaw->anak as $anak)
                                <tr>
                                    <td>{{$anak->nama}}</td>
                                    <td>{{$anak->tempat_lahir}}</td>
                                    <td>{{\Carbon\Carbon::parse($anak->tgl_lahir)->translatedFormat('d M Y')}}</td>
                                    <td>{{ucfirst($anak->kewarganegaraan)}}</td>
                                    <td>{{$anak->alamat}}</td>
                                </tr>
                                @endforeach
                            <tbody>
                        </table>
                        <h5>Data Saksi 1</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {!!($skaw->nama_saksi1)??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {!!($skaw->nik_saksi1)??'-'!!}
                            </div>
                        </div>
                        <h5>Data Saksi 2</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {!!($skaw->nama_saksi2)??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {!!($skaw->nik_saksi2)??'-'!!}
                            </div>
                        </div>
                        <h5>Dokumen Pendukung</h5>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Permohonan</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Akta Lahir Ahli Waris</label>
                            <div class="col-sm-9">
                                <iframe
                                    src="{{asset('storage/backend/images/dokumen/skaw/akta_lahir/'.$skaw->file_akta_lahir)}}"
                                    frameborder="0" width="100%" height="250px"></iframe>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Silsilah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Buku Nikah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Keterangan Kematian</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Ahli Waris</label>
                            <div class="col-sm-9">
                                <iframe src="{{asset('storage/backend/images/dokumen/skaw/ktp/'.$skaw->file_ktp)}}"
                                    frameborder="0" width="100%" height="250px"></iframe>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/kk/'.$skaw->file_kk)}}" target="_blank"
                                    width="200px"><img src="{{asset('storage/backend/images/dokumen/skaw/kk/'.$skaw->file_kk)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Pernyataan</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.dokumen.skaw')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1 && $skaw->status == '1' && empty($skaw->no_surat) &&
                        Auth::user()->roles()->first()->id == 'operator')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rejectedOperator"
                            data-id="{{$skaw->encodeHash($skaw->id)}}" class="operator btn btn-md btn-danger btn-icon"
                            title="Tolak">Tolak</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#acceptedOperator"
                            data-id="{{$skaw->encodeHash($skaw->id)}}" class="operator btn btn-md btn-success btn-icon"
                            title="Terima">Terima</a>
                        @elseif(!empty($skaw->no_surat) && Auth::user()->roles()->first()->id == 'kasi' &&
                        $skaw->kasi_id == Auth::guard('admin')->user()->id)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKasi"
                            data-id="{{$skaw->encodeHash($skaw->id)}}" class="kasi btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skaw->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' &&
                        $skaw->verifikasi_kasi == '1' &&
                        $skaw->verifikasi_sekdes == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiSekdes"
                            data-id="{{$skaw->encodeHash($skaw->id)}}" class="sekdes btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skaw->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' &&
                        $skaw->verifikasi_kasi
                        == '1' && $skaw->verifikasi_sekdes == '1' && $skaw->verifikasi_kades == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKades"
                            data-id="{{$skaw->encodeHash($skaw->id)}}" class="kades btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skaw.reject')}}" method="post">
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
<form action="{{route('backend.dokumen.skaw.accept')}}" method="post">
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
<form action="{{route('backend.dokumen.skaw.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id',$skaw->encodeHash($skaw->id))}}" name="id">
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
<form action="{{route('backend.dokumen.skaw.sekdes')}}" method="post">
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
<form action="{{route('backend.dokumen.skaw.kasi')}}" method="post">
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
