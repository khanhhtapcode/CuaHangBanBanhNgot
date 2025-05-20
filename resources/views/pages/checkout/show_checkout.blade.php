@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Thanh Toán giỏ hàng</li>
            </ol>
        </div>

        <div class="register-req">
            <p>Vui lòng đăng ký tài khoản và tiến hành thanh toán để dễ dàng theo dõi lịch sử đơn hàng, hoặc tiếp tục với thanh toán không cần đăng ký.</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-20 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin khách hàng</p>
                        <div class="form-one">
                            <form action="{{ URL::to('/save-shipping') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_name" placeholder="Họ và tên">
                                <input type="email" name="shipping_email" placeholder="Email*">

                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <p>Ghi chú gửi hàng</p>
                                <textarea name="shipping_notes" placeholder="Ghi chú cho đơn hàng, hướng dẫn đặc biệt khi giao hàng" rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm-10">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng và thanh toán</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th class="image">Hình ảnh</th>
                        <th class="description">Tên sản phẩm</th>
                        <th class="price">Đơn giá</th>
                        <th class="quantity">Số lượng</th>
                        <th class="total">Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    ?>
                    @if(!empty($cart) && count($cart) > 0)
                    @foreach($cart as $key => $item)
                    <?php
                    
                    $subtotal = $item['product_price'] * $item['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td class="cart_product">
                            <img src="{{ url('uploads/product/'.$item['product_image']) }}" width="100" alt="{{ $item['product_name'] }}">
                        </td>
                        <td class="cart_description">
                            <h4>{{ $item['product_name'] }}</h4>
                            <p>ID: {{ $item['product_id'] }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($item['product_price'], 0, ',', '.') }} VNĐ</p>
                        </td>
                        <td class="">
                            <!-- <form method="POST" action="{{ url('/update-cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">

                            </form> -->
                        <td class="cart_quantity">
                            {{-- Nút tăng số lượng --}}
                            <form action="{{ route('update.cart') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <input type="hidden" name="action" value="increase">
                                <button type="submit" class="cart_quantity_up"> + </button>
                            </form>

                            {{-- Ô hiển thị số lượng (readonly) --}}
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2" readonly>

                            {{-- Nút giảm số lượng --}}
                            <form action="{{ route('update.cart') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit" class="cart_quantity_down"> - </button>
                            </form>
                        </td>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                $subtotal = $item['product_price'] * $item['quantity'];
                                echo number_format($subtotal, 0, ',', '.') . ' VNĐ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{ URL::to('/delete-to-cart/'.$item['product_id']) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td colspan="2"><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                    </tr> -->
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->


@endsection
