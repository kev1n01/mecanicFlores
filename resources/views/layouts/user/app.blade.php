<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Basic Page Needs -->
    <title>
        @yield('title', config('app.name'))
    </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="admin fot enetero market shop" />
    <meta name="author" content="Enetero minimarket" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assetsuser/libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/font-material/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/nivo-slider/css/nivo-slider.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/nivo-slider/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/nivo-slider/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/owl.carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/libs/slider-range/css/jslider.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assetsuser/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assetsuser/css/reponsive.css')}}">
</head>

<body class="home home-2">
<div id="all">
    <!-- Header -->
    <header id="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container topbar-content">
                <div class="row">
                    <!-- Topbar Left -->
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="topbar-left d-flex">
                            <div class="email">
                                <i class="fa fa-envelope" aria-hidden="true"></i>Email: enetero_org@gmail.com
                            </div>
                        </div>
                    </div>

                    <!-- Topbar Right -->
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="topbar-right d-flex justify-content-end">
                            <!-- My Account -->
                            <div class="dropdown account">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    Mi cuenta
                                </div>
                                <div class="dropdown-menu">
                                    <div class="item">
                                        <a href="#" title="Log in to your customer account"><i class="fa fa-cog"></i>Mi cuenta</a>
                                    </div>
                                    <div class="item">
                                        <a href="{{route('login')}}" title="Log in to your customer account"><i class="fa fa-sign-in"></i>Iniciar sesión</a>
                                    </div>
                                    <div class="item">
                                        <a href="{{route('register')}}" title="Register Account"><i class="fa fa-user"></i>Registrarme</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Top -->
        <div class="header-top">
            <div class="container">
                <div class="row margin-0">
                    <div class="col-lg-2 col-md-2 col-sm-12 padding-0">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="#">
                                <img class="img-responsive" src="{{ asset('assetsuser/img/logo.png')}}" alt="Logo">
                            </a>
                        </div>

                        <span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-12 padding-0">
                        <!-- Main Menu -->
                        <div id="main-menu">
                            <ul class="menu">
                                <li class="dropdown">
                                    <a href="#" title="Homepage">Home</a>
                                </li>

                                <li class="dropdown">
                                    <a href="#" title="Product">Productos</a>
                                </li>

                                <li>
                                    <a href="#">Nosotros</a>
                                </li>

                                <li>
                                    <a href="#">Contacto</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 padding-0">
                        <!-- Cart -->
                        <div class="block-cart dropdown">
                            <div class="cart-title">
                                <i class="fa fa-shopping-basket"></i>
                                <span class="cart-count">2</span>
                            </div>

                            <div class="dropdown-content">
                                <div class="cart-content">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="product-image">
                                                <a href="#">
                                                    <img src="{{asset('assetsuser/img/product/7.jpg')}}" alt="Product">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="">Organic Strawberry Fruits</a>
                                                </div>
                                                <div>
                                                    2 x <span class="product-price">$28.98</span>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a class="remove" href="#">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="total">
                                            <td>Total:</td>
                                            <td colspan="2">$92.96</td>
                                        </tr>

                                        <tr>
                                            <td colspan="3">
                                                <div class="cart-button">
                                                    <a class="btn btn-primary" href="#" title="View Cart">Ver carrito</a>
                                                    <a class="btn btn-primary" href="#" title="Checkout">Comprar</a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div id="content" class="site-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-col">
                        <div class="block text">
                            <div class="block-content">
                                <a href="#" class="logo-footer">
                                    <img src="{{asset('assetsuser/img/logo-2.png')}}" alt="Logo">
                                </a>

                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisc ing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
                                    Ut enim ad minim veniam, quis nostrud exercita tion ullamco laboris nisi ut aliquip.
                                </p>
                            </div>
                        </div>

                        <div class="block social">
                            <div class="block-content">
                                <ul>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-dribbble"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-col">
                        <div class="block menu">
                            <h2 class="block-title">Información</h2>

                            <div class="block-content">
                                <ul>
                                    <li><a href="#">Productos nuevos</a></li>
                                    <li><a href="#">Más vendidos</a></li>
                                    <li><a href="#">Contáctenos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-col">
                        <div class="block menu">
                            <h2 class="block-title">Tu cuenta</h2>

                            <div class="block-content">
                                <ul>
                                    <li><a href="#">Mis ordenes</a></li>
                                    <li><a href="#">Mi información personal</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-col">
                        <div class="block text">
                            <h2 class="block-title">Contáctenos</h2>

                            <div class="block-content">
                                <div class="contact">
                                    <div class="item d-flex">
                                        <div>
                                            <i class="zmdi zmdi-home"></i>
                                        </div>
                                        <div>
                                            <span>123 Suspendis matti, VST District, NY Accums, North American</span>
                                        </div>
                                    </div>
                                    <div class="item d-flex">
                                        <div>
                                            <i class="zmdi zmdi-phone-in-talk"></i>
                                        </div>
                                        <div>
                                            <span>0123-456-78910<br>0987-654-32100</span>
                                        </div>
                                    </div>
                                    <div class="item d-flex">
                                        <div>
                                            <i class="zmdi zmdi-email"></i>
                                        </div>
                                        <div>
                                            <span><a href="mailto:support_entero@domain.com">support_entero@gmail.com</a><br><a href="mailto:enetero_org@gmail.com">enetero_org@gmail.com</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Go Up button -->
    <div class="go-up">
        <a href="#">
            <i class="fa fa-long-arrow-up"></i>
        </a>
    </div>

    <!-- Page Loader -->
{{--    <div id="page-preloader">--}}
{{--        <div class="page-loading">--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

<!-- Vendor JS -->
<script src="{{asset('assetsuser/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assetsuser/libs/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('assetsuser/libs/jquery.countdown/jquery.countdown.js')}}"></script>
<script src="{{asset('assetsuser/libs/nivo-slider/js/jquery.nivo.slider.js')}}"></script>
<script src="{{asset('assetsuser/libs/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('assetsuser/libs/slider-range/js/tmpl.js')}}"></script>
<script src="{{asset('assetsuser/libs/slider-range/js/jquery.dependClass-0.1.js')}}"></script>
<script src="{{asset('assetsuser/libs/slider-range/js/draggable-0.1.js')}}"></script>
<script src="{{asset('assetsuser/libs/slider-range/js/jquery.slider.js')}}"></script>
<script src="{{asset('assetsuser/libs/elevatezoom/jquery.elevatezoom.js')}}"></script>

<!-- Template CSS -->
<script src="{{asset('assetsuser/js/main.js')}}"></script>
</body>

</html>
