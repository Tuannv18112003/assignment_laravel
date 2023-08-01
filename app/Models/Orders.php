<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['client_id', 'total_price'];

    public static function getBill() {
        DB::enableQueryLog();
        $list_bills = DB::table('clients')
        ->join('orders', 'clients.id', '=', 'orders.client_id')
        ->select('orders.id' ,'clients.username', 'clients.phone', 'orders.status', 'orders.created_at')
        ->orderByDesc('orders.created_at')
        ->paginate(5)->withQueryString();

        // dd($list_bills);
        // dd(DB::getQueryLog());
        return $list_bills;
    }

    public static function getBillDetails($id) {

        DB::enableQueryLog();
        $list_details = DB::table('clients')
        ->join('orders', 'clients.id', '=', 'orders.client_id')
        ->join('products_orders', 'orders.id', '=', 'products_orders.order_id')
        ->join('products', 'products_orders.product_id', '=', 'products.id')
        ->select(DB::raw('clients.username AS username, 
            products_orders.quantity as quantity,
            products.product_name as product_name, 
            products.price as price, 
            orders.total_price as total'))
        ->where('products_orders.order_id', '=', $id)
        ->paginate(5);
        
        // dd($list_details);
        // dd(DB::getQueryLog());
        return $list_details;

    }

    public static function getCoupon($code) {
        // DB::enableQueryLog();
        $coupon = DB::table('coupons')
        ->select('code_discount', 'discount')
        ->where('code_discount', '=', $code)
        ->get();

        // dd(DB::getQueryLog());
        return $coupon;
    }
}
