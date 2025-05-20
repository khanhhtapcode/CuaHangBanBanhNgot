<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cửa hàng bánh ngọt Quang Béo Cakes">
    <meta name="author" content="Quang Béo Cakes">
    <title>Trang chủ | Quang Béo Cakes</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{('public/frontend/js/html5shiv.js')}}"></script>
    <script src="{{('public/frontend/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('public/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('public/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('public/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('public/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    <?php

    use Illuminate\Support\Facades\Session;
    ?>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 123 456 789</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@quangbeocakes.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('public/frontend/images/logo.png') }}" alt="Quang Béo Cakes" />
                            </a>

                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    Việt Nam
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Hà Nội</a></li>
                                    <li><a href="#">TP.HCM</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VND
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">EUR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> Danh sách yêu thích</a></li>
                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                ?>
                                <?php if ($customer_id != NULL && $shipping_id == NULL): ?>
                                    <li>
                                        <a href="{{ URL::to('/checkout') }}">
                                            <i class="fa fa-crosshairs"></i> Thanh toán
                                        </a>
                                    </li>
                                <?php elseif ($customer_id != NULL && $shipping_id != NULL): ?>
                                    <li>
                                        <a href="{{ URL::to('/payment') }}">
                                            <i class="fa fa-crosshairs"></i> Thanh toán
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="{{ URL::to('/login-checkout') }}">
                                            <i class="fa fa-crosshairs"></i> Thanh toán
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li><a href="{{URL::to ('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>


                                <?php

                                $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL) {

                                ?>
                                    <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                <?php
                                } else {
                                ?>
                                    <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Chuyển đổi điều hướng</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Cửa hàng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
                                        <!-- Thanh toán phải kiếm tra điều kiện -->
                                        <?php

                                        $customer_id = Session::get('customer_id');
                                        if ($customer_id != NULL) {

                                        ?>
                                            <li><a href="{{ URL::to('/checkout') }}"></i>Thanh toán</a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="{{ URL::to('/login-checkout') }}">Thanh toán</a></li>
                                        <?php
                                        }
                                        ?>
                                        <!-- <li><a href="checkout.html">Thanh toán</a></li> -->
                                        <li><a href="{{URL::to ('/show-cart') }}">Giỏ hàng</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Danh sách bài viết</a></li>
                                        <li><a href="blog-single.html">Bài viết chi tiết</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{URL::to ('/show-cart') }}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{URL::to ('/tim-kiem') }}" method="post">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" />
                                <button name="search_items" value="Tìm kiếm" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>QUANG</span> BÉO CAKES</h1>
                                    <h2>Cửa hàng bánh ngọt chất lượng</h2>
                                    <p>Thưởng thức những chiếc bánh ngọt thơm ngon, được làm từ nguyên liệu tươi sạch mỗi ngày!</p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/poster1.png')}}" class="girl img-responsive" alt="Bánh ngọt" />

                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>QUANG</span> BÉO CAKES</h1>
                                    <h2>Thiết kế bánh độc đáo</h2>
                                    <p>Đặt bánh theo ý thích, từ bánh sinh nhật đến bánh cưới, chúng tôi đều đáp ứng!</p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/poster1.png')}}" class="girl img-responsive" alt="Bánh kem" />

                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>QUANG</span> BÉO CAKES</h1>
                                    <h2>Bánh ngọt miễn phí giao hàng</h2>
                                    <p>Miễn phí giao hàng nội thành với đơn hàng từ 500.000 ₫!</p>
                                    <button type="button" class="btn btn-default get">Mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/poster1.png')}}" class="girl img-responsive" alt="Bánh quy" />

                                </div>
                            </div>
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-products-->
                            @foreach ($category_product as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ URL::to('/loc-danh-muc-san-pham/'.$cate->category_id) }}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu bánh</h2>

                            <div class="brands-name">

                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand_product as $key => $brand)
                                    <li>
                                        <a href="{{ URL::to('/loc-thuong-hieu-san-pham/'.$brand->brand_id) }}">
                                            <span class="pull-right">(50)</span>{{ $brand->brand_name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <!-- <div class="price-range">
                            <h2>Khoảng giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="2000000" data-slider-step="5000" data-slider-value="[500000,1500000]" id="sl2"><br />
                                <b class="pull-left">0 ₫</b> <b class="pull-right">2.000.000 ₫</b>
                            </div>
                        </div>/price-range -->

                        <!-- <div class="shipping text-center"> shipping -->
                        <!-- <img src="{{('public/frontend/images/home/shipping.jpg')}}" alt="Giao hàng miễn phí" />
                        </div>/shipping -->
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>QUANG</span> BÉO CAKES</h2>
                            <p>Thưởng thức những chiếc bánh ngọt thơm ngon, được làm từ nguyên liệu tươi sạch!</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{URL::to('public/uploads/product/banh1.webp')}}" alt="Video làm bánh" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Video làm bánh quy</p>
                                <h2>24/12/2024</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/frontend/images/home/iframe2.png')}}" alt="Video làm bánh kem" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Video làm bánh kem</p>
                                <h2>24/12/2024</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/frontend/images/home/iframe3.png')}}" alt="Video làm bánh donut" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Video làm bánh donut</p>
                                <h2>24/12/2024</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/frontend/images/home/iframe4.png')}}" alt="Video làm bánh macaron" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Video làm bánh macaron</p>
                                <h2>24/12/2024</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{('public/frontend/images/home/map.png')}}" alt="Bản đồ cửa hàng" />
                            <p>123 Nguyễn Huệ, Quận 1, TP.HCM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hỗ trợ trực tuyến</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Tình trạng đơn hàng</a></li>
                                <li><a href="#">Đổi địa điểm</a></li>
                                <li><a href="#">Câu hỏi thường gặp</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Mua nhanh</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Bánh Quy</a></li>
                                <li><a href="#">Bánh Kem</a></li>
                                <li><a href="#">Bánh Donut</a></li>
                                <li><a href="#">Thẻ quà tặng</a></li>
                                <li><a href="#">Bánh Macaron</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Điều khoản sử dụng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Chính sách hoàn tiền</a></li>
                                <li><a href="#">Hệ thống thanh toán</a></li>
                                <li><a href="#">Hệ thống vé</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Về Quang Béo Cakes</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Thông tin cửa hàng</a></li>
                                <li><a href="#">Tuyển dụng</a></li>
                                <li><a href="#">Địa điểm cửa -
                                <li><a href="#">Chương trình liên kết</a></li>
                                <li><a href="#">Bản quyền</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Nhận thông tin</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Địa chỉ email của bạn" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Nhận thông tin mới nhất từ <br />cửa hàng của chúng tôi...</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Bản quyền © 2025 Quang Béo Cakes. Mọi quyền được bảo lưu.</p>
                    <p class="pull-right">Thiết kế bởi <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
    </footer><!--/Footer-->

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>

</html>