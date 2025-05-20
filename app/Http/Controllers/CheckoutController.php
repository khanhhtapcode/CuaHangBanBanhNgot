<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();
class CheckoutController extends Controller
{
    //
    public function login_checkout()
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product);
    }
    public function signup_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout()
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session, mặc định mảng rỗng nếu chưa có
        return view('pages.checkout.show_checkout')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('cart', $cart); // Truyền biến cart sang view
    }
    public function save_shipping(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        Session::put('shipping_name', $request->shipping_name);
        return Redirect::to('/payment');
    }
    public function payment()
    {  
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session, mặc định mảng rỗng nếu chưa có
        return view('pages.checkout.payment')->
            with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('cart', $cart); // Truyền biến cart sang view
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email = $request->customer_email;
        $password = md5($request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
    
}
