<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style type="text/css">
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: 0.5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -0.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -0.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: 0.75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: 0.75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, 0.92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
</head>

<body>

    <div class="page-content container">
        <div id="print-session" class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Mã Hóa Đơn
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    {{ $order->maDonHang }}
                </small>
            </h1>
            <div class="page-tools">
                <div class="action-buttons">
                    <a id="print-button" class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <h3 class="text-default-d3">
                                    @if ($order->status == 1)
                                        Hóa Đơn Bán Hàng
                                    @else
                                        Hóa Đơn Tạm Tính
                                    @endif
                                </h3>
                                <span><i class="font-size-12">(Cửa Hàng TireStore)</i></span>
                            </div>
                        </div>
                    </div>

                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Khách Hàng:</span>
                                <span
                                    class="text-600 text-110 text-blue align-middle">{{ $order->customer->hoTen }}</span>
                            </div>
                            @if ($order->customer->id !== 1)
                                <div class="text-grey-m2">
                                    <div class="my-1">Địa Chỉ: {{ $order->customer->diaChi }}</div>
                                    <div class="my-1"></div>
                                    <div class="my-1">
                                        <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                        <b class="text-600">SĐT: {{ $order->customer->sdt }}</b>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Hóa Đơn
                                </div>
                                <div class="my-2">
                                    <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    <span class="text-600 text-90">Mã Hóa Đơn:</span> #{{ $order->maDonHang }}
                                </div>
                                <div class="my-2">
                                    <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    <span class="text-600 text-90">Ngày Phát Hành:</span>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Tên Sản Phẩm</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">SL</div>
                            <div class="d-none d-sm-block col-sm-2">Đơn Giá</div>
                            <div class="col-2">Thành Tiền</div>
                        </div>
                        @foreach ($products as $product)
                            <div class="text-95 text-secondary-d3">
                                <div class="row mb-2 mb-sm-0 py-25">
                                    <div class="d-none d-sm-block col-1">{{ $loop->index + 1 }}</div>
                                    <div class="col-9 col-sm-5">{{ $product->tenHang }}</div>
                                    <div class="d-none d-sm-block col-2">{{ $product->pivot->soLuong }}</div>
                                    <div class="d-none d-sm-block col-2 text-95">
                                        {{ number_format($product->pivot->donGia, 0, ',', '.') . ' đ' }}</div>
                                    <div class="col-2 text-secondary-d2">
                                        {{ number_format($product->pivot->thanhTien, 0, ',', '.') . ' đ' }}</div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row border-b-2 brc-default-l2"></div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Ghi Chú: {{ $order->desc }}
                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">Tiền Mặt</div>
                                    <div class="col-5">
                                        <span
                                            class="text-120 text-secondary-d1">{{ number_format($order->cash, 0, ',', '.') . ' đ' }}</span>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-7 text-right">Chuyển Khoản</div>
                                    <div class="col-5">
                                        <span
                                            class="text-110 text-secondary-d1">{{ number_format($order->payCash, 0, ',', '.') . ' đ' }}</span>
                                    </div>
                                </div>
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">Tổng Tiền</div>
                                    <div class="col-5">
                                        <span
                                            class="text-150 text-success-d3 opacity-2">{{ number_format($order->price, 0, ',', '.') . ' đ' }}</span>
                                    </div>
                                </div>
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">Còn Nợ</div>
                                    <div class="col-5">
                                        <span
                                            class="text-150 text-success-d3 opacity-2">{{ number_format($order->tienNo, 0, ',', '.') . ' đ' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <span class="text-secondary-d1 text-105"><i>Cảm ơn quý khách đã mua hàng !</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // Ẩn nút in khi người dùng bắt đầu in hóa đơn
        document.getElementById('print-button').addEventListener('click', function() {
            $('#print-session').hide(); // Ẩn nút in
            window.print(); // Thực hiện in
    
            // Hiển thị lại nút in sau khi in xong
            $('#print-session').show();
        });
    </script>
    
</body>

</html>
