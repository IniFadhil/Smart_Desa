@extends('backend.layouts.app')

@section('title') Komentar @endsection

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
        <h1>Komentar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Informasi</div>
            <div class="breadcrumb-item"><a href="{{route('backend.informasi.komentar')}}"> Komentar</a></div>
            <div class="breadcrumb-item active">List</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Komentar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Judul</th> -->
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Komentar</th>                                        
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($komentar as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <!-- <td>
                                        @if($row->kategori == 'berita')
                                            {{($row->berita->title)??'-'}}
                                        @elseif($row->kategori == 'agenda')
                                            {{($row->agenda->title)??'-'}}
                                        @elseif($row->kategori == 'pengumuman')
                                            {{($row->pengumuman->title)??'-'}}
                                        @else
                                            {{($row->infoGrafis->title)??'-'}}
                                        @endif
                                        </td> -->
                                        <td>{{$row->kategori}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->komentar}}</td>
                                        <td>
                                            @if(Session::get('permission')->update == 1)
                                            <a href="{{route('backend.informasi.komentar.reply',['id' => $row->encodeHash($row->id)])}}"
                                                class="btn btn-md btn-primary btn-icon" title="Balas"><i class="fas fa-comment-dots"></i></a>
                                            @if($row->status == 'show')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#inactiveConfirmation"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="ubah btn btn-md btn-danger btn-icon" title="Sembunyikan"><i
                                                    class="fas fa-bullhorn"></i></a>
                                            @else
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#activeConfirmation"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="ubah btn btn-md btn-success btn-icon" title="Tampilkan"><i
                                                    class="fas fa-bullhorn"></i></a>
                                            @endif
                                            @endif
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#deleteConfirmation"
                                                data-id="{{$row->encodeHash($row->id)}}"
                                                class="ubah btn btn-md btn-danger btn-icon" title="Hapus"><i
                                                    class="fas fa-trash"></i></a>
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
<form action="{{route('backend.informasi.komentar.active')}}" method="post">
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
<form action="{{route('backend.informasi.komentar.inactive')}}" method="post">
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
<form action="{{route('backend.informasi.komentar.delete')}}" method="post">
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
                    <p>Apakah Anda Yakin Menghapus Data Ini?</p>
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
