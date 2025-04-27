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
    public function lietke_danhmuc()
    {
        return view('admin.list_category_product');
    }
    public function luu_danhmuc_sanpham(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_des'] = $request->category_product_des;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('thongbao', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/lietke-danhmuc');
    }
    
}
