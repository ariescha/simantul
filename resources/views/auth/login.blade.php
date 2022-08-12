<!doctype html>
<html class="no-js" lang="en">
@include('sweetalert::alert')
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi Penilaian Kinerja</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/assets/img/favicon.ico')}}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
	  <!-- nalika Icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/nalika-icon.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.transitions.css')}}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css')}}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- morrisjs CSS
		============================================ -->
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu/metisMenu-vertical.css')}}">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/calendar/fullcalendar.print.min.css')}}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/data-table/bootstrap-table.css')}}">

    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .icon:hover{
            transition: .5s ease;
            filter:brightness(70%);
            display: inline-block;
        }

        .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        padding-left:30px;
        }

        .ver-hor-center {
        margin: 0;
        position: absolute;
        top: 25%;
        left: 47%;
        -ms-transform: translateY(-50%, -50%);
        transform: translateY(-50%, -50%);
        }
    </style>
</head>

<body>
<div style="display:block; width:100%; height: 100%;">
    <div style="width:40%; height: 100%; float: left; display: inline-block;">
        <div class="vertical-center">
            <img src="{{asset('assets/img/logo/logo-square.png')}}" alt="" style="width:80px;">
            <h4 style="color:white; ">Welcome to</h4>
            <h2 style="color:white;font-family:'Poppins'">SIMANTUL APP</h2>
        </div>
    </div>
  <div style="width:60%; height: 100%; float: left; display: inline-block; background-color: #f8f7fd">
        
        <div class="ver-hor-center">
            <center>
              
            <h3 style="color:#280653; ">LOGIN <br>@if(isset($id)) @if($id == '1') CUSTOMER SERVICE OFFICER @elseif($id == '2') COMMAND CENTER @elseif($id == '3') TIC AREA @else ADMIN @endif @endif</h3>
            </center>
            
            <form id="form-login" action="{{route('loginpost')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              
              <input type="hidden" name="role_id" value="{{$id}}">
              <div class="row">
                @if(\Session::has('alert'))
                <div class="alert alert-danger">
                  <div>{{Session::get('alert')}}</div>
                </div>
                @endif
              </div>
                <div class="row">
                    <select name="shift" id="shift" class="form-control" style="width:40%" required>
                        <option value="" disabled selected>Pilih Shift</option>
                        <option value="1">Shift 1 (06:00-14:00)</option>
                        <option value="2">Shift 2 (14:00-22:00)</option>
                        <option value="3">Shift 3 (22:00-06:00)</option>
                    </select>
                </div>
                <div class="row">
                    <input type="text" style="width: 600px;" class="form-control" name="npp"  id="npp" placeholder="NPP" required>
                </div>
                <div class="row">
                    <input type="password" style="width: 600px;" class="form-control" name="password"  id="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <center>
                        <button type="submit"  style="width: 600px;"class="btn btn-primary">Masuk</button>
                    </center>
                </div> <br>
                <div class="row" style="padding-left:10px">
                    Bukan @if(isset($id)) @if($id == '1') Customer Service Officer @elseif($id == '2') Command Center @elseif($id == '3') TIC Area @else Admin @endif @endif ? 
                    <a href="{{route('welcome-page')}}">Masuk sebagai user lain.</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
    <!-- jquery
		============================================ -->
    <script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset('assets/js/jquery-price-slider.js')}}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset('assets/js/jquery.meanmenu.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <!-- sticky JS
		============================================ -->
    <script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset('assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('assets/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="{{asset('assets/js/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu/metisMenu-active.js')}}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{asset('assets/js/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/sparkline/jquery.charts-sparkline.js')}}"></script>
    <!-- calendar JS
		============================================ -->
    <script src="{{asset('assets/js/calendar/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/fullcalendar-active.js')}}"></script>
	<!-- float JS
		============================================ -->
    <script src="{{asset('assets/js/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/js/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/js/flot/curvedLines.js')}}"></script>
    <script src="{{asset('assets/js/flot/flot-active.js')}}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
   
</html>