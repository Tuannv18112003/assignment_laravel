<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientsRequest;
use App\Models\Brands;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\ProductOrder;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {

        if ($request->isMethod('POST')) {
            $id = $request->id;
            $price = $request->input('price');
            $product = Products::find($id);
            if (!$product) {
                $notification = [
                    'alert-type' => 'error',
                    'message' => 'Sản phẩm không tồn tại'
                ];

                return redirect()->back()->with($notification);
            }

            $carts = session()->get('carts', []);

            if (isset($carts[$id])) {
                $carts[$id]['quantity'] += 1;
            } else {
                $carts[$id] = [
                    'product_name' => $product->product_name,
                    'price' => $price,
                    'image' => $product->image,
                    'quantity' => 1
                ];
            }

            session()->put('carts', $carts);

            // dd($carts);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function viewCart()
    {
        $title = 'Giỏ hàng';
        $carts = session()->get('carts');
        $coupons = session()->get('coupons');


        return view('frontend.cart', compact('title', 'carts', 'coupons'));
    }

    public function deleteCart($id)
    {
        $carts = session()->get('carts');

        if (!isset($carts[$id])) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Không tồn tại sản phẩm'
            ];
            return redirect()->back()->with($notification);
        }

        unset($carts[$id]);
        session()->put('carts', $carts);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Xóa sản phẩm thành công'
        ];
        
        return redirect()->back()->with($notification);
    }


    public function addCoupon(Request $request) {
        // dd($request->all());
        $coupon = Orders::getCoupon($request->coupon);
        if(!empty($coupon) && count($coupon) > 0) {
            $coupons = session()->get('coupons', []);
            $coupons['coupon'] = $coupon[0]->discount;
            session()->put('coupons', $coupons);

            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm mã giảm giá thành công'
            ];

            return redirect()->route('cart.view')->with($notification);
        }else {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Mã giảm giá không tồn tại'
            ];
            return redirect()->route('cart.view')->with($notification)->withInput();
        }
    }

    public function checkoutCart(ClientsRequest $request)
    {
        $title = 'Thanh toán';
        $carts = session()->get('carts');
        
        $ids = $request->id;
        $quantities = $request->quantity;
        $arr_match = [];
        foreach ($ids as $key => $id) {
            $arr_match[] = [
                $id => $quantities[$key]
            ];
        }

        foreach ($ids as $key => $id) {
            if ($carts[$id]) {
                $carts[$id]['quantity'] = $arr_match[$key][$id];
            }
        }

        session()->put('carts', $carts);

        session()->get('totals', []);

        $totals = [
            'discount' => $request->discount,
            'total_price' => $request->total_price,
        ];

        $discount = $request->discount;
        $total_price = $request->total_price;
        session()->put('totals', $totals);
        return view('frontend.checkout', compact('title', 'carts', 'discount', 'total_price'));
    }

    public function addOrdersCarts(ClientsRequest $request)
    {
        $clientParams = $request->except('_token', 'product_id');
        $productParams = $request->product_id;
        // dd($productParams);
        $carts = session()->get('carts');


        // dd($request->all());
        $totals = session()->get('totals');
        $total_price = (int)$totals['total_price'];
        $client = Clients::create($clientParams);
        if($client->id) {
            // DB::enableQueryLog();
            $order_id = Orders::create([
                'client_id' => $client->id,
                'total_price' => $total_price
            ]);

            // dd(DB::getQueryLog());

            if($order_id->id) {
                if(isset($carts) && count($carts) > 0) {

                    foreach($carts as $key => $cart) {
                        $product_order = ProductOrder::create([
                            'order_id' => $order_id->id,
                            'product_id' => (int)$key,
                            'quantity' => $cart['quantity']
                        ]);
                    }

                    if($product_order->id) {
                        $carts = session()->get('carts');
                        $request->session()->forget('carts');
                        $totals = session()->get('totals');
                        $request->session()->forget('totals');
                        $coupons = session()->get('coupons');
                        $request->session()->forget('coupons');
                        $notification = [
                            'alert-type' => 'success',
                            'message' => 'Đặt hàng thành công, vui lòng chờ xác nhận'
                        ];
                        return redirect()->route('home')->with($notification);
                    }
                }
            }
        }
        
    }

    public function listCartPayment() {
        
    }
}
