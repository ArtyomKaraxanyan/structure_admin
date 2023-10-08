<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category, $fileUpload, $product;

    public function __construct(CategoryRepository $category, FileRepository $fileRepository, ProductRepository $productRepository)
    {
        $this->category = $category;
        $this->fileUpload = $fileRepository;
        $this->product = $productRepository;
    }


    public function index()
    {
        $categories = $this->category->paginate();

        return view('admin.category.index', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = $this->category->all();
        return view('admin.category.create', ['parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $categoryRequest)
    {
        $newCategory = $categoryRequest->all();
        $newCategory['slug'] = str_replace(' ', '-', strtolower($newCategory['name']));
        if (isset($newCategory['image']

        )) {
            $data = ['image' => $newCategory['image'], 'directory' => 'category'];
            $image = $this->fileUpload->fileUpload($data);
            $newCategory['image'] = $image;
        }

        $this->category->create($newCategory);

        return redirect()->back()->withSuccess('Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $category = $this->category->findSlug($slug);
        $childCategories = $this->category->paginate()->whereNull('parent_id')->where('id', '!=', $category->id)->where('id', '!=', $category->parent_id);
        $childProducts = $this->product->paginate()->whereNull('category_id');
        return view('admin.category.show', ['category' => $category, 'childCategories' => $childCategories, 'childProducts' => $childProducts,]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = $this->category->all()->where('id', '!=', $id);
        $category = $this->category->findOrFail($id);
        if (!$category) {
            return abort(404);
        }
        return view('admin.category.edit', ['parents' => $parents, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $categoryData = $request->all();
        $categoryData['slug'] = str_replace(' ', '-', strtolower($categoryData['name']));
        if (isset($categoryData['image'])) {
            $image = $this->fileUpload->fileUpload(['directory' => 'category', 'image' => $categoryData['image']]);
            $categoryData['image'] = $image;
        }
        $this->category->update($category, $categoryData);

        return redirect()->back()->withSuccess('Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->category->delete($category);
        return redirect()->back();
    }

    public function deleteImage(Category $category)
    {
        $directory = 'category/';
        $this->fileUpload->fileDelete($category, $directory);
        return response()->json(['result' => 'success', 'code' => 200]);

    }

    public function addChildCategory(Category $category, Request $request)
    {

        if (!$request->child) {
            return redirect()->back()->with(['error' => 'Request not found']);

        }
        DB::table('categories')->whereIn('id', $request->child)->update(['parent_id' => $category->id]);
        return redirect()->back()->withSuccess('Updated!');

    }

    public function removeChildCategory(Category $category)
    {
        if (!$category) {
            return redirect()->back()->with(['error' => 'Request not found']);
        }
        $category->update(array('parent_id' => null));
        return redirect()->back()->withSuccess('Updated!');

    }

    public function addChildProducts(Category $category, Request $request)
    {

        if (!$request->products) {
            return redirect()->back()->with(['error' => 'Request not found']);
        }
        DB::table('products')->whereIn('id', $request->products)->update(['category_id' => $category->id]);
        return redirect()->back()->withSuccess('Updated!');

    }

    public function removeChildProduct(Product $product)
    {
        if (!$product) {
            return redirect()->back()->with(['error' => 'Request not found']);
        }
        $product->update(array('category_id' => null));
        return redirect()->back()->withSuccess('Updated!');

    }
}


