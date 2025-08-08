@extends('backend.layouts.app')

@section('title') Profil BUMDES @endsection

@section('top-resource')
<link rel="stylesheet" href="{{asset('public/backend/node_modules/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet"
    href="{{asset('public/backend/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/selectric/public/selectric.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
<script src="{{asset('public/backend/editor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('description');

</script>
@endsection

@section('bottom-resource')
<script src="{{asset('public/backend/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/backend/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/backend/node_modules/selectric/public/jquery.selectric.min.js')}}"></script>
<script src="{{asset('public/backend/js/page/forms-advanced-forms.js')}}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgId = '#preview-' + $(input).attr('id');
                $(imgId).attr('src', e.target.result);
                // $('.uploading1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // CKEDITOR.replace('ckeditor');
    $("form#mainform input[type='file']").change(function () {
        readURL(this);
    });

</script>
@endsection

@section('content')
@if(Session::get('permission'))
@if(Session::get('permission')->update == 1)
<section class="section">
    <div class="section-header">
      <h1>Profil BUMDES</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item">BUMDES</div>
          <div class="breadcrumb-item"><a href="{{route('backend.bumdes.profil')}}"> Profil</a></div>
          <div class="breadcrumb-item active">Edit</div>
      </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" enctype="multipart/form-data" id="mainform">
                        {{csrf_field()}}
                        <div class="card-header">
                            <h4>Form Edit Profil BUMDES</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama BUMDES</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="">
                                    <input type="text" class="form-control {{($errors->has('name'))?'is-invalid':''}}"
                                        name="name" value="{{old('name',$profil->name)}}">
                                    @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Deskripsi Singkat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control {{($errors->has('short_description'))?'is-invalid':''}}"
                                        name="short_description" value="{{old('short_description',$profil->short_description)}}">
                                    @if($errors->has('short_description'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('short_description')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea type="text"
                                        class="form-control summernote {{($errors->has('description'))?'is-invalid':''}}"
                                        id="description" name="description">{{old('description',$profil->description)}}</textarea>
                                </div>
                                @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{$errors->first('description')}}
                                </div>
                                @endif
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">Foto</label>
                                <div class="col-sm-9">
                                    <?php $img = asset('public/backend/images'); ?>
                                    <img src="<?php echo (!empty($profil->img) ? $img . '/bumdes/profil/' . $profil->img : $img . '/default.jpg') ?>"
                                        id="preview-img" style="width: 200px">
                                    <input type="file" class="form-control {{($errors->has('img'))?'is-invalid':''}}"
                                        id="img" name="img" value="{{$profil->img}}"
                                        accept="image/jpg,image/jpeg,image/png">
                                    @if($errors->has('img'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('img')}}
                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control select2">
                                        <option value="show" {{(old('status',$profil->status) == 'show')?'selected':''}}>Aktif
                                        </option>
                                        <option value="hide" {{(old('status',$profil->status) == 'hide')?'selected':''}}>Tidak
                                            Aktif
                                        </option>
                                    </select>
                                    @if($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('status')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{route('backend.bumdes.profil')}}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<script>
    window.location.href = "{{route('backend.bumdes.profil')}}"

</script>
@endif
@else
<script>
    window.location.href = "{{route('backend.dashboard')}}"
</script>
@endif
@endsection
