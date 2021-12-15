<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://www.pu.edu.tw/var/file/0/1000/msys_1000_5150459_40816.ico" rel="icon">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--<meta http-equiv="refresh" content="10">-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        /*main*/
        .main {
            display: flex;
        }

        /*side-menu*/
        .side-menu {
            background-color: #3188c7;
            width: 25%;
            margin: 20px 20px 20px 20px;
            height: 93vh;
        }

        .side-menu .introduce {
            padding: 10px;
        }

        .side-menu .introduce h4 {
            color: #ffc001;
            border-left: 6px solid #ffc001;
            padding-left: 10px;
            margin: 0px 20px 12px 20px;
        }

        .side-menu .introduce ul {
            color: #fff;
        }

        .side-menu .introduce table {
            background-color: #434343;
            color: #fff;
            margin: 10px 0 10px 0;
            width: 100%;
            height: 75vh;
            overflow-y: auto;
            display: block;
        }

        .side-menu .introduce table tr {
            width: 100%;
        }

        .side-menu .introduce table td {
            font-size: 2px;
            width: 23%;
            padding: 5px;
        }

        .side-menu .introduce table b {
            font-size: 14px;
        }

        .side-menu .introduce table td img {
            margin: 15px;
            height: 10px;
            width: 10px;
        }

        .side-menu .introduce table thead {
            width: 100%;
            position: sticky;
            top: 0;
            background-color: #434343;
        }

        /*main_view*/
        .main_view {
            position: absolute;
            width: 70%;
            margin: 20px 20px 20px 0px;
            right: 0px
        }

        #mapid {
            width: 100%;
            height: 93vh;
        }

        .under_menu_hidden {
            position: absolute;
            bottom: 0px;
            height: 100px;
            width: 100%;
            z-index: 9999;
            background-color: #3188c7;
            opacity: 0.5;
            display: flex;
            transition: 0.2s;
        }

        .under_menu_show {
            position: absolute;
            bottom: 0px;
            height: 40%;
            width: 100%;
            background-color: #3188c7;
            transition: 0.2s;
            padding: 20px;
            z-index: 99999;
        }

        #showbox {
            color: #fff;
            margin: 0 0 0 10px;
        }

        .time {
            display: flex;
            color: #fff;
            padding: 5px;
            height: 50px;
        }

        /**/
        @media screen and (min-width: 960px) {

            .side-menu,
            .main_view {
                display: block;
            }

            .under_menu_hidden,
            .under_menu_show {
                display: none;
            }
        }

        @media screen and (max-width: 960px) {
            .side-menu {
                display: none;
            }

            .main_view {
                width: 100%;
                margin: 20px 0 0 0;
            }

            #mapid {
                height: 400px;
            }

            .under_menu_hidden {
                display: none;
            }

            .under_menu_show {
                display: block;
            }

            #Expand_button {
                height: 20px;
                width: 40px;
                top: 20px;
                position: absolute;
                left: 48%;
            }

            .under_menu_show h4 {
                color: #ffc001;
                border-left: 6px solid #ffc001;
                padding-left: 10px;
                margin: 0px 20px 12px 20px;
            }

            #under_menu_dot {
                color: #fff;
                margin: 20px;
            }

            .under_menu_show ul {
                color: #fff;
            }

            .under_menu_show table {
                background-color: #434343;
                color: #fff;
                /*width: 100%;*/
                height: 75%;
                overflow-y: auto;
                display: block;
            }

            .under_menu_show table tr {
                vertical-align: middle;
            }

            .under_menu_show table td {
                font-size: 6%;
                width: 100px;
                padding: 5%;
            }

            .under_menu_show table thead {
                position: sticky;
                top: 0;
                background-color: #434343;
            }

            .under_menu_show table b {
                font-size: 15px;

            }

            .under_menu_show table td img {
                height: 12px;
                width: 10px;
            }

            .time {
                display: flex;
                color: #fff;
                height: 30px;
                font-size: 12px;
            }

            #showbox2 {
                color: #fff;
                margin: 0 0 0 5px;
            }
        }

    </style>

    <title>Project</title>
</head>

<body onload="myFunction()">

    <div class="body_main" id="body_main">

        <div class="main" id="main">

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
                                <td><b>緯度</b></td>
                                <td><b>經度</b></td>
                                <td><b>燈號</b></td>
                            </tr>
                        </thead>
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

                            var i_1 = L.marker([24.225971, 120.57743], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_2 = L.marker([24.226049, 120.577676], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_3 = L.marker([24.226167, 120.577945], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_4 = L.marker([24.226245, 120.578202], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_5 = L.marker([24.226401, 120.578803], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_6 = L.marker([24.22644, 120.57849], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_7 = L.marker([24.226255, 120.579157], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_8 = L.marker([24.226333, 120.5795], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_9 = L.marker([24.226323, 120.579886], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_10 = L.marker([24.226343, 120.580283], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_11 = L.marker([24.226391, 120.580637], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_12 = L.marker([24.226391, 120.581142], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_13 = L.marker([24.226352, 120.5817], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_14 = L.marker([24.226411, 120.582021], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_15 = L.marker([24.22647, 120.582322], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_16 = L.marker([24.226519, 120.582633], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_17 = L.marker([24.226675, 120.582869], {
                                icon: greyIcon
                            }).addTo(mymap);
                            var i_18 = L.marker([24.226812, 120.583105], {
                                icon: greyIcon
                            }).addTo(mymap);

                        </script>

                        @foreach($people_reverse as $p)
                        <script>
                            var lng = ["{!!$p->lng!!}"];
                            var sos = ["{!!$p->sos!!}"];

                            text(lng, sos);

                            function text(lng, sos) {

                                if (lng >= 120.577229 && lng < 120.577561) {
                                    if (sos == 0) {
                                        L.marker([24.225971, 120.57743], {
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
                                if (lng >= 120.577808 && lng < 120.578082) {
                                    if (sos == 0) {
                                        L.marker([24.226167, 120.577945], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226167, 120.577945], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.578082 && lng < 120.578355) {
                                    if (sos == 0) {
                                        L.marker([24.226245, 120.578202], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226245, 120.578202], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.578355 && lng < 120.578645) {
                                    if (sos == 0) {
                                        L.marker([24.226401, 120.578803], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226401, 120.578803], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.578645 && lng < 120.578999) {
                                    if (sos == 0) {
                                        L.marker([24.22644, 120.57849], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.22644, 120.57849], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.578999 && lng < 120.579337) {
                                    if (sos == 0) {
                                        L.marker([24.226255, 120.579157], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226255, 120.579157], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.579337 && lng < 120.579686) {
                                    if (sos == 0) {
                                        L.marker([24.226333, 120.5795], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226333, 120.5795], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.579686 && lng < 120.580066) {
                                    if (sos == 0) {
                                        L.marker([24.226323, 120.579886], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226323, 120.579886], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.580066 && lng < 120.580468) {
                                    if (sos == 0) {
                                        L.marker([24.226343, 120.580283], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226343, 120.580283], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.580468 && lng < 120.580881) {
                                    if (sos == 0) {
                                        L.marker([24.226391, 120.580637], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226391, 120.580637], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.580881 && lng < 120.581289) {
                                    if (sos == 0) {
                                        L.marker([24.226391, 120.581142], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226391, 120.581142], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.581289 && lng < 120.581595) {
                                    if (sos == 0) {
                                        L.marker([24.226352, 120.5817], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226352, 120.5817], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.581595 && lng < 120.581858) {
                                    if (sos == 0) {
                                        L.marker([24.226411, 120.582021], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226411, 120.582021], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.581858 && lng < 120.582169) {
                                    if (sos == 0) {
                                        L.marker([24.22647, 120.582322], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.22647, 120.582322], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.582169 && lng < 120.582491) {
                                    if (sos == 0) {
                                        L.marker([24.226519, 120.582633], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226519, 120.582633], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.582491 && lng < 120.582759) {
                                    if (sos == 0) {
                                        L.marker([24.226675, 120.582869], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226675, 120.582869], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                if (lng >= 120.582759 && lng < 120.58299) {
                                    if (sos == 0) {
                                        L.marker([24.226812, 120.583105], {
                                            icon: greenIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    } else {
                                        L.marker([24.226812, 120.583105], {
                                            icon: redIcon
                                        }).addTo(mymap).style = "z-index:999";
                                    }
                                }
                                console.log(lng);
                            }
                            //setInterval("console.log(lng)",refresh(),5000);

                        </script>
                        @endforeach

                        @foreach($people as $p)
                        <tr>
                            <td>{{ $p->sidimei }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->lat }}</td>
                            <td>{{ $p->lng }}</td>

                            @if(($p->sos)==0)
                            <td>
                                <img src="{{ asset('images/place_20210902151307446923456.png') }}" alt="綠燈"
                                    style=color:#20c997>
                            </td>
                            @else
                            <td>
                                <img src="{{ asset('images/place_20210902151350874022788.png') }}" alt="紅燈"
                                    style=color:#dc3545>
                            </td>
                            @endif
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>

            <div class="under_menu_show" id="under_menu_show">
                <div class="time">
                    <p>上次更新時間 : </p>
                    <div id="showbox2"></div>
                </div>
                <h4>監控狀態</h4>
                <table>
                    <thead>
                        <tr>
                            <td><b>學號</b></td>
                            <td><b>姓名</b></td>
                            <td><b>經度</b></td>
                            <td><b>緯度</b></td>
                            <td><b>燈號</b></td>
                        </tr>
                    </thead>
                    @foreach($people as $p)
                    <tr>
                        <td>{{ $p->sidimei }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->lat }}</td>
                        <td>{{ $p->lng }}</td>
                        @if(($p->sos)==0)
                        <td>
                            <img src="{{ asset('images/place_20210902151307446923456.png') }}" alt="綠燈"
                                style=height:10px;>
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/place_20210902151350874022788.png') }}" alt="紅燈"
                                style=height:10px;>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            document.getElementById('showbox').innerHTML = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: "2-digit",
                second: "2-digit"
            });
            //RWD時使用
            document.getElementById('showbox2').innerHTML = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: "2-digit",
                second: "2-digit"
            });
            var pageRefresh = 10000;
            setTimeout(function () {
                refresh();
            }, pageRefresh);
        });

        function refresh() {
            $("#side-menu").load(location.href + " #side-menu>*", "");
            $("#under_menu_hidden").load(location.href + " #under_menu_hidden>*", "");
            $("#body_main").load(location.href);
        }

        function close1() {
            document.getElementById("under_menu_show").style.display = "none";
            document.getElementById("under_menu_hidden").style.display = "block";
        }

        function close2() {
            document.getElementById("under_menu_show").style.display = "block";
            document.getElementById("under_menu_hidden").style.display = "none";
        }

    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://use.fontawesome.com/77aaba30bc.js"> </script>
</body>

</html>
