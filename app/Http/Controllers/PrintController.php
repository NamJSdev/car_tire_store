<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printInvoice($orderId)
    {
        // Tìm đơn hàng theo ID với các sản phẩm liên quan
        $order = Order::with('products')->findOrFail($orderId);

        // Lấy danh sách sản phẩm từ đơn hàng
        $products = $order->products;

        // Lặp qua các sản phẩm để lấy thông tin chi tiết
        foreach ($products as $product) {
            // Tìm sản phẩm trong bảng Products dựa vào productID từ pivot table
            $sanPham = Product::findOrFail($product->pivot->productID);
            // Lấy ra các thông tin cần thiết từ bảng trung gian
            $tenHang = $sanPham->tenHang; // Ví dụ: 'tenHang' là tên cột chứa tên sản phẩm trong bảng Products
            $soLuong = $product->pivot->soLuong;
            $thanhTien = $product->pivot->thanhTien;
            $donGia = $product->pivot->donGia;

            // Các xử lý khác tại đây nếu cần
        }

        // Trả về view hoặc response JSON theo yêu cầu của bạn
        return view('pages.invoice', compact('order', 'products'));
    }
}