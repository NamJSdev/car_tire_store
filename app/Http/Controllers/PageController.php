<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAndProduct;
use App\Models\Product;
use App\Models\PaymentSlip;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Tính toán tiền mặt từ đơn hàng và thanh toán
        $cashOrder = $query->sum('cash');
        $cashPayment = PaymentSlip::query()->where('status', '0')->sum('cash') - PaymentSlip::query()->where('status', '1')->sum('cash');
        $cash = $cashOrder + $cashPayment;

        // Số sản phẩm
        $sumProduct = Product::count();
        $tienNo = $query->sum('tienNo');
        $hetHang = Product::where('tonKho','0')->count();
        $khachHang = Customer::count();
        // Lấy top 5 sản phẩm có lượng bán nhiều nhất
        $topProducts = Product::orderBy('luongBan', 'desc')->take(5)->get();

        $orderProduct = OrderAndProduct::query();
        // Lọc theo ngày
        if ($request->filled('date')) {
            $date = $request->input('date');
            $query->whereDate('ngayTao', $date);
            $orderProduct->whereDate('created_at', $date);
            Cookie::queue('filter_date', $date, 1440); // Lưu cookie trong 1 ngày
        } elseif ($request->cookie('filter_date')) {
            $date = $request->cookie('filter_date');
            $query->whereDate('ngayTao', $date);
            $orderProduct->whereDate('created_at', $date);
        }

        // Lọc theo tháng
        if ($request->filled('month')) {
            $month = $request->input('month');
            $query->whereMonth('ngayTao', '=', substr($month, 5, 2))
                ->whereYear('ngayTao', '=', substr($month, 0, 4));
            $orderProduct->whereMonth('created_at', '=', substr($month, 5, 2))
                ->whereYear('created_at', '=', substr($month, 0, 4));
            Cookie::queue('filter_month', $month, 1440); // Lưu cookie trong 1 ngày
        } elseif ($request->cookie('filter_month')) {
            $month = $request->cookie('filter_month');
            $query->whereMonth('ngayTao', '=', substr($month, 5, 2))
                ->whereYear('ngayTao', '=', substr($month, 0, 4));
            $orderProduct->whereMonth('created_at', '=', substr($month, 5, 2))
                ->whereYear('created_at', '=', substr($month, 0, 4));
        }

        // Lọc theo năm
        if ($request->filled('year')) {
            $year = $request->input('year');
            $query->whereYear('ngayTao', $year);
            $orderProduct->whereYear('created_at', $year);
            Cookie::queue('filter_year', $year, 1440); // Lưu cookie trong 1 ngày
        } elseif ($request->cookie('filter_year')) {
            $year = $request->cookie('filter_year');
            $query->whereYear('ngayTao', $year);
            $orderProduct->whereYear('created_at', $year);
        }

        $tienLai = $orderProduct->sum('thanhTien') - $orderProduct->sum('donGia');
        // Lấy danh sách đơn hàng sau khi lọc
        $orders = $query->orderBy('created_at', 'desc')->get();

        // Tính tổng doanh thu từ danh sách đơn hàng
        $totalRevenue = $orders->sum('price');

        // Lấy danh sách sản phẩm mới (ví dụ lấy 3 sản phẩm mới nhất)
        $newProducts = Product::orderBy('created_at', 'desc')->take(3)->get();

        // Trả về view và truyền các biến cần thiết
        return view('pages.index', compact('orders', 'totalRevenue', 'cash', 'sumProduct', 'topProducts', 'newProducts', 'tienLai','tienNo','hetHang','khachHang'));
    }
    public function clearFilters(Request $request)
    {
        Cookie::queue(Cookie::forget('filter_date'));
        Cookie::queue(Cookie::forget('filter_month'));
        Cookie::queue(Cookie::forget('filter_year'));

        return redirect()->route('dashboard');
    }
}