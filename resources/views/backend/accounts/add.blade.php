@extends('backend.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách tài khoản</a></li>
                        <li class="breadcrumb-item active">Thêm tài khoản</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tên tài khoản</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" 
                                name="name"
                                value="{{old('name')}}">
                                @error('name')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" 
                                name="email"
                                value="{{old('email')}}">
                                @error('email')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" 
                                name="password"
                                value="{{old('password')}}">
                                @error('password')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="profile_image" name="image">
                                @error('image')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="show_image"
                                    src=""
                                    alt="Card image cap">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Vai trò</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="rule">
                                    <option value="1" {{old('rule')== 1 ? 'selected' : ''}} >Admin</option>
                                    <option value="2" {{old('rule')== 2 ? 'selected' : ''}}>Nhân viên</option>
                                    
                                </select>
                                @error('rule')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary waves-effect waves-light">Thêm tài khoản</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#profile_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
