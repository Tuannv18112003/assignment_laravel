<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class Brands extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'brands';
    protected $fillable = ['brand_name', 'image', 'status'];

    public static function getCountBrandsProducts() {
        DB::enableQueryLog();
        $brands = DB::table('brands')
        ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
        ->select('brands.id', 'brands.brand_name', 'brands.image', DB::raw('count(products.id) as countProduct'))
        ->groupBy('brands.id')
        ->get();
        return $brands;
        // dd($brands);
        // dd(DB::getQueryLog());
    }
   
}
