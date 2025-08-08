@extends('backend.layouts.app')

@section('title') Surat Keterangan Kematian @endsection

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
        <h1>Surat Keterangan Kematian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.dokumen.skm')}}"> Surat Keterangan Kematian</a>
            </div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    @if(empty($skm->no_surat) && Auth::user()->roles()->first()->id != 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Operator</code>
        </div>
    </div>
    @elseif($skm->verifikasi_kasi == '0' &&$skm->verifikasi_sekdes == '0' && !empty($skm->no_surat) &&
    Auth::user()->roles()->first()->id != 'kasi')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kasi</code>
        </div>
    </div>
    @elseif($skm->verifikasi_sekdes == '0' && $skm->verifikasi_kasi == '1' && Auth::user()->roles()->first()->id !=
    'sekretaris_desa')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Sekretaris Desa</code>
        </div>
    </div>
    @elseif($skm->verifikasi_sekdes == '1' && $skm->verifikasi_kades == '0' && Auth::user()->roles()->first()->id ==
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
                        <h4>Detail Surat Keterangan Kematian</h4>
                    </div>
                    <div class="card-body">
                        <h5>Data Jenazah</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                {{($skm->no_surat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Kepala Keluarga</label>
                            <div class="col-sm-9">
                                {{($skm->nama_kepala_keluarga)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Kartu Keluarga</label>
                            <div class="col-sm-9">
                                {{($skm->no_kk)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_jenazah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_jenazah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                {{($skm->jk_jenazah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                {{($skm->tempat_lahir)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                {{($skm->agama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir </label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skm->tgl_lahir_jenazah)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skm->pekerjaanJenazah->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {{($skm->alamat_jenazah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->provinsiJenazah->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kotaJenazah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kecamatanJenazah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->areaJenazah->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                {{($skm->kewarganegaraan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kebangsaan</label>
                            <div class="col-sm-9">
                                {{($skm->kebangsaan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keturunan</label>
                            <div class="col-sm-9">
                                {{($skm->keturunan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Anak Ke</label>
                            <div class="col-sm-9">
                                {{($skm->anak_ke)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Kematian </label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skm->tgl_kematian)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pukul </label>
                            <div class="col-sm-9">
                                {{($skm->pukul)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sebab Kematian </label>
                            <div class="col-sm-9">
                                {{($skm->sebab_kematian)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Kematian </label>
                            <div class="col-sm-9">
                                {{($skm->tempat_kematian)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Yang Menerangkan </label>
                            <div class="col-sm-9">
                                {{($skm->yang_menerangkan)??'-'}}
                            </div>
                        </div>
                        <h5>Data Ibu</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_ibu)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_ibu)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">
                                {{($skm->umur_ibu)??'-'}} Tahun
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skm->pekerjaanIbu->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skm->alamat_ibu)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->provinsiIbu->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kotaIbu->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kecamatanIbu->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->areaIbu->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Data Ayah</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_ayah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_ayah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">
                                {{($skm->umur_ayah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skm->pekerjaanAyah->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skm->alamat_ayah)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->provinsiAyah->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kotaAyah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->kecamatanAyah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skm->areaAyah->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Data Pelapor</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">
                                {{($skm->umur_pelapor)??'-'}} Tahun
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skm->pekerjaanPelapor->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {{($skm->alamat_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hubungan Dengan yang meninggal</label>
                            <div class="col-sm-9">
                                {{($skm->hubungan)??'-'}}
                            </div>
                        </div>
                        <h5>Data Saksi 1</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_saksi1)??'-'}}
                            </div>
                        </div>

                        <h5>Data Saksi 2</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skm->nik_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skm->nama_saksi2)??'-'}}
                            </div>
                        </div>

                        <h5>Dokumen Penunjang</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File SK Rumah Sakit</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs)}}"
                                    target="_blank">
                                    <img src="{{asset('storage/backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Alm</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Pelapor</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Saksi</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi)}}"
                                        width="200px"></a>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.dokumen.skm')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1 && $skm->status == '1' && empty($skm->no_surat) &&
                        Auth::user()->roles()->first()->id == 'operator')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rejectedOperator"
                            data-id="{{$skm->encodeHash($skm->id)}}" class="operator btn btn-md btn-danger btn-icon"
                            title="Tolak">Tolak</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#acceptedOperator"
                            data-id="{{$skm->encodeHash($skm->id)}}" class="operator btn btn-md btn-success btn-icon"
                            title="Terima">Terima</a>
                        @elseif(!empty($skm->no_surat) && Auth::user()->roles()->first()->id == 'kasi' && $skm->kasi_id
                        == Auth::guard('admin')->user()->id)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKasi"
                            data-id="{{$skm->encodeHash($skm->id)}}" class="kasi btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skm->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' &&
                        $skm->verifikasi_kasi == '1'&&
                        $skm->verifikasi_sekdes == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiSekdes"
                            data-id="{{$skm->encodeHash($skm->id)}}" class="sekdes btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skm->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' &&
                        $skm->verifikasi_kasi
                        == '1' && $skm->verifikasi_sekdes == '1' && $skm->verifikasi_kades == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKades"
                            data-id="{{$skm->encodeHash($skm->id)}}" class="kades btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skm.reject')}}" method="post">
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
<form action="{{route('backend.dokumen.skm.accept')}}" method="post">
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
<form action="{{route('backend.dokumen.skm.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id',$skm->encodeHash($skm->id))}}" name="id">
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
<form action="{{route('backend.dokumen.skm.sekdes')}}" method="post">
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
<form action="{{route('backend.dokumen.skm.kasi')}}" method="post">
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
