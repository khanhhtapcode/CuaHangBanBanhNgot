<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class AdminController extends Controller
{
    // form dang nhap
    public function index()
    {
        return view('admin_login');
    }
    // trang chu admin
    public function show_dashboard()
    {
        return view('admin.dashboard');
    }
    // xu li dang nhap
    public function truycap_dashboard(Request $request)
    {
        $admin_email = $request->input('admin_email');
        $admin_password = md5($request->input('admin_password'));
        $result = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
    
        if ($result) {
            // Đăng nhập thành công
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            // Sai tài khoản/mật khẩu
            Session::put('canh_bao', 'Mật khẩu hoặc tên đăng nhập không đúng');
            return Redirect::to('/admin');
        }
    }
    
    // phuong thuc dang xuat
    public function dangxuat(Request $request)
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        echo "ban da dang xuat";
        return Redirect::to('/admin');
    }
}
