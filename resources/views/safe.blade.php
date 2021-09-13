<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--什麼版本IE 就用什麼版本的標準模式 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--設定手機行動版網頁的 viewport 資訊-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <style>
        .side-menu {
            background-color: #3188c7;
            width: 25%;
            margin: 20px 20px 20px 20px;
            height: 93vh;
        }

        #mapid {
            width: 100%;
            height: 93vh;
        }

        #showbox {
            color: #fff;
            margin: 0 0 0 10px;
        }

    </style>
    <title>安全通道監控畫面</title>
</head>

<body>
    <div class="main_view" id="main_view">

        <div id="mapid">

            <script>
                var mymap = L.map('mapid').setView([24.227541, 120.581083], 17);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                }).addTo(mymap);

                var popup = L.popup();

                var LeafIcon = L.Icon.extend({
                    options: {
                        iconSize: [20, 20],
                    }
                });

            </script>

        </div>
    </div>
    <div class="side-menu" id="side-menu">
        <div class="introduce">
            <div class="time">
                <p>上次更新時間 : </p>
                <div id="showbox"></div>
            </div>

            <h4>監控狀態</h4>
            <table>
                <thead>
                    <tr>
                        <td><b>學號</b></td>
                        <td><b>姓名</b></td>
                        <td><b>燈號</b></td>
                    </tr>
                </thead>
                @foreach($people as $p)
                <tr>
                    <td>{{ $p->sidimei }}</td>
                    <td>{{ $p->name }}</td>
                    @if(($p->sos)==0)
                    <td>
                        <img src="{{ asset('images/place_20210902151307446923456.png') }}" alt="綠燈" style=height:10px;>
                    </td>
                    @else
                    <td>
                        <img src="{{ asset('images/place_20210902151350874022788.png') }}" alt="紅燈" style=height:10px;>
                    </td>
                    @endif
                </tr>
                @endforeach
                <script>
                    var greenIcon = new LeafIcon({
                        iconUrl: "{{ asset('images/place_202109021513001911151453.png') }}"
                    });
                    var redIcon = new LeafIcon({
                        iconUrl: "{{ asset('images/place_2021090215134222249174.png') }}"
                    });
                    var greyIcon = new LeafIcon({
                        iconUrl: "{{ asset('images/place_202109021513151497675353.png') }}"
                    });

                </script>
                @foreach($beacon as $b)

                <script>
                    var i_1 = L.marker(["{!!$b->lat!!}", "{!!$b->lng!!}"], {

                        icon: greyIcon

                    }).addTo(mymap);

                </script>

                @endforeach
                @foreach($people_reverse as $p)
                <script>
                    var lng = ["{!!$p->lng!!}"];
                    var sos = ["{!!$p->sos!!}"];

                    text(lng, sos);

                    function text(lng, sos) {

                        if (lng >= 120.577229 && lng < 120.577561) {
                            if (sos == 0) {
                                i_1 {
                                    icon: greenIcon
                                }).addTo(mymap).style = "z-index:999";
                        } else {
                            L.marker([24.225971, 120.57743], {
                                icon: redIcon
                            }).addTo(mymap).style = "z-index:999";
                        }
                    }
                    if (lng >= 120.577561 && lng < 120.577808) {
                        if (sos == 0) {
                            L.marker([24.226049, 120.577676], {
                                icon: greenIcon
                            }).addTo(mymap).style = "z-index:999";
                        } else {
                            L.marker([24.226049, 120.577676], {
                                icon: redIcon
                            }).addTo(mymap).style = "z-index:999";
                        }
                    }

                    function bigandsmall(biglng, smalllng) {
                        if (lng >= biglng && lng < smalllng) {

                        }
                    }

                    console.log(lng);
                    }
                    //setInterval("console.log(lng)",refresh(),5000);

                </script>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            document.getElementById('showbox').innerHTML = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: "2-digit",
                second: "2-digit"
            });
            var pageRefresh = 10000;
            setTimeout(function () {
                refresh();
            }, pageRefresh);
        });


        function close1() {
            document.getElementById("under_menu_show").style.display = "none";
            document.getElementById("under_menu_hidden").style.display = "block";
        }

        function close2() {
            document.getElementById("under_menu_show").style.display = "block";
            document.getElementById("under_menu_hidden").style.display = "none";
        }

    </script>


</body>

</html>
