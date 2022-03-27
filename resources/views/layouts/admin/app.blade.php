<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title', config('app.name'))
    </title>

    @include('layouts.admin.styles')
    @stack('styles')
    @livewireStyles
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- sidebar -->
        @include('layouts.admin.sidebar')
        <!-- sidebar -->

        <!-- top navigation -->
        @include('layouts.admin.nav')

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        @include('layouts.admin.footer')
        <!-- /footer content -->
      </div>
    </div>
    
    @stack('modals')
    @include('layouts.admin.scripts')
    @stack('scripts')
    @livewireScripts
  </body>
</html>
