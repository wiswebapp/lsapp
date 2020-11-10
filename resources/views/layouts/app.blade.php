<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    @include('include.navbar')
    
    <div id="app">

        <div class="container">
           
            @include('include.messages')
            @yield('content')
            
        </div>

    </div>
    
    <div class="footer">
        <hr>
        <center>
            <div style="color:red;background: black;margin: 0px;padding: 10px;text-shadow: 0px 0px 2px white;">
                <h3>BLOG - A Complete Blog App For Blogger</h3>
                <h4>This page took {{ number_format(microtime(true) - LARAVEL_START,2,'.','') }} seconds to render</h4>
            </div>
        </center>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        //CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
