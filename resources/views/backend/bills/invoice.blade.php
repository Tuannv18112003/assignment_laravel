<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Hóa đơn thanh toán</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='#' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {

            /* background-color: #000; */
            font-family: 'Roboto', sans-serif;
        }

        .padding {

            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
        }

        .text-dark {
            color: #3d405c !important;
        }
    </style>
</head>

<body className='snippet-body'>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <div class="float-right">
                    <h3 class="mb-0">Phiếu thanh toán</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6 ">
                        <h3 class="text-dark mb-1">Tên khách hàng: <span>{{isset($list_details) && count($list_details) > 0 ? $list_details[0]->username : 'hi'}}</span></h3>
                        <div>Address: <span>{{isset($list_details) && count($list_details) > 0 ? $list_details[0]->address : ''}}</span></div>
                        <div>Email: {{isset($list_details) && count($list_details) > 0 ? $list_details[0]->email : ''}}</div>
                        <div>Phone: <span>{{isset($list_details) && count($list_details) > 0 ? $list_details[0]->phone : 'hi'}}</span></div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th class="right">Giá</th>
                                <th class="center">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($list_details) && count($list_details) > 0)
                            @php
                                $total_discount = 0;
                                $total_current = 0;
                            @endphp
                            @foreach ($list_details as $key => $item)
                                @php
                                    $total_current = $item->price * $item->quantity;
                                    $total_discount += $total_current;
                                @endphp
                                <tr>
                                    <td class="center">{{++$key}}</td>
                                    <td class="left strong">{{$item->product_name}}</td>
                                    <td class="right">{{$item->quantity}}</td>
                                    <td class="center">{{number_format($item->price, 0, '', ',')}} VNĐ</td>
                                    <td class="right">{{number_format($total_current, 0, '', ',')}} VNĐ</td>
                                </tr>
                            @endforeach
                        @else
                                <td colspan="4" class="text-center">Không có đơn hàng</td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                @php
                                    $total_dis = $total_discount - $item->total;
                                @endphp
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Tổng tiền</strong>
                                    </td>
                                    <td class="right">{{number_format($total_discount, 0, '', ',')}} VNĐ</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Giảm giá</strong>
                                    </td>
                                    <td class="right">{{number_format($total_dis, 0, '', ',')}} VNĐ</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Tổng tiền thanh toán</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark">{{number_format($item->total, 0, '', ',')}} VNĐ</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'>
    </script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>
        #
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>

</body>

</html>
