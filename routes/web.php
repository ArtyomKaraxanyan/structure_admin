<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

//Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::delete('/product/image/{product}', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('product_image_delete');

     Route::controller(CategoryController::class)->group(function (){
         Route::delete('/category/image/{category}', 'deleteImage')->name('image_delete');
         Route::post('/add/child/{category}', 'addChildCategory')->name('categories.add.child.category');
         Route::post('/add/child/product/{category}', 'addChildProducts')->name('categories.add.child.product');
         Route::post('/remove/child/{category}', 'removeChildCategory')->name('categories.removeChild');
         Route::post('/remove/child/product/{product}', 'removeChildProduct')->name('categories.removeChildProduct');
     });

    foreach (\App\Enums\RoutingEnum::routeing() as $key => $value){
        Route::resource(strtolower($key), $value);
}

});

