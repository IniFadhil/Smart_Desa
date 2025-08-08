@extends('backend.layouts.app')

@section('title') Galeri Foto @endsection

@section('top-resource')
<link rel="stylesheet" href="{{asset('public/backend/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/chocolat/dist/css/chocolat.css')}}">
@endsection

@section('bottom-resource')
<script src="{{asset('public/backend/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('public/backend/node_modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/jquery-ui-dist/jquery-ui.min.js')}}"></script>
<script>
    $('.ubah').click(function () {
        var id = $(this).data('id');
        $('.id').val(id);
    })

</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->read == 1 || Session::get('permission')->create == 1 ||
Session::get('permission')->update == 1 || Session::get('permission')->delete == 1)
<section class="section">
    <div class="section-header">
        <h1>Galeri</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Galeri</div>
            <div class="breadcrumb-item"><a href="#">Foto</a></div>
            <div class="breadcrumb-item active">List</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Foto</h4>
                        <div class="card-header-action">
                            @if(Session::get('permission')->create == 1)
                            <!-- <a href="#" data-toggle="modal" data-target="#importConfirmation"
                                class="btn btn-warning btn-icon"><i class="fas fa-plus-circle"></i> Import</a> -->
                            <a href="{{route('backend.galeri.foto.create')}}" class="btn btn-success btn-icon"><i
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
                                        <th>Judul</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                  $i = 1;
                                  @endphp
                                  @foreach($fotos as $row)
                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$row->title}}</td>
                                      <td>{{$row->img}}</td>
                                      <td>{{$row->status}}</td>
                                      <td>
                                        @if(Session::get('permission')->update == 1)
                                        <a href="{{route('backend.galeri.foto.edit',['id' => $row->encodeHash($row->id)])}}"
                                            class="btn btn-md btn-primary btn-icon" title="Edit"><i
                                                class="far fa-edit"></i></a>
                                        @if($row->status == 'show')
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#inactiveConfirmation"
                                            data-id="{{$row->encodeHash($row->id)}}"
                                            class="ubah btn btn-md btn-danger btn-icon" title="Non Aktifkan"><i
                                                class="fas fa-power-off"></i></a>
                                        @else
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#activeConfirmation"
                                            data-id="{{$row->encodeHash($row->id)}}"
                                            class="ubah btn btn-md btn-success btn-icon" title="Aktifkan"><i
                                                class="fas fa-power-off"></i></a>
                                        @endif
                                        @endif
                                        @if(Session::get('permission')->read == 1)
                                        <a href="{{route('backend.galeri.foto.detail',['id' => $row->encodeHash($row->id)])}}"
                                            class="btn btn-md btn-secondary btn-icon" title="Detail"><i
                                                class="fas fa-info-circle"></i></a>
                                        @endif
                                      </td>
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
<form action="{{route('backend.galeri.foto.active')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="activeConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Mengaktifkan Data Ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('backend.galeri.foto.inactive')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" class="id" value="" name="id">
    <div class="modal fade" tabindex="-1" role="dialog" id="inactiveConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Menonaktifkan Data Ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form>
<!-- <form action="{{route('backend.informasi.infoGrafis')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal fade" tabindex="-1" role="dialog" id="importConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" id="" value="" name="pegawai">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>

                </div>
            </div>
        </div>
    </div>
</form> -->
@else
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"

</script>
@endif
@endsection
