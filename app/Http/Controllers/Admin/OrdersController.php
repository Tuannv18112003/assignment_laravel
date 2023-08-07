<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Orders;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function listBill() {
        $title = 'Danh sách đơn hàng';
        $list_bills = Orders::getBill();
        // dd($list_bills);
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

    public function invoicePDF($id) {
        $list_details = Orders::getBillDetails($id);

        Pdf::setOption(['defaultFont' => 'roboto']);
        $pdf = Pdf::loadView('backend.bills.invoice', compact('list_details'));
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }


    public function emailPDF($id) {

        try {
            $list_details = Orders::getBillDetails($id);
            // dd($list_details[0]->email);
            Mail::to($list_details[0]->email)->send(new InvoiceMail($list_details));
    
            $notification = [
                'alert-type' => 'success',
                'message' => 'Gửi email thành công'
            ];
    
            return redirect()->back()->with($notification);

        }catch(\Exception $e) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Gửi email thất bại'
            ];

            return redirect()->back()->with($notification);
        }
        
    }
}
