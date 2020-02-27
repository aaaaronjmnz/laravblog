<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravblog! -- the first blog site I  made with Laravel</title>

    <!-- Bootstrap core CSS -->
    <!-- Add a "/" at the beginning of each path to fix css style sheet not working
         on some pages. -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog-home.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--    <!-- Fonts -->--}}
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    {{--    <!-- Styles -->--}}
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

</head>

<body>

    @include('inc.navbar')
    @yield('content')
    @include('inc.sbconditions')

    <!-- HANGING DIV CLOSING TAGS DITO KASI NASISIFORMAT NG PAGE PAG WALA YAN -->
    </div>
    </div>

    <!-- TURN ON FOOTER HERE KUNG GUSTO MO PERO PANGIT PAG MERON E PUTANG INA -->
    {{--@include('inc.footer')--}}

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
