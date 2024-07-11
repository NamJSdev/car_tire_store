<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OutPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentSlipController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarrantyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('dashboard')->middleware('auth');

//Show form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Lấy list tài khoản quản trị hệ thống
Route::get('/tai-khoan-he-thong', [AccountController::class, 'getAdminAccount'])->name('taikhoanhethong')->middleware('admin');
//Lấy list tài khoản nhân viên
Route::get('/tai-khoan-nhan-vien', [AccountController::class, 'getStaffAccount'])->name('taikhoannhanvien')->middleware('admin');
// Route cho việc tạo tài khoản hệ thống
Route::get('/tao-tai-khoan-he-thong', [AccountController::class, 'createAccountForm'])->name('create-account-form')->middleware('admin');
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('create-account')->middleware('admin');
// Route cho việc cập nhật thông tin tài khoản hệ thống
Route::post('/sua-tai-khoan-he-thong', [AccountController::class, 'updateAccountAdmin'])->name('update-account-admin')->middleware('admin');
// Route cho việc cập nhật thông tin tài khoản nhân viên 
Route::post('/sua-tai-khoan-nhan-vien', [AccountController::class, 'updateAccountStaff'])->name('update-account-staff')->middleware('admin');
// Route cho việc xóa tài khoản hệ thống
Route::post('/xoa-tai-khoan-admin', [AccountController::class, 'deleteAccountAdmin'])->name('delete-account-admin')->middleware('admin');
// Route cho việc xóa tài khoản nhan vien
Route::post('/xoa-tai-khoan-nhan-vien', [AccountController::class, 'deleteAccountStaff'])->name('delete-account-staff')->middleware('admin');

// Route cho việc hiển thị list khách hàng
Route::get('/danh-sach-khach-hang', [CustomerController::class, 'getList'])->name('danh-sach-khach-hang')->middleware('auth');
// Route cho việc tạo khách hàng mới
Route::get('/them-moi-khach-hang', [CustomerController::class, 'createForm'])->name('create-form')->middleware('auth');
Route::post('/tao-moi-khach-hang', [CustomerController::class, 'createCustomer'])->name('create-customer')->middleware('auth');
// Route cho việc cập nhật thông tin khách hàng
Route::post('/cap-nhat-thong-tin-khach-hang', [CustomerController::class, 'update'])->name('update-customer')->middleware('auth');
// Route cho việc xóa khách hàng
Route::post('/xoa-khach-hang', [CustomerController::class, 'delete'])->name('delete-customer')->middleware('admin');
Route::post('/cap-nhat-du-no', [CustomerController::class, 'duNo'])->name('customers.duNo')->middleware('auth');

// Route xử lý thêm mới danh mục
Route::get('/danh-muc/form-khoi-tao', [CategoryController::class, 'create'])->name('categories.create')->middleware('admin');
Route::get('/danh-muc/danh-sach-danh-muc', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::post('/danh-muc/sua-danh-muc', [CategoryController::class, 'update'])->name('categories.update')->middleware('admin');
Route::post('/danh-muc/xoa-danh-muc', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('admin');
Route::post('/danh-muc', [CategoryController::class, 'store'])->name('categories.store')->middleware('admin');
Route::post('/danh-muc-nhanh', [CategoryController::class, 'storeQuick'])->name('categories.storeQuick')->middleware('admin');

// Route xử lý thêm mới sản phẩm
Route::get('/san-pham/form-khoi-tao', [ProductController::class, 'create'])->name('products.create')->middleware('admin');
Route::post('/san-pham', [ProductController::class, 'store'])->name('products.store')->middleware('admin');
Route::get('/san-pham/danh-sach-san-pham', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/san-pham/danh-sach-san-pham/search', [ProductController::class, 'search'])->name('products.search')->middleware('auth');
Route::post('/san-pham/xoa-san-pham', [ProductController::class, 'delete'])->name('products.delete')->middleware('admin');
Route::post('/san-pham/sua-san-pham', [ProductController::class, 'update'])->name('products.update')->middleware('admin');

// Route xử lý thu ngân tạo đơn hàng
Route::get('/thu-ngan', [CashierController::class, 'index'])->name('cashiers.index')->middleware('auth');

// Route xử lý đơn hàng
Route::get('/don-hang', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/products/default', [CashierController::class, 'defaultProducts'])->name('products.default')->middleware('auth');
Route::get('/products/search', [CashierController::class, 'search'])->name('cashiers.search')->middleware('auth');
Route::post('/don-hang/tao-don-hang', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::post('/don-hang/huy-don-hang', [OrderController::class, 'cancel'])->name('orders.cancel')->middleware('admin');
Route::get('/don-hang/{orderId}', [OrderController::class, 'orderInvoice'])->name('orders.invoice')->middleware('auth');
Route::post('/don-hang/xoa-don-hang', [OrderController::class, 'delete'])->name('orders.delete')->middleware('admin');

//In đơn hàng
Route::get('/hoa-don/{orderId}', [PrintController::class, 'printInvoice'])->name('print.invoice')->middleware('auth');

//Route xử lý bảo hành sản phẩm
Route::get('/thong-tin-bao-hanh', [WarrantyController::class, 'index'])->name('warranties.index')->middleware('auth');

//Route xử lý nhập chi
Route::get('/quan-ly-nhap-chi', [PaymentSlipController::class, 'index'])->name('payment_slips.index')->middleware('auth');
Route::post('/quan-ly-nhap-chi/tao-phieu', [PaymentSlipController::class, 'store'])->name('payment_slips.store')->middleware('auth');
Route::post('/quan-ly-nhap-chi/cap-nhat-phieu', [PaymentSlipController::class, 'update'])->name('payment_slips.update')->middleware('auth');
Route::post('/quan-ly-nhap-chi/xoa-phieu', [PaymentSlipController::class, 'delete'])->name('payment_slips.delete')->middleware('auth');

//Thống kê
Route::post('/clear-filters', [PageController::class, 'clearFilters'])->name('clearFilters');

//404
Route::get('/khong-co-quyen-truy-cap', [OutPageController::class, 'index'])->name('404');