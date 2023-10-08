@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>

                <li class="breadcrumb-item active">Product</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card m-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Update Product') }}</h5>

                        <form class="row g-3" action="{{route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="col-md-8 m-auto">
                                    @if($product->image)
                                    <div class="mb-3 manage_image" >
                                        <img src="{{ asset('storage/uploads/product/100x100/'.$product->image) }}" title="{{$product->image}}" >
                                        <i class="bi bi-trash image_remove" data-url="{{route('product_image_delete',$product->id)}}"></i>
                                    </div>
                                    @endif
                                    <div class="form-floating has-validation mb-3">
                                        <select class="select_parent select2" id="select_parent" name="category_id">
                                            <option value="">---</option>
                                            @forelse($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' :''}}>{{$category->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-floating has-validation mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="{{__('Product name')}}"
                                               value="{{$product->name}}">
                                        @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <label for="name">{{ __('Product name') }}</label>
                                    </div>

                                        <div class="form-floating has-validation mb-3">
                                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                   id="price" name="price" placeholder="{{__('Product Price')}}"
                                                   value="{{$product->price}}">
                                            @error('price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <label for="name">{{ __('Product price') }}</label>
                                        </div>

                                        <div class="form-floating has-validation mb-3">
                                    <textarea   rows="4" cols="50" class="form-control @error('description') is-invalid @enderror"
                                                id="description" name="description">{{$product->description}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <label for="name">{{ __('Product description') }}</label>
                                        </div>

                                    <div class="mb-3">
                                        <h6 >{{ __('Product image') }}</h6>
                                        <div class="upload-content d-flex">
                                            <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                                   id="image" name="image"  placeholder="{{__('Product image')}}"
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