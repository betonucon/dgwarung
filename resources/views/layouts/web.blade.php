
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>BP SUPPLIER</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="{{url_plug()}}/img/icon.png" rel="icon">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="{{url_plug()}}/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{url_plug()}}/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
    
	<style>
        .loadnya {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1070;
			top: 0;
			left: 0;
			background-color: rgb(0,0,0);
			background-color: rgb(243 230 230 / 81%);
			overflow-x: hidden;
			transition: transform .9s;
		}
		.loadnya-content {
			position: relative;
			top: 25%;
			width: 100%;
			text-align: center;
			margin-top: 30px;
			color:#fff;
			font-size:20px;
		}
        .swal-text {
            width: 100%;
            color: #000;
        }
        .form-horizontal.form-bordered .form-group .col-form-label {
            padding: 1% 1% 1% 3%;
        }
        .form-horizontal.form-bordered .form-group>div {
            padding: 1%;
        }
		.timeline-steps {
			display: flex;
			justify-content: center;
			flex-wrap: wrap
		}
		.table td {
			padding: 2px 8px  !important;
			vertical-align: top;
			border-top: 1px solid #e4e7ea;
			font-size:11px;
		}
		.table th {
			padding: 8px !important;
			vertical-align: top;
			border-top: 1px solid #e4e7ea;
		}
		.timeline-steps .timeline-step {
			align-items: center;
			display: flex;
			flex-direction: column;
			position: relative;
			margin: 1rem
		}

		@media (min-width:768px) {
			.timeline-steps .timeline-step:not(:last-child):after {
				content: "";
				display: block;
				border-top: .25rem dotted #3b82f6;
				width: 3.46rem;
				position: absolute;
				left: 7.5rem;
				top: .3125rem
			}
			.timeline-steps .timeline-step:not(:first-child):before {
				content: "";
				display: block;
				border-top: .25rem dotted #3b82f6;
				width: 3.8125rem;
				position: absolute;
				right: 7.5rem;
				top: .3125rem
			}
		}
		.panel.panel-inverse>.panel-heading {
			background: #0e0e66;
			color: #fff;
		}
		.sidebar .nav>li>a {
			padding: 7px 20px;
			line-height: 20px;
			color: rgb(255 255 255);
			display: block;
			text-decoration: none;
		}
		.sidebar .nav>li.active>a {
			position: relative;
			z-index: 10;
			color: #fff;
			background: #32668b;
		}
		.timeline-steps .timeline-content {
			width: 10rem;
			text-align: center
		}

		.timeline-steps .timeline-content .inner-circle {
			border-radius: 1.5rem;
			height: 1rem;
			width: 1rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background-color: #3b82f6
		}
		.sidebar .nav>li.nav-profile .info {
			font-size: 14px;
			color: #080836;
			position: relative;
		}
		.sidebar .nav>li.nav-profile .info small {
			display: block;
			color: #0e0e44;
			font-size: 12px;
			margin-bottom: -5px;
		}
		.timeline-steps .timeline-content .inner-circle:before {
			content: "";
			background-color: #3b82f6;
			display: inline-block;
			height: 3rem;
			width: 3rem;
			min-width: 3rem;
			border-radius: 6.25rem;
			opacity: .5
		}
		.img-logo-png{
			width:83%;
		}
		@media only screen and (max-width: 700px) {
			#hidden-mobile{
				display:none;
			}
			.form-horizontal.form-bordered .form-group .col-form-label+div {
				padding: 0% 1% 0% 5% !important;
			}
			.img-logo-png{
				width:50%;
			}
		}
		
    </style>
	@stack('style')
</head>
<body style="font-family: sans-serif;">
	<!-- begin #page-loader -->
	<div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
			<button class="btn btn-light" type="button" disabled>
  				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  				Loading...
			</button>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<img src="{{url_plug()}}/img/logo.png?V={{date('ymdhis')}}" class="img-logo-png">
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{url_plug()}}/img/akun.png" alt="" /> 
						<span class="d-none d-md-inline">{{Auth::user()->name}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
						<a href="javascript:;" class="dropdown-item">Calendar</a>
						<a href="javascript:;" class="dropdown-item">Setting</a> -->
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		@include('layouts.side')
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<div class="modal fade" id="modal-aktive" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Notifikasi</h4>
					<button type="button" class="close" >×</button>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-red" onclick="location.assign(`{{url('stokorder')}}`)">Logout</a>
				</div>
			</div>
		</div>
	</div>  
	<audio id="myAudio">
        <source src="{{url_plug()}}/img/audio.mp3" type="audio/mp3">
    </audio>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="{{url_plug()}}/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="{{url_plug()}}/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url_plug()}}/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/moment/min/moment.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	
	<script src="{{url_plug()}}/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/select2/dist/js/select2.min.js"></script>
    @stack('ajax')
	<script type='text/javascript' src="{{url_plug()}}/js/jquery.inputmask.bundle.js"></script>
	
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>