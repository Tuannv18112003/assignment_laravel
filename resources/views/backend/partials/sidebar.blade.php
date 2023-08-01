<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                {{-- @php
                    $user = Auth::user()->rule;
                @endphp --}}


                {{-- @if ($user == 1) --}}
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- @endif --}}
                
                <li>
                    <a href="{{route('bill.list')}}" class="waves-effect">
                        <i class="ri-bill-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Danh sách đơn hàng</span>
                    </a>
                </li>

                {{-- @if ($user == 1) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-file-user-line"></i>
                        <span>Quản lý tài khoản</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('admin.list') }}">Danh sách tài khoản</a></li> --}}
                        <li><a href="{{ route('admin.add') }}">Thêm tài khoản</a></li>
                    </ul>
                </li>
                {{-- @endif --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-product-hunt-line"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product.list') }}">Danh sách sản phẩm</a></li>
                        <li><a href="{{ route('product.add') }}">Thêm sản phẩm</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-sticky-note-line"></i>
                        <span>Quản lý danh mục</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('brand.list') }}">Danh sách danh mục</a></li>
                        <li><a href="{{ route('brand.add') }}">Thêm danh mục</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-3-line"></i>
                        <span>Quản lý slide</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('slide.list') }}">Danh sách slide</a></li>
                        <li><a href="{{ route('slide.add') }}">Thêm slide</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-coupon-4-line"></i>
                        <span>Quản lý coupons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('coupon.list')}}">Danh sách coupons</a></li>
                        <li><a href="{{ route('coupon.add') }}">Thêm coupons</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                                <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                                <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                                <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                                <li><a href="layouts-preloader.html">Preloader</a></li>
                                <li><a href="layouts-colored-sidebar.html">Colored Sidebar</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                <li><a href="layouts-hori-topbar-light.html">Topbar light</a></li>
                                <li><a href="layouts-hori-boxed-width.html">Boxed width</a></li>
                                <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                                <li><a href="layouts-hori-colored-header.html">Colored Header</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
        </div>
        <!-- Sidebar -->
    </div>
</div>
