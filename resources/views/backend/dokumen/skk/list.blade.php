@extends('backend.layouts.app')

@section('title') Surat Keterangan Kelahiran @endsection

@section('top-resource')
<link rel="stylesheet" href="{{asset('backend/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/node_modules/chocolat/dist/css/chocolat.css')}}">
@endsection

@section('bottom-resource')
<script src="{{asset('backend/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('backend/node_modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{asset('backend/node_modules/jquery-ui-dist/jquery-ui.min.js')}}"></script>
<script>
    $('.ubah').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })

    $('.delete').click(function () {
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
    
    $('#closeModal').click(function () {
        $('#printConfirmation').modal('hide');
    })
</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->read == 1 || Session::get('permission')->create == 1 ||
Session::get('permission')->update == 1 || Session::get('permission')->delete == 1)
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Kelahiran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Dokumen</div>
            <div class="breadcrumb-item"><a href="{{route('backend.dokumen.skk')}}"> Surat Keterangan Kelahiran</a></div>
            <div class="breadcrumb-item active">List</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Pengajuan Surat Keterangan Kelahiran</h4>
                        <div class="card-header-action">
                            @if(Session::get('permission')->create == 1)
                            <!-- <a href="#" data-toggle="modal" data-target="#importConfirmation"
                                class="btn btn-warning btn-icon"><i class="fas fa-plus-circle"></i> Import</a> -->
                            <a href="{{route('backend.dokumen.skk.create')}}" class="btn btn-success btn-icon"><i
                                    class="fas fa-plus-circle"></i> Tambah</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bayi</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Verifikasi Kasi</th>
                                        <th>Verifikasi Sekdes</th>
                                        <th>Verifikasi Kades</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($skk as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->nama_bayi}}</td>
                                        <td>{{$row->jk_bayi}}</td>
                                        <td>{{($row->tgl_lahir_bayi)??'-'}}</td>
                                        <td><span class="badge badge-{{($row->verifikasi_kasi =='1')?'success':'warning'}}">{{($row->verifikasi_kasi == '1')?'Selesai':'Belum'}}</span></td>
                                        <td><span class="badge badge-{{($row->verifikasi_sekdes =='1')?'success':'warning'}}">{{($row->verifikasi_sekdes == '1')?'Selesai':'Belum'}}</span></td>
                                        <td><span class="badge badge-{{($row->verifikasi_kades =='1')?'success':'warning'}}">{{($row->verifikasi_kades == '1')?'Selesai':'Belum'}}</span></td>
                                        <td>{{\Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y')}}</td>
                                        <td>
                                            @if(Session::get('permission')->update == 1)
                                            @if(!empty($row->no_surat) && Auth::user()->roles()->first()->id == 'operator' && $row->verifikasi_kasi == '1' && $row->verifikasi_sekdes == '1' && $row->verifikasi_kades == '1')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#printConfirmation"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="ubah btn btn-md btn-warning btn-icon" title="Print Dokumen"><i
                                                    class="fas fa-print"></i></a>
                                            @endif
                                            @endif
                                            @if(!empty($row->no_surat) && Auth::user()->roles()->first()->id == 'kasi' && $row->verifikasi_kasi == '0')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#verifikasiKasi"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="kasi btn btn-md btn-success btn-icon" title="Verifikasi"><i
                                                    class="fas fa-check-circle"></i></a>
                                            @endif
                                            @if(!empty($row->no_surat) && Auth::user()->roles()->first()->id == 'sekretaris_desa' && $row->verifikasi_kasi == '1' && $row->verifikasi_sekdes == '0')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#verifikasiSekdes"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="sekdes btn btn-md btn-success btn-icon" title="Verifikasi"><i
                                                    class="fas fa-check-circle"></i></a>
                                            @endif
                                            @if(!empty($row->no_surat) && Auth::user()->roles()->first()->id == 'kepala_desa' && $row->verifikasi_kasi == '1' && $row->verifikasi_sekdes == '1' && $row->verifikasi_kades == '0')
                                            {{--<a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#verifikasiKades"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="kades btn btn-md btn-success btn-icon" title="Verifikasi"><i
                                                    class="fas fa-check-circle"></i></a>--}}
                                            @endif
                                            @if(Session::get('permission')->delete == 1 && Auth::user()->roles()->first()->id == 'operator' && $row->status == '0')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#deleteConfirmation"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="delete btn btn-md btn-danger btn-icon" title="Hapus"><i
                                                    class="fas fa-trash"></i></a>
                                            @endif
                                            @if(Session::get('permission')->read == 1)
                                            <a href="{{route('backend.dokumen.skk.detail',['id' => $row->encodeHash($row->id)])}}"
                                                class="btn btn-md btn-secondary btn-icon" title="Detail"><i
                                                    class="fas fa-info-circle"></i></a>
                                            @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="{{route('backend.dokumen.skk.print')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="printConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan mencetak data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-success" id="closeModal">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.dokumen.skk.kades')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
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
<form action="{{route('backend.dokumen.skk.delete')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin mengahpus data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
@else
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
