<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $brand_id = $detail->brand_id;
            $relateds = Products::relatedProducts($id, $brand_id);
            // dd($related);
            // dd($detail->brand_id);
        }
        
        return view('frontend.detail', compact('title', 'detail', 'relateds'));
    }

    public function shop(Request $request, $brand_id = null) {
        
        $title = 'Danh sách sản phẩm';

        $shop_products = Products::shopProducts();
        $brands = Brands::all();

        if($brand_id) {
            $shop_products = Products::shopProducts($brand_id);
        }

        if ($request->id) {
            $ids = $request->id;
            $shop_products = Products::shopProducts($ids);
        }

        return view('frontend.shop', compact('title', 'brands', 'shop_products'));
    }


}
