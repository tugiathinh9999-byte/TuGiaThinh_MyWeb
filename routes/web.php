<?php
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;

Route::get('/', function () {
    return view('welcome');
});

//Demo
Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);


//---------------------------------------------------
Route::prefix('admin')->group(function () {

    Route::resource('category', CategoryController::class);

    Route::resource('brand', BrandController::class);

    Route::resource('product', ProductController::class);

    Route::resource('user', UserController::class);

    Route::resource('post', PostController::class);

});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin', function () {
    return view('admin.layouts.admin');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');

Route::resource('admin/categories', CategoryController::class)
    ->names('admin.categories');

Route::resource('admin/brands', BrandController::class)
    ->names('admin.brands');

Route::resource('admin/users', UserController::class)
    ->names('admin.users');

Route::resource('admin/products', ProductController::class)
    ->names('admin.products');

Route::resource('admin/posts', PostController::class)
    ->names('admin.posts');

//goi test1,2
Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);
