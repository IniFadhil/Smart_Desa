@extends('backend.layouts.app')

@section('title') Produk BUMDES @endsection

@section('top-resource')
@endsection

@section('bottom-resource')
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Produk BUMDES</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item">BUMDES</div>
          <div class="breadcrumb-item"><a href="{{route('backend.bumdes.produk')}}"> Produk</a></div>
          <div class="breadcrumb-item active">Detail</div>
      </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama BUMDES</label>
                            <div class="col-sm-9">
                                {{($produk->bumdes->name)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                {{($produk->name)??'-'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-9">
                                {!!($produk->short_description)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                {!!($produk->description)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <img src="{{($produk->img)?asset('public/backend/images/bumdes/produk/'.$produk->img):asset('public/backend/images/default.jpg')}}" alt="" class="img-fluid" width="200px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dibuat</label>
                            <div class="col-sm-9">
                                {!!($produk->created_by)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Disunting</label>
                            <div class="col-sm-9">
                                {!!($produk->updated_by)??'-'!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <span class="badge badge-{{($produk->status == 'show')?'success':'danger'}}">
                                    {{($produk->status == 'show')?'Aktif':'Tidak Aktif'}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('backend.bumdes.produk')}}" class="btn btn-secondary">Kembali</a>
                        @if(Session::get('permission')->update == 1)
                        <a href="{{route('backend.bumdes.produk.edit',['id'=> $produk->encodeHash($produk->id)])}}"
                            class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
