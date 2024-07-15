<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAndProduct;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maDonHang', 'LIKE', "%{$search}%")
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('sdt', 'LIKE', "%{$search}%");
                });
        }

        $datas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.order', compact('datas'));
    }
    public function store(Request $request)
    {
        //Validate the request
        $request->validate([
            'customer_id' => 'required',
            'staff_id' => 'required',
            'total_amount' => 'required|numeric',
            'cash_amount' => 'nullable|numeric',
            'bank_amount' => 'nullable|numeric',
            'change_amount' => 'nullable|numeric',
            'debt_amount' => 'nullable|numeric',
            'products' => 'required|array',
            'products.*.id' => 'required',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.unit_price' => 'required|numeric',
            'products.*.total_price' => 'required|numeric',
            'desc' => 'nullable|string',
            'duNo' => 'required|boolean'
        ]);

        DB::beginTransaction();

        try {
            // Create a new order
            $order = new Order();
            $order->maDonHang = Order::generateUniqueMaDonHang(); // Assuming you have a function to generate order code
            $order->desc = $request->desc;
            $order->price = $request->total_amount;
            $order->customerID = $request->customer_id;
            $order->accountID = $request->staff_id;
            $order->cash = $request->cash_amount;
            $order->payCash = $request->bank_amount;
            $order->tienNo = $request->debt_amount;
            $order->ngayTao = Carbon::now();
            $order->capNhat = Carbon::now();
            $order->status = 1; // Assuming 1 is the default status
            $order->save();

            // Save order items and update product stock
            foreach ($request->products as $product) {
                $productRecord = Product::where('id', $product['id'])->first();

                $orderProduct = new OrderAndProduct();
                $orderProduct->orderID = $order->id;
                $orderProduct->productID = $product['id'];
                $orderProduct->soLuong = $product['quantity'];
                $orderProduct->donGia = $product['unit_price'];
                $orderProduct->ThanhTien = $product['total_price'];
                $orderProduct->save();

                // Update product stock
                $productRecord->tonKho -= $product['quantity'];
                $productRecord->luongBan += $product['quantity'];
                $productRecord->save();

                // Save warranty information
                if ($productRecord->thoiGianBaoHanh > 0) {
                    $warrantyStart = Carbon::now();
                    $warrantyEnd = Carbon::now()->addMonths($productRecord->thoiGianBaoHanh);

                    $warranty = new Warranty();
                    $warranty->orderID = $order->id;
                    $warranty->productID = $product['id'];
                    $warranty->warrantyPeriod = $productRecord->thoiGianBaoHanh;
                    $warranty->warrantyStart = $warrantyStart;
                    $warranty->warrantyEnd = $warrantyEnd;
                    $warranty->terms = 'Default terms'; // Assuming default terms
                    $warranty->status = 1; // Assuming 1 is the default status
                    $warranty->save();
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Order saved successfully',
                'order_id' => $order->id, // Trả về order_id để sử dụng trong JavaScript
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Có lỗi xảy ra. Vui lòng thử lại!', 'error' => $e->getMessage()], 500);
        }
    }
    public function orderInvoice($orderId)
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
        return view('pages.order-detail', compact('order', 'products'));
    }

    public function cancel(Request $request)
    {
        $order = Order::with('products')->findOrFail($request->id);

        // Cập nhật trạng thái đơn hàng thành 3
        $order->status = 3;
        $order->capNhat = Carbon::now();
        $order->save();

        // Cộng lại số lượng hàng hóa vào kho
        foreach ($order->products as $product) {
            $productToUpdate = Product::findOrFail($product->pivot->productID);
            $productToUpdate->tonKho += $product->pivot->soLuong;
            $productToUpdate->luongBan -= $product->pivot->soLuong;
            $productToUpdate->save();
        }

        // Tìm và xóa các bản ghi bảo hành liên quan đến orderID
        $warranties = Warranty::where('orderID', $order->id)->get();
        foreach ($warranties as $warranty) {
            $warranty->delete();
        }

        return redirect()->route('orders.index')->with('success', 'Hủy Đơn Hàng Thành Công.');
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Bắt đầu transaction để đảm bảo toàn bộ các thao tác được thực hiện thành công hoặc rollback nếu có lỗi
        DB::beginTransaction();

        try {
            // Xóa các bản ghi liên quan trong bảng trung gian (order_and_product)
            DB::table('order_and_product')->where('orderID', $id)->delete();

            // Xóa các bản ghi bảo hành liên quan (nếu có)
            DB::table('warranties')->where('orderID', $id)->delete();

            // Xóa chính đơn hàng
            $order->delete();

            // Commit transaction
            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();

            return redirect()->route('orders.index')->with('error', 'Có lỗi xảy ra khi xóa đơn hàng.');
        }
    }
}