@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
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
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php

            // use Illuminate\Support\Facades\Session;

            // $thongbao = Session::get('thongbao');
            // if ($thongbao) {
            //     echo '<span style="color: red; font-size: 20px;">' . $thongbao . '</span>';
            //     Session::put('thongbao', null); // Xóa thông báo sau khi hiển thị
            // }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Tình trạng</th>
                        <th>Hành động</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lietke_donhang as $key => $order)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox"
                                    name="post[]"><i></i></label></td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->order_total }}</td>
                        <td>{{ $order->order_status }}</td>
                        <td>
                            <a href="{{ route('admin.update_order', ['order_id' => $order->order_id]) }}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-active"></i></a>
                            <a  href="{{ route('admin.delete_order', ['order_id' => $order->order_id]) }}"  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')" class="active" ui-toggle-class="">
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