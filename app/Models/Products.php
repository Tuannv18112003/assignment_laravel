<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'product_name', 
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
        // ->inRandomOrder()
        ->get();

        return $featuredproducts;

    }

}
