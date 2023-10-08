<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $product, $category, $fileUpload;

    public function __construct(ProductRepository $productRepository,CategoryRepository $categoryRepository,FileRepository $fileRepository)
    {
        $this->product=$productRepository;
        $this->category=$categoryRepository;
        $this->fileUpload=$fileRepository;

    }


    public function index()
    {
       $products= $this->product->paginate();

        return view('admin.product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories= $this->category->all();
        return view('admin.product.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $productRequest)
    {
        $newProduct=$productRequest->all();
        $newProduct['slug']=str_replace(' ', '-',strtolower($newProduct['name']));
        if (isset($newProduct['image'])){
            $data=['image'=>$newProduct['image'],'directory'=>'product'];
            $image =$this->fileUpload->fileUpload($data);
            $newProduct['image']=$image;
        }

        $this->product->create($newProduct);

        return redirect()->back()->withSuccess('Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product=$this->product->findSlug($slug);;

        return view('admin.product.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=$this->category->all();
        $product=$this->product->findOrFail($id);

        return view('admin.product.edit',['product'=>$product,'categories'=>$categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $productData = $request->all();
        $productData['slug']=str_replace(' ', '-',strtolower($productData['name']));
        if (isset($productData['image'])) {
            $image= $this->fileUpload->fileUpload(['directory'=>'product','image'=>$productData['image']]);
            $productData['image']=$image;
        }
        $this->product->update($product,$productData);

        return redirect()->back()->withSuccess('Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->product->delete($product);
        return redirect()->back();
    }

    public function deleteImage(Product $product)
    {
        $directory = 'product/';
        $this->fileUpload->fileDelete($product,$directory);
        return response()->json(['result'=>'success','code'=>200]);

    }

}
