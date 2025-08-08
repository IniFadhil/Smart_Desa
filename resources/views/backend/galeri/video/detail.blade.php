@extends('backend.layouts.app')

@section('title') Galeri Video @endsection

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
            <div class="breadcrumb-item"> <a href="{{route('backend.galeri.video')}}">Video</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Video</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                {{($video->title)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                {!!($video->description)??'-'!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">URL</label>
                            <div class="col-sm-9">
                                {!!($video->url)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dibuat</label>
                            <div class="col-sm-9">
                                {!!($video->created_by)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                {!!($video->created_at)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <span class="badge badge-{{($video->status == 'show')?'success':'danger'}}">
                                    {{($video->status == 'show')?'Aktif':'Tidak Aktif'}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Video</label>
                            <div class="col-sm-9">
                                <iframe frameBorder="0" src="{{str_replace('watch?v=','embed/',$video->url)}}" width="600px" height="400px"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.galeri.video')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1)
                        <a href="{{route('backend.galeri.video.edit',['id'=> $video->encodeHash($video->id)])}}"
                            class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
