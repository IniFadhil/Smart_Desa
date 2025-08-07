@extends('backend.layouts.app')

@section('title') Surat Keterangan Kelahiran @endsection

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
        <h1>Surat Keterangan Kelahiran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.dokumen.skk')}}"> Surat Keterangan Kelahiran</a>
            </div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    @if(empty($skk->no_surat) && Auth::user()->roles()->first()->id != 'operator')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Operator</code>
        </div>
    </div>
    @elseif($skk->verifikasi_kasi == '0' &&$skk->verifikasi_sekdes == '0' && !empty($skk->no_surat) &&
    Auth::user()->roles()->first()->id != 'kasi')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Kasi</code>
        </div>
    </div>
    @elseif($skk->verifikasi_sekdes == '0' && $skk->verifikasi_kasi == '1' && Auth::user()->roles()->first()->id !=
    'sekretaris_desa')
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Belum di verifikasi oleh <code>Sekretaris Desa</code>
        </div>
    </div>
    @elseif($skk->verifikasi_sekdes == '1' && $skk->verifikasi_kades == '0' && Auth::user()->roles()->first()->id ==
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
                        <h4>Detail Surat Keterangan Kelahiran</h4>
                    </div>
                    <div class="card-body">
                        <h5>Data Bayi</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                {{($skk->no_surat)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Kepala Keluarga</label>
                            <div class="col-sm-9">
                                {{($skk->nama_kepala_keluarga)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Kartu Keluarga</label>
                            <div class="col-sm-9">
                                {{($skk->no_kk)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Bayi</label>
                            <div class="col-sm-9">
                                {{($skk->nama_bayi)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin Bayi</label>
                            <div class="col-sm-9">
                                {{($skk->jk_bayi)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Dilahirkan</label>
                            <div class="col-sm-9">
                                {{($skk->tempat_dilahirkan)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                {{($skk->tempat_lahir)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hari</label>
                            <div class="col-sm-9">
                                {{($skk->hari)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir Bayi</label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skk->tgl_lahir_bayi)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pukul</label>
                            <div class="col-sm-9">
                                {{($skk->pukul)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelahiran</label>
                            <div class="col-sm-9">
                                {{($skk->jenis_kelahiran)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kelahiran ke</label>
                            <div class="col-sm-9">
                                {{($skk->kelahiran_ke)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Penolong Kelahiran</label>
                            <div class="col-sm-9">
                                {{($skk->penolong_kelahiran)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Berat Bayi</label>
                            <div class="col-sm-9">
                                {{($skk->berat_bayi)??'-'}} kg
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Panjang Bayi</label>
                            <div class="col-sm-9">
                                {{($skk->panjang_bayi)??'-'}} cm
                            </div>
                        </div>
                        <h5>Data Ibu</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skk->nik_ibu)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skk->nama_ibu)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skk->tgl_lahir_ibu)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skk->pekerjaanIbu->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skk->alamat_ibu)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->provinsiIbu->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kotaIbu->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kecamatanIbu->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->areaIbu->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                {!!($skk->kewarganegaraan_ibu)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kebangsaan</label>
                            <div class="col-sm-9">
                                {!!($skk->kebangsaan_ibu)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Pencatatan Perkawinan</label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skk->tgl_pencatatan_perkawinan)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <h5>Data Ayah</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skk->nik_ayah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skk->nama_ayah)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                {{\Carbon\Carbon::parse($skk->tgl_lahir_ayah)->translatedFormat('d M Y')??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skk->pekerjaanAyah->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skk->alamat_ayah)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->provinsiAyah->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kotaAyah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kecamatanAyah->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->areaAyah->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                {!!($skk->kewarganegaraan_ayah)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kebangsaan</label>
                            <div class="col-sm-9">
                                {!!($skk->kebangsaan_ayah)??'-'!!}
                            </div>
                        </div>
                        <h5>Data Pelapor</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skk->nik_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skk->nama_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">{{($skk->umur_pelapor)??'-'}} Tahun
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">{{($skk->jk_pelapor)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skk->pekerjaanPelapor->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skk->alamat_pelapor)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->provinsiPelapor->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kotaPelapor->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kecamatanPelapor->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->areaPelapor->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Data Saksi 1</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skk->nik_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skk->nama_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">{{($skk->umur_saksi1)??'-'}} Tahun
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">{{($skk->jk_saksi1)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skk->pekerjaanSaksi1->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skk->alamat_saksi1)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->provinsiSaksi1->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kotaSaksi1->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kecamatanSaksi1->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->areaSaksi1->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Data Saksi 2</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                {{($skk->nik_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                {{($skk->nama_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">{{($skk->umur_saksi2)??'-'}} Tahun
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">{{($skk->jk_saksi2)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{($skk->pekerjaanSaksi2->nama)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                {!!($skk->alamat_saksi2)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->provinsiSaksi2->nama))??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kotaSaksi2->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->kecamatanSaksi2->nama))??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                {!!ucwords(strtolower($skk->areaSaksi2->nama))??'-'!!}
                            </div>
                        </div>
                        <h5>Dokumen Penunjang</h5><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File SK Kelahiran</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran)}}"
                                    target="_blank">
                                    <img src="{{asset('storage/backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Surat Nikah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah)}}"
                                    target="_blank"><img
                                        src="{{asset('storage/backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skk/kk/'.$skk->file_kk)}}" target="_blank"
                                    width="200px"><img src="{{asset('storage/backend/images/dokumen/skk/kk/'.$skk->file_kk)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Ayah</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File KTP Ibu</label>
                            <div class="col-sm-9">
                                <a href="{{asset('storage/backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu)}}"
                                    target="_blank" width="200px"><img
                                        src="{{asset('storage/backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu)}}"
                                        width="200px"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.dokumen.skk')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1 && $skk->status == '1' && empty($skk->no_surat) &&
                        Auth::user()->roles()->first()->id == 'operator')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rejectedOperator"
                            data-id="{{$skk->encodeHash($skk->id)}}" class="operator btn btn-md btn-danger btn-icon"
                            title="Tolak">Tolak</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#acceptedOperator"
                            data-id="{{$skk->encodeHash($skk->id)}}" class="operator btn btn-md btn-success btn-icon"
                            title="Terima">Terima</a>
                        @elseif(!empty($skk->no_surat) && Auth::user()->roles()->first()->id == 'kasi' && $skk->kasi_id
                        == Auth::guard('admin')->user()->id)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKasi"
                            data-id="{{$skk->encodeHash($skk->id)}}" class="kasi btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skk->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' &&
                        $skk->verifikasi_kasi == '1'&&
                        $skk->verifikasi_sekdes == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiSekdes"
                            data-id="{{$skk->encodeHash($skk->id)}}" class="sekdes btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @elseif(!empty($skk->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' &&
                        $skk->verifikasi_kasi
                        == '1' && $skk->verifikasi_sekdes == '1' && $skk->verifikasi_kades == '0')
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#verifikasiKades"
                            data-id="{{$skk->encodeHash($skk->id)}}" class="kades btn btn-md btn-success btn-icon"
                            title="Verifikasi">Verifikasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skk.reject')}}" method="post">
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
<form action="{{route('backend.dokumen.skk.accept')}}" method="post">
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
<form action="{{route('backend.dokumen.skk.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="{{old('id',$skk->encodeHash($skk->id))}}" name="id">
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
<form action="{{route('backend.dokumen.skk.sekdes')}}" method="post">
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
<form action="{{route('backend.dokumen.skk.kasi')}}" method="post">
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
