<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>
        @yield('title', config('app.name'))
    </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="admin fot enetero market shop" />
    <meta name="author" content="Enetero minimarket" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-white">
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        <!--start login contant-->
        <div class="app-contant">
            <div class="bg-white">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                            <div class="d-flex align-items-center h-100-vh">
                                @yield('content')
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                            <div class="row align-items-center h-100">
                                <div class="col-7 mx-auto ">
                                    <img class="img" src="{{asset('assets/img/login-img.png')}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end login contant-->
    </div>
    <!-- end app-wrap -->
</div>
<!-- end app -->

<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/app1.js') }}"></script>
</body>

</html>
