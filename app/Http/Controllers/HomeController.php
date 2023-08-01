<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use App\Models\Slides;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index() {
        $title = 'Trang chủ';
        $brands = Brands::getCountBrandsProducts();
        // resizeImage($brands, 100, 100);


        $products = Products::getFeaturedProducts();
        // resizeImageProduct($products, 326, 326);        


        $slides = Slides::all();
        // resizeImage($slides, 1393, 430);
        // dd($brands);
        return view('frontend.index', compact('products', 'slides', 'brands', 'title'));
    }

    public function detail($id) {
        $title = 'Chi tiết sản phẩm';
        if($id) {
            $detail = Products::find($id);
        }
        
        return view('frontend.detail', compact('title', 'detail'));
    }

    public function shop($id) {
        // if($id) {
        //     $shop_products = Products::table('products')
        //     ->left
        // }
    }
}
