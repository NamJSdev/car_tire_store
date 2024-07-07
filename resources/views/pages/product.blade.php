@extends('layouts.app')
@section('title', 'Danh Sách Sản Phẩm')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Sản Phẩm</h4>
                    </div>
                    <a href="{{ route('products.create') }}" class="btn btn-primary add-list"><i class="las la-plus"></i> Thêm
                        Sản Phẩm Mới</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Ảnh</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Danh Mục</th>
                                <th>Giá Bán</th>
                                <th>Tồn Kho</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body" id="product-table-body">
                            @include('partials.product_table', ['datas' => $datas])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var formData = $('#searchForm').serialize();
                var url = "{{ route('products.search') }}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#product-table-body').html(response);

                        if ($('#product-table-body').children().length === 0) {
                            $('#product-table-body').html(
                                '<tr><td colspan="7" class="text-center">Không có sản phẩm nào.</td></tr>'
                                );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
