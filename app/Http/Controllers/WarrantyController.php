<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        $query = Warranty::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->orWhereHas('order', function ($query) use ($search) {
                    $query->where('maDonHang', 'LIKE', "%{$search}%")
                        ->orWhereHas('customer', function ($query) use ($search) {
                            $query->where('sdt', 'LIKE', "%{$search}%");
                        });
                });
            });
        }

        $datas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.warranty', compact('datas'));
    }
}