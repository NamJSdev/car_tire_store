<?php

namespace App\Http\Controllers;

use App\Models\PaymentSlip;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentSlipController extends Controller
{
    public function index()
    {
        $datas = PaymentSlip::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.payment-slip', compact('datas'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'cash' => 'required',
            'desc' => 'nullable|string',
        ]);

        if ($request->name == 0) {
            $name = "Nhập Tiền Mặt";
            $status = 0;
        } else {
            $name = "Phiếu Chi";
            $status = 1;
        };
        // Create a new category
        $payment = PaymentSlip::create([
            'name' => $name,
            'cash' => $request->cash,
            'desc' => $request->input('desc'),
            'ngayTao' => Carbon::now(),
            'status' => $status,
        ]);

        // Redirect to a page with a success message
        return redirect()->route('payment_slips.index')->with('success', 'Phiếu đã được tạo thành công.');
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'cash' => 'required',
            'desc' => 'nullable|string',
        ]);
        // Find the category by ID
        $payment = PaymentSlip::find($request->id);

        if (!$payment) {
            return redirect()->route('payment_slips.index')->with('error', 'Phiếu không tồn tại.');
        }
        // Save the updated category
        if ($request->name == 0) {
            $status = 0;
            $name = "Nhập Tiền Mặt";
        } else {
            $name = "Phiếu Chi";
            $status = 1;
        };
        $payment->name = $name;
        $payment->status = $status;
        $payment->desc = $request->desc;
        $payment->cash = $request->cash;
        $payment->save();

        // Redirect to a page with a success message
        return redirect()->route('payment_slips.index')->with('success', 'Phiếu đã được cập nhật thành công.');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        PaymentSlip::destroy($request->id);

        return redirect()->route('payment_slips.index')->with('success', 'Phiếu đã được xóa thành công.');
    }
}