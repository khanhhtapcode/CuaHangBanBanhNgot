@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    @foreach ($category_name as $key => $cate_name)
    
    <h2 class="title text-center">{{ $cate_name->category_name}}</h2>
    @endforeach

    @foreach ($product as $key => $pro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to ('public/uploads/product/'.$pro->product_image) }}" alt="" />
                    <h2>{{number_format ($pro->product_price)." "."VNĐ" }}</h2>
                    <p>{{ $pro->product_name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
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