<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ $title  = 'Trang quản trị'}}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('assets/css/paper-dashboard.css') }}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {{-- <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" /> --}}


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
    <style>
    	.perfect-scrollbar-off .sidebar .sidebar-wrapper{
    		overflow-x:hidden; 
    	}
    </style>
    @yield('styles')
</head>

<body>
	<div class="wrapper">
	    <div class="sidebar" data-background-color="brown" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<a href="#" class="simple-text logo-mini">
					LCT
				</a>

				<a href="#" class="simple-text logo-normal">
					lct system
				</a>
			</div>
	    	<div class="sidebar-wrapper">
				<div class="user">
	                <div class="info text-center text-uppercase">
						<!--<div class="photo">
		                    <img src="{{ asset('assets/img/faces/face-1.jpg') }}" />
		                </div>-->

	                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								{{ Auth::user()->name }}
		                        <!--<b class="caret"></b>-->
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <!--<div class="collapse" id="collapseExample">
	                        <ul class="nav">
	                            <li>
									<a href="#profile">
										<span class="sidebar-mini">Mp</span>
										<span class="sidebar-normal">My Profile</span>
									</a>
								</li>
	                            <li>
									<a href="#edit">
										<span class="sidebar-mini">Ep</span>
										<span class="sidebar-normal">Edit Profile</span>
									</a>
								</li>
	                            <li>
									<a href="#settings">
										<span class="sidebar-mini">S</span>
										<span class="sidebar-normal">Settings</span>
									</a>
								</li>
	                        </ul>
	                    </div>-->
	                </div>
	            </div>

	            @include('layouts.menu.list')
	            
	    	</div>
	    </div>

	    <div class="main-panel">
			<nav class="navbar navbar-default">
	            <div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
					</div>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar bar1"></span>
	                        <span class="icon-bar bar2"></span>
	                        <span class="icon-bar bar3"></span>
	                    </button>
	                    <a class="navbar-brand" href="#Dashboard">
							
						</a>
	                </div>
	                <div class="collapse navbar-collapse">

						<!--<form class="navbar-form navbar-left navbar-search-form" role="search">
	    					<div class="input-group">
	    						<span class="input-group-addon"><i class="fa fa-search"></i></span>
	    						<input type="text" value="" class="form-control" placeholder="Search...">
	    					</div>
	    				</form>-->

	                    <ul class="nav navbar-nav navbar-right">
	                        <!--<li>
	                            <a href="#stats" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
	                                <i class="ti-panel"></i>
									<p>Stats</p>
	                            </a>
	                        </li>
	                        <li class="dropdown">
	                            <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
	                                <i class="ti-bell"></i>
	                                <span class="notification">5</span>
									<p class="hidden-md hidden-lg">
										Notifications
										<b class="caret"></b>
									</p>
	                            </a>
	                            <ul class="dropdown-menu">
	                                <li><a href="#not1">Notification 1</a></li>
	                                <li><a href="#not2">Notification 2</a></li>
	                                <li><a href="#not3">Notification 3</a></li>
	                                <li><a href="#not4">Notification 4</a></li>
	                                <li><a href="#another">Another notification</a></li>
	                            </ul>
	                        </li>
							<li>
	                            <a href="#settings" class="btn-rotate">
									<i class="ti-settings"></i>
									<p class="hidden-md hidden-lg">
										Settings
									</p>
	                            </a>
	                        </li>-->
	                        <li>

	                            <a class="btn-rotate"  href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" rel="tooltip" title="Đăng xuất" data-placement="left">
                                        
									<i class="fa fa-sign-out"></i>
									<p class="hidden-md hidden-lg">
										{{ __('Signout') }}
									</p>
	                            </a>
	                        </li>
	                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
	                    </ul>
	                </div>
	            </div>
	        </nav>

	        <div class="content">
	            <div class="container-fluid">
	            	@yield('content')

                </div>
	        </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="http://www.creative-tim.com">
                                    Creative Tim
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                   Blog
                                </a>
                            </li>
                            <li>
                                <a href="http://www.creative-tim.com/license">
                                    Licenses
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!--<div class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                    </div>-->
                </div>
            </footer>
	    </div>
	</div>
</body>
<script>
	
	var token = '{{ csrf_token()}}';
</script>
	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="{{ asset('assets/js/es6-promise-auto.min.js') }}"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>

	<!--  Select Picker Plugin -->
	<script src="{{ asset('assets/js/bootstrap-selectpicker.js') }}"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="{{ asset('assets/js/bootstrap-switch-tags.js') }}"></script>

	<!-- Circle Percentage-chart -->
	<script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('assets/js/chartist.min.js') }}"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

	<!-- Vector Map plugin -->
	<script src="{{ asset('assets/js/jquery-jvectormap.js') }}"></script>

	<!--  Google Maps Plugin    -->
	<script async defer src="//maps.googleapis.com/maps/api/js?libraries=places‌​&key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=vi&region=vn"></script>

	<!-- Wizard Plugin    -->
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.min.js') }}"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="{{ asset('assets/js/jquery.datatables.js') }}"></script>

	<!--  Full Calendar Plugin    -->
	<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="{{ asset('assets/js/paper-dashboard.js') }}"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	{{-- <script src="{{ asset('assets/js/demo.js') }}"></script> --}}
	<script src="{{ asset('js/utils.js')}}"></script>

	@yield('scripts')
<script>
	var pushNotify = (type = 'warning', content = 'Có thông báo mới') => {
		$.notify({
			icon: 'ti-flag-alt',
			message: content,
		}, {
			type: type,
			// delay: 5000,
			placement: {
                from: 'top',
                align: 'right'
            },
            
		});
	}
	$(() => {
		let path = window.location.href;
		path = path.replace(/\/$/, "");
		path = decodeURIComponent(path);
		$('ul#slibar-menu li').each(function(index, el) {
			// if ($(el).children('a').attr('href') === path) {
			// 	$(el).addClass('active');
			// }
			//console.log(el);
			if ($(el).children('li a').attr('href') === path) {
				$(el).parent().parent().addClass('in');
				$(el).addClass('active');
				$(el).parent().parent().parent().addClass('active');
				// console.log(el);
			}
			if ($(el).children('a').attr('href') === path) {
				$(el).addClass('active');
			}
		});
	});
</script>
</html>
