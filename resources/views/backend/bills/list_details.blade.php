@extends('backend.admin_master')
@section('admin')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Danh sách đơn hàng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('bill.list')}}">
                            <i class="fas fa-angle-left"></i>
                            Trở về
                        </a>
                </li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between items-center my-3">
                    <h6>Tên khách hàng: {{isset($list_details) && count($list_details) > 0 ? $list_details[0]->username : 'hi'}}</h6>
                    <div>
                        <a href="{{route('invoice-pdf', $list_details[0]->order_id)}}" class="btn btn-success">In hóa đơn</a>
                        <a href="{{route('email-pdf', $list_details[0]->order_id)}}" class="btn btn-info">Gửi email</a>
                    </div>
                </div>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>


                    <tbody>
                        @if (isset($list_details) && count($list_details) > 0)
                            @php
                                $total_discount = 0;
                                $total_current = 0;
                            @endphp
                            @foreach ($list_details as $key => $item)
                                @php
                                    $total_current = $item->price * $item->quantity;
                                    $total_discount += $total_current;
                                @endphp
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{number_format($item->price, 0, '', ',')}} VNĐ</td>
                                    <td>{{number_format($total_current, 0, '', ',')}} VNĐ</td>
                                  
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4">
                                        @php
                                            $total_dis = $total_discount - $item->total;
                                        @endphp

                                        <p>Giảm giá:  
                                            <span>{{number_format($total_dis, 0, '', ',')}} VNĐ</span>
                                        </p>
                                        <h6 >Tổng thanh toán:  
                                            <span>{{number_format($item->total, 0, '', ',')}} VNĐ</span>
                                        </h6>
                                    </td>
                                </tr>
                        @else
                                <td colspan="4" class="text-center">Không có đơn hàng</td>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="d-flex justify-content-end">
        {{ !empty($list_details) ? $list_details->links() : '' }}
    </div>
@endsection
