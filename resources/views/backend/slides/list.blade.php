@extends('backend.admin_master')
@section('admin')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách slides</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Quản lý slides</a></li>
                        <li class="breadcrumb-item active">Danh sách slides</li>
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

                    <h4 class="card-title">Danh sách slides</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slides as $key => $slide)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$slide->title}}</td>
                                    <td>
                                        <img src="{{'/storage/'.$slide->image}}" alt="Không có ảnh" width="80" height="80">
                                    </td>
                                    <td >
                                        {{$slide->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt'}}
                                    </td>
                                    <td class="flex justify-content-center">
                                        <a 
                                            href="{{route('slide.get_edit', ['id'=>$slide->id])}}" 
                                            title="Edit slide">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('bạn có chắc muốn xóa slide này ?')"
                                            href="{{route('slide.delete', ['id'=>$slide->id])}}" 
                                            title="Delete slide">
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
        {{ $slides->links() }}
    </div>
@endsection
