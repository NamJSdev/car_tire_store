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
                    <div>
                        <a href="{{ route('products.create') }}" class="btn btn-primary add-list"><i class="las la-plus"></i>
                            Thêm
                            Sản Phẩm Mới</a>
                        <button id="toggleFiltersButton" class="btn btn-secondary ml-2"><i class="las la-filter"></i>Bộ
                            Lọc</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div id="filters" class="d-flex justify-content-between mb-4 filter">
                    <div class="d-flex flex-column">
                        <label class="font-size-14 font-italic font-weight-500">Lọc Danh Mục :</label>
                        <select id="categoryFilter" class="selectpicker form-control" data-style="py-0">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column">
                        <label class="font-size-14 font-italic font-weight-500">Lọc Theo Giá :</label>
                        <select id="sortFilter" class="form-control selectpicker" data-style="py-0">
                            <option value="">Giá mặc định</option>
                            <option value="desc">Giá giảm dần</option>
                            <option value="asc">Giá tăng dần</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column">
                        <label class="font-size-14 font-italic font-weight-500">Lọc Theo Tồn Kho :</label>
                        <select id="stockFilter" class="form-control selectpicker" data-style="py-0">
                            <option value="">Tất cả sản phẩm</option>
                            <option value="in_stock">Sản phẩm còn hàng</option>
                            <option value="out_of_stock">Sản phẩm hết hàng</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column">
                        <label class="font-size-14 font-italic font-weight-500 selectpicker" data-style="py-0">Lọc Theo
                            Trạng Thái :</label>
                        <select id="statusFilter" class="form-control selectpicker" data-style="py-0">
                            <option value="">Tất cả trạng thái</option>
                            <option value="activated">Cho phép bán</option>
                            <option value="locked">Không cho phép bán</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Ảnh</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Danh Mục</th>
                                <th>Giá Bán</th>
                                <th>Bảo Hành</th>
                                <th>Tồn Kho</th>
                                <th>Trạng Thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body" id="product-table-body">
                            @include('partials.product_table', ['datas' => $datas])
                        </tbody>
                    </table>
                    @if ($datas->isEmpty())
                        <p class="text-center mt-3">Không có sản phẩm nào.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    <!-- View Modal HTML -->
    <div id="viewModal" class="modal fade">
        <div class="modal-dialog" style="max-width: 675px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi Tiết Sản Phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="card card-block card-stretch card-height-helf mb-0" style="border: none">
                    <div class="card-body card-item-right">
                        <div class="align-items-top row">
                            <div class="rounded w-100 col-md-5">
                                <img id="product-image" class="style-img img-fluid m-auto" alt="image">
                            </div>
                            <div class="style-text text-left col-md-7 ml-0">
                                <h5 id="tenSanPham" class="mb-2"></h5>
                                <hr>
                                <p class="mb-2">Mã Sản Phẩm : <span id="maSanPham"></span></p>
                                <p class="mb-2">Danh Mục : <span id="danhMucSanPham"></span></p>
                                <hr>
                                <p class="mb-2">Giá Vốn : <span id="giaVonSanPham"></span></p>
                                <p class="mb-0">Giá Bán : <span id="giaBanSanPham"></span></p>
                                <hr>
                                <p class="mb-2">Đã Bán : <span id="luongBanSanPham"></span> <span
                                        class="donViTinhSanPham"></span></p>
                                <p class="mb-2">Tồn Kho : <span id="tonKhoSanPham"></span> <span
                                        class="donViTinhSanPham"></span></p>
                                <p class="mb-0">Bảo Hành : <span id="baoHanhSanPham"></span> Tháng</p>
                                <hr>
                                <p class="mb-0">Mô Tả : <span id="moTaSanPham"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Đóng">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog" style="max-width: 70%">
            <div class="modal-content">
                <form id="editForm" action="{{route('products.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh Sửa Sản Phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="id">
                        <div class="form-group col-md-6">
                            <label>Mã Sản Phẩm:</label>
                            <input type="text" class="form-control" name="maHang" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tên Sản Phẩm:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Bảo Hành (tháng):</label>
                            <input type="number" class="form-control" name="baoHanh" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tồn Kho:</label>
                            <input type="number" class="form-control" name="tonKho" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Đơn Vị:</label>
                            <input type="text" class="form-control" name="donVi" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Danh Mục:</label>
                            <select name="danhMuc" class="selectpicker form-control" data-style="py-0">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Giá Vốn:</label>
                            <input type="number" class="form-control" name="giaVon" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Giá Bán:</label>
                            <input type="number" class="form-control" name="giaBan" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nhập Hàng:</label>
                            <input type="number" class="form-control" name="hangNhap" placeholder="Số lượng">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="d-flex justify-content-between">
                                <label for="image">Ảnh:</label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio6" name="status"
                                            class="custom-control-input" value="activated" />
                                        <label class="custom-control-label" for="customRadio6">
                                            Cho Phép Bán
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio7" name="status"
                                            class="custom-control-input" value="locked" />
                                        <label class="custom-control-label" for="customRadio7">
                                            Ngừng Bán
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input image-file" id="image" name="image"
                                    accept="image/*">
                                <label class="custom-file-label" for="image">Chọn ảnh</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Mô Tả:</label>
                            <textarea type="text" class="form-control" name="desc" style="height: 120px"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Cập Nhật">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('products.delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Sản Phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-danger" value="Xóa">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ngăn sự kiện enter trong ô tìm kiếm
            $('#searchInput').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });

            // Lắng nghe sự kiện input để tìm kiếm
            $('#searchInput').on('input', function() {
                loadProducts();
            });

            // Lắng nghe sự kiện thay đổi bộ lọc
            $('#categoryFilter, #sortFilter, #statusFilter, #stockFilter').on('change', function() {
                loadProducts();
            });
            // Toggle bộ lọc
            $('#toggleFiltersButton').on('click', function() {
                $('#filters').toggleClass('filter');
            });

            function loadProducts() {
                var formData = $('#searchForm').serialize();
                var category = $('#categoryFilter').val();
                var sort = $('#sortFilter').val();
                var status = $('#statusFilter').val();
                var stock = $('#stockFilter').val();

                formData += '&category=' + category + '&sort=' + sort + '&status=' + status + '&stock=' + stock;

                $.ajax({
                    type: 'GET',
                    url: "{{ route('products.search') }}",
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
            }
            $('[data-toggle="tooltip"]').tooltip();
            $('#viewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var maHang = button.data('ma-hang');
                var giaVon = button.data('gia-von');
                var giaBan = button.data('gia-ban');
                var danhMuc = button.data('danh-muc');
                var tonKho = button.data('ton-kho');
                var donVi = button.data('don-vi');
                var baoHanh = button.data('bao-hanh');
                var luongBan = button.data('luongBan');
                var moTa = button.data('desc');
                var image = button.data('image');

                $('#viewModal #tenSanPham').text(name);
                $('#viewModal #maSanPham').text(maHang);
                $('#viewModal #danhMucSanPham').text(danhMuc);
                $('#viewModal #giaVonSanPham').text(giaVon);
                $('#viewModal #giaBanSanPham').text(giaBan);
                $('#viewModal #tonKhoSanPham').text(tonKho);
                $('#viewModal #luongBanSanPham').text(luongBan);
                $('#viewModal #baoHanhSanPham').text(baoHanh);
                $('#viewModal #moTaSanPham').text(moTa);
                $('#viewModal .donViTinhSanPham').text(donVi);
                $('#viewModal #product-image').attr('src', image);
                $('#viewModal').modal('show');
            });
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var maHang = button.data('ma-hang');
                var giaVon = button.data('gia-von');
                var giaBan = button.data('gia-ban');
                var danhMuc = button.data('danh-muc');
                var tonKho = button.data('ton-kho');
                var donVi = button.data('don-vi');
                var baoHanh = button.data('bao-hanh');
                var moTa = button.data('desc');
                var status = button.data('status');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="maHang"]').val(maHang);
                modal.find('input[name="name"]').val(name);
                modal.find('input[name="baoHanh"]').val(baoHanh);
                modal.find('input[name="tonKho"]').val(tonKho);
                modal.find('input[name="donVi"]').val(donVi);
                modal.find('input[name="giaVon"]').val(giaVon);
                modal.find('input[name="giaBan"]').val(giaBan);
                modal.find('select[name="danhMuc"]').val(danhMuc);
                modal.find('textarea[name="desc"]').val(moTa);
                if (status === 'activated') {
                    $('#customRadio6').prop('checked', true);
                } else {
                    $('#customRadio7').prop('checked', true);
                }

                // Cập nhật giá trị cho thẻ select
                modal.find('select[name="danhMuc"]').val(danhMuc).change();
            });

            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                console.log(id)
                $('#delete-id').val(id);
            });
        });
    </script>
    <!-- Hiển thị phân trang -->
    @if ($datas->lastPage() > 1)
        <nav class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($datas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Numbered Page Links --}}
                @php
                    $currentPage = $datas->currentPage();
                    $lastPage = $datas->lastPage();
                    $maxPages = 5; // Số lượng trang tối đa hiển thị
                    $halfMaxPages = floor($maxPages / 2);
                    $startPage = max($currentPage - $halfMaxPages, 1);
                    $endPage = min($currentPage + $halfMaxPages, $lastPage);
                @endphp

                @if ($startPage > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url(1) }}">1</a>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item {{ $datas->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $datas->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($endPage < $lastPage)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($datas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
@endsection
