@extends('layoutes.site.site')
@section('title','cart')

@section('css')
    <style>
        .container-cart h3{
            text-align: right;
        }
        .container-cart p{
            background-color: #A333C8;
            color: white;
            width: 20%;
            padding: 10px;
            border-radius: 20px
        }
    </style>
@stop
@section('content')
    <div class="container container-cart col-12 mt-5 mb-5" style="direction: rtl">
        <h3 style="">سلة المشتريات</h3>
        <p style="" class="mt-3">ملاحظة : يتم الدفع عند الاستلام</p>
    </div>
    <div class="container" style="direction: rtl">
        <form action="{{route('cart.product.confirm')}}" method="POST">
            @csrf
            @if(isset($details))
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th>صورة المنتج</th>
                        <th>الكمية المطلوبة</th>
                        <th>سعر المنتج</th>
                        <th>الاجمالى</th>
                        <th>حذف المنتج</th>
                    </tr>
                    <?php $i = -1 ?>
                    @foreach($details as $de)
                        <?php $i++ ?>
                        <tr class="product-rows">
                            <td>{{$de->product->id}}</td>
                            <td>{{$de->product->name}}</td>
                            <td><img width="100" data-src="{{$de->product->image}}"></td>
                            <td>
                                <input type="hidden"  name="cart_id" value="{{$de->cart_id}}">
                                <input type="hidden" name="user_id" value="{{$cart->user_id}}">
                                <input type="hidden" name="products[{{$i}}][product_id]" value="{{$de->product->id}}">
                                <input autocomplete="off" type="number" min="1" class="product_qty form-control" value="1" name="products[{{$i}}][qty]">
                            </td>
                            <td class="product_price">
                                @if($de->product->is_offer == null)
                                    {{$de->product->price}}
                                    جنيه
                                @else
                                    {{$de->product->new_price}}
                                    {{--                                    {!! $de->product->new_price !!}--}}
                                    جنيه
                                @endif
                            </td>
                            <td class="product_result"></td>
                            <td>
                                <a href="{{route('cart.product.delete',[$de->cart_id,$de->product_id])}}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--                <span class="span-product d-none">اجمالى الاوردر</span><p id="product_result"></p>--}}
                {{--                <p style="display: inline-block">اجمالى الطلب : </p>--}}
                {{--                <span id="product-total"></span>--}}
                <br>
                <input id="add_order" type="submit" value="اطلب الاوردر" class="btn btn-primary">
            @else
                <div class="cart_empty mt-3" style="display: flex;justify-content: center;align-items: center">
                    <img src="{{asset('assets/imgs/cart_empty.png')}}">
                </div>
                <div class="cart_empty_text text-center mt-3">
                    <p>سلة المنتجات فارغة</p>
                </div>
            @endif
        </form>
    </div>



@stop
@section('js')
    <script>
        let total = 0,
            products_qty = document.getElementsByClassName('product_qty');
        for (let q = 0;q < products_qty.length;q++){
            let product_qty = products_qty[q];
            let product_result = product_qty.parentElement.nextElementSibling.nextElementSibling;
            product_result.textContent = parseInt(product_qty.value) * parseInt(product_qty.parentElement.nextElementSibling.textContent) + ' جنيه ';
            product_qty.onchange = function (){
                product_result.textContent = parseInt(this.value) * parseInt(this.parentElement.nextElementSibling.textContent) + ' جنيه ';
            }
        }

        // when click button add confirm
        let add_order = document.getElementById('add_order');
        add_order.onclick = function (){
            return confirm('هل انت متأكد من طلب الاوردر ؟');
        }

    </script>
@stop
