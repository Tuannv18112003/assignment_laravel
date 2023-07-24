<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SlidesController;
use App\Http\Controllers\HomeController;

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

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');



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
    Route::post('/update', [BrandsController::class, 'updateBrands'])->name('update');
    Route::get('/delete/{id}', [BrandsController::class, 'deleteBrands'])->name('delete');
});

// Admin routes slides
Route::prefix('/slide')->name('slide.')->group(function() {
    Route::get('/list', [SlidesController::class, 'listSlides'])->name('list');
    Route::get('/add', [SlidesController::class, 'addSlides'])->name('add');
    Route::post('/add', [SlidesController::class, 'postSlides'])->name('post');
    Route::get('/edit/{id}', [SlidesController::class, 'editSlides'])->name('get_edit');
    Route::post('/update', [SlidesController::class, 'updateSlides'])->name('update');
    Route::get('/delete/{id}', [SlidesController::class, 'deleteSlides'])->name('delete');
});


// ================================================================

// ROUTES FRONTEND 
Route::get('/', [HomeController::class, 'index'])->name('home');

