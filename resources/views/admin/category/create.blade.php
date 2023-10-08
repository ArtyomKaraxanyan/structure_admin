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
                    <h5 class="card-title">{{ __('Create Category') }}</h5>

                    <form class="row g-3" method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <div class="col-md-8 m-auto">
                                <div class="form-floating has-validation mb-3">
                               <select class="select_parent select2" id="select_parent" name="parent_id">
                                   <option value="">---</option>
                                   @forelse($parents as $parent)
                                   <option value="{{$parent->id}}"{{old('parent_id')==$parent->id?'selected':''}}>{{$parent->name}}</option>
                                       @empty
                                   @endforelse
                               </select>
                                </div>
                                <div class="form-floating has-validation mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" placeholder="{{__('Category name')}}"
                                           value="{{old('name')}}">
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
                                    <button type="submit" class="btn btn-success" id="save">{{__('Create')}}</button>
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

@endsection