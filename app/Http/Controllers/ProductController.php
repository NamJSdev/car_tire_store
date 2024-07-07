<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $datas = Product::orderBy('created_at', 'desc')->paginate(10);

        if (request()->ajax()) {
            return view('partials.product_table', compact('datas'));
        }

        return view('pages.product', compact('datas'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('tenHang', 'like', "%{$search}%")
                ->orWhere('maHang', 'like', "%{$search}%");
        }

        $datas = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('partials.product_table', compact('datas'));
        }

        return view('pages.product', compact('datas'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validate the incoming request
        $request->validate([
            'category' => "required|integer",
            'name' => 'required|string|max:255',
            'thoiGianBaoHanh' => 'required|string|max:255',
            'donViTinh' => 'required|string|max:255',
            'giaBan' => 'required|string|max:255',
            'giaVon' => 'required|string|max:255',
            'tonKho' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //Gọi hàm generateUniqueMaHang để sinh mã hàng ngẫu nhiên
        $maHang = Product::generateUniqueMaHang();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        if ($request->status == 'on') {
            $status = 'activated';
        } else {
            $status = 'locked';
        }
        // Create a new category
        $product = Product::create([
            'maHang' => $maHang,
            'tenHang' => $request->input('name'),
            'categoryID' => $request->input('category'),
            'donViTinh' => $request->input('donViTinh'),
            'giaVon' => $request->input('giaVon'),
            'giaBan' => $request->input('giaBan'),
            'tonKho' => $request->input('tonKho'),
            'thoiGianBaoHanh' => $request->input('thoiGianBaoHanh'),
            'desc' => $request->input('desc'),
            'luongBan' => 0,
            'status' => $status,
            'warrantyStatus' => 'activated',
            'desc' => $request->input('desc'),
            'image' => $imagePath,
        ]);

        // Redirect to a page with a success message
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công.');
    }
}