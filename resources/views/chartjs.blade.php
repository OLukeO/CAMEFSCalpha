@extends('base')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
            <div class="panel-heading"></div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
                <form method="post" action="{{ route('chartjs.index') }}">
                    @csrf
                    <div class="form-group">
                        <label for="logtime">
                            <font size="7">歷史日期:(ex:xxxx-xx-xx)</font>
                            <button type="submit" class="btn btn-primary">
                                <font size="5">查詢</font>
                            </button>
                        </label>
                        <input type="text" class="form-control" name="logtime" />

                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<br>
<script>
  var ctx = document.getElementById("canvas");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: 'People',
        data: [],
        borderWidth: 1,
        backgroundColor: "#E4B8EF"
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      },
      elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '即時人流'
            }
    },
    
  });
  var updateChart = function() {
    $.ajax({
      url: "{{ route('api.chart') }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        myChart.data.labels = data.labels;
        myChart.data.datasets[0].data = data.data;
        myChart.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  
  updateChart();
  setInterval(() => {
    updateChart();
  }, 5000);
</script>
<br>
@endsection

<!-- 景點一 -->
@section('content1')
<script>
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas1" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time1 = <?php echo $Alltime; ?>;
    var people1 = <?php echo $Allpeople; ?>;
    var barChartData1 = {
        labels: time1[1],
        datasets: [{
            label: 'People',
            backgroundColor: "red",
            data: people1[1],
        }]

    };

    var ctx = document.getElementById("canvas1").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData1,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點1 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點二 -->
@section('content2')
<script>
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas2" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time2 = <?php echo $Alltime; ?>;
    var people2 = <?php echo $Allpeople; ?>;
    var barChartData2 = {
        labels: time2[2],
        datasets: [{
            label: 'People',
            backgroundColor: "orange",
            data: people2[2],
        }]

    };
    var ctx = document.getElementById("canvas2").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData2,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點2 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點三 -->
@section('content3')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas3" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time3 = <?php echo $Alltime; ?>;
    var people3 = <?php echo $Allpeople; ?>;
    var barChartData3 = {
        labels: time3[3],
        datasets: [{
            label: 'People',
            backgroundColor: "yellow",
            data: people3[3]
        }]
    };
    var ctx = document.getElementById("canvas3").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData3,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點3 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點4 -->
@section('content4')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas4" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time4 = <?php echo $Alltime; ?>;
    var people4 = <?php echo $Allpeople; ?>;
    var barChartData4 = {
        labels: time4[4],
        datasets: [{
            label: 'People',
            backgroundColor: "#90EE90",
            data: people4[4]
        }]
    };
    var ctx = document.getElementById("canvas4").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData4,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點4 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點5 -->
@section('content5')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas5" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time5 = <?php echo $Alltime; ?>;
    var people5 = <?php echo $Allpeople; ?>;
    var barChartData5 = {
        labels: time5[5],
        datasets: [{
            label: 'People',
            backgroundColor: "green",
            data: people5[5]
        }]
    };
    var ctx = document.getElementById("canvas5").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData5,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點5 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點6 -->
@section('content6')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas6" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time6 = <?php echo $Alltime; ?>;
    var people6 = <?php echo $Allpeople; ?>;
    var barChartData6 = {
        labels: time6[6],
        datasets: [{
            label: 'People',
            backgroundColor: "#e0ffff",
            data: people6[6]
        }]
    };
    var ctx = document.getElementById("canvas6").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData6,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點6 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點7 -->
@section('content7')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas7" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time7 = <?php echo $Alltime; ?>;
    var people7 = <?php echo $Allpeople; ?>;
    var barChartData7 = {
        labels: time7[7],
        datasets: [{
            label: 'People',
            backgroundColor: "blue",
            data: people7[7]
        }]
    };
    var ctx = document.getElementById("canvas7").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData7,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點7 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點8 -->
@section('content8')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas8" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time8 = <?php echo $Alltime; ?>;
    var people8 = <?php echo $Allpeople; ?>;
    var barChartData8 = {
        labels: time8[8],
        datasets: [{
            label: 'People',
            backgroundColor: "purple",
            data: people8[8]
        }]
    };
    var ctx = document.getElementById("canvas8").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData8,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點8 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點9 -->
@section('content9')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas9" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time9 = <?php echo $Alltime; ?>;
    var people9 = <?php echo $Allpeople; ?>;
    var barChartData9 = {
        labels: time9[9],
        datasets: [{
            label: 'People',
            backgroundColor: "#AD7418",
            data: people9[9]
        }]
    };
    var ctx = document.getElementById("canvas9").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData9,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點9 人數'
            }
        }
    });
</script>
<br>
@endsection
<!-- 景點10 -->
@section('content10')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">24小時</div>
                <div class="panel-body">
                    <canvas id="canvas10" height="280" width="600"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var time10 = <?php echo $Alltime; ?>;
    var people10 = <?php echo $Allpeople; ?>;
    var barChartData10 = {
        labels: time10[10],
        datasets: [{
            label: 'People',
            backgroundColor: "black",
            data: people10[10]
        }]
    };
    var ctx = document.getElementById("canvas10").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData10,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 10
                    }
                }]
            },
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }

            },
            responsive: true,
            title: {
                display: true,
                fontSize: 20,
                text: '景點10 人數'
            }
        }
    });
</script>
<br>
@endsection