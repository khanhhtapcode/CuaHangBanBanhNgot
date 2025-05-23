<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class BrandProduct extends Controller
{
    //
    public function them_thuonghieu()
    {
        return view('admin.add_brand_product');
    }
    // hàm lấy danh sách danh mục sản phẩm
    public function lietke_thuonghieu()
    {
        $lietke_thuonghieu = DB::table('tbl_brand')->get();
        return view('admin.list_brand_product')->with('list_brand_product', $lietke_thuonghieu);
    }

    public function luu_thuonghieu_sanpham(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;
        DB::table('tbl_brand')->insert($data);
        Session::put('thongbao', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::route('admin.list_brand_product');
    }
    public function an_thuonghieu($brand_id)
    {
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status' => 1]);
        Session::put('thongbao', 'Ẩn thương hiệu sản phẩm thành công');
        return Redirect::route('admin.list_brand_product');
    }
    public function hien_thuonghieu($brand_id)
    {
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status' => 0]);
        Session::put('thongbao', 'Hiện thương hiệu sản phẩm thành công');
        return Redirect::route('admin.list_brand_product');
    }
    public function sua_thuonghieu($brand_id){
        // lấy thông tin danh mục sản phẩm
        $sua_thuonghieu = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();
        return view('admin.edit_brand_product')->with('edit_brand_product', $sua_thuonghieu);
        //
    }
    public function luucapnhat_thuonghieu(Request $request, $brand_id)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);
        Session::put('thongbao', 'Sửa thương hiệu sản phẩm thành công');
        return Redirect::route('admin.list_brand_product');
    }
    public function xoa_thuonghieu(Request $request, $brand_id)
    {
        $data = array();
        DB::table('tbl_brand')->where('bthương hiệurand_id', $brand_id)->delete();
        Session::put('thongbao', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::route('admin.list_brand_product');
    }

    //Kết thúc phần admin của thương hiệu sản phẩm

    public function show_brand_home($brand_id)
    {
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        // Lấy danh sách sản phẩm theo danh mục
        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('tbl_brand.brand_id', $brand_id)
            ->orderby('tbl_product.product_id', 'desc')->get();

        // Lấy tên hiển thị thương hiệu
        $brand_by_name = DB::table('tbl_brand')->where('brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('product', $brand_by_id)// Truyền biến $product
            ->with('brand_name', $brand_by_name);// Truyền biến $brand_by_name
    }
}
