@extends('layoutes.admin.admin')
@section('title','الاقسام')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            اضافة قسم جديد
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة قسم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">اسم القسم</label>
                                    <input required="required" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="desc">وصف القسم</label>
                                <textarea required="required" name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control"></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-none" id="cats_list" >
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="projectinput1"> اختر القسم الرئيسى
                                    </label>
                                    <select name="parent" class="select2 form-control">
                                        <option value="">اختر القسم</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent')
                                        <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>قسم رئيسى </label>
                                <input type="radio" name="type" value="1" checked class="switchery"data-color="success"/>
                            </div>
                            <div class="col-md-4">
                                <label>قسم فرعى</label>
                                <input type="radio" name="type" value="2" class="switchery" data-color="success"/>
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
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم القسم</th>
                <th>وصف القسم</th>
                <th>قسم رئيسى</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach ($categories as $cat)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->description }}</td>
                        <td>{{ $cat->_parent ? $cat->_parent->name : '-'}}</td>
                        <td>
                            {{--  @if(auth('admin')->user()->store_id == null)  --}}
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $cat->id }}"
                                    title="Edit"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $cat->id }}"
                                    title="Delete"><i
                                    class="fa fa-trash"></i></button>
                            {{--  @endif  --}}
                        </td>
                    </tr>
                    <!-- edit_modal_Grade -->
                    <div class="modal fade" id="edit{{ $cat->id }}" tabindex="-1" role="dialog"
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
                                    <form action="{{route('categories.update','test')}}" method="post">
                                        {{ method_field('patch') }}
                                        @csrf
                                        <input type="hidden" name="cat_id" value="{{ $cat->id }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fname">اسم القسم</label>
                                                    <input required="required" value="{{ $cat->name }}" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="desc">وصف القسم</label>
                                                <textarea required="required" name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{ $cat->description }}</textarea>
                                                @error('description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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
                    <div class="modal fade" id="delete{{ $cat->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        حذف القسم <b>{{ $cat->name }}</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('categories.destroy','test')}}"
                                          method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        Are You Sure ?
                                        <input id="id" type="hidden" name="cat_id" class="form-control"
                                               value="{{ $cat->id }}">
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
        <script src="{{ URL::asset('assets/Admin/js/jquery-3.3.1.min.js') }}"></script>
        <script>
            $('input:radio[name="type"]').change(
                function(){
                    if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                        $('#cats_list').removeClass('d-none');
                    }else{
                        $('#cats_list').addClass('d-none');
                    }
                });
        </script>
    </div>


@stop
