<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>靜宜大學</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <!-- 引用其他 blade -->
        @include('nav')
    </div>

    <div class="container">
        @yield('main')
    </div>

    <div class="container">
        <!-- 引用其他 blade -->
        @include('footer')
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>

</html>
