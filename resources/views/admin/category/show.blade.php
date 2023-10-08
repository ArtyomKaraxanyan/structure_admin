@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'/'}}l">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card text-center">
                    <div class="card-title"><h1>{{$category->name}}</h1></div>
                    <div class="card-body ">
                        <div>
                            <img src="{{ asset('storage/uploads/category/original/'.$category->image) }}" alt="" style="max-width: 300px">
                        </div>
                        <div>

                         <p style="color:green;">{{!is_null($category->parent())?'Parent':''}}</p>
                            <a href="{{!is_null($category->parent())?route('categories.show',$category->parent()->slug):'#'}}"> <h3>{{!is_null($category->parent())?$category->parent()->name:''}}</h3></a>
                        </div>
                        <a href="{{ route('categories.edit', $category->id) }}"
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
                               data-url="{{ route('categories.destroy', $category->id) }}"
                               title="{{ __('Delete') }}"><i class="bi bi-trash"></i>
                            </a>
                        </form>
                    </div>
                </div>
                <div class="card-title"><h5>Add childes</h5></div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="{{route('categories.add.child.category',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-md-8 m-auto">
                                <div class="form-floating has-validation mb-3">
                                    <select class="select_parent select2" id="select_parent" name="child[]" multiple="multiple">
                                        @forelse($childCategories as $itemChild)
                                            <option value="{{$itemChild->id}}">{{$itemChild->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" id="save">{{__('Add')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="accordion" id="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#category_child" aria-expanded="false" aria-controls="category_child">
                                Category Child
                            </button>
                        </h2>
                        <div id="category_child" class="accordion-collapse collapse" aria-labelledby="category_child" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-lg-12 m-auto">

                                <div class="card-title"><h5>Category childes</h5></div>
                                <div class="card-body">


                                    <div class="table-responsive" id="data-list">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Actions</th>
                                                <th scope="col">Remove Child</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($category->child() as $child)
                                                <tr>
                                                    <th scope="row">{{ $child->id }}</th>
                                                    <td>
                                                        <img src="{{ asset('storage/uploads/category/100x100/'.$child->image) }}"
                                                             alt="">
                                                    </td>
                                                    <td><a href="{{route('categories.show',$child->slug)}}"> <h3>{{$child->name}}</h3></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('categories.edit', $child->id) }}"
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
                                                               data-url="{{ route('categories.destroy', $child->id) }}"
                                                               title="{{ __('Delete') }}">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                    <td>

                                                        <form method="post" action="" class="d-inline-block delete_item">
                                                            @method('POST')
                                                            @csrf
                                                            <a type="button"
                                                               class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                                                               data-url="{{ route('categories.removeChild', $child->id) }}"
                                                               title="{{ __('Remove Child') }}">
                                                                <i class="bi bi-x-circle"></i>
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
                        </div>
                    </div>
                </div>

                <div class="card-title"><h5>Products childes</h5></div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="{{route('categories.add.child.product',$category->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <div class="col-md-8 m-auto">
                                <div class="form-floating has-validation mb-3">
                                    <select class="select_parent select2" id="select_child" name="products[]" multiple="multiple">
                                        @forelse($childProducts as $childProduct)
                                            <option value="{{$childProduct->id}}">{{$childProduct->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" id="save">{{__('Add')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="accordion" id="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_child" aria-expanded="false" aria-controls="product_child">
                              Product Child
                            </button>
                        </h2>
                        <div id="product_child" class="accordion-collapse collapse" aria-labelledby="product_child" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-lg-12 m-auto">
                                    <div class="table-responsive" id="data-list">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Actions</th>
                                                <th scope="col">Remove Child</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($category->products() as $product)
                                                <tr>
                                                    <th scope="row">{{ $product->id }}</th>
                                                    <td>
                                                        <img src="{{ asset('storage/uploads/product/100x100/'.$product->image) }}"
                                                             alt="">
                                                    </td>
                                                    <td><a href="{{route('products.show',$product->slug)}}"> <h3>{{$product->name}}</h3></a>
                                                    </td>
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
                                                            <a type="button"
                                                               class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                                                               data-url="{{ route('products.destroy', $product->id) }}"
                                                               title="{{ __('Delete') }}">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                    <td>

                                                        <form method="post" action="" class="d-inline-block delete_item">
                                                            @method('POST')
                                                            @csrf
                                                            <a type="button"
                                                               class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                                                               data-url="{{ route('categories.removeChildProduct', $product->id) }}"
                                                               title="{{ __('Remove Child') }}">
                                                                <i class="bi bi-x-circle"></i>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
