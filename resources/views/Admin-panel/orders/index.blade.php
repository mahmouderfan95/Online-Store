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
                <th>تريخ الطلب</th>
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
                    <td>{{$order->created_at->format('d/m/Y')}}</td>
                    <td>{{ $order->user->name}}</td>
                    <td>{{ $order->user->phone_number }}</td>
                    <td>{{ $order->user->address }}</td>
                    <td>{{ $order->total_price . ' EGB'}}</td>
                    <td>{{ $order->status}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('order.details',$order->id)}}">تفاصيل الطلب</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_{{$order->id}}">
                            تعديل حالة الطلب
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">تعديل حالة الطلب</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('orders.update',$order->id)}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <div class="form-group">
                                                <label for="order_status">حالة الطلب</label>
                                                <select id="order_status" class="form-control" name="status">
                                                    <option hidden value="">اختر حالة الطلب</option>
                                                    <option {{$order->status == 'done' ? 'selected' : ''}} value="done">تم الانتهاء</option>
                                                    <option {{$order->status == 'cancel' ? 'selected' : ''}} value="cancel" >تم الالغاء</option>
                                                    <option {{$order->status == 'pending' ? 'selected' : ''}} value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">تحديث</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@stop
