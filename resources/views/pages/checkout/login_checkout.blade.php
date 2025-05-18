@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <!-- Form Đăng nhập -->
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Đăng nhập vào tài khoản của bạn</h2>
                    <form action="{{URL::to ('/login-customer') }}" method="post">
                        {{ csrf_field() }}
                        <input type="email" name="customer_email" placeholder="Địa chỉ Email" />
                        <input type="password" name="customer_password" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div>
            </div>

            <!-- Từ ngữ ngăn cách -->
            <div class="col-sm-1">
                <h2 class="or">HOẶC</h2>
            </div>

            <!-- Form Đăng ký -->
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Đăng ký tài khoản mới</h2>
                    <form action="{{ URL::to('/signup-customer') }}" method="post">
                        {{ csrf_field() }}
                        <input type="text" placeholder="Họ và tên" name="customer_name" />
                        <input type="email" placeholder="Địa chỉ Email" name="customer_email" />
                        <input type="text" placeholder="Số điện thoại" name="customer_phone" />
                        <input type="password" placeholder="Mật khẩu" name="customer_password"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection