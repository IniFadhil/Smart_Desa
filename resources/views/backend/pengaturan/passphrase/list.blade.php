@extends('backend.layouts.app')

@section('title') Passphrase @endsection

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

</script>
@endsection

@section('content')

@if(!empty(Session::get('permission')))
@if(Session::get('permission')->read == 1 || Session::get('permission')->create == 1 ||
Session::get('permission')->update == 1 || Session::get('permission')->delete == 1)
<section class="section">
    <div class="section-header">
        <h1>Passphrase</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Pengaturan</div>
            <div class="breadcrumb-item"><a href="{{route('backend.pengaturan.passphrase')}}"> Passphrase</a></div>
            <div class="breadcrumb-item active">List</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            @if(count($passphrase) == 0 && Session::get('permission')->create == 1)
            <div class="col-12">
                <div class="card">
                    <form method="post" action="{{route('backend.pengaturan.passphrase.create')}}"
                        enctype="multipart/form-data" id="mainform">
                        {{csrf_field()}}
                        <div class="card-header">
                            <h4>Form Passphrase</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Passphrase</label>
                                <div class="col-sm-9">
                                    <input type="password"
                                        class="form-control {{($errors->has('passphrase'))?'is-invalid':''}}"
                                        name="passphrase" value="" placeholder="Passphrase harus mengandung minimal 1 Huruf Kapital dan 1 Angka dan tidak boleh mengandung simbol">
                                    @if($errors->has('passphrase'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('passphrase')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Passphrase</h4>
                        <div class="card-header-action">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Passphrase</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($passphrase as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{!!($row->passphrase)??'-'!!}</td>
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
<form action="{{route('backend.manajemen.modul.active')}}" method="post">
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
<form action="{{route('backend.manajemen.modul.inactive')}}" method="post">
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
<!-- <form action="{{route('backend.manajemen.modul')}}" method="post" enctype="multipart/form-data">
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
