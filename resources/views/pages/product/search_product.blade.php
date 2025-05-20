@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    
    @foreach ($search_product as $key => $search)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to ('public/uploads/product/'.$search->product_image) }}" alt="" />
                    <h2>{{number_format ($search->product_price)." "."VNĐ" }}</h2>
                    <p>{{ $search->product_name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format ($search->product_price)." "."VNĐ"}}</h2>
                        <p>{{ $search->product_name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
     @endforeach
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div>
@endsection