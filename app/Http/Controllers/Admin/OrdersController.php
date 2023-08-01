<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function listBill() {
        $title = 'Danh sách đơn hàng';
        $list_bills = Orders::getBill();
        return view('backend.bills.list_bills', compact('title', 'list_bills'));
    }

    public function listDetails($id) {
        $title = 'Chi tiết đơn hàng';

        $list_details = Orders::getBillDetails($id);
        return view('backend.bills.list_details', compact('title', 'list_details'));
    }

    public function updateBills($id) {
        if($id) {
            // DB::enableQueryLog();
            $status = Orders::find($id);
            if($status->status == 1) {
                $result = Orders::where('id', $id)->update(['status' => 2]);
                $notification = [
                    'alert-type' => 'success',
                    'message' => 'Xác nhận đơn hàng thành công'
                ];
            }else if($status->status == 2) {
                $result = Orders::where('id', $id)->update(['status' => 3]);
                $notification = [
                    'alert-type' => 'success',
                    'message' => 'Đang giao hàng'
                ];
            }else if($status->status == 3) {
                $result = Orders::where('id', $id)->update(['status' => 4]);
                $notification = [
                    'alert-type' => 'success',
                    'message' => 'Giao hàng thành công'
                ];
            }else {
                $result = false;
            }
            // dd(DB::getQueryLog());

            return redirect()->route('bill.list')->with($notification);
        }

    }

    public function deleteBills($id) {
        if($id) {
            Orders::where('id', '=', $id)->update(['status' => 0]);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Hủy đơn hàng thành công'
            ];
            return redirect()->route('bill.list')->with($notification);
        }
    }
}
