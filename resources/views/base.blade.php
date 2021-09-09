<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>靜宜大學</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- 引用其他 blade -->
        @include('nav')
    </div>

    <div class="container">
        @yield('main')
    </div>
    <div class="scene1">
        @yield('content1')
    </div>
    <div class="scene2">
        @yield('content2')
    </div>
    <div class="scene3">
        @yield('content3')
    </div>
    <div class="scene4">
        @yield('content4')
    </div>
    <div class="scene5">
        @yield('content5')
    </div>
    <div class="scene6">
        @yield('content6')
    </div>
    <div class="scene7">
        @yield('content7')
    </div>
    <div class="scene8">
        @yield('content8')
    </div>
    <div class="scene9">
        @yield('content9')
    </div>
    <div class="scene10">
        @yield('content10')
    </div>
    <div class="container">
        <!-- 引用其他 blade -->
        @include('footer')
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>

</html>
