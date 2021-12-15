<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta http-equiv="refresh" content="20">-->
  <title>人流查詢</title>
  <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />laravel bootstrap-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.0/chartjs-plugin-zoom.min.js" integrity="sha512-3e8Qp+1eECsPJGQnecRHymxL07q95A5zPcylJ7PHXl1E6wRwrm3bejznFJ8wHqRkp2q7foUqSDrpAGqt0/xuXg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>

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
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>



</html>