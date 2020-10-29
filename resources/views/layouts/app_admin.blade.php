@php
    $isLogin = (Request::segment(2) == "login") ? true : false;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    <!--Admin Panel-->
    <link rel="stylesheet" href="{{adminAssets('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{adminAssets('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('dist/css/adminlte.min.css')}}">    
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
</head>

@if ($isLogin)
    <body class="hold-transition login-page">    
@else
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
@endif

    <div class="wrapper">
        
        @if (!$isLogin)
            @include('include.admin_navbar');
            @include('include.admin_sidebar');
        @endif

        @yield('content_admin')

        @if (!$isLogin)
        @include('include.admin_footer')
        @endif

    </div>

    <!-- jQuery -->
    <script src="{{adminAssets('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{adminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{adminAssets('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{adminAssets('dist/js/adminlte.js')}}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{adminAssets('dist/js/demo.js')}}"></script>
    <!-- PAGE PLUGINS -->
    <script src="{{adminAssets('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{adminAssets('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{adminAssets('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{adminAssets('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <script src="{{adminAssets('plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{adminAssets('dist/js/pages/dashboard2.js')}}"></script>
    {{-- <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script> --}}
</body>
</html>
