<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getList(Request $request)
    {
        $query = Customer::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('sdt', 'like', '%' . $search . '%')
                    ->orWhere('hoTen', 'like', '%' . $search . '%');
            });
        }

        $datas = $query->paginate(10);

        // Tính toán duNo và soSanPhamDaMua cho từng khách hàng
        foreach ($datas as $customer) {
            $customer->duNo = $customer->orders->sum('tienNo');
            $customer->soSanPhamDaMua = $customer->orderProducts->sum('soLuong');
        }

        return view('pages.customer', compact('datas'));
    }

    public function createForm()
    {
        return view('pages.add-customer');
    }

    public function createCustomer(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email|unique:accounts,email',
            'phone' => 'required|string',
            'gioiTinh' => 'nullable|string',
            'desc' => 'nullable|string',
            'birthday' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Create a new record in the 'accounts' table
        $customer = Customer::create([
            'hoTen' => $request->input('name'),
            'sdt' => $request->input('phone'),
            'gioiTinh' => $request->input('gioiTinh') ?? '',
            'ngaySinh' => $request->input('birthday') ?? null,
            'diaChi' => $request->input('address') ?? '',
            'email' => $request->input('email') ?? '',
            'desc' => $request->input('desc') ?? '',
            'status' => 'already',
        ]);

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('danh-sach-khach-hang')->with('success', 'Thông tin khách hàng đã được tạo thành công.');
    }
    public function update(Request $request)
    {
        // dd($request);
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $request->id,
            'phone' => 'required|string|max:15',
            'sex' => 'nullable|string|max:10',
            'desc' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        // Find the customer by ID
        $customer = Customer::find($request->id);

        if (!$customer) {
            return redirect()->route('danh-sach-khach-hang')->with('error', 'Khách hàng không tồn tại.');
        }

        // Update the customer information
        $customer->hoTen = $request->input('name');
        $customer->email = $request->input('email');
        $customer->sdt = $request->input('phone');
        $customer->gioiTinh = $request->input('sex');
        $customer->desc = $request->input('desc');
        $customer->ngaySinh = $request->input('birthday');
        $customer->diaChi = $request->input('address');

        // Save the updated customer
        $customer->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('danh-sach-khach-hang')->with('success', 'Cập nhật khách hàng thành công.');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Customer::destroy($request->id);

        return redirect()->route('danh-sach-khach-hang')->with('success', 'Tài khoản đã được xóa thành công.');
    }
    public function duNo(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'duNo' => 'required|numeric',  // Ensure duNo is numeric for calculation
        ]);

        // Find the customer's orders
        $orders = Order::where('customerID', $request->id)->get();

        if ($orders->isEmpty()) {
            return redirect()->route('danh-sach-khach-hang')->with('error', 'Không tìm thấy đơn hàng nào của khách hàng này.');
        }

        // Calculate the total outstanding debt for the customer
        $totalDebt = $orders->sum('tienNo');

        // The amount the customer has paid
        $amountPaid = $request->duNo;

        // Check if the amount paid is greater than the total debt
        if ($amountPaid > $totalDebt) {
            return redirect()->route('danh-sach-khach-hang')->with('error', 'Số tiền trả lớn hơn số tiền nợ.');
        }

        // Calculate the new debt
        $newDebt = $totalDebt - $amountPaid;

        // Update the tienNo for each order
        foreach ($orders as $order) {
            if ($amountPaid <= 0) break;

            if ($order->tienNo <= $amountPaid) {
                $amountPaid -= $order->tienNo;
                $order->tienNo = 0;
            } else {
                $order->tienNo -= $amountPaid;
                $amountPaid = 0;
            }
            $order->save();
        }

        return redirect()->route('danh-sach-khach-hang')->with('success', 'Cập nhật dư nợ cho khách hàng thành công.');
    }
}