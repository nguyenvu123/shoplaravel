@extends('layout')
@section('content')
    <h1>next bai 11</h1>
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất </h2>

        <?php foreach ($products_new as $prod_new): ?>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{URL::to ('/product-detail/'.$prod_new->product_id)}}"> <img src="{{('public/upload/products/'.$prod_new->product_img)}}" alt=""/></a>

                        <h2>{{number_format($prod_new->product_price)}} VNĐ</h2>
                        <p>{{$prod_new->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>

                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div><!--features_items-->
@endsection