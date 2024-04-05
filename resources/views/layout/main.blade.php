<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    @include('layout.navbar')
    @yield('container')
</body>
<script src="{{ asset('/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

</html>
