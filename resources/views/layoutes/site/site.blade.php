<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('assets/site/img/Fevicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/nice-select/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/owl-carousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/vendors/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
    @yield('css')
</head>
    <body>
    <main class="site-main">
        @include('layoutes.site.header')

        @yield('content')

        @include('layoutes.site.subscribe')
    </main>
        @include('layoutes.site.footer')
    <script src="{{asset('assets/site/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/skrollr.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('assets/site/vendors/mail-script.js')}}"></script>
    <script src="{{asset('assets/site/js/main.js')}}"></script>
    @yield('js')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    </body>

</html>
