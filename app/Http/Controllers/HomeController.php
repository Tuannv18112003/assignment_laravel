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
        resizeImage($brands, 100, 100);


        $products = Products::getFeaturedProducts();
        resizeImageProduct($products, 500, 500);        

        $slides = Slides::all();
        resizeImage($slides, 1393, 430);

        // dd($brands);





        return view('frontend.index', compact('products', 'slides', 'brands', 'title'));
    }
}
