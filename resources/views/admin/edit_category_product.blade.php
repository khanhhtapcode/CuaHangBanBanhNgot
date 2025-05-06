@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
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
                @foreach ($edit_category_product as $key => $edit_value)
                <div class="position-center">
                <form role="form" method="post" action="{{ route('admin.luucapnhat_danhmuc', ['category_product_id' => $edit_value->category_id]) }}">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_value->category_name }}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="9" cols="125" name="category_product_desc" id="exampleInputPassword1" placeholder="mô tả">{{ $edit_value->category_desc}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
    @endsection