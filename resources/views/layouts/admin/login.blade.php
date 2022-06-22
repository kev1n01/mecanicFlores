<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title', config('app.name'))
    </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/build/images/logomecanic.png')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet"/>

    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"  type="text/css" />

    <link href="{{ asset('assets/build/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/build/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset('assets/build/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/build/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/build/css/forms/switches.css') }}">
</head>
<body class="form ">
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/build/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/build/js/authentication/form-1.js') }}"></script>

</body>
</html>
