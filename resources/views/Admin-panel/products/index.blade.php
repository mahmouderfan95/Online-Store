@extends('layoutes.admin.admin')
@section('title','المنتجات')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small mb-3" data-toggle="modal" data-target="#exampleModal">
            اضافة منتج جديد
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة منتج جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">اسم المنتج</label>
                                    <input required="required" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="desc">وصف المنتج</label>
                                <textarea name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control"></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">صورة المنتج</label>
                                    <input required="required" name = "image" type="file" class="@error('image') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">سعر المنتج</label>
                                    <input required="required" name = "price" type="number" class="@error('price') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">كمية المنتج</label>
                                    <input required="required" name = "qty" type="number" class="@error('qty') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                    @error('qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Category</label>
                                <select required="required" name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="">
                                    <option value="">Choose</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">حالة المنتج</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="1">مفعل</option>
                                        <option value="0">غير مفعل</option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input is_offer " type="checkbox" value="0" id="defaultCheck1" name="is_offer">
                                        <label class="form-check-label" for="defaultCheck1">
                                            عرض
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none new_price">
                            <div class="form-group">
                                <label for="fname">سعر المنتج بعد الخصم</label>
                                <input name = "new_price" type="number" class="@error('new_price') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                @error('new_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
    @include('layoutes.admin.success')
    @include('layoutes.admin.error')
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>وصف المنتج</th>
                <th>صورة المنتج</th>
                <th>سعر المنتج</th>
                <th>عليه العرض</th>
                <th>سعر المنتج بعد العرض</th>
                <th>كمية المنتج</th>
                <th>قسم المنتج</th>
                <th>حالة المنتج</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach ($products as $product)
                <?php $i++ ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td><img src="{{$product->image}}" width="100"></td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->is_offer == null ? '-' : 'عليه عرض'}}</td>
                    <td>{{$product->new_price}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->status != 0 ? 'مفعل' : 'غير مفعل'}}</td>

                    <td>
                        {{--  @if(auth('admin')->user()->store_id == null)  --}}
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $product->id }}"
                                title="Edit"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $product->id }}"
                                title="Delete"><i
                                class="fa fa-trash"></i></button>
                        {{--  @endif  --}}
                    </td>
                </tr>
                <!-- edit_modal_product -->
                <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog"
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
                                <form action="{{route('products.update','test')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fname">اسم المنتج</label>
                                                <input value="{{$product->name}}" required="required" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="desc">وصف المنتج</label>
                                            <textarea name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{$product->description}}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fname">صورة المنتج</label>
                                                <input name = "image" type="file" class="@error('image') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fname">سعر المنتج</label>
                                                <input value="{{$product->price}}" required="required" name = "price" type="number" class="@error('price') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fname">كمية المنتج</label>
                                                <input value="{{$product->qty}}" required="required" name = "qty" type="number" class="@error('qty') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                @error('qty')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Category</label>
                                            <select required="required" name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="">
                                                <option value="">Choose</option>
                                                @foreach ($categories as $cat)
                                                    <option {{$product->category_id == $cat->id ? 'selected' : ''}} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fname">حالة المنتج</label>
                                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                    <option {{$product->status == 1 ? 'selected' : ''}} value="1">مفعل</option>
                                                    <option {{$product->status == 0 ? 'selected' : ''}} value="0">غير مفعل</option>
                                                </select>
                                                @error('status')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input {{$product->is_offer == 0 ? 'checked' : ''}} class="form-check-input is_offer " type="checkbox" value="0" id="defaultCheck1" name="is_offer">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        عرض
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none new_price">
                                        <div class="form-group">
                                            <label for="fname">سعر المنتج بعد الخصم</label>
                                            <input value="{{$product->new_price}}" name = "new_price" type="number" class="@error('new_price') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('new_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delete_modal_product -->
                <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    حذف المنتج <b>{{ $product->name }}</b>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('products.destroy','test')}}"
                                      method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    Are You Sure ?
                                    <input id="id" type="hidden" name="product_id" class="form-control"
                                           value="{{ $product->id }}">
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
    <script src="{{ URL::asset('assets/Admin/js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(function (){
            if ($('.is_offer').is(':checked')) {
                $(".new_price").removeClass('d-none');
            }else{
                $(".new_price").addClass('d-none');
            }
            $(".is_offer").on('change',function(){
                if ($(this).is(':checked')) {
                    $(".new_price").removeClass('d-none');
                }else{
                    $(".new_price").addClass('d-none');
                }
            });
        });
    </script>

@endsection
