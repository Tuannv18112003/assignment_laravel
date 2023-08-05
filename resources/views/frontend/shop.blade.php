@extends('frontend.view_master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop')}}">Shop</a>
                    <span class="breadcrumb-item active">Danh sách sản phẩm</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                    Lọc theo danh mục</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form method="get" action="{{route('shop')}}">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-all" name="id[]" value="all">
                            <label class="custom-control-label" for="price-all">Tất cả sản phẩm</label>
                        </div>
                        @foreach ($brands as $key => $brand)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input price-item" id="price-{{$key+1}}" name="id[]" value="{{$brand->id}}">
                                <label class="custom-control-label" for="price-{{$key+1}}">{{$brand->brand_name}}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-warning w-100">Lọc</button>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                        </div>
                    </div>

                    @if(isset($shop_products) && count($shop_products) > 0)
                    @foreach ($shop_products as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{$item->image ? Storage::url($item->image) : 'https://picsum.photos/327/327?random=6'}}" alt="">
                                    <div class="product-action">
                                        <form action="{{route('cart')}}" method="POST">
                                            @php
                                                $oldPrice = $item->price;
                                                $currentPrice = $item->price - ($item->price * ($item->sale / 100));
                                            @endphp
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="price" value="{{$currentPrice}}">
                                            <a class="btn btn-outline-dark btn-square" href="">
                                                <button type="submit" class="btn btn-outline-dark btn-square">
                                                    <i class="fa fa-shopping-cart"></i>        
                                                </button>
                                            </a>
                                        </form>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$item->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        @if ($item->sale > 0)
                                            <h5><span>{{number_format($currentPrice, 0, '', ',')}}</span> VNĐ</h5>
                                            <h6 class="text-muted ml-2"><del>
                                                <span>
                                                    {{number_format($oldPrice, 0, '', ',')}}    
                                                </span> VNĐ</del></h6>
                                        @else
                                            <h5><span>{{number_format($currentPrice, 0, '', ',')}}</span> VNĐ</h5>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    
                    <div class="col-12">
                        @if (isset($shop_products) && count($shop_products) > 0)
                            {{ $shop_products->links() }}                        
                        @endif
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@push('scripts')
    <script>
        let checkAllProducts = document.querySelector('#price-all');
        let checkItemProducts = document.querySelectorAll('.price-item');
        checkAllProducts.onclick = function() {
            checkItemProducts.forEach((item, index) => {
                if(checkAllProducts.checked == true) {
                    item.disabled = true;   
                }else {
                    item.disabled = false;
                }
            }); 
        }
    </script>
@endpush
