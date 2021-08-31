<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://www.pu.edu.tw/var/file/0/1000/msys_1000_5150459_40816.ico" rel="icon">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
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

        /*banner*/
        .banner {
            display: flex;
            background-color: #434343;
            width: 100%;
        }

        .banner img {
            width: 60px;
            height: 60px;
            margin: 5px 10px 5px 20px;
        }

        #time {
            color: #fff;
            padding: 28px 10px 0 20px;
            font-size: 14px;
        }

        #banner_right_img {
            display: none;
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
            height: 84vh;
        }

        #start-L {
            color: #fff;
            margin: 10px;
        }

        .side-menu .introduce {
            padding: 10px;
        }

        .side-menu .introduce h4 {
            color: #ffc001;
            border-left: 6px solid #ffc001;
            padding-left: 10px;
            margin: 20px 20px 12px 20px;
        }

        .side-menu .introduce ul {
            color: #fff;
        }

        .side-menu .introduce table {
            background-color: #434343;
            color: #fff;
            margin: 10px 0 10px 0;
            width: 100%;
        }

        .side-menu .introduce table td {
            font-size: 8px;
            width: 20%;
            padding: 5%;
        }

        .side-menu .introduce table b {
            font-size: 15px;
        }

        /*main_view*/
        .main_view {
            width: 75%;
            background-color: #ffc001;
            margin: 20px 20px 20px 0px;
        }

        #mapid {
            width: 100%;
            height: 84vh;
        }

        /*check_box*/
        #side_menu-switch {
            position: absolute;
            opacity: 0;
            z-index: -1;
            display: none;
        }

        .side_menu {
            position: relative;
            width: 100%;
            height: 40%;
            z-index: 999;
            background-color: #3188c7;
            display: flex;
            transform: translateY(40%);
            transition: .2s;
            display: none;
        }

        /*側邊選單_區域內*/
        #side_menu-switch:checked+.side_menu {
            transform: translateY(-100%);
            display: block;
        }

        .side_menu {
            display: none;
        }

        /**/
        @media screen and (max-width: 960px) {
            #time {
                display: none;
            }

            .side-menu {
                display: none;
            }

            .main_view {
                width: 100%;
                height: 95%;
                margin: 20px 0 0 0;
            }

            .banner_right {
                position: absolute;
                right: 20px;
                padding: 17px 0 10px 0;
            }

            #banner_right_img {
                display: block;
                width: 25px;
                height: 20px;
            }
        }

        @media screen and (max-width: 540px) {
            #time {
                display: none;
            }
        }

    </style>

    <title>Project</title>
</head>

<body>
    <div class="banner">
        <a href="https://www.pu.edu.tw/" target="_blank">
            <img src="https://www.pu.edu.tw/var/file/0/1000/msys_1000_5150459_40816.ico" title="前往學校網頁(另開視窗)">
        </a>
        <div id="time"></div>
    </div>

    <div class="main">
        <div class="side-menu">
            <div class="introduce">
                <a href="#" accesskey="L" style="text-decoration:none" id="start-L">:::</a>
                <h4>監控狀態</h4>
                <table>
                    <tr>
                        <td><b>學號</b></td>
                        <td><b>姓名</b></td>
                        <td><b>經度</b></td>
                        <td><b>緯度</b></td>
                        <td><b>燈號</b></td>
                    </tr>

                    @foreach($people as $p)
                    <tr>
                        <td>{{ $p->sidimei }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->lan }}</td>
                        <td>{{ $p->lng }}</td>
                        @if(($p->sos)==0)
                        <td>
                            <img src="green_icon.png" alt="綠燈" style=color:#20c997>
                        </td>
                        @else
                        <td>
                            <img src="red_icon.png" alt="紅燈" style=color:#dc3545>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>

        <div class="main_view">
            <div id="mapid">
            </div>
        </div>

        <div class="side_menu">
            <a href="#" accesskey="L" style="text-decoration:none" id="start-L">:::</a>
            <h4>監控狀態</h4>
        </div>
    </div>

    <script>
        let newTimer = () => {
            let date = new Date();
            let str = date.toLocaleDateString();
            str += "  " + date.toLocaleTimeString();
            let odiv = document.getElementById("time");
            odiv.innerHTML = str;
            setTimeout(newTimer, 1000);
        }
        window.onload = () => {
            newTimer();
        }

        /*
            var sos_f = document.getElementById("sos").value;
            var lan_f = document.getElementById("lan").value;
            var lng_f = document.getElementById("lng").value;
            var img_green = "green_icon.png";
            var img_red = "red_icon.png";

            function loadicon() {
                if(sos_f == 1 ){
                    L.marker([lan_f, lng], { icon: redIcon }).addTo(mymap).bindPopup("<b>危險狀態</b>").openPopup();
                    return sidimei = img_red;
                }else{
                    L.marker([lan, lng], { icon: greenIcon }).addTo(mymap).bindPopup("<b>受監控狀態</b>").openPopup();
                    return sidimei = img_green;
                }
            }
        */
        var mymap = L.map('mapid').setView([24.227565, 120.581095], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
        }).addTo(mymap);

        /*L.marker([24.225745, 120.577193]).addTo(mymap)
            .bindPopup("<b>靜宜大學</b><br />校門口").openPopup();
        */
        var popup = L.popup();

        var LeafIcon = L.Icon.extend({
            options: {
                iconSize: [20, 20],
            }
        });

        var greenIcon = new LeafIcon({
            iconUrl: 'green_icon.png'
        });
        var redIcon = new LeafIcon({
            iconUrl: 'red_icon.png'
        });
        var greyIcon = new LeafIcon({
            iconUrl: 'grey_icon.png'
        });
        /*固定點*/
        L.marker([24.225971, 120.57743], {
            icon: greyIcon
        }).addTo(mymap); //.bindPopup("ibeacon_1")
        L.marker([24.226049, 120.577676], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226167, 120.577945], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226245, 120.578202], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226401, 120.578803], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.22644, 120.57849], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226255, 120.579157], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226333, 120.5795], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226323, 120.579886], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226343, 120.580283], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226391, 120.580637], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226391, 120.581142], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226352, 120.5817], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226411, 120.582021], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.22647, 120.582322], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226519, 120.582633], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226675, 120.582869], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226812, 120.583105], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.225971, 120.57743], {
            icon: greyIcon
        }).addTo(mymap);
        L.marker([24.226401, 120.581442], {
            icon: greyIcon
        }).addTo(mymap);
        /* */
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick);

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
