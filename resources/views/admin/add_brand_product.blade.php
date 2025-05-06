@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <?php

            use Illuminate\Support\Facades\Session;

            $thongbao = Session::get('thongbao');
            if ($thongbao) {
                echo '<span style="color: red; font-size: 20px;">' . $thongbao . '</span>';
                Session::put('thongbao', null); // Xóa thông báo sau khi hiển thị
            }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{ route('admin.luu_thuonghieu_sanpham') }}">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" rows="9" cols="125" name="brand_desc" id="exampleInputPassword1" placeholder="mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <select class="form-control m-bot15" name="brand_status" id="exampleInputFile">
                                <label for="exampleInputFile">Hiển thị</label>
                                <option value=0>Ẩn</option> <!--value 0,1 tuong trung cho an va hien kieu int trong category_product_status -->
                                <option value=1>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm thương hiệu sản phẩm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection