@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Các thương hiệu sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Chọn thao tác</option>
                    <option value="1">Xóa mục đã chọn</option>
                    <option value="2">Chỉnh sửa hàng loạt</option>
                    <option value="3">Xuất dữ liệu</option>
                </select>

                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php

            use Illuminate\Support\Facades\Session;

            $thongbao = Session::get('thongbao');
            if ($thongbao) {
                echo '<span style="color: red; font-size: 20px;">' . $thongbao . '</span>';
                Session::put('thongbao', null); // Xóa thông báo sau khi hiển thị
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên thương hiệu</th>
                        <th>Hiển thị</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_brand_product as $key => $brand)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox"
                                    name="post[]"><i></i></label></td>
                        <td>{{ $brand->brand_name }}</td>
                        <td><span class="text-ellipsis">
                                <?php
                                if ($brand->brand_status == 0) {
                                    echo 'Ẩn';
                                ?>

                                    <a href="{{ route('admin.an_thuonghieu', ['brand_id' => $brand->brand_id]) }}"><span class="fa-styling fa fa-thumbs-down"></span></a>

                                <?php
                                } else {
                                    echo 'Hiện';
                                ?>
                                    <a href="{{ route('admin.hien_thuonghieu', ['brand_id' => $brand->brand_id]) }}"><span class="fa-styling fa fa-thumbs-up"></span></a>

                                <?php
                                }
                                ?>
                            </span></td>
                        <td>{{ $brand->brand_desc }}</td>
                        <td>
                            <a href="{{ route('admin.sua_thuonghieu', ['brand_id' => $brand->brand_id]) }}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-active"></i></a>
                            <a  href="{{ route('admin.xoa_thuonghieu', ['brand_id' => $brand->brand_id]) }}"  onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?')" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">hiển thị 20-30 trong tổng số 50 danh mục</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection