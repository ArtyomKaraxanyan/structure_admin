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
            <div class="col-lg-12 m-auto">
                <div class="card text-center">
                    <div class="card-title"><h1>{{$product->name}}</h1></div>
                    <div class="card-body ">
                        <div>
                            <img src="{{ asset('storage/uploads/product/original/'.$product->image) }}" alt="" style="max-width: 300px">
                        </div>
                        <div>

                         <p style="color:green;">{{!is_null($product->parent())?'Parent':''}}</p>
                            <a href="{{!is_null($product->parent())?route('categories.show',$product->parent()->slug):'#'}}"> <h3>{{!is_null($product->parent())?$product->parent()->name:''}}</h3></a>
                            <b>{{$product->price}}</b>
                            <p> {{$product->description}}</p>
                        </div>
                        <a href="{{ route('products.edit', $product->id) }}"
                           title="{{ __('Edit') }}"
                           type="button"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="post" action="" class="d-inline-block delete_item">
                            @method('DELETE')
                            @csrf
                            <a type="button"
                               class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                               data-url="{{ route('products.destroy', $product->id) }}"
                               title="{{ __('Delete') }}"><i class="bi bi-trash"></i>
                            </a>
                        </form>
                    </div>
                </div>

            </div>
            </div>
    </section>
@endsection
