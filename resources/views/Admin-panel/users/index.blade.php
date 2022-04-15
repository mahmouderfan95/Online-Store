@extends('layoutes.admin.admin')
@section('title','المستخدمين')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            اضافة مستخدم جديد
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مستخدم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">اسم المستخدم</label>
                                    <input autocomplete="off" required="required" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">البريد الالكترونى</label>
                                    <input autocomplete="off" required="required" name = "email" type="text" class="@error('email') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">كلمة السر</label>
                                    <input autocomplete="off" required="required" name = "password" type="password" class="@error('password') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">الهاتف المحمول</label>
                                    <input autocomplete="off" required="required" name = "phone_number" type="text" class="@error('phone_number') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('phone_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">العنوان</label>
                                    <input autocomplete="off" required="required" name = "address" type="text" class="@error('address') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">اضافة</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <br><br>
    @include('layoutes.admin.success')
    @include('layoutes.admin.error')
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>اسم المستخدم</th>
            <th>البريد الالكترونى</th>
            <th>الهاتف المحمول</th>
            <th>العنوان</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0 ?>
        @foreach ($users as $user)
            <?php $i++ ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number}}</td>
                <td>{{$user->address}}</td>
                <td>
                    {{--  @if(auth('admin')->user()->store_id == null)  --}}
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#edit{{ $user->id }}"
                            title="Edit"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete{{ $user->id }}"
                            title="Delete"><i
                            class="fa fa-trash"></i></button>
                    {{--  @endif  --}}
                </td>
            </tr>
            <!-- edit_modal_Grade -->
            <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                id="exampleModalLabel">
                                تعديل
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- edit_form -->
                            <form action="{{route('users.update','test')}}" method="post">
                                {{ method_field('patch') }}
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="old_password" value="{{$user->password}}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">اسم المستخدم</label>
                                            <input value="{{$user->name}}" autocomplete="off" required="required" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">البريد الالكترونى</label>
                                            <input value="{{$user->email}}" autocomplete="off" required="required" name = "email" type="text" class="@error('email') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">كلمة السر</label>
                                            <input autocomplete="off" name = "password" type="password" class="@error('password') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">الهاتف المحمول</label>
                                            <input value="{{$user->phone_number}}" autocomplete="off" required="required" name = "phone_number" type="text" class="@error('phone_number') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('phone_number')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fname">العنوان</label>
                                            <input value="{{$user->address}}" autocomplete="off" required="required" name = "address" type="text" class="@error('address') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">اغلاق</button>
                                    <button type="submit"
                                            class="btn btn-success">تحديث</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- delete_modal_Grade -->
            <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                id="exampleModalLabel">
                                حذف  <b>{{ $user->name }}</b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('users.destroy','test')}}"
                                  method="post">
                                {{ method_field('Delete') }}
                                @csrf
                                Are You Sure ?
                                <input id="id" type="hidden" name="user_id" class="form-control"
                                       value="{{ $user->id }}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">اغلاق</button>
                                    <button type="submit"
                                            class="btn btn-danger">حذف</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </table>
@endsection
