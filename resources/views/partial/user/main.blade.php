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
    <link href="{{ asset('/ourcss/detail_product.css') }}" rel="stylesheet">
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
    <script src="{{ asset('/bootstrap/dist/js/bootstrap.bundle.min.js') }}" data-navigate-track></script>
    {{-- Swiper --}}
    <script src="{{ asset('/swiper/swiper-bundle.min.js') }}" data-navigate-track></script>
    {{-- Tawk --}}
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66470166981b6c564771709d/1hu2lqu95';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
