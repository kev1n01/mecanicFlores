<!DOCTYPE html>
<html lang="zxx">

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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/font-material/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/nivo-slider/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/nivo-slider/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/nivo-slider/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/libs/slider-range/css/jslider.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assetsuser/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsuser/css/reponsive.css') }}">
    @stack('styles')
    @livewireStyles
</head>

<body class="home home-3">
<div id="all">
    <!-- Header -->
    <header id="header">
        <div class="container">
            <div class="header-top">
                <div class="row align-items-center">
                    <!-- Header Left -->
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <!-- Main Menu -->
                        <div id="main-menu">
                            <ul class="menu">
                                <li class="dropdown">
                                    <a href="{{route('user.home')}}" title="Homepage">Home</a>
                                </li>

                                <li class="dropdown">
                                    <a href="{{route('user.store')}}" title="Product">Tienda</a>
                                </li>

                                <li>
                                    <a href="{{route('user.about')}}">Nosotros</a>
                                </li>

                                <li>
                                    <a href="{{route('user.contact')}}">Contacto</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Header Center -->
                    <div class="col-lg-2 col-md-2 col-sm-12  justify-content-center">
                        <!-- Logo -->
                        <div class="">
                            <a href="{{route('user.home')}}">
                                <h3>MARKET ENETERO</h3>
                            </a>
                        </div>

                        <span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
                    </div>


                    <!-- Header Right -->
                    <div class="col-lg-5 col-md-5 col-sm-12 header-right d-flex justify-content-end align-items-center">
                        @if(Auth::user())
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                 class="img-circle " style="padding-right: 4px;" width="10%">
                            <span class="bg-success user-status"></span>
                            <div class="mr-1 ml-1">
                                <p class="text-white " style="margin: 0px;">{{ Auth::user()->name }}</p>
                            </div>
                        @endif

                        <!-- Cart -->
                        <div class="block-cart dropdown">

                        </div>

                        <!-- My Account -->
                        <div class="my-account dropdown toggle-icon">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                            <div class="dropdown-menu">
                                <div class="item">
                                    <a href="{{route('user.cart')}}" ><i class="fa fa-shopping-cart"></i>Ver carrito</a>
                                </div>
                                @if(Auth::user())
                                    <div class="item">
                                        <a href="{{route('user.profile')}}" ><i class="fa fa-cog"></i>Mi perfil</a>
                                    </div>
                                    <div class="item">
                                        <a href="{{route('user.purchase')}}" ><i class="fa fa-shopping-bag"></i>Mis compras</a>
                                    </div>

                                    @if(Auth::user()->roles()->first()->name === 'administrador')
                                        <div class="item">
                                            <a href="{{route('admin.dashboard')}}" ><i class="fa fa-dashboard"></i>Panel administrativo</a>
                                        </div>
                                    @endif
                                    <div class="item">
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i>Salir
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                @else
                                    <div class="item">
                                        <a type="button" data-toggle="modal" data-target="#ModalLogin" >
                                            <i class="fa fa-sign-in"></i>Iniciar sesión
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a type="button" data-toggle="modal" data-target="#ModalRegister" >
                                            <i class="fa fa-user"></i>Registrarme
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('livewire.user.modal.login')
                        @include('livewire.user.modal.register')
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div id="content" class="site-content">
        <!-- Slideshow -->
        <div class="section slideshow">
            <div class="tiva-slideshow-wrapper">
                <div id="tiva-slideshow" class="nivoSlider">
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('assetsuser/img/slideshow/home3-slideshow-1.jpg') }}" alt="Slideshow Image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('assetsuser/img/slideshow/home3-slideshow-2.jpg') }}" alt="Slideshow Image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('assetsuser/img/slideshow/home3-slideshow-3.jpg') }}" alt="Slideshow Image">
                    </a>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="footer-intro">
                            <a href="" class="logo-footer">
                               <h4>MARKET ENETERO</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                            <div class="social">
                                <ul>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-dribbble"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="footer-top">
                            <div class="row">

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-col">
                                    <div class="block menu">
                                        <h2 class="block-title">Tu cuenta</h2>

                                        <div class="block-content">
                                            <ul>
                                                <li><a href="#">Mis compras</a></li>
                                                <li><a href="#">Mi información personal</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer-left">
                                    <div class="block newsletter">
                                        <h2 class="block-title">Boletin informativo</h2>

                                        <div class="block-content">
                                            <p class="description">Suscríbase al boletín para recibir ofertas especiales y noticias exclusivas sobre los productos ENETERO</p>
                                            <form action="#" method="post">
                                                <input type="text" placeholder="Enter Your Email">
                                                <button type="submit" class="btn btn-primary">Suscribir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer-right">
                                    <div class="block text">
                                        <h2 class="block-title">Contactenos</h2>

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
                                                        <span>+51 954454543<br>+51 948234121</span>
                                                    </div>
                                                </div>
                                                <div class="item d-flex">
                                                    <div>
                                                        <i class="zmdi zmdi-email"></i>
                                                    </div>
                                                    <div>
                                                        <span><a href="mailto:support_enetero@gmail.com">support_enetero@gmail.com</a><br><a href="mailto:enetero@gmail.com">enetero@gmail.com</a></span>
                                                    </div>
                                                </div>
                                            </div>
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
    <div id="page-preloader">
        <div class="page-loading">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</div>

<!-- Vendor JS -->
<script src="{{ asset('assetsuser/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assetsuser/libs/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assetsuser/libs/jquery.countdown/jquery.countdown.js') }}"></script>
<script src="{{ asset('assetsuser/libs/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
<script src="{{ asset('assetsuser/libs/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assetsuser/libs/slider-range/js/tmpl.js') }}"></script>
<script src="{{ asset('assetsuser/libs/slider-range/js/jquery.dependClass-0.1.js') }}"></script>
<script src="{{ asset('assetsuser/libs/slider-range/js/draggable-0.1.js') }}"></script>
<script src="{{ asset('assetsuser/libs/slider-range/js/jquery.slider.js') }}"></script>
<script src="{{ asset('assetsuser/libs/elevatezoom/jquery.elevatezoom.js') }}"></script>

<!-- Template CSS -->
<script src="{{ asset('assetsuser/js/main.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        background: '#80b77e',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    function ToastSuccessfulNotification(msg) {
        Toast.fire({
            icon: 'success',
            title: msg,
        })
    }
    function ToastWarningNotification(msg) {
        Toast.fire({
            icon: 'error',
            title: msg,
        })
    }
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('successful_alert', Msg => {
            ToastSuccessfulNotification(Msg);
        });
        window.livewire.on('warning_alert', Msg => {
            ToastWarningNotification(Msg);
        });

    });
</script>
@stack('modals')
@stack('scripts')
@livewireScripts
</body>
</html>
