    @extends('layoutes.site.site')
    @section('title','Edit Profile ' . $user->name)
    @section('content')
        <section class="login_box_area section-margin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login_box_img">
                            <div class="hover">
                                <h4>Edit profile page</h4>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem labore, fugiat, quo, ipsa nisi laborum omnis cum officiis nemo quia dignissimos eveniet quas possimus!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login_form_inner register_form_inner">
                            <h3>Edit profile {{$user->name}}</h3>
                            <form class="row login_form" action="{{route('user.update.profile')}}" method="POST" id="register_form">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="col-md-12 form-group">
                                    <input value="{{$user->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <input value="{{$user->phone_number}}" type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="phone number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'phone number'">
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <input value="{{$user->address}}" type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <input value="{{$user->email}}" type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" value="submit" class="button button-register w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    @stop
