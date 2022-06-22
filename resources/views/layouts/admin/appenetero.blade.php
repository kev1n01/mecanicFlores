<!DOCTYPE html>
<html lang="en">
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
    <!-- plugin stylesheets -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('styles')
    @livewireStyles

</head>

<body>
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        <!-- begin pre-loader -->
        <div class="loader">
            <div class="h-100 d-flex justify-content-center">
                <div class="align-self-center">
                    <img src="{{ asset('assets/img/loader.svg') }}" alt="loader">
                </div>
            </div>
        </div>
        <!-- end pre-loader -->
        <!-- begin app-header -->
        <header class="app-header top-bar">
            <!-- begin navbar -->
            <nav class="navbar navbar-expand-md">

                <!-- begin navbar-header -->
                <div class="navbar-header d-flex align-items-center">
                    <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/img/logo.png" class="img-fluid logo-desktop" alt="logo" />
                        <img src="assets/img/logo-icon.png" class="img-fluid logo-mobile" alt="logo" />
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-align-left"></i>
                </button>
                <!-- end navbar-header -->
                <!-- begin navigation -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navigation d-flex">
                        <ul class="navbar-nav nav-left">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                                    <i class="ti ti-align-right"></i>
                                </a>
                            </li>
                            <li class="nav-item full-screen d-none d-lg-block" id="btnFullscreen">
                                <a href="javascript:void(0)" class="nav-link expand">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav nav-right ml-auto">

                            <li class="nav-item">
                                <a class="nav-link search" href="javascript:void(0)">
                                    <i class="ti ti-search"></i>
                                </a>
                                <div class="search-wrapper">
                                    <div class="close-btn">
                                        <i class="ti ti-close"></i>
                                    </div>
                                    <div class="search-content">
                                        <form>
                                            <div class="form-group">
                                                <i class="ti ti-search magnifier"></i>
                                                <input type="text" class="form-control autocomplete" placeholder="Search Here" id="autocomplete-ajax" autofocus="autofocus">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown user-profile">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/img/avtar/02.jpg" alt="avtar-img">
                                    <span class="bg-success user-status"></span>
                                </a>
                                <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                    <div class="bg-gradient px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="mr-1">
                                                <h4 class="text-white mb-0">Admin ****</h4>
                                                <small class="text-white">Admin@example.com</small>
                                            </div>

                                            <a class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="cerrar seccion" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-user pr-2 text-success"></i> perfil</a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-envelope pr-2 text-primary"></i> bandeja de entrada
                                            <span class="badge badge-primary ml-auto">6</span>
                                        </a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class=" ti ti-settings pr-2 text-info"></i> ajustes
                                        </a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-compass pr-2 text-warning"></i> nesecitas ayuda?</a>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <a class="bg-light p-3 text-center d-block" href="#">
                                                    <i class="fe fe-mail font-20 text-primary"></i>
                                                    <span class="d-block font-13 mt-2">mi mensajes</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="bg-light p-3 text-center d-block" href="#">
                                                    <i class="fe fe-plus font-20 text-primary"></i>
                                                    <span class="d-block font-13 mt-2">nuevo mensaje</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end navigation -->
            </nav>
            <!-- end navbar -->
        </header>

        <div class="app-container">
            <!-- begin app-nabar -->
            @include('layouts.admin.sidebarenetero')

            <div class="app-main" id="main">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- end app-wrap -->
</div>

<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/app1.js') }}"></script>
@stack('modals')
@stack('scripts')
@livewireScripts
</body>
</html>
