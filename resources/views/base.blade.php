<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>靜宜大學</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style>
        /*main_view*/
        .main_view {
            width: 75%;
        }

        #mapid {
            width: 100%;
            height: 500px;
        }

    </style>

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
