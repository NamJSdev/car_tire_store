@extends('layouts.app')
@section('title', 'Thêm Tài Khoản')

@section('content')
<div class="container-fluid add-form-list">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Tạo Tài Khoản</h4>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('create-account')}}" data-toggle="validator">
            @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tên *</label>
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
                    <label>Email *</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Nhập Email"
                      name="email"
                      required
                    />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Loại Tài Khoản</label>
                    <select
                      name="role"
                      class="selectpicker form-control"
                      data-style="py-0"
                    >
                      <option value="2">TK Nhân Viên</option>
                      <option value="1">TK Quản Trị</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password *</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Nhập Mật Khẩu"
                      name="password"
                      required
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
              </div>
              <button type="submit" class="btn btn-primary mr-2">
                Tạo Tài Khoản
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