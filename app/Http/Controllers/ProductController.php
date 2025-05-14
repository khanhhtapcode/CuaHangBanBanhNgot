<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();
class ProductController extends Controller
{
    public function them_sanpham()
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('category_product', $category_product)->with('brand_product', $brand_product);
    }
    // hàm lấy danh sách danh mục sản phẩm
    public function lietke_sanpham()
    {
        $lietke_sanpham = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('tbl_product.product_id', 'desc')
            ->get(); // <--- Quan trọng!

        return view('admin.list_product')->with('list_product', $lietke_sanpham);
    }


    public function luu_sanpham(Request $request)
    {
        $get_image = $request->file('product_image');

        if (!$get_image) {
            Session::put('thongbao', 'Vui lòng chọn ảnh sản phẩm');
            return redirect()->back(); // ← về lại form
        }

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_product_id;
        $data['brand_id'] = $request->brand_id;
        // Kiểm tra brand_id
        if (!$request->brand_id) {
            Session::put('thongbao', 'Vui lòng chọn thương hiệu sản phẩm');
            return redirect()->back();
        }
        $data['product_status'] = $request->product_status;

        $new_image = time() . '.' . $get_image->getClientOriginalExtension();
        $get_image->move('public/uploads/product', $new_image);
        $data['product_image'] = $new_image;

        DB::table('tbl_product')->insert($data);
        Session::put('thongbao', 'Thêm sản phẩm thành công');
        return Redirect::route('admin.list_product');
    }


    public function an_sanpham($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('thongbao', 'Ẩn sản phẩm thành công');
        return Redirect::route('admin.list_product');
    }
    public function hien_sanpham($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('thongbao', 'Hiệnr thị sản phẩm thành công');
        return Redirect::route('admin.list_product');
    }
    public function sua_sanpham($product_id)
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        // Lấy thông tin sản phẩm cần sửa
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get(); // dùng get() vì trong view có foreach

        return view('admin.edit_product')
            ->with('edit_product', $edit_product) // ← TRUYỀN ĐÚNG DỮ LIỆU
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product);
    }

    public function luucapnhat_sanpham(Request $request, $product_id)
    {
        $get_image = $request->file('product_image');

        // Chuẩn bị dữ liệu cần cập nhật
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_product_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;

        // Nếu có ảnh mới thì xử lý, còn không thì giữ nguyên ảnh cũ
        if ($get_image) {
            $new_image = time() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        // Cập nhật vào database
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);

        Session::put('thongbao', 'Cập nhật sản phẩm thành công');
        return Redirect::route('admin.list_product');
    }
    public function xoa_sanpham(Request $request, $product_id)
    {
        $data = array();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('thongbao', 'Xóa sản phẩm thành công');
        return Redirect::route('admin.list_product');
    }
}
