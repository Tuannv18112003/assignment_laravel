@extends('backend.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Đổi mật khẩu</h4> <br>

                            @if(count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show">
                                        {{$error}}
                                    </p>
                                @endforeach
                            
                            @endif

                            <form action="{{route('update.password')}}" method="POST" >
                                @csrf
                                <div class="row mb-3">
                                    <label for="old_password" class="col-sm-2 col-form-label">Nhập lại mật khẩu cũ</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="old_password" name="old_password" value="">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="new_password" name="new_password" value="">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-sm-2 col-form-label">Nhập lại mật khẩu mới</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" value="">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    {{-- <label for="" class="col-sm-2 col-form-label"></label> --}}
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Đổi mật khẩu">
                                    </div>
                                </div>
                            </form>
                            <!-- end row -->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection