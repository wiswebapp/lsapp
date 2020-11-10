@php
    $isLogin = (Request::segment(2) == "login") ? true : false;
    if(!$isLogin){
        $isLogin = (Request::segment(1) == "admin") ? (empty(Request::segment(2))) ? true :false : false;
    }
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
    <link rel="stylesheet" href="{{adminAssets('plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{adminAssets('dist/css/adminlte.min.css')}}">
    <!-- jQuery -->
    <script src="{{adminAssets('plugins/jquery/jquery.min.js')}}"></script>
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
            @include('admin.include.admin_js');
            @include('admin.include.admin_navbar');
            @include('admin.include.admin_sidebar');
        @endif

        @yield('content_admin')

        @if (!$isLogin)
        @include('admin.include.admin_footer')
        @endif

    </div>
    
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="{{adminAssets('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{adminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{adminAssets('dist/js/adminlte.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{adminAssets('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- PAGE PLUGINS -->
    <script src="{{adminAssets('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{adminAssets('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{adminAssets('dist/js/pages/adminapp.js')}}"></script>
</body>
</html>
