<!doctype html>
<html class="no-js" lang="en">
@include('sweetalert::alert')
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard V.1 | Nalika - Material Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/assets/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- nalika Icon CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/nalika-icon.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="assets/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/css/data-table/bootstrap-table.css">

    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .icon:hover{
            transition: .5s ease;
            filter:brightness(70%);
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <center>
                      <img src="assets/img/logo/logo-square.png" alt="" style="width:80px;margin-top:30px">
                        <h3 style="color:white;">Selamat Datang!</h3>
                        <div class="row"style="margin:50px">
                            <div class="col-lg-3">

                                <a type="button" class="icon" style="background-color:transparent;border:none;" href="{{ url('login/'.'1')}}">
                                    <center>
                                        <img src="assets/img/user/cso.png" width="100%" alt="">
                                        <div class="row"style="background-color:#685072;width:100%;">
                                            <h4 style="color:white;padding-top:15px;padding-bottom:15px;">Customer <br>Service Officer</h4>
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a type="button" class="icon" style="background-color:transparent;border:none;" href="{{ url('login/'.'2')}}"><img src="assets/img/user/command-center.png" alt="">
                                    <center>
                                        <div class="row"style="background-color:#685072;width:100%;">
                                            <h4 style="color:white;padding-top:15px;padding-bottom:15px;">Command<br>Center</h4>
                                        </div>
                                    </center>
                                </a>   
                            </div>
                            <div class="col-lg-3">
                                <a type="button" class="icon" style="background-color:transparent;border:none;" href="{{ url('login/'.'3')}}"><img src="assets/img/user/tic-area.png" alt="">
                                    <center>
                                        <div class="row"style="background-color:#685072;width:100%;">
                                            <h4 style="color:white;padding-top:15px;padding-bottom:15px;">Traffic <br>Information Center</h4>
                                        </div>
                                    </center>
                                </a>
                            </div>
                            <div class="col-lg-3">
                            <a type="button" class="icon" style="background-color:transparent;border:none;" href="{{ url('login/'.'4')}}"><img src="assets/img/user/admin.png" alt="">
                                <center>
                                    <div class="row"style="background-color:#685072;width:100%;">
                                        <h4 style="color:white;padding-top:15px;padding-bottom:15px;">Admin /<br>Management</h4>
                                    </div>
                                </center>
                            </a>
                            </div>

                        </div>
                    </center>
                    
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
    </div>
    <!-- jquery
		============================================ -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="assets/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="assets/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="assets/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="assets/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="assets/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="assets/js/metisMenu/metisMenu.min.js"></script>
    <script src="assets/js/metisMenu/metisMenu-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="assets/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/sparkline/jquery.charts-sparkline.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="assets/js/calendar/moment.min.js"></script>
    <script src="assets/js/calendar/fullcalendar.min.js"></script>
    <script src="assets/js/calendar/fullcalendar-active.js"></script>
	<!-- float JS
		============================================ -->
    <script src="assets/js/flot/jquery.flot.js"></script>
    <script src="assets/js/flot/jquery.flot.resize.js"></script>
    <script src="assets/js/flot/curvedLines.js"></script>
    <script src="assets/js/flot/flot-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="assets/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="assets/js/main.js"></script>
</body>
   
</html>