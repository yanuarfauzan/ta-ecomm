<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> &mdash; e-comm</title>
    <!-- Bootstrap -->
    <link href="{{ asset('/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Swiper --}}
    <link href="{{ asset('/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    {{-- Our CSS --}}
    <link href="{{ asset('/ourcss/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('/ourcss/home.css') }}" rel="stylesheet">

    {{-- Our navbar js --}}
    <script src="{{ asset('/ourjs/navbar.js') }}"></script>

</head>

<body style="overflow-x: hidden">
    <div id="app">
        <div class="main-wrapper">
            @include('partial.user.navbar')
            <!-- Main Content -->
            <div class="main-content" style="margin-top: 165px;">
                @yield('container')
            </div>
            @include('partial.user.footer')
        </div>
    </div>

    
    <!-- Bootstrap -->
    <script src="{{ asset('/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Swiper --}}
    <script src="{{ asset('/swiper/swiper-bundle.min.js') }}"></script>
</body>

</html>
