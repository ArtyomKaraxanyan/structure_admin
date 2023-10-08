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
                <div class="col-lg-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product List</h5>
                            <h5 class="card-title">
                                <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-success text-capitalize">
                                    + Create
                                </a>
                            </h5>
                            <div class="table-responsive" id="data-list">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>
                                                <img src="{{ asset('storage/uploads/product/100x100/'.$product->image) }}" alt="" >
                                            </td>
                                            <td>
                                                <a href="{{!is_null($product->parent())?route('categories.show',$product->parent()->slug):'#'}}"> {{!is_null($product->parent())?$product->parent()->name:''}}</a>
                                            </td>
                                          <td>   <a href="{{route('products.show',$product->slug)}}">{{ $product->name }} </a></td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                   title="{{ __('Edit') }}"
                                                   type="button"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="post" action="" class="d-inline-block delete_item">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="button" class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                                                       data-url="{{ route('products.destroy', $product->id) }}"
                                                       title="{{ __('Delete') }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                Empty data
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $products->links(".admin.partials.pagination") !!}
                </div>
            </div>
        </section>
@endsection
