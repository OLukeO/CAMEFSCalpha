<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar練習</title>
    <!-- css連結 -->
    <link rel="stylesheet" href="style.css">

    <!-- JQuery連結 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JS連結 -->
    <script src="script.js"></script>

    <!-- FontAwesome 連結 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap 連結 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <style type="text/css">
        @import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC:100,300,400,500,700,900&display=swap"rel="stylesheet");
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");

        .container-all {
            display: flex;
            align-items: stretch;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: rgb(0, 0, 0);
            opacity: 70%;
            color: white;
            transition: 1s;
        }

        #sidebar.active {
            margin-left: -200px;
        }

        .container-right {
            background-color: lavender;
            width: 100%;
            height: 100vh;
            text-align: center;
            padding: 30px;
        }

        .collapse-btn {
            position: relative;
            top: 1%;
            left: 200px;
            background-color: rgb(0, 0, 0);
            color: white;
            border: none;
            font-size: 30px;
            padding: 5px;
        }

        .collapse-btn:hover {
            background-color: rgb(0, 0, 0);
            transition: 0.4s;
        }

        #sidebar p {
            text-align: center;
            font-size: 30px;
            font-style: italic;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 20px;
            display: block;
            text-decoration: none;
            color: white;
        }

        #sidebar ul li a:hover {
            color: rgb(0, 0, 0);
            background: #fff;
        }

        .fas,
        .far,
        .fab {
            float: right;
        }

        ul ul li a {
            background-color: rgb(203, 142, 247);
            font-size: 20px;
            font-style: italic;
        }

        @media (max-width:600px) {
            #sidebar {
                margin-left: -100px;
                width: 150px;
                font-size: 20px;
            }

            .collapse-btn {
                position: relative;
                top: 1%;
                left: 110px;
            }

            #sidebar.active {
                margin-left: 0px;
            }

            #sidebar ul p {
                font-size: 18px;
                text-align: left;
            }
        }

        .banner {
            display: flex;
        }

        .banner {
            width: 100%;
            height: 70px;
            background-color: #bad8f1;
            position: relative;
        }

        .banner .left {
            display: flex;
        }

        .banner .left {
            margin: 10px;
        }

        .banner .left img {
            width: 50px;
            height: 50px;
        }

        .banner .left h3 {
            color: #707070;
            margin: 10px 0 0 10px;
        }

        .banner .right .login p {
            right: 20px;
            margin: 20px 0 0 0;
            position: absolute;
        }

    </style>
    <script>
        //  展開/收合按鈕
        $(document).ready(function () {

            $("#collapse").on("click", function () {

                $("#sidebar").toggleClass("active");
                $(".fa-align-left").toggleClass("fa-chevron-circle-right");
            })
        })

    </script>


</head>

<body onload=>

    <div class="container-all">


        <!-- 左邊 -->
        <div class="container-left">
            <!-- 導覽列 -->
            <nav id="sidebar">

                <!-- 展往/縮起來 按鈕 -->

                <button type="button" id="collapse" class="collapse-btn">
                    <i class="fas fa-align-left"></i>
                </button>


                <!-- List 列表 -->
                <ul class="list-unstyled">
                    <p> C w C 頻道 </p>


                    <li>
                        <a href="#">首頁Home <i class="fas fa-home"></i> </a>
                    </li>
                    <li>
                        <a href="#">關於本頻道<i class="fab fa-youtube"></i> </a>
                    </li>
                    <li>
                        <a href="#sublist" data-bs-toggle="collapse" id="dropdown">系列影片 <i
                                class="far fa-file-video"></i></a>

                        <!-- 子連結列表  -->
                        <ul id="sublist" class="list-unstyled collapse">
                            <li>
                                <a href="#">HTML</a>
                            </li>
                            <li>
                                <a href="#">CSS</a>
                            </li>
                            <li>
                                <a href="#">JavaScript</a>
                            </li>

                        </ul>


                    </li>

                    <li>
                        <a href="#">作品 <i class="fas fa-briefcase"></i> </a>
                    </li>

                </ul>


            </nav>

        </div>

        <!-- 右邊 -->
        <div class="banner">
            <div class="left">
                <div class="checkbox"></div>
                <img src="https://upload.wikimedia.org/wikipedia/zh/5/54/PU_Logo.png">
                <h3>靜宜大學智慧校園</h3>
                <!--圖片&文字-->
            </div>
            <div class="right">
                <div class="login">
                    <!--接後台-->
                    <p>拉拉拉</p>
                </div>
            </div>

        </div>

    </div>

</body>

</html>
