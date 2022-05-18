@extends('layoutes.site.site')
@section('title',$product->name)
@section('content')
    <!--================Single Product details =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{$product->image}}" alt="">
                        </div>
                        <!-- <div class="single-prd-item">
                            <img class="img-fluid" src="img/category/s-p1.jpg" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid" src="img/category/s-p1.jpg" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{$product->name}}</h3>
                        <h2>${{$product->price}}</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : {{$product->category->name}}</a></li>
                            <li><a href="#"><span>Qantty</span> : {{$product->qty}}</a></li>
                        </ul>
                        <p>{{$product->description}}</p>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="ti-angle-left"></i></button>
                            <input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="ti-angle-right"></i></button>
                            <a class="button primary-btn" href="#">Add to Cart</a>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product details =================-->
    <!--================ Start related Product area =================-->
    <section class="related-product-area section-margin--small">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>{{$product->category->name}}</p>
                <h2>Related <span class="section-intro__style">Product</span></h2>
            </div>
            <div class="row mt-30">
                @isset($related_product)
                    @foreach($related_product as $product)
                        <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                            <div class="single-search-product-wrapper">
                                <div class="single-search-product d-flex">
                                    <a href="#"><img src="{{$product->image}}" alt=""></a>
                                    <div class="desc">
                                        <a href="{{route('product.details',$product->name)}}" class="title">{{$product->name}}</a>
                                        <div class="price">${{$product->price}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endisset

            </div>
        </div>
    </section>
    <!--================ end related Product area =================-->


@stop
