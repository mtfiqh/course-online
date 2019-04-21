<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sbtemplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('sbtemplate/css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">
    @yield('additional-css')
</head>

<body id="page-top">
    <div id="wrapper">
        @yield('sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="height:100vh">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbar')

                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
        
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('sbtemplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbtemplate/js/sb-admin-2.min.js') }}"></script>
    @yield('additional-js')
</body>

</html>
