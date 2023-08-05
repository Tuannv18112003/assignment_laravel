@extends('backend.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm sản phẩm</h4>
                    <form action="{{ route('product.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" hidden value="{{$product->id}}">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}">
                                @error('product_name')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="short_description" value="{{$product->short_description}}">
                                @error('short_description')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="profile_image" name="image" >
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
                                    src="{{$product->image ? ''.Storage::url($product->image) : ''}}"
                                    alt="Card image cap">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-url-input" class="col-sm-2 col-form-label">Màu sắc</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="color" value="{{$product->color}}">
                                @error('color')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Cấu hình</label>
                            <div class="col-sm-10">
                                <textarea name="config" class="elm1">{{$product->config}}</textarea>
                                @error('config')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-password-input" class="col-sm-2 col-form-label">Giá</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="price" value="{{$product->price}}">
                                @error('price')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-password-input" class="col-sm-2 col-form-label">Giảm giá (%)</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="sale" value="{{$product->sale}}">
                                @error('sale')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="elm1" name="description">{{$product->description}}</textarea>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Thương hiệu</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="brand_id" >
                                    <option value="">Lựa chọn thương hiệu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id}}" 
                                            {{($brand->id == $product->brand_id) ? 'selected' : '' }}
                                            >{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary waves-effect waves-light">Chỉnh sửa sản phẩm</button>
                                <a href="{{route('product.list')}}" class="btn btn-warning">Quay lại</a>
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
