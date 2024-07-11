@extends('layouts.app')
@section('title', 'Thêm Sản Phẩm')

@section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Thêm Sản Phẩm Mới</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                            data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Danh Mục Sản Phẩm *</label>
                                        <a class="badge bg-success ml-3 edit" href="#" title="Edit"
                                            data-toggle="modal" data-target="#editModal"><i class="fas fa-plus"></i> Thêm
                                            Nhanh Danh Mục</a>
                                        <select name="category" class="selectpicker form-control" data-style="py-0">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã Hàng/Mã Vạch/Mã Sản Phẩm</label>
                                        <input type="text" name="maHang" class="form-control"
                                            placeholder="Được Thiết Lập Tự Động" readonly />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm *</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Nhập Tên Sản Phẩm" data-errors="Làm đơn điền tên sản phẩm."
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Giá Nhập *</label>
                                        <input type="number" name="giaVon" class="form-control"
                                            placeholder="Nhập Giá Nhập" data-errors="Please Enter Cost." required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Giá Bán *</label>
                                        <input type="number" name="giaBan" class="form-control" placeholder="Nhập Giá Bán"
                                            data-errors="Please Enter Price." required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Thời Gian Bảo Hành (Tính Theo Tháng) *</label>
                                        <input type="number" name="thoiGianBaoHanh" class="form-control"
                                            placeholder="Nhập Thời Gian Bảo Hành" data-errors="Please Enter Price."
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Đơn Vị Tính *</label>
                                        <input type="text" name="donViTinh" class="form-control"
                                            placeholder="VD: chiếc, cái, kg, ..." data-errors="Please Enter Price."
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label>Số Lượng Sản Phẩm*</label>
                                            <div
                                                class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                <input type="checkbox" name="status"
                                                    class="custom-control-input bg-success" id="customCheck-2"
                                                    checked="">
                                                <label class="custom-control-label font-size-18" for="customCheck-2">Cho
                                                    Phép Bán</label>
                                            </div>
                                        </div>
                                        <input type="text" name="tonKho" class="form-control"
                                            placeholder="Nhập Số Lượng" required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ảnh Sản Phẩm</label>
                                        <input type="file" class="form-control image-file" name="image"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô Tả / Chi Tiết Sản Phẩm</label>
                                        <textarea class="form-control" rows="4" name="desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                Thêm Mới
                            </button>
                            <button type="reset" class="btn btn-danger">Làm Mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('categories.storeQuick') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Nhanh Danh Mục Sản Phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input type="hidden" name="id">
                            <input style="height: 63px" type="file" class="form-control image-file" name="image"
                                accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label>Tên Danh Mục</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="desc">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Thêm Mới">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
