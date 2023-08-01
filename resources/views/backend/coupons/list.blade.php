@extends('backend.admin_master')
@section('admin')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách mã</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Quản lý mã</a></li>
                        <li class="breadcrumb-item active">Danh sách mã</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách mã</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên mã</th>
                                <th>Mã code</th>
                                <th>Giảm giá</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$coupon->title}}</td>
                                    <td>{{$coupon->code_discount}}</td>
                                    <td>{{$coupon->discount}} %</td>
                                    <td >
                                        {{$coupon->deleted_at == null ? 'Kích hoạt' : 'Chưa kích hoạt'}}
                                    </td>
                                    <td class="flex justify-content-center">
                                        <a 
                                            href="{{route('coupon.edit', ['id'=>$coupon->id])}}" 
                                            title="Edit Coupon">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a id="delete"
                                        href="{{route('coupon.delete', ['id'=>$coupon->id])}}" 
                                            title="Delete Coupon">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="d-flex justify-content-end">
        {{ $coupons->links() }}
    </div>
@endsection
