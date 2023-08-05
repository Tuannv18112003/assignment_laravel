<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'product_name', 
        'short_description',
        'email',
        'image',
        'color', 
        'config',
        'price', 
        'sale',
        'description',
        'brand_id',
        'status'
    ];


    public static function getFeaturedProducts() {
        $featuredproducts = DB::table('products')
        ->select('id','product_name', 'image', 'price', 'sale')
        ->limit(8)
        ->inRandomOrder()
        ->get();

        return $featuredproducts;

    }

    public static function relatedProducts($id=null, $brand_id = null) {
        // DB::enableQueryLog();
        $related_product = DB::table('products')
        ->select('id', 'product_name', 'image', 'price', 'sale')
        ->where('products.brand_id', '=', $brand_id)
        ->where('products.id', '!=', $id)
        ->limit(4)
        ->inRandomOrder()
        ->get();

        // dd(DB::getQueryLog());

        return $related_product;
    }

    public static function shopProducts($ids=[], $brand_id = null) {
        // DB::enableQueryLog();
        $shop_products = DB::table('products')
        ->select('id', 'product_name', 'image', 'price', 'sale');

        // if($brand_id) {
        //     $shop_products = $shop_products->where('products.brand_id', '=', $brand_id);
        // }

        if($ids) {
            // dd( $ids);
            foreach($ids as $id) {
                if($id = 'all') {
                    $shop_products = $shop_products;
                } else {
                    $shop_products = $shop_products->whereIn('brand_id', $ids);
                }
            }
        }

        $shop_products = $shop_products
        ->orderBy('id', 'desc')
        // ->withQueryString()
        ->paginate(9);
        // dd(DB::getQueryLog());

        return $shop_products;
    }

}
