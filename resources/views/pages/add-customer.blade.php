@extends('layouts.app')
@section('title', 'Thêm Khách Hàng')

@section('content')
<div class="container-fluid add-form-list">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Thêm Khách Hàng Mới</h4>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('create-customer')}}" data-toggle="validator">
            @csrf
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Họ Tên *</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Nhập Tên"
                      name="name"
                      required
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Số Điện Thoại *</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Nhập SĐT"
                      name="phone"
                      required
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Nhập Email"
                      name="email"
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Giới Tính</label>
                    <select
                      name="gioiTinh"
                      class="selectpicker form-control"
                      data-style="py-0"
                    >
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ngày Sinh</label>
                    <input
                      type="date"
                      class="form-control"
                      placeholder="Nhập Mật Khẩu"
                      name="birthday"
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mô Tả</label>
                    <input
                      type="text"
                      class="form-control"
                      name="desc"
                      placeholder="Mô Tả"
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Địa Chỉ</label>
                    <input
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Nhập Địa Chỉ"
                    />
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
              <button type="submit" class="btn btn-primary mr-2">
                Thêm Khách Hàng
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