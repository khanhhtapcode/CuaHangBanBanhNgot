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
        return Redirect::route('admin.add_category_product');
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
    public function sua_danhmuc($category_product_id){
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
}
