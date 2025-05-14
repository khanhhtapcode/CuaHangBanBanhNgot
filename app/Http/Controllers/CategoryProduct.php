<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();
class CategoryProduct extends Controller
{
    // 
    public function them_danhmuc()
    {
        return view('admin.add_category_product');
    }
    // hàm lấy danh sách danh mục sản phẩm
    public function lietke_danhmuc()
    {
        $lietke_danhmuc = DB::table('tbl_category_product')->get();
        return view('admin.list_category_product')->with('list_category_product', $lietke_danhmuc);
    }

    public function luu_danhmuc_sanpham(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('thongbao', 'Thêm danh mục sản phẩm thành công');
        return Redirect::route('admin.list_category_product');
    }
    public function an_danhmuc($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('thongbao', 'Ẩn danh mục sản phẩm thành công');
        return Redirect::route('admin.list_category_product');
    }
    public function hien_danhmuc($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('thongbao', 'Hiện danh mục sản phẩm thành công');
        return Redirect::route('admin.list_category_product');
    }
    public function sua_danhmuc($category_product_id)
    {
        // lấy thông tin danh mục sản phẩm
        $sua_danhmuc = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        return view('admin.edit_category_product')->with('edit_category_product', $sua_danhmuc);
        //
    }
    public function luucapnhat_danhmuc(Request $request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('thongbao', 'Sửa danh mục sản phẩm thành công');
        return Redirect::route('admin.list_category_product');
    }
    public function xoa_danhmuc(Request $request, $category_product_id)
    {
        $data = array();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('thongbao', 'Xóa danh mục sản phẩm thành công');
        return Redirect::route('admin.list_category_product');
    }
    public function timkiem(Request $request)
    {
        $keyword = $request->keyword;
        $timkiem = DB::table('tbl_category_product')->where('category_name', 'like', '%' . $keyword . '%')->get();
        return view('admin.list_category_product')->with('list_category_product', $timkiem);
    }
    //Kết thúc phần admin của danh mục sản phẩm

    public function show_category_home($category_id)
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        // Lấy danh sách sản phẩm theo id
        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_category_product.category_id', $category_id)
            ->orderby('tbl_product.product_id', 'desc')->get();

        // Lấy tên danh mục
        $category_by_name = DB::table('tbl_category_product')->where('category_id', $category_id)->limit(1)->get();



        return view('pages.category.show_category')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('product', $category_by_id) // Truyền biến $product
            ->with('category_name', $category_by_name); // Truyền biến $category_name
    }
}
