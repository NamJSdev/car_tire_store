<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $staffs = Account::all()->makeHidden(['password', 'email']);
        return view('pages.cashier', compact('customers', 'staffs'));
    }
    public function defaultProducts()
    {
        $products = Product::where('status', 'activated')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Xử lý đường dẫn ảnh
        foreach ($products as $product) {
            if ($product->image) {
                $product->image = asset('storage/' . $product->image);
            } else {
                // Nếu không có ảnh, có thể cung cấp một ảnh mặc định
                $product->image = "../assets/images/logo.png";
            }
        }

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $query = Product::where('status', 'activated');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tenHang', 'like', "%{$search}%")
                    ->orWhere('maHang', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        // Xử lý đường dẫn ảnh
        foreach ($products as $product) {
            if ($product->image) {
                $product->image = asset('storage/' . $product->image);
            } else {
                // Nếu không có ảnh, có thể cung cấp một ảnh mặc định
                $product->image = "../assets/images/logo.png";
            }
        }

        return response()->json($products);
    }
}