@extends('frontend.view_master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Cửa hàng</a>
                    <span class="breadcrumb-item active">Thanh toán</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="{{route('post.checkout')}}" method="POST" name="checkoutCart">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Địa chỉ
                            thanh toán</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" name="username" value="{{old('username')}}">
                                @error('username')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" value="{{old('email')}}">
                                @error('email')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" type="text" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Địa chỉ nhận hàng</label>
                                <input class="form-control" type="text" name="address" value="{{old('address')}}">
                                @error('address')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                        data-target="#shipping-address">Tạo tài khoản</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mb-5" id="shipping-address">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Nhập
                                vào mật khẩu</span></h5>
                        <div class="bg-light p-30">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Mật khẩu</label>
                                    <input class="form-control" type="password" placeholder="*************" value="{{old('password')}}">
                                    @error('password')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input class="form-control" type="rePassword" placeholder="*************" value="{{old('rePassword')}}">
                                    @error('rePassword')
                                    <span style="color: red; padding-top:4px">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Hóa
                            đơn</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Sản phẩm</h6>
                            @foreach ($carts as $key => $cart)
                                <input type="text" value="{{$key}}" name="product_id[]" hidden>

                                <div class="d-flex justify-content-between cart-item">
                                    <p>{{ $cart['product_name'] }}</p>
                                    <p>
                                        <span class="product-quantity">{{ $cart['quantity'] }}</span>
                                        <span style="font-size:12px; display:inline-block; padding:0 5px">X</span>
                                        <span class="product-price">
                                            {{ number_format($cart['price'], 0, '', ',') }}
                                        </span> VNĐ
                                    </p>
                                </div>
                            @endforeach

                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Tổng tiền</h6>
                                <h6 class="product-total"></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Giảm giá</h6>
                                <h6 class="font-weight-medium"><span class="product-discount">{{isset($discount) ? $discount : 0 }}</span>%</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Tổng tiền cần thanh toán</h5>
                                <h6 id="total-amount">{{isset($total_price) ? number_format($total_price, 0, '', ',') : 0}} VNĐ</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Thanh toán</span></h5>
                        <div class="bg-light p-30">
                            <button class="btn btn-block btn-primary font-weight-bold py-3">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->
@endsection

@push('scripts')
    <script>
        // Code cart
        function totalAmount() {
            let cartItem = document.querySelectorAll(".cart-item");

            // console.log(quantity);

            let total_amount = 0;
            cartItem.forEach(function(item, index) {
                let product_price = Number(
                    item.querySelector(".product-price").innerText.replace(/,/g, '')
                );
                let quantity = item.querySelector(".product-quantity").innerText;

                total = Number(product_price * quantity);
                total_amount += total;

                document.querySelector(".product-total").innerText = total_amount.toLocaleString(
                    "vi-VN", {
                        style: "currency",
                        currency: "VND"
                    }
                );
            });
        }

        totalAmount();
    </script>
@endpush
