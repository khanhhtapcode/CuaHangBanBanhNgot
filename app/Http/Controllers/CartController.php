<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class CartController extends Controller
{
    //
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        // Lấy thông tin sản phẩm theo ID
        $product_info = DB::table('tbl_product')
            ->where('product_id', $productId)
            ->first();

        // Lấy danh sách danh mục (để hiển thị trên trang giỏ hàng)
        $category_product = DB::table('tbl_category_product')
            ->orderby('category_id', 'desc')->get();
        // Lấy danh sách thương hiệu (để hiển thị trên trang giỏ hàng)
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        // Lấy giỏ hàng hiện tại từ session, hoặc tạo mới mảng trống
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã có trong giỏ, cộng dồn số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$productId] = [
                'product_id' => $product_info->product_id,
                'product_name' => $product_info->product_name,
                'product_price' => $product_info->product_price,
                'product_image' => $product_info->product_image,
                'quantity' => $quantity,
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Trả về view show_cart với danh mục và giỏ hàng
        return Redirect::to('/show-cart');
    }
    public function show_cart()
    {
        $category_product = DB::table('tbl_category_product')
            ->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session, mặc định mảng rỗng nếu chưa có

        return view('pages.cart.show_cart')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('cart', $cart); // Truyền biến cart sang view
    }
    public function delete_cart($product_id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]); // Xóa sản phẩm khỏi giỏ hàng
        }

        session()->put('cart', $cart); // Cập nhật giỏ hàng trong session

        return Redirect::to('/show-cart'); // Quay lại trang giỏ hàng
    }
    public function update_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $action = $request->input('action'); // "increase" hoặc "decrease"

        $cart = session()->get('cart');

        if ($cart && isset($cart)) {
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $product_id) {
                    if ($action === 'increase') {
                        $cart[$key]['quantity'] += 1;
                    } elseif ($action === 'decrease') {
                        $cart[$key]['quantity'] = max(1, $cart[$key]['quantity'] - 1); // không nhỏ hơn 1
                    }
                }
            }
        }

        session()->put('cart', $cart); // Cập nhật session

        return redirect('/show-cart'); // Trả về trang giỏ hàng
    }
}
