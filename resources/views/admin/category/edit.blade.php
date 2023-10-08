@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card m-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Update Category') }}</h5>

                        <form class="row g-3" action="{{route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <div class="col-md-8 m-auto">
                                    @if($category->image)
                                    <div class="mb-3 manage_image" >
                                        <img src="{{ asset('storage/uploads/category/100x100/'.$category->image) }}" title="{{$category->image}}" >
                                        <i class="bi bi-trash image_remove" data-url="{{route('image_delete',$category->id)}}"></i>
                                    </div>
                                    @endif
                                    <div class="form-floating has-validation mb-3">
                                        <select class="select_parent select2" id="select_parent" name="parent_id">
                                            <option value="">---</option>
                                            @forelse($parents as $parent)
                                                <option value="{{$parent->id}}" {{$parent->id == $category->parent_id? 'selected' :''}}>{{$parent->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-floating has-validation mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="{{__('Category name')}}"
                                               value="{{$category->name}}">
                                        @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <label for="name">{{ __('Category name') }}</label>
                                    </div>

                                    <div class="mb-3">
                                        <h6 >{{ __('Category image') }}</h6>
                                        <div class="upload-content d-flex">
                                            <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                                   id="image" name="image"  placeholder="{{__('Category image')}}"
                                                   value="{{old('image')}}">
                                            @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" id="">{{__('Update')}}</button>
                                        <button type="reset" class="btn btn-secondary">{{__('Reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
<script>


</script>
@endsection