@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
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
                @foreach ($edit_brand_product as $key => $edit_value)
                <div class="position-center">
                <form role="form" method="post" action="{{ route('admin.luucapnhat_thuonghieu', ['brand_id' => $edit_value->brand_id]) }}">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="exampleInputEmail1">Tên thuong hiệu</label>
                            <input type="text" value="{{ $edit_value->brand_name }}" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả cho thương hiệu</label>
                            <textarea style="resize: none" rows="9" cols="125" name="brand_desc" id="exampleInputPassword1" placeholder="mô tả">{{ $edit_value->brand_desc}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
    @endsection