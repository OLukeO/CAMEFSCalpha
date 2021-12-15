<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="20">

    <!--什麼版本IE 就用什麼版本的標準模式 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--設定手機行動版網頁的 viewport 資訊-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--Ajax-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <link href="{{ asset('css/map.css') }}" rel="stylesheet" type="text/css" />

    <title>安全通道監控畫面</title>
</head>

<body>



    <div class="main_view" id="main_view">

        <div id="mapid">
            <!--地圖中心點-->
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
        <div class="introduce" id="side">

            <div class="time">

                <div id="showbox"></div>
            </div>

            <h4>監控狀態</h4>

            <table id="peopleinfo">
                <thead>
                    <tr>
                        <td><b> 學號 </b></td>
                        <td><b> 姓名 </b></td>
                        <td><b> 燈號 </b></td>
                    </tr>
                </thead>

                <!--安全監控資料-->
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


                <!--地圖上原點圖片-->
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

                <!--計算使用者位置-->

                @foreach($people_reverse as $p)
                <script language=JavaScript>
                    var distance = ["{!!$p->distance!!}"];
                    var sos = ["{!!$p->sos!!}"];

                    text(distance, sos);
                    //位置以及紅綠點判定
                    function text(distance, sos) {

                        //if (distance <= 15) {
                        if (sos == 0) {
                            //L.marker(["{!!$p->lat!!}", "{!!$p->lng!!}"], {}).remove(mymap).style =
                            //"z-index:999"; //消除原本顏色
                            L.marker(["{!!$p->lat!!}", "{!!$p->lng!!}"], {
                                icon: greyIcon
                            }).remove(mymap);
                            L.marker(["{!!$p->lat!!}", "{!!$p->lng!!}"], {
                                icon: greenIcon
                            }).addTo(mymap);
                        } else if (sos == 1) {
                            L.marker(["{!!$p->lat!!}", "{!!$p->lng!!}"], {
                                icon: redIcon
                            }).addTo(mymap);
                        }
                        //}
                    }

                </script>
                @endforeach


            </table>
        </div>
    </div>
    <script>
        /*var pageRefresh = 10000;
        setTimeout(function () {
            refresh();
        }, pageRefresh);*/



        //更新時間
        let newTimer = () => {
            let date = new Date();
            let str = "資料更新時間 :  " + date.toLocaleDateString();
            str += "  " + date.toLocaleTimeString();
            let odiv = document.getElementById("showbox");
            odiv.innerHTML = str;
            setTimeout(newTimer, 1000);
        }
        window.onload = () => {
            newTimer();
            refresh();
        }


        //RWD縮排
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
