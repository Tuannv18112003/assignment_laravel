@extends('backend.admin_master')
@section('admin')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Quản lý sản phẩm</a></li>
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
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

                    <h4 class="card-title">Danh sách sản phẩm</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Màu sắc</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>
                                        <img src="{{'/storage/'.$product->image}}" alt="Không có ảnh" width="80" height="80">
                                    </td>
                                    <td>
                                        {{number_format($product->price, 0, '', ',')}}
                                    </td>
                                    <td>
                                        {{$product->color}}
                                    </td>
                                    <td class="flex justify-content-center">
                                        <a href="{{route('product.get_edit', ['id'=>$product->id])}}" title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('bạn có chắc muốn xóa sản phẩm này ?')"
                                            href="{{route('product.delete', ['id'=>$product->id])}}" 
                                            title="Delete Product">
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
        {{ $products->links() }}
    </div>
@endsection
