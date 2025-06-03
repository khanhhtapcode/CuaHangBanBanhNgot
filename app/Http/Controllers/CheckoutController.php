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
        $product = DB::table('tbl_product')->orderby('product_id', 'desc')->get();
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session, mặc định mảng rỗng nếu chưa có
        return view('pages.checkout.payment')->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('product', $product)
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
    public function order_place(Request $request)
    {
        // Lưu thông tin thanh toán
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // Lưu đơn hàng
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Session::get('total'); // 💰 Tổng tiền
        $order_data['order_status'] = 'Đang xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // Lưu chi tiết đơn hàng (giả sử có mảng $cart lưu trong Session)
        $cart = Session::get('cart');
        // Lặp qua từng sản phẩm trong giỏ hàng và lưu vào tbl_order_details
        foreach ($cart as $item) {
            $order_detail = array();
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $item['product_id'];
            $order_detail['product_name'] = $item['product_name'];
            $order_detail['product_price'] = $item['product_price'];
            $order_detail['product_sales_quantity'] = $item['quantity'];
            DB::table('tbl_order_details')->insert($order_detail);
        }
        if ($data["payment_method"] == 1) {
            // Thanh toán bằng thẻ ATM nội địa
            // return view('pages.checkout.handcash');
            echo '<h2 style="color: red; text-align: center;">Thanh toán bằng thẻ ATM nội địa</h2>';
        } elseif ($data["payment_method"] == 2) {
            $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
            // Thanh toán bằng tieenf mặt
            return view('pages.checkout.handcash')
                ->with('category_product', $category_product)
                ->with('brand_product', $brand_product);
            // Xóa giỏ hàng sau khi đặt hàng
            Session::forget('cart');
            // echo '<h2 style="color: red; text-align: center;">Thanh toán bằng tiền mặt</h2>';
        } elseif ($data["payment_method"] == 3) {
            // Thanh toán bằng tiền Chuyển Khoản ngan hàng
            // 
            echo '<h2 style="color: red; text-align: center;">Thanh toán bằng chuyen khoan ngan hang</h2>';
        }
        // Xóa giỏ hàng sau khi đặt hàng
        Session::forget('cart');
        Session::forget('total');

        // return redirect('/payment')->with('message', 'Đặt hàng thành công!');
    }
    public function manage_order()
    {
        $lietke_donhang = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_customer.customer_email')
            ->orderBy('tbl_order.order_id', 'desc')
            ->get();

        return view('admin.manage_order')
            ->with('lietke_donhang', $lietke_donhang);
    }
    public function update_order($order_id, Request $request){

    }
    public function delete_order($order_id, Request $request){

    }
}