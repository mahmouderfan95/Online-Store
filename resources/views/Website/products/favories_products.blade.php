@extends('layoutes.site.site')
@section('title','Favorites Products')
@section('content')
    <!-- ================ favorites products section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Favorites <span class="section-intro__style">Products</span></h2>
            </div>
            <div class="row">
                @if($favs->count() > 0)
                    @foreach($favs as $fav)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ $fav->product->image }}" alt="">
                                    <ul class="card-product__imgOverlay">
                                        {{--                                        <li><button><i class="ti-search"></i></button></li>--}}
                                        <li><button><i class="ti-shopping-cart"></i></button></li>
                                        <form action="{{route('product.add.fav')}}" method="POST">
                                            @csrf
                                            @if(auth('web')->user())
                                                <input type="hidden" name="user_id" value="{{auth('web')->user()->id}}">
                                            @endif
                                            <input type="hidden" name="product_id" value="{{$fav->product->id}}">
                                            <li><button type="submit"><i class="ti-heart"></i></button></li>
                                        </form>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{$fav->product->category->name}}</p>
                                    <h4 class="card-product__title"><a href="{{route('product.details',$fav->product->name)}}">{{$fav->product->name}}</a></h4>
                                    <p class="card-product__price">${{$fav->product->price}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="alert-danger">Favorites is empty</p>
                @endif

            </div>
        </div>
    </section>
    <!-- ================ All product section end ================= -->



@stop
