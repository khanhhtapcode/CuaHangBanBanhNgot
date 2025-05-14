    @extends('admin_layout')
    @section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
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
                        @foreach($edit_product as $key => $edit_value)
                        <form role="form" method="post" action="{{ route('admin.luucapnhat_sanpham', ['product_id' => $edit_value->product_id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="product_name" value="{{$edit_value->product_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea style="resize: none" rows="9" cols="125" name="product_desc" id="exampleInputPassword1" placeholder="mô tả">{{$edit_value->product_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea style="resize: none" rows="9" cols="125" name="product_content" id="exampleInputPassword1" placeholder="nhập nội dung">{{$edit_value->product_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="number" name="product_price" value="{{$edit_value->product_price}}" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" required>
                            </div>
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" value="" class="form-control" id="exampleInputEmail1" placeholder="hình ảnh sản phẩm">
                                <img src="{{ asset('public/uploads/product/' . $edit_value->product_image) }}" width="100" height="150" alt="">
                            </div>
                            <div class="form-group">
                                <!--trả về tên và id tương ứng của category_product  -->
                                <label for="category_status_1">Danh mục sản phẩm</label>
                                <select class="form-control m-bot15" name="category_product_id" id="category_status_1">
                                    @foreach ($category_product as $cate)

                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <!--trả về tên và id tương ứng của brand  -->
                            <div class="form-group">
                                <label for="category_status_2">Thương hiệu sản phẩm</label>
                                <select class="form-control m-bot15" name="brand_id" id="category_status_2">
                                    @foreach ($brand_product as $brand)

                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_status_3">Hiển thị</label>
                                <select class="form-control m-bot15" name="product_status" id="category_status_3">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
        @endsection