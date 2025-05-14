<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    public function index()
    {
        $category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->limit(6)->get();
        return view('pages.home')->with('category_product', $category_product)->with('brand_product', $brand_product)->with('product', $product);
    }
}
