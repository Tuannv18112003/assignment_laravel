<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('dashboard');
});


// Admin routes product
Route::prefix('/product')->name('product.')->group(function () {
    Route::get('/add', [ProductsController::class, 'addProducts'])->name('add');
    Route::post('/add', [ProductsController::class, 'postProducts'])->name('post');

    Route::get('/list', [ProductsController::class, 'listProducts'])->name('list');
    Route::get('/edit/{id}', [ProductsController::class, 'getEditProducts'])->name('get_edit');
    Route::post('/update', [ProductsController::class, 'editProducts'])->name('edit');
    Route::get('/delete/{id}', [ProductsController::class, 'deleteProducts'])->name('delete');
});

// Admin routes brands
Route::prefix('/brand')->name('brand.')->group(function () {
    Route::get('/list', [BrandsController::class, 'listBrands'])->name('list');
    Route::get('/add', [BrandsController::class, 'addBrands'])->name('add');
    Route::post('/add', [BrandsController::class, 'postBrands'])->name('post');
    Route::get('/edit/{id}', [BrandsController::class, 'editBrands'])->name('get_edit');
    // Route::get('/edit/{id}', [BrandsController::class, 'editBrands'])->name('get_edit');
    Route::get('/delete/{id}', [BrandsController::class, 'deleteBrands'])->name('delete');
});
