<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

// fronend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('dashboard', 'HomeController@index');
Route::get('/trang-chu', function () {
    return view('trangchu');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
// sang trang login
Route::get('/admin/login', function () {
    return view('admin_login');
})->name('admin_login');




// backend
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/dashboard', action: [AdminController::class, 'show_dashboard'])->name('admin.show_dashboard');
Route::post('/admin-dashboard', [AdminController::class, 'truycap_dashboard'])->name('admin.truycap_dashboard'); // phuong thuc post lay du lieu tu form va xu li
Route::get('/dangxuat', action: [AdminController::class, 'dangxuat'])->name('admin.dangxuat');

//Danh muc san pham(categoryproduct)
// Hiển thị form thêm danh mục
Route::get('/them-danhmuc', [CategoryProduct::class, 'them_danhmuc'])->name('admin.add_category_product');
// Hiển thị danh sách danh mục
Route::get('/lietke-danhmuc', [CategoryProduct::class, 'lietke_danhmuc'])->name('admin.list_category_product');
// Xử lý thêm danh mục
Route::post('/luu-danhmuc-sanpham', [CategoryProduct::class, 'luu_danhmuc_sanpham'])->name('admin.luu_danhmuc_sanpham');
// Xử lý ẩn/hiện
Route::get('/an-danh-muc/{category_product_id}', [CategoryProduct::class, 'an_danhmuc'])->name('admin.an_danhmuc');
Route::get('/hien-danh-muc/{category_product_id}', [CategoryProduct::class, 'hien_danhmuc'])->name('admin.hien_danhmuc');
// / Xử lý sửa danh mục
//Route::get('/sua-danhmuc/{category_product_id}', [CategoryProduct::class, 'luucapnhat_danhmuc'])->name('admin.luucapnhat_danhmuc');
Route::get('/sua-danhmuc/{category_product_id}', [CategoryProduct::class, 'sua_danhmuc'])->name('admin.sua_danhmuc');
Route::post('/luu-capnhat-danhmuc/{category_product_id}', [CategoryProduct::class, 'luucapnhat_danhmuc'])->name('admin.luucapnhat_danhmuc');
// Xử lý xóa danh mục
Route::get('/xoa-danhmuc/{category_product_id}', [CategoryProduct::class, 'xoa_danhmuc'])->name('admin.xoa_danhmuc');


//Thương hiệu sản phẩm
// Hiển thị form thêm danh mục
Route::get('/them-thuonghieu', [BrandProduct::class, 'them_thuonghieu'])->name('admin.add_brand_product');
// Hiển thị danh sách danh mục
Route::get('/lietke-thuonghieu', [BrandProduct::class, 'lietke_thuonghieu'])->name('admin.list_brand_product');
// Xử lý thêm danh mục
Route::post('/luu-thuonghieu-sanpham', [BrandProduct::class, 'luu_thuonghieu_sanpham'])->name('admin.luu_thuonghieu_sanpham');
// Xử lý ẩn/hiện
Route::get('/an-thuonghieu/{brand_id}', [BrandProduct::class, 'an_thuonghieu'])->name('admin.an_thuonghieu');
Route::get('/hien-thuonghieu/{brand_id}', [BrandProduct::class, 'hien_thuonghieu'])->name('admin.hien_thuonghieu');
// / Xử lý sửa danh mục
//Route::get('/sua-danhmuc/{category_product_id}', [CategoryProduct::class, 'luucapnhat_danhmuc'])->name('admin.luucapnhat_danhmuc');
Route::get('/sua-thuonghieu/{brand_id}', [BrandProduct::class, 'sua_thuonghieu'])->name('admin.sua_thuonghieu');
Route::post('/luu-capnhat-thuonghieu/{brand_id}', [BrandProduct::class, 'luucapnhat_thuonghieu'])->name('admin.luucapnhat_thuonghieu');
// Xử lý xóa danh mục
Route::get('/xoa-thuonghieu/{brand_id}', [BrandProduct::class, 'xoa_thuonghieu'])->name('admin.xoa_thuonghieu');

//sản phẩm
// Hiển thị form thêm danh mục
Route::get('/them-sanpham', [ProductController::class, 'them_sanpham'])->name('admin.add_product');
// Hiển thị danh sách danh mục
Route::get('/lietke-sanpham', [ProductController::class, 'lietke_sanpham'])->name('admin.list_product');
// Xử lý thêm danh mục
Route::post('/luu-sanpham', [ProductController::class, 'luu_sanpham'])->name('admin.luu_sanpham');
// Xử lý ẩn/hiện
Route::get('/an-sanpham/{product_id}', [ProductController::class, 'an_sanpham'])->name('admin.an_sanpham');
Route::get('/hien-sanpham/{product_id}', [ProductController::class, 'hien_sanpham'])->name('admin.hien_sanpham');
// / Xử lý sửa danh mục
//Route::get('/sua-danhmuc/{category_product_id}', [CategoryProduct::class, 'luucapnhat_danhmuc'])->name('admin.luucapnhat_danhmuc');
Route::get('/sua-sanpham/{product_id}', [ProductController::class, 'sua_sanpham'])->name('admin.sua_sanpham');
Route::post('/luu-capnhat-sanpham/{product_id}', [ProductController::class, 'luucapnhat_sanpham'])->name('admin.luucapnhat_sanpham');
// Xử lý xóa danh mục
Route::get('/xoa-sanpham/{product_id}', [ProductController::class, 'xoa_sanpham'])->name('admin.xoa_sanpham');























































Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
