@extends('backend.layouts.app')

@section('title') Galeri Foto @endsection

@section('top-resource')
@endsection

@section('bottom-resource')
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Galeri</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Galeri</div>
            <div class="breadcrumb-item"> <a href="{{route('backend.galeri.foto')}}">Foto</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Foto</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                {{($foto->title)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                {!!($foto->description)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dibuat</label>
                            <div class="col-sm-9">
                                {!!($foto->created_by)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                {!!($foto->created_at)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <span class="badge badge-{{($foto->status == 'show')?'success':'danger'}}">
                                    {{($foto->status == 'show')?'Aktif':'Tidak Aktif'}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <img src="{{asset('public/backend/images/galeri/foto/'.$foto->img)}}" alt="{{($foto->title)??'-'}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.galeri.foto')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1)
                        <a href="{{route('backend.galeri.foto.edit',['id'=> $foto->encodeHash($foto->id)])}}"
                            class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
