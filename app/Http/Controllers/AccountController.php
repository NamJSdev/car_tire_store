<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Info;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAdminAccount()
    {
        $datas = Account::where('roleID', 1)->get();
        return view('pages.admin-account', compact('datas'));
    }
    public function getStaffAccount()
    {
        $datas = Account::where('roleID', 2)->get();
        return view('pages.staff-account', compact('datas'));
    }

    public function createAccountForm()
    {
        return view('pages.add-account');
    }
    public function createAccount(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:accounts,email',
            'role' => 'required|integer',
            'password' => 'required|min:6',
            'desc' => 'nullable|string',
        ]);

        // Create a new record in the 'infos' table
        $info = Info::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
        ]);

        // Create a new record in the 'accounts' table
        $account = Account::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'roleID' => $request->input('role'),
            'infoID' => $info->id, 
        ]);

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('taikhoanhethong')->with('success', 'Tài Khoản đã được tạo thành công.');
    }

    public function updateAccountAdmin(Request $request)
    {
        // dd($request->user_name);
        $request->validate([
            'id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'desc' => 'string|max:255',
            'email' => 'required|string|max:255|email',
            'password' => 'nullable|string|min:6',
        ]);
    
        // Find the account by ID
        $account = Account::find($request->id);
        
        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }
    
        // Update the account details
        $account->email = $request->email;
        if($request->password != ""){
            $account->password = bcrypt($request->password);
        }
        $account->save();
    
        // Update the info details
        $info = Info::find($account->infoID);
        if ($info) {
            $info->name = $request->user_name;
            $info->desc = $request->desc;
            $info->save();
        } else {
            return redirect()->back()->with('error', 'Associated info not found.');
        }
    
        return redirect()->route('taikhoanhethong')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }
    public function updateAccountStaff(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'desc' => 'string|max:255',
            'email' => 'required|string|max:255|email',
            'password' => 'nullable|string|min:6',
        ]);
    
        // Find the account by ID
        $account = Account::find($request->id);
        
        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }
    
        // Update the account details
        $account->email = $request->email;
        if($request->password != ""){
            $account->password = bcrypt($request->password);
        }
        $account->save();
    
        // Update the info details
        $info = Info::find($account->infoID);
        if ($info) {
            $info->name = $request->user_name;
            $info->desc = $request->desc;
            $info->save();
        } else {
            return redirect()->back()->with('error', 'Associated info not found.');
        }
    
        return redirect()->route('taikhoannhanvien')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }

    public function deleteAccountAdmin(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Account::destroy($request->id);

        return redirect()->route('taikhoanhethong')->with('success', 'Tài khoản đã được xóa thành công.');
    }
    public function deleteAccountStaff(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Account::destroy($request->id);

        return redirect()->route('taikhoannhanvien')->with('success', 'Tài khoản đã được xóa thành công.');
    }
}