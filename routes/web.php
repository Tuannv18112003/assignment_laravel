<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\SlidesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\View\CartsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




// ================================================================

// ROUTES FRONTEND 

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');

// Shop
Route::get('/shop/{id?}', [HomeController::class, 'shop'])->name('shop'); 
// Route::get('/shop/list/{id?}', [HomeController::class, 'shop']);
// Route::post('shop/filter', [HomeController::class, 'filterProducts'])->name('shop.filter');


// Cart
// Route::get('/cart', [CartsController::class, 'addToCart'])->name('cart');
Route::get('/cart', [CartsController::class, 'viewCart'])->name('cart.view');;
Route::post('/cart', [CartsController::class, 'addToCart'])->name('cart');
Route::get('/cart/delete/{id}', [CartsController::class, 'deleteCart'])->name('cart.delete');
Route::get('/cart/checkout', [CartsController::class, 'checkoutCart'])->name('cart.checkout');
Route::get('/cart/pay', [CartsController::class, 'listCartPayment'])->name('cart.pay');

// Coupon
Route::post('cart/coupon', [CartsController::class, 'addCoupon'])->name('cart.coupon.add');

// relationship cart, product, clients;
Route::post('/checkout', [CartsController::class, 'addOrdersCarts'])->name('post.checkout');


Route::get( '/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/client/dashboard',[AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('client.dashboard');

Route::middleware(['auth', 'admin'])->group(function () {

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
    Route::prefix('/slide')->name('slide.')->group(function () {
        Route::get('/list', [SlidesController::class, 'listSlides'])->name('list');
        Route::get('/add', [SlidesController::class, 'addSlides'])->name('add');
        Route::post('/add', [SlidesController::class, 'postSlides'])->name('post');
        Route::get('/edit/{id}', [SlidesController::class, 'editSlides'])->name('get_edit');
        Route::post('/update', [SlidesController::class, 'updateSlides'])->name('update');
        Route::get('/delete/{id}', [SlidesController::class, 'deleteSlides'])->name('delete');
    });

    // Admin routes bills
    Route::prefix('/bill')->name('bill.')->group(function() {
        Route::get('/list', [OrdersController::class, 'listBill'])->name('list');
        Route::get('/list_details/{id}', [OrdersController::class, 'listDetails'])->name('details');
        Route::get('/update/{id}', [OrdersController::class, 'updateBills'])->name('update');
        Route::get('/delete/{id}', [OrdersController::class, 'deleteBills'])->name('delete');
    });


    // Admin routes coupons 
    Route::prefix('/coupon')->name('coupon.')->group(function() {
        Route::get('/list', [CouponsController::class, 'listCoupon'])->name('list');
        Route::get('/add', [CouponsController::class, 'addCoupon'])->name('add');
        Route::post('/add', [CouponsController::class, 'postCoupon'])->name('post');
        Route::get('/edit/{id}', [CouponsController::class, 'editCoupon'])->name('edit');
        Route::post('/update', [CouponsController::class, 'updateCoupon'])->name('update');
        Route::get('/delete/{id}', [CouponsController::class, 'deleteCoupon'])->name('delete');
    });


    // Admin profile
    // ADMIN ALL ROUTES
    Route::prefix('/admin')->group(function () {
        Route::get('/logout', [AdminController::class ,'logout'])->name('admin.logout');
        Route::get('/profile',[AdminController::class, 'Profile'])->name('admin.profile');
        Route::get('/edit/profile',[AdminController::class, 'EditProfile'])->name('edit.profile');
        Route::post('/store/profile',[AdminController::class, 'StoreProfile'])->name('store.profile');
        Route::get('/change/password',[AdminController::class, 'ChangePassword'])->name('change.password');
        Route::post('/update/password',[AdminController::class, 'UpdatePassword'])->name('update.password');

        Route::middleware('admin.accounts')->group(function () {
            Route::get('/add', [AdminController::class, 'addAccount'])->name('admin.add');
            Route::post('/post', [AdminController::class, 'postAccounts'])->name('admin.post');
        });
    });
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
