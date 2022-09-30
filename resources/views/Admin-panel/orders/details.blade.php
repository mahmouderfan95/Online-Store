@extends('layoutes.admin.admin')
@section('title','تفاصيل الطلب')
@section('content')
    @include('layoutes.admin.success')
    @include('layoutes.admin.error')
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>صورة المنتج</th>
                <th>سعر المنتج</th>
                <th>الكمية المطلوبة</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach ($details as $detail)
                @foreach($detail->cart->details as $cart_detail)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $cart_detail->product->name}}</td>
                        <td><img width="80" src="{{ $cart_detail->product->image }}"></td>
                        <td>{{ $cart_detail->product->price . ' EGB' }}</td>
                        <td>{{ $cart_detail->qty }}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>


@stop
