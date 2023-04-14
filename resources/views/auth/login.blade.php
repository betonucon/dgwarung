
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
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->
			<div class="login-header">
				<div class="brand">
                    <img src="{{url_plug()}}/img/logo.png?v={{date('Y-m-d')}}" width="100%">
				</div>
				
			</div>
			<!-- end brand -->
			<!-- begin login-content -->
			<div class="login-content">
				<form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                        @csrf
					<div class="form-group m-b-20">
						<input type="text" class="form-control form-control-lg" name="email" placeholder="username" required />
                        @if ($errors->has('email'))
                            
                                <strong>{{ $errors->first('email') }}</strong>
                            
                        @endif
                    </div>
					<div class="form-group m-b-20">
						<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                        @if ($errors->has('password'))
                            
                            <strong>{{ $errors->first('password') }}</strong>
                        
                        @endif
                    </div>
					<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember_checkbox" /> 
						<label for="remember_checkbox">
							Remember Me
						</label>
					</div>
					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
					</div>
					
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end login -->
		
		<!-- begin login-bg -->
		<ul class="login-bg-list clearfix">
			<li class="active"><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-17.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-17.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-16.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-16.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-15.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-15.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-14.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-14.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-13.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-13.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-12.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-12.jpg)"></a></li>
		</ul>
		<!-- end login-bg -->
		
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url_plug()}}/assets/js/demo/login-v2.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>