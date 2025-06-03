@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
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
                    // echo '<pre>';
                    // print_r($item);
                    // echo '</pre>';
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
</section>
<section id="do_action">
    <div class="container">
        <!-- <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div> -->
        <div class="row">
            <!-- <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div> -->
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>

                        <li>Tổng tiền<span>{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
                        <li>Phí ship<span>Free</span></li>
                        <li>Tổng<span>{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
                    </ul>
                    <!-- <a class="btn btn-default update" href="">Update</a> -->
                    <?php

                    use Illuminate\Support\Facades\Session;

                    $customer_id = Session::get('customer_id');
                    if ($customer_id != NULL) {

                    ?>
                    <?php
                    Session::put('total', $total);
                    ?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-default check_out " href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
