@extends('layouts.app')
@section('title', 'Thêm Danh Mục Hang Hóa')

@section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Thêm Danh Mục Hàng Hóa</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
                            data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ảnh</label>
                                        <input type="file" class="form-control image-file" name="image"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên Danh Mục *</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nhập Tên Danh Mục" required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô Tả</label>
                                        <input type="text" class="form-control" name="desc"
                                            placeholder="Nhập Mô Tả" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                Thêm Danh Mục
                            </button>
                            <button type="reset" class="btn btn-danger">Làm Mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
@endsection
