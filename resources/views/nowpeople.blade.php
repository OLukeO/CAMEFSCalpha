@extends('base')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <canvas id="canvas" height="400" width="600"></canvas>
                </div>
                <div id="time" style="position:absolute;right: 0;">
                </div>
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
                        beginAtZero: true
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
            plugins: {
                title: {
                    display: true,
                    text: '即時人流',
                    font: {
                        size: 50
                    }
                }

            }
        },

    });
    var updateChart = function () {
        $.ajax({
            url: "{{ route('api.chart') }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                myChart.data.labels = data.labels;
                myChart.data.datasets[0].data = data.data;
                myChart.update();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    updateChart();
    setInterval(() => {
        updateChart();
    }, 5000);

</script>
<script>
    //時間
    let newTimer = () => {
        let date = new Date();
        let str = "資料更新時間 :  " + date.toLocaleDateString();
        str += "  " + date.toLocaleTimeString();
        let odiv = document.getElementById("time");
        odiv.innerHTML = str;
        setTimeout(newTimer, 5000);
    }
    window.onload = () => {
        newTimer();
    }

</script>
<br>
@endsection
