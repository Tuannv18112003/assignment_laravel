@extends('frontend.view_master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <a href="" class="btn btn-success rounded my-4">Xem đơn hàng đã mua</a>
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $i = 0;
                        @endphp
                        @if (isset($carts) && !empty($carts))
                            @foreach ($carts as $key => $item)
                                <tr class="cart-item">
                                    <td class="align-middle">{{ ++$i }}</td>
                                    <td class="align-middle"><img
                                            src="{{ $item['image'] && is_file($item['image']) ? Storage::url($item['image']) : 'https://picsum.photos/seed/picsum/500/500' }}"
                                            alt="" style="width: 50px;">
                                        {{ $item['product_name'] }}</td>
                                    <td class="align-middle "><span
                                            class="product-price">{{ number_format($item['price'], 0, '', ',') }} </span>
                                        VNĐ</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <input type="text" name="id[]" value="{{ $key }}" hidden
                                                multiple>
                                            <input type="number" min="0"
                                                class="form-control form-control-sm bg-secondary border-0 text-center product-quantity"
                                                name="quantity[]" value="{{ $item['quantity'] }}" multiple>
                                        </div>
                                    </td>
                                    <td class="align-middle product-price"><span class="product-total"></span></td>
                                    <td class="align-middle"><a href="{{ route('cart.delete', $key) }}" id="delete"
                                            class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr colspan="6" class="text-center">
                                <td>Không có sản phẩm trong giỏ hàng</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 ">
                <form class="mb-30" action="{{ route('cart.coupon.add') }}" method="POST">
                    <div class="input-group mb-4">
                        @csrf
                        <input type="text" class="form-control border-0 p-4" placeholder="Mã giảm giá" name="coupon">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Thêm mã</button>
                        </div>
                    </div>
                </form>

                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3 ">
                        Tóm tắt giỏ hàng
                    </span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Tổng tiền</h6>
                            <h6 class="total"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Giảm giá</h6>
                            <h6 class="font-weight-medium">
                                <span class="product-discount">{{isset($coupons) ? $coupons['coupon'] : 0 }}</span> %
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Tổng tiền cần thanh toán</h5>
                            <h5 id="total-amount"></h5>
                        </div>
                        <form action="{{ route('cart.checkout') }}" method="GET">
                            @csrf
                            @if (isset($carts) && !empty($carts))
                                @foreach ($carts as $key => $item)
                                <input type="text" name="id[]" value="{{ $key }}" hidden
                                multiple>
                                <input type="number" min="0"
                                class="form-control form-control-sm bg-secondary border-0 text-center hidden-quantity"
                                name="quantity[]" value="" multiple hidden>
                                @endforeach
                                <input type="number" hidden name="total_price" class="total_price" value="">
                                <input type="text" hidden value="{{isset($coupons) ? $coupons['coupon'] : 0 }}" name="discount">
                            @endif
                            <button type="submit"
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3
                                    {{ isset($carts) && count($carts) == 0 ? 'disabled' : '' }}
                                    ">Thanh
                                toán
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Cart End -->
@endsection

@push('scripts')
    <script>
        // Code cart
        function totalAmount() {
            let cartItem = document.querySelectorAll(".cart-item");

            // console.log(quantity);

            let total_amount = 0;
            $hidden_quantity = document.querySelector(".hidden-quantity");
            // console.log($hidden_quantity);
            cartItem.forEach(function(item, index) {
                let product_price = Number(
                    item.querySelector(".product-price").innerText.replace(/,/g, '')
                );
                let quantity = item.querySelector(".product-quantity");


                total = Number(product_price * quantity.value);
                total_amount += total;

                item.querySelector(".product-total").innerText = total.toLocaleString(
                    "vi-VN", {
                        style: "currency",
                        currency: "VND"
                    }
                );

                // item.querySelector(".product-price").innerText =
                //     product_price.toLocaleString("vi-VN", {
                //         style: "currency",
                //         currency: "VND",
                //     });
            });

            document.querySelector(".total").innerText = total_amount.toLocaleString(
                "vi-VN", {
                    style: "currency",
                    currency: "VND"
                }
            );
            let discount = document.querySelector(".product-discount").innerText;
            if (discount) {
                total_amount = Math.round(Number(total_amount - (total_amount * (discount / 100))));
            }
            document.querySelector("#total-amount").innerText =
                total_amount.toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND",
                });
            
            document.querySelector('.total_price').value = total_amount;
        }

        totalAmount();


        function connectQuantity() {
            let quantity = document.querySelectorAll('.product-quantity');

            let hidden_quantity = document.querySelectorAll(".hidden-quantity");
            
            for(let i = 0; i < quantity.length; i++) {
                // console.log(hidden_quantity[i].value);
                hidden_quantity[i].value = quantity[i].value;
            }
            
            quantity.forEach(function(item, index) {
                item.onchange = function() {
                    hidden_quantity[index].value = quantity[index].value;
                    totalAmount();
                }
            })
        }

        connectQuantity();
    </script>
@endpush
