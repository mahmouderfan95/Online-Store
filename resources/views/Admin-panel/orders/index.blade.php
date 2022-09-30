@extends('layoutes.admin.admin')
@section('title','الطلبات')
@section('content')
    @include('layoutes.admin.success')
    @include('layoutes.admin.error')
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم العميل</th>
                <th>تلفون العميل</th>
                <th>عنوان العميل</th>
                <th>المبلغ الاجمالى</th>
                <th>حالة الطلب</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach ($orders as $order)
                <?php $i++ ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $order->user->name}}</td>
                    <td>{{ $order->user->phone_number }}</td>
                    <td>{{ $order->user->address }}</td>
                    <td>{{ $order->total_price . ' EGB'}}</td>
                    <td>{{ $order->status}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('order.details',$order->id)}}">تفاصيل الطلب</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@stop
