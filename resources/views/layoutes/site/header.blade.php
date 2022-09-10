<!--================ Start Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item active"><a class="nav-link" href="{{route('homepage')}}">Home</a></li>
                        @if(!auth('web')->user())
                            <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                        @endif
                        @if(!auth('web')->user())
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>

                    <ul class="nav-shop">
                        <a href="{{route('users.favorites')}}">
                            <li class="nav-item">
                            <button>
                                <i class="ti-heart"></i>
                                @if(auth('web')->user())
                                    <span class="nav-shop__circle">
                                        {{\App\Models\Favorite::where('user_id',auth('web')->user()->id)->count()}}
                                    </span>
                                @else
                                    <span class="nav-shop__circle">0</span>
                                @endif
                            </button> </li>
                        </a>
                        <a href="{{route('cart.get.products')}}">
                            @if(auth('web')->user())
                                @php
                                    $cart = \App\Models\Cart::where('user_id',auth('web')->user()->id)->where('is_open',0)->first();
                                    $details = \App\Models\CartDetails::where('cart_id',$cart->id)->where('is_open',0)->count();
                                @endphp
                            @endif
                            <li class="nav-item">
                                <button>
                                    <i class="ti-shopping-cart"></i>
                                    @if(auth('web')->user())
                                        <span class="nav-shop__circle">
                                            {{$details ?? 0}}
                                        </span>
                                    @else
                                        <span class="nav-shop__circle">
                                            0
                                        </span>
                                    @endif
                                </button>
                            </li>
                        </a>
                    </ul>
                    @if(auth('web')->user())
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{auth('web')->user()->name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('user.edit.profile',auth('web')->user()->id)}}">Edit Profile</a>
                            <a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->
