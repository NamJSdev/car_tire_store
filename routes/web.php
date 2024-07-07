<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('dashboard')->middleware('auth');

//Show form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Lấy list tài khoản quản trị hệ thống
Route::get('/tai-khoan-he-thong', [AccountController::class, 'getAdminAccount'])->name('taikhoanhethong')->middleware('auth');
//Lấy list tài khoản nhân viên
Route::get('/tai-khoan-nhan-vien', [AccountController::class, 'getStaffAccount'])->name('taikhoannhanvien')->middleware('auth');
// Route cho việc tạo tài khoản hệ thống
Route::get('/tao-tai-khoan-he-thong', [AccountController::class, 'createAccountForm'])->name('create-account-form')->middleware('auth');
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('create-account')->middleware('auth');
// Route cho việc cập nhật thông tin tài khoản hệ thống
Route::post('/sua-tai-khoan-he-thong', [AccountController::class, 'updateAccountAdmin'])->name('update-account-admin')->middleware('auth');
// Route cho việc cập nhật thông tin tài khoản nhân viên 
Route::post('/sua-tai-khoan-nhan-vien', [AccountController::class, 'updateAccountStaff'])->name('update-account-staff')->middleware('auth');
// Route cho việc xóa tài khoản hệ thống
Route::post('/xoa-tai-khoan-admin', [AccountController::class, 'deleteAccountAdmin'])->name('delete-account-admin')->middleware('auth');
// Route cho việc xóa tài khoản nhan vien
Route::post('/xoa-tai-khoan-nhan-vien', [AccountController::class, 'deleteAccountStaff'])->name('delete-account-staff')->middleware('auth');

// Route cho việc hiển thị list khách hàng
Route::get('/danh-sach-khach-hang', [CustomerController::class, 'getList'])->name('danh-sach-khach-hang')->middleware('auth');
// Route cho việc tạo khách hàng mới
Route::get('/them-moi-khach-hang', [CustomerController::class, 'createForm'])->name('create-form')->middleware('auth');
Route::post('/tao-moi-khach-hang', [CustomerController::class, 'createCustomer'])->name('create-customer')->middleware('auth');
// Route cho việc cập nhật thông tin khách hàng
Route::post('/cap-nhat-thong-tin-khach-hang', [CustomerController::class, 'update'])->name('update-customer')->middleware('auth');
// Route cho việc xóa khách hàng
Route::post('/xoa-khach-hang', [CustomerController::class, 'delete'])->name('delete-customer')->middleware('auth');

// Route xử lý thêm mới danh mục
Route::get('/danh-muc/form-khoi-tao', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth');
Route::get('/danh-muc/danh-sach-danh-muc', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::post('/danh-muc/sua-danh-muc', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth');
Route::post('/danh-muc/xoa-danh-muc', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('auth');
Route::post('/danh-muc', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');
Route::post('/danh-muc-nhanh', [CategoryController::class, 'storeQuick'])->name('categories.storeQuick')->middleware('auth');

// Route xử lý thêm mới sản phẩm
Route::get('/san-pham/form-khoi-tao', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/san-pham', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/san-pham/danh-sach-san-pham', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/san-pham/danh-sach-san-pham/search', [ProductController::class, 'search'])->name('products.search')->middleware('auth');