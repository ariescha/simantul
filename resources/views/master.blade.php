<!doctype html>
<html class="no-js" lang="en">
@include('sweetalert::alert')
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi Penilaian Kinerja</title>
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
    
    <link rel="stylesheet" type="text/css" href="assets/css/datatable.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .checked {
        color: orange;
      }
    </style>
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.js" integrity="sha512-5m2r+g00HDHnhXQDbRLAfZBwPpPCaK+wPLV6lm8VQ+09ilGdHfXV7IVyKPkLOTfi4vTTUVJnz7ELs7cA87/GMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<?php 
  $username = Session::get('username');
  $role = Session::get('role');  
?>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                <div class="menu-switcher-pro">
                    <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
						<i class="icon nalika-menu-task"></i>
					</button>
                </div>
            </div>
            <div class="sidebar-header" style="visibility:hidden">
                <a href="index.html"><img class="main-logo" src="assets/img/logo/logo.png" alt="" /></a>
                <strong><img src="assets/img/logo/logosn.png" alt="" /></strong>
            </div>
			<div class="nalika-profile" style="visibility:hidden">
				<!-- <div class="profile-dtl">
					<a href="#"><img src="assets/img/notification/4.jpg" alt="" /></a>
					<h2>Lakian <span class="min-dtn">Das</span></h2>
				</div> -->
				<div class="profile-social-dtl">
					<ul class="dtl-social">
						<li><a href="#"><i class="icon nalika-facebook"></i></a></li>
						<li><a href="#"><i class="icon nalika-twitter"></i></a></li>
						<li><a href="#"><i class="icon nalika-linkedin"></i></a></li>
					</ul>
				</div>
			</div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                      @if($role == 1)
                        <li>
                            <a class="@yield('dashboard-cso')" id="home-button" href="{{route('dashboard-cso')}}"  aria-expanded="false"><i class="fa fa-lg fa-edit"></i> <span class="mini-click-non">Dashboard</span></a>
                        </li>
                      @elseif($role == 2)
                      <li>
                            <a class="@yield('dashboard-cc')" id="home-button" href="{{route('dashboard-command-center')}}" aria-expanded="false"><i class="fa fa-lg fa-edit"></i> <span class="mini-click-non">Dashboard</span></a>
                        </li>
                        <li>
                            <a class="@yield('rekap-cc')" id="home-button" href="{{route('rekapitulasi-command-center')}}" aria-expanded="false"><i class="fa fa-lg fa-line-chart"></i> <span class="mini-click-non">Rekapitulasi</span></a>
                        </li> 
                      @elseif($role == 3)
                      <li>
                            <a class="@yield('data-petugas')" id="home-button" href="{{route('Petugas')}}" aria-expanded="false"><i class="fa fa-lg fa-user"></i> <span class="mini-click-non">Data Petugas</span></a>
                        </li>
                      <li>
                            <a class="@yield('dashboard-tic')" id="home-button" href="{{route('dashboard-tic-area')}}" aria-expanded="false"><i class="fa fa-lg fa-edit"></i> <span class="mini-click-non">Dashboard</span></a>
                        </li>
                      @elseif($role == 4)
                      <li>
                            <a class="@yield('dashboard-admin')" id="home-button" href="{{route('dashboard-admin')}}" aria-expanded="false"><i class="fa fa-lg fa-edit"></i> <span class="mini-click-non">Dashboard</span></a>
                        </li>
                        <li>
                            <a class="@yield('rekap-admin')" id="home-button" href="{{route('rekapitulasi-admin')}}" aria-expanded="false"><i class="fa fa-lg fa-line-chart"></i> <span class="mini-click-non">Rekapitulasi</span></a>
                        </li> 
                      @endif
                        
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="assets/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcome-heading">
                                            <h3 style="color:white"><b>Dashboard</b></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                   
															                        <span class="admin-name">Hi, {{$username}}</span>\
                                                </li>
                                                <li class="nav-item" style="visibility:hidden">
                                                    <span class="admin-name">CSO</span>
                                                </li>
                                                <li class="nav-item">
                                                    @if($role == 1)
                                                    <span class="admin-name">CSO</span>
                                                    @elseif($role == 2)
                                                    <span class="admin-name">Command Center</span>
                                                    @elseif($role == 3)
                                                    <span class="admin-name">TIC Area</span>
                                                    @elseif($role == 4)
                                                    <span class="admin-name">Admin</span>
                                                    @endif
                                                </li>
                                                <li class="nav-item" style="visibility:hidden">
                                                    <span class="admin-name">CSO</span>
                                                </li>
                                                <li class="nav-item">
                                                  <a href="#" role="button" title="Log Out" onclick="logout()"><i class="fa fa-sign-out"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2022 <a href="#">JMTC</a> | Jasa Marga Tollroad Command Center</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      function logout(){
        Swal.fire({
                    title: "Apakah anda yakin",
                    text: "Ingin logout dari SIMANTUL?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    console.log(result);
                    if(result['value'] == true){
                      window.location.href= "{{URL::to('logout')}}";
                    }
                });
      }
    </script>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            document.getElementById('sidebarCollapse').click();
        });

    </script>
</html>