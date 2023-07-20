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
                                <th>Tên thương hiệu</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $brand)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td >
                                        {{$brand->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt'}}
                                    </td>
                                    <td class="flex justify-content-center">
                                        <a href="{{route('brand.get_edit', ['id'=>$brand->id])}}" title="Edit Brand">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('bạn có chắc muốn xóa sản phẩm này ?')"
                                            href="{{route('brand.delete', ['id'=>$brand->id])}}" 
                                            title="Delete Brand">
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
        {{ $brands->links() }}
    </div>
@endsection
