<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Models\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CouponsController extends Controller
{

    public function listCoupon() {
        $title = 'Mã giảm giá';
        $coupons = Coupons::paginate(5)->withQueryString();
        return view('backend.coupons.list', compact('title', 'coupons'));
    }

    public function addCoupon() {
        $title = 'Thêm mã giảm giá';
        return view('backend.coupons.add', compact('title'));
    }

    public function postCoupon(CouponsRequest $request) {
        $params = $request->except('_token');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['image'] = uploadFile('images/coupons', $request->file('image'));
        }

        $coupons = Coupons::create($params);
        if($coupons->id) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm mã giảm giá thành công'
            ];
            return redirect()->route('coupon.list')->with($notification);
        }
    }

    public function editCoupon($id) {
        $title = 'Chỉnh sửa mã giảm giá';

        $coupon = Coupons::find($id);
        return view('backend/coupons/edit', compact('title', 'coupon'));
    }

    public function updateCoupon(CouponsRequest $request) {
        $id = $request->id;
        $product = Coupons::find($id);
        $params = $request->except('_token');
        // dd($params);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $resultDL = Storage::delete('/public/coupons' . $product->image);
            if ($resultDL) {
                $params['image'] = uploadFile('images', $request->file('image'));
            } else {
                $params['image'] = $product->image;
            }
        }

        $result = Coupons::where('id', $id)
        ->update($params);

        if ($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Sửa mã giảm giá thành công'
            ];
            return redirect()->route('coupon.list')->with($notification);
        }
    }

    public function deleteCoupon($id) {
        $delete = Coupons::where('id', $id)->delete();
        if($delete) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Xóa mã giảm giá thành công'
            ];
        } else {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Xóa mã giảm giá thất bại'
            ];
        }

        return redirect()->back()->with($notification);
    }
}
