@extends('layouts.app')
@section('title', 'Thu Ngân')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="pos" class="main" role="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 w-100">
                    <div class="main-content mt-0">
                        <div class="order-search" style="margin: 10px 0; position: relative;">
                            <input type="text" class="form-control" placeholder="Nhập mã sản phẩm hoặc tên sản phẩm..."
                                id="search-pro-box">
                            <div id="search-results" class="dropdown-menu w-100 overflow-auto"
                                style="display: none; max-height: 390px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Mã hàng</th>
                                            <th>Tên</th>
                                            <th>Giá bán</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="search-results-body">
                                        <!-- Kết quả tìm kiếm sẽ được thêm vào đây -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="product-results w-100">
                            <table class="data-table table mb-0 tbl-server-info w-100">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Ảnh</th>
                                        <th>Mã hàng</th>
                                        <th>Tên</th>
                                        <th class="text-center">Số Lượng</th>
                                        <th class="text-center">Tồn Kho</th>
                                        <th class="text-center">Giá bán</th>
                                        <th class="text-center">Thành tiền</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    <!-- Danh sách sản phẩm trong đơn hàng sẽ được thêm vào đây -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border-left">
                    <div class="morder-info">
                        <div class="tab-contents">
                            <div class="form-group marg-bot-10 clearfix">
                                <div class="d-flex justify-content-between">
                                    <label>Khách Hàng:</label>
                                    <div
                                        class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                        <input type="checkbox" name="duNo" class="custom-control-input bg-success"
                                            id="customCheck-2">
                                        <label class="custom-control-label font-size-18" for="customCheck-2">Dư Nợ</label>
                                    </div>
                                </div>

                                <div class="input-group mb-4">
                                    <select name="customer" class="selectpicker form-control" data-style="py-0"
                                        data-live-search="true">
                                        <option value="">Chọn Khách Hàng</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->hoTen }}
                                                <span>({{ $customer->sdt }})</span>
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">

                                        <a class="btn btn-primary" href="{{ route('create-form') }}" type="button">
                                            <i class="la la-user-plus font-size-20 mt-2"></i>
                                        </a>
                                    </div>
                                </div>
                                <div id="cys-suggestion-box"
                                    style="border: 1px solid #444; display: none; overflow-y: auto; background-color: #fff; z-index: 2; position: absolute; left: 0; width: 100%; padding: 5px 0px; max-height: 400px;">
                                    <!-- Customer search suggestion box -->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group marg-bot-10 clearfix">
                            <label>Nhân Viên Bán Hàng</label>
                            <select name="staff" class="selectpicker form-control h-100" data-style="py-0"
                                data-live-search="true">
                                <option value="">Lựa Chọn Nhân Viên Bán Hàng</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->info->name }}
                                        <span>({{ $staff->info->desc }})</span>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group marg-bot-10 clearfix row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0"><i class="la la-money font-size-20"></i> Thành Tiền:</label>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="text" id="total-amount" class="form-control text-right h-100 bg-blue"
                                    readonly />
                            </div>
                        </div>
                        <hr>
                        <div class="form-group marg-bot-10 clearfix row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0"><i class="la la-credit-card font-size-20"></i> Khách Phải Trả:</label>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="text" id="amount-to-pay" class="form-control text-right h-100 bg-blue"
                                    readonly />
                            </div>
                        </div>
                        <hr>
                        <div class="form-group marg-bot-10 clearfix row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0"><i class="la la-money font-size-20"></i> Tiền Mặt:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" id="cash-amount" class="form-control text-right"
                                    placeholder="Tiền Mặt" />
                            </div>
                        </div>
                        <div class="form-group marg-bot-10 clearfix row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0"><i class="la la-bank font-size-20"></i> Chuyển Khoản:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" id="bank-amount" class="form-control text-right"
                                    placeholder="Chuyển Khoản" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-group marg-bot-10 clearfix row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0">$ Tiền Thừa:</label>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="text" id="change-amount" class="form-control text-right h-100 bg-blue"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group marg-bot-10 clearfix row debt-info">
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="mb-0">$ Tiền Nợ:</label>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="text" id="debt-amount" class="form-control text-right h-100 bg-blue"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group marg-bot-10 clearfix row pr-2 pl-3">
                            <input type="text" name="desc" class="form-control" placeholder="Ghi chú đơn hàng" />
                        </div>
                        <div class="form-group marg-bot-10 clearfix row pr-2 pl-3">
                            <div class="col-md-6 pl-0">
                                <button type="button" class="btn btn-primary w-100">
                                    <i class="fa fa-print font-size-20"></i> In Tạm Tính
                                </button>
                            </div>
                            <div class="col-md-6 pr-0">
                                <button type="button" class="btn btn-primary w-100">
                                    <i class="fa fa-angry font-size-20"></i> Quan Tâm
                                </button>
                            </div>
                        </div>
                        <div class="form-group marg-bot-10 clearfix row pr-2 pl-3">
                            <button id="submit-order" type="button" class="btn btn-primary w-100">
                                Thanh Toán
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-pro-box').on('focus input', function() {
                var query = $(this).val();

                if (query.length === 0 || query.length > 2) {
                    $.ajax({
                        url: query.length === 0 ? "{{ route('products.default') }}" :
                            "{{ route('cashiers.search') }}",
                        method: 'GET',
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $('#search-results-body').empty();
                            if (data.length > 0) {
                                $.each(data, function(index, product) {
                                    var imageUrl = product.image.replace(/\\/g, '');
                                    $('#search-results-body').append(`
                                        <tr>
                                            <td><img src="${imageUrl}" class="img-fluid rounded avatar-50 mr-3" alt="image" /></td>
                                            <td>${product.maHang}</td>
                                            <td>${product.tenHang}</td>
                                            <td>${formatCurrency(parseInt(product.giaBan))}</td>
                                            <td>
                                                <button class="btn btn-primary add-to-order" data-product='${JSON.stringify(product)}'>
                                                    Thêm
                                                </button>
                                            </td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#search-results-body').append(
                                    '<tr><td colspan="4" class="text-center">Không tìm thấy sản phẩm nào</td></tr>'
                                );
                            }
                            $('#search-results').show();
                        }
                    });
                }
            });

            $('#search-pro-box').on('blur', function() {
                setTimeout(function() {
                    $('#search-results').hide();
                }, 200);
            });

            $(document).on('click', '.add-to-order', function() {
                var product = $(this).data('product');
                var existingRow = $(`#product-${product.maHang}`);
                if (existingRow.length > 0) {
                    var qtyInput = existingRow.find('.quantity-input');
                    var newQty = parseInt(qtyInput.val()) + 1;
                    qtyInput.val(newQty);
                    updateRow(existingRow, product.giaBan, newQty);
                } else {
                    var imageUrl = product.image.replace(/\\/g, '');
                    var row = `
                        <tr id="product-${product.maHang}" data-id="${product.id}">
                            <td style="padding-right: 0px !important;"><img src="${imageUrl}" class="img-fluid rounded avatar-50 mr-3" alt="image" /></td>
                            <td class="pr-0" style="padding-right: 0px !important;">${product.maHang}</td>
                            <td style="padding-right: 0px !important;">${product.tenHang}</td>
                            <td class="text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                                <button class="btn btn-sm btn-danger decrease-quantity">-</button>
                                <input type="number" class="quantity-input text-center" min="1" value="1" style="width: 40px;">
                                <button class="btn btn-sm btn-primary increase-quantity">+</button>
                            </td>
                            <td class="text-center">${product.tonKho}</td>
                            <td class="text-center" style="padding-right: 0px !important;">${formatCurrency(parseInt(product.giaBan))}</td>
                            <td class="text-center pr-0" style="padding-right: 0px !important;">${formatCurrency(parseInt(product.giaBan))}</td>
                            <td class="text-center" style="padding-left: 0px !important;"><button class="btn btn-danger remove-product text-center"><i class="fa fa-trash mr-0"></i></button></td>
                        </tr>
                    `;
                    $('.product-results tbody').append(row);
                }
                updateTotalAmount();
                $('#search-results').hide();
            });

            $(document).on('click', '.increase-quantity', function() {
                var row = $(this).closest('tr');
                var qtyInput = row.find('.quantity-input');
                var newQty = parseInt(qtyInput.val()) + 1;
                qtyInput.val(newQty);
                updateRow(row);
                updateTotalAmount();
            });

            $(document).on('click', '.decrease-quantity', function() {
                var row = $(this).closest('tr');
                var qtyInput = row.find('.quantity-input');
                var newQty = parseInt(qtyInput.val()) - 1;
                if (newQty > 0) {
                    qtyInput.val(newQty);
                    updateRow(row);
                    updateTotalAmount();
                }
            });

            $(document).on('input', '.quantity-input', function() {
                var row = $(this).closest('tr');
                updateRow(row);
                updateTotalAmount();
            });

            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove();
                updateTotalAmount();
            });

            function updateRow(row) {
                var unitPrice = parseFloat(row.find('td').eq(5).text().replace(/\./g, '').replace(' đ', ''));
                var qty = parseInt(row.find('.quantity-input').val());
                var total = unitPrice * qty;
                row.find('td').eq(6).text(formatCurrency(total));
            }

            function updateTotalAmount() {
                var totalAmount = 0;
                $('.product-results tbody tr').each(function() {
                    var total = parseFloat($(this).find('td').eq(6).text().replace(/\./g, '').replace(' đ',
                        ''));
                    totalAmount += total;
                });
                $('#total-amount').val(formatCurrency(totalAmount));
                $('#amount-to-pay').val(formatCurrency(totalAmount));
                updateChangeAmount();
            }

            function formatCurrency(value) {
                return value.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' đ';
            }

            function updateChangeAmount() {
                var totalAmount = parseFloat($('#total-amount').val().replace(/\./g, '').replace(' đ', ''));
                var cashAmount = parseFloat($('#cash-amount').val().replace(/\./g, '').replace(' đ', '')) || 0;
                var bankAmount = parseFloat($('#bank-amount').val().replace(/\./g, '').replace(' đ', '')) || 0;
                var changeAmount = 0;

                if ((cashAmount !== 0 || bankAmount !== 0) && (cashAmount + bankAmount >= totalAmount)) {
                    changeAmount = cashAmount + bankAmount - totalAmount;
                } else {
                    changeAmount = 0;
                }

                $('#change-amount').val(formatCurrency(changeAmount));
            }

            $('#cash-amount, #bank-amount').on('input', function() {
                updateChangeAmount();
            });

            // Biến để lưu trữ số nợ
            var debtAmount = 0;
            $('.debt-info').hide();
            // Xử lý khi checkbox Dư Nợ được chọn
            $('#customCheck-2').on('change', function() {
                if ($(this).prop('checked')) {
                    // Nếu được chọn, hiển thị phần nhập số nợ và tính toán
                    $('.debt-info').show();
                    updateDebtAmount();
                } else {
                    // Nếu không được chọn, ẩn phần nhập số nợ
                    $('.debt-info').hide();
                    debtAmount = 0;
                    $('#debt-amount').val(formatCurrency(debtAmount));
                    updateTotalAmount();
                }
            });

            // Hàm cập nhật số nợ
            function updateDebtAmount() {
                var totalAmount = parseFloat($('#total-amount').val().replace(/\./g, '').replace(' đ', ''));
                var cashAmount = parseFloat($('#cash-amount').val().replace(/\./g, '').replace(' đ', '')) || 0;
                var bankAmount = parseFloat($('#bank-amount').val().replace(/\./g, '').replace(' đ', '')) || 0;
                if (cashAmount === 0 && bankAmount === 0) {
                    // Nếu không nhập số tiền mặt và chuyển khoản, số nợ bằng thành tiền
                    debtAmount = totalAmount;
                } else {
                    // Nếu có nhập số tiền mặt hoặc chuyển khoản, tính số nợ
                    debtAmount = totalAmount - cashAmount - bankAmount;
                }
                $('#debt-amount').val(formatCurrency(debtAmount));
            }

            // Cập nhật số nợ khi thay đổi số tiền mặt và chuyển khoản
            $('#cash-amount, #bank-amount').on('input', function() {
                updateDebtAmount();
            });

            // Format initial values
            $('#total-amount').val(formatCurrency(parseFloat($('#total-amount').val().replace(/\./g, '').replace(
                ' đ', '')) || 0));
            $('#cash-amount').val(formatCurrency(parseFloat($('#cash-amount').val().replace(/\./g, '').replace(' đ',
                '')) || 0));
            $('#bank-amount').val(formatCurrency(parseFloat($('#bank-amount').val().replace(/\./g, '').replace(' đ',
                '')) || 0));
            $('#amount-to-pay').val(formatCurrency(parseFloat($('#amount-to-pay').val().replace(/\./g, '').replace(
                ' đ',
                '')) || 0));
            $('#change-amount').val(formatCurrency(parseFloat($('#change-amount').val().replace(/\./g, '').replace(
                ' đ', '')) || 0));
            $('#debt-amount').val(formatCurrency(parseFloat($('#debt-amount').val().replace(/\./g, '').replace(
                ' đ', '')) || 0));
        });

        //Gửi yêu cầu tạo đơn hàng
        $('#submit-order').click(function() {
            var orderData = [];
            $('.product-results tbody tr').each(function() {
                var productId = $(this).attr('data-id');
                var quantity = $(this).find('.quantity-input').val();
                var unitPrice = parseFloat($(this).find('td').eq(5).text().replace(/\./g, '').replace(' đ',
                    ''));
                var totalPrice = parseFloat($(this).find('td').eq(6).text().replace(/\./g, '').replace(' đ',
                    ''));
                orderData.push({
                    id: productId,
                    quantity: quantity,
                    unit_price: unitPrice,
                    total_price: totalPrice
                });
            });

            var formData = {
                customer_id: $('select[name="customer"]').val(),
                staff_id: $('select[name="staff"]').val(),
                total_amount: $('#total-amount').val().replace(/\./g, '').replace(' đ', ''),
                cash_amount: $('#cash-amount').val().replace(/\./g, '').replace(' đ', ''),
                bank_amount: $('#bank-amount').val().replace(/\./g, '').replace(' đ', ''),
                change_amount: $('#change-amount').val().replace(/\./g, '').replace(' đ', ''),
                debt_amount: $('#debt-amount').val().replace(/\./g, '').replace(' đ', ''),
                desc: $('input[name="desc"]').val(),
                products: orderData,
                duNo: $('#customCheck-2').prop('checked') ? 1 : 0
            };

            $.ajax({
                url: "{{ route('orders.store') }}",
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Đơn hàng đã được tạo thành công!');
                    // Xử lý sau khi gửi đơn hàng thành công
                    console.log(response);
                },
                error: function(response) {
                    alert('Có lỗi xảy ra khi gửi đơn hàng.');
                    console.log(response)
                    // Xử lý lỗi khi gửi đơn hàng
                }
            });
        });
    </script>

@endsection
