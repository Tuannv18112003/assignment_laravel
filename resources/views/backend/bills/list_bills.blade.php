@extends('backend.admin_master')
@section('admin')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Danh sách đơn hàng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách đơn hàng</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái đơn hàng</th>
                            <td>Đơn hàng</td>
                            <th style="width:240px">Hành động</th>
                        </tr>
                    </thead>


                    <tbody>
                        @if (isset($list_bills) && !empty($list_bills))
                            @foreach ($list_bills as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            Chờ xác nhận
                                        @elseif($item->status == 2)
                                            Đã xác nhận
                                        @elseif($item->status == 3)
                                            Đang giao
                                        @elseif($item->status == 4)
                                            Giao hàng thành công
                                        @elseif($item->status == 0)
                                            Đơn đã bị hủy
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" href="{{route('bill.details', $item->id)}}" class="btn btn-info btn-rounded waves-effect waves-light">Xem chi tiết</a>
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        @if ($item->status == 1)
                                        <a type="button" href="{{route('bill.update', $item->id)}}" class="btn btn-warning btn-rounded waves-effect waves-light">Xác nhận</a>
                                        <a type="button" href="{{route('bill.delete', $item->id)}}" id="delete" class="btn btn-danger btn-rounded waves-effect waves-light">Hủy đơn</a>
                                        @elseif($item->status == 2)
                                            <a type="button" href="{{route('bill.update', $item->id)}}" class="btn btn-primary btn-rounded waves-effect waves-light">Đang giao</a>
                                            <a type="button" href="{{route('bill.delete', $item->id)}}" id="delete" class="btn btn-danger btn-rounded waves-effect waves-light">Hủy đơn</a>
                                        @elseif($item->status == 3)
                                            <a type="button" href="{{route('bill.update', $item->id)}}" class="btn btn-primary btn-rounded waves-effect waves-light">GH thành công</a>
                                            <a type="button" href="{{route('bill.delete', $item->id)}}" id="delete" class="btn btn-danger btn-rounded waves-effect waves-light">Hủy đơn</a>
                                        @elseif($item->status == 0)                                         
                                            <span class="alert alert-danger" role="alert">Đơn bị hủy</span>
                                        @else
                                            <span class="alert alert-primary" role="alert">Đã giao</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <td colspan="6" class="text-center">Không có đơn hàng</td>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="d-flex justify-content-end">
        {{ $list_bills->links() }}
    </div>
@endsection
