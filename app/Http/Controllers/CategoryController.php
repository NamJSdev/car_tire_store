<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.category', compact('datas'));
    }
    public function create()
    {
        return view('pages.add-category');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create a new category
        $category = Category::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'image' => $imagePath,
        ]);

        // Redirect to a page with a success message
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công.');
    }
    public function storeQuick(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create a new category
        $category = Category::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'image' => $imagePath,
        ]);

        // Redirect to a page with a success message
        return redirect()->route('products.create')->with('success', 'Danh mục đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the category by ID
        $category = Category::find($request->id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        // Update the category information
        $category->name = $request->input('name');
        $category->desc = $request->input('desc');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $category->image = $imagePath;
        }

        // Save the updated category
        $category->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }


    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Category::destroy($request->id);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}