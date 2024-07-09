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
    public function index()
    {
        return view('pages.order');
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
            $order->tienNo = $request->duNo ? $request->total_amount - $request->cash_amount - $request->bank_amount : 0;
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

            return response()->json(['message' => 'Order saved successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Có lỗi xảy ra. Vui lòng thử lại!', 'error' => $e->getMessage()], 500);
        }
    }
}