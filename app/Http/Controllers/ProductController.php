<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $query = Product::query();
        $datas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.product', compact('datas', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Product::query();
        // Xử lý tìm kiếm
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('tenHang', 'like', "%{$search}%")
                ->orWhere('maHang', 'like', "%{$search}%");
        }

        // Xử lý lọc theo danh mục
        if ($request->has('category') && $request->input('category') != '') {
            $category = $request->input('category');
            $query->where('categoryID', $category);
        }

        // Xử lý sắp xếp giá
        if ($request->has('sort') && $request->input('sort') != '') {
            $sort = $request->input('sort');
            $query->orderBy('giaBan', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }
        if (request()->has('status') && request()->input('status') != '') {
            $status = request()->input('status');
            $query->where('status', $status);
        }
        if ($request->has('stock') && $request->input('stock') != '') {
            $stock = $request->input('stock');
            if ($stock == 'in_stock') {
                $query->where('tonKho', '>', 0);
            } elseif ($stock == 'out_of_stock') {
                $query->where('tonKho', '=', 0);
            }
        }

        $datas = $query->paginate(10);

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
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }
    public function update(Request $request)
    {
        $product = Product::find($request->id);

        if ($request->has('name') && $request->input('name') != '') {
            $product->tenHang = $request->input('name');
        }

        if ($request->has('maHang') && $request->input('maHang') != '') {
            $product->maHang = $request->input('maHang');
        }

        if ($request->has('giaVon') && $request->input('giaVon') != '') {
            $product->giaVon = $request->input('giaVon');
        }

        if ($request->has('giaBan') && $request->input('giaBan') != '') {
            $product->giaBan = $request->input('giaBan');
        }

        if ($request->has('tonKho') && $request->input('tonKho') != '') {
            $product->tonKho = $request->input('tonKho');
        }

        if ($request->has('desc') && $request->input('desc') != '') {
            $product->desc = $request->input('desc');
        }

        if ($request->has('danhMuc') && $request->input('danhMuc') != '') {
            $product->categoryID = $request->input('danhMuc');
        }

        if ($request->has('hangNhap') && $request->input('hangNhap') != '') {
            $product->tonKho += $request->input('hangNhap');
        }

        if ($request->has('status') && $request->input('status') != '') {
            $product->status = $request->input('status');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Product::destroy($request->id);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}