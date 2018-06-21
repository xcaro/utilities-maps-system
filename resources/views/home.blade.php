@extends('layouts.app')
@section('styles')
<style>
#direct-box {
	background: rgba(255, 255, 255, 0.5);
	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    width: 400px;
    display: none;
}
#direct-box .header{
	background: #3367D6 !important;
	color: rgba(255,255,255,0.87);
	padding: 20px;
}
#direct-box .header h3{
	font-weight: normal!important;
}
#direct-box .content{
	padding: 15px 20px;
	background: rgba(66, 133, 244, 0.67);
}
#direct-box .input-group-text {
	background-color: unset;
	color: white;
	border: none;
}
.dismiss {
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #4285F4;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    -webkit-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
    border-radius: 1px;
}
.dismiss:hover {
    background: rgba(255, 255, 255, 0.87);
    color: #4285F4;
}
#direct-box .btn-search{
	background-color: #3367D6;
	color: rgba(255,255,255,0.87);
	padding: 10px;
	text-align: center;
	font-size: 20px;
	-webkit-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
}
#direct-box .btn-search:hover{
	background-color: rgba(51,103,214,0.87);
	color: white;
	cursor: pointer;
}
#direct-box #result{
	background: white;
}
</style>
@endsection
@section('content')
<div id="app"></div>

<nav id="sidebar">
    <div class="sidebar-header">
        <h3>noname system</h3>
    </div>

    <ul class="components">
        <li id="show-direct-box">
        	<a href="#">
        		<i class="fa fa-map"></i>
        		<p>Directions</p>
        	</a>
        </li>
        <li>
        	<a href="#">
        		<i class="fa fa-map-marker"></i>
        		<p>Search Places</p>
        	</a>
        </li>
        <li data-toggle="modal" data-target="#sign-up">
        	<a href="#">
        		<i class="fa fa-user-plus"></i>
        		<p>Sign Up</p>
        	</a>
        </li>
        <li data-toggle="modal" data-target="#sign-in">
        	<a href="#">
        		<i class="fa fa-sign-in"></i>
        		<p>Sign In</p>
        	</a>
        </li>
    </ul>

    <div class="widget-toggle">
    	<button class="widget-toggle-button" id="dismiss"></button>
    </div>
</nav>

<div id="left-panel">
	<div id="search-box">
		<div class="input-group">
			<div class="input-group-prepend">
		    	<button class="btn btn-search" type="button" id="sidebarCollapse"><i class="fa fa-align-justify"></i></button>
		    </div>
			<input type="text" name="search" class="search-input form-control" placeholder="Search Maps" autocomplete="off" />
			<div class="input-group-append">
				<button type="button" class="btn btn-search"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</div>
</div>

<div id="direct-box">
	<div class="header">
		<h3>Directions</h3>
		<div class="dismiss"><i class="fa fa-close"></i></div>
	</div>
	<div class="content">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-dot-circle-o"></i></span>
		    </div>
			<input type="text" class="form-control" placeholder="Start point..." autocomplete="off" id="start-point" />
			<!--<div class="input-group-append">
				<button type="button" class="btn btn-search"><i class="fa fa-search"></i></button>
			</div>-->
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
		    </div>
			<input type="text" class="form-control" placeholder="End point..." autocomplete="off" id="end-point" />
			<!--<div class="input-group-append">
				<button type="button" class="btn btn-search"><i class="fa fa-search"></i></button>
			</div>-->
		</div>
	</div>
	<div class="btn-search" id="direct-btn">
		<i class="fa fa-search"></i>
	</div>
	<div id="result">
		
	</div>
</div>

<div id="sign-up" class="modal">
	<div class="modal-dialog modal-lg">
		 <div class="modal-content">
		 	<div class="modal-header">
		 		<h5 class="modal-title">Sign Up</h5>
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		 	</div>
		 	<div class="modal-body">
		 		<div class="container-fluid">
		 			<div class="row">
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Fullname</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Username</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 			</div>
		 			<div class="row">
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Email</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Re-Email</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 			</div>
		 			<div class="row">
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Password</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 				<div class="col">
		 					<div class="form-group row">
		 						<label class="col-sm-3 col-form-label">Re-Password</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" >
							    </div>
		 					</div>
		 				</div>
		 			</div>
		 		</div>
		 	</div>
		 	<div class="modal-footer">
		        <button type="button" class="btn btn-primary">Sign Up</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		 </div>
	</div>
</div>
<div id="sign-in" class="modal">
	<div class="modal-dialog">
		 <div class="modal-content">
		 	<div class="modal-header">
		 		<h5 class="modal-title">Sign Up</h5>
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		 	</div>
		 	<div class="modal-body">
		 		<div class="container-fluid">
	 				<div class="form-group row">
 						<label class="col-sm-3 col-form-label">Username</label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control" placeholder="Username">
					    </div>
 					</div>
 					<div class="form-group row">
 						<label class="col-sm-3 col-form-label">Password</label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control" placeholder="Password">
					    </div>
 					</div>
 					<div class="form-group row">
 						<label class="col-sm-3 col-form-label"></label>
					    <div class="col-sm-9">
					    	<div class="form-check">
						        <input class="form-check-input" type="checkbox" id="check-remember">
						        <label class="form-check-label" for="check-remember">
						        	Remember me
						        </label>
						    </div>
					    </div>
 					</div>
		 		</div>
		 	</div>
		 	<div class="modal-footer">
		        <button type="button" class="btn btn-primary">Sign In</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		 </div>
	</div>
</div>
<div id="register-clinic" class="modal">
	<div class="modal-dialog">
		 <div class="modal-content">
		 	<div class="modal-header">
		 		<h5 class="modal-title">Sign Up</h5>
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		 	</div>
		 	<div class="modal-body">
		 		<div class="container-fluid">
	 				<div class="form-group row">
 						<label class="col-sm-4 col-form-label">Loại phòng khám</label>
					    <div class="col-sm-8">
					    	<select class="form-control" id="clinic-type">
					    	</select>
					    </div>
 					</div>
 					<div class="form-group row">
 						<label class="col-sm-4 col-form-label">Tên phòng khám</label>
					    <div class="col-sm-8">
					    	<select class="form-control" id="clinic-name">
					    		<option>ABC</option>
					    	</select>
					    </div>
 					</div>
 					<div class="form-group row">
 						<label class="col-sm-4 col-form-label">Lượt khám</label>
					    <div class="col-sm-8">
					    	<select class="form-control" id="clinic-shifts">
					    		<option>10:00 - 11:00</option>
					    		<option disabled>10:00 - 11:00</option>
					    	</select>
					    </div>
 					</div>
 					<div class="form-group row">
 						<div class="col-sm-4">
 							<label class="col-form-label">Mô tả triệu chứng</label>
 							<small class="text-muted">Optional</small>
 						</div>
 						{{--  --}}
					    <div class="col-sm-8">
					    	<textarea class="form-control"></textarea>
					    </div>
 					</div>
		 		</div>
		 	</div>
		 	<div class="modal-footer">
		        <button type="button" class="btn btn-primary">Sign In</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		 </div>
	</div>
</div>
<div id="map"></div>

@endsection
@section('scripts')
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script async defer src="//maps.googleapis.com/maps/api/js?libraries=places‌​&key=AIzaSyA0kXy7r6QF_I9nixVMeP1TbIZ3ERfWgYc&libraries=places&language=vi&region=vn"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
	$(() => {

		let map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 17,
		});

		map.controls[google.maps.ControlPosition.LEFT_TOP].push(document.getElementById('left-panel'));
		map.controls[google.maps.ControlPosition.LEFT_TOP].push(document.getElementById('direct-box'));

		// auto-complete
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('result'));
		let startPoint = document.getElementById('start-point');
		let endPoint = document.getElementById('end-point');
		var autocompleteFrom = new google.maps.places.Autocomplete(startPoint);
        var autocompleteTo = new google.maps.places.Autocomplete(endPoint);
        
        document.getElementById('direct-btn').addEventListener('click', () => {
        	directionsService.route({
        		origin: startPoint.value,
				destination: endPoint.value,
				travelMode: google.maps.TravelMode.DRIVING,
        	}, (response, status) => {
				if (status === google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
					//get direction info
					var htmlReturn = '';
					var route = response.routes[0];
					// console.log(route.legs[0].steps);
					// var listSteps = route.legs[0].steps;
					// listSteps.forEach((e) => {
					// 	document.getElementById('result').innerHTML += e.instructions + '<br>';
					// });
					htmlReturn += "Distance: <strong>" + route.legs[0].distance.text + "</strong>, Duration: <strong>" + route.legs[0].duration.text + "</strong>";
					//document.getElementById('infoDirections').innerHTML  = htmlReturn;
				} else {
					window.alert('Directions request failed due to ' + status);
				}
        	});
        });

		$('#direct-box .dismiss').click(() => {
			$('#direct-box').hide('fast');
			$('#left-panel').show('fast');
		});
		$('#show-direct-box').click(() => {
			$('#direct-box').show('fast');
			$('#sidebar').removeClass('active');
		});
		$("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss').on('click', () => {
            $('#sidebar').removeClass('active');
            //$('.overlay').fadeOut();
            $('.widget-toggle .widget-toggle-button').hide();
            $('#left-panel').show('fast');
        });

        $('#sidebarCollapse').on('click', () => {
            $('#sidebar').addClass('active');
            //$('.overlay').fadeIn();
            $('.collapse.in').toggleClass('in');
            //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
            $('.widget-toggle .widget-toggle-button').show();
            $('#left-panel').hide('fast');
        });

        $('#register-clinic').modal('show');
        $.ajax({
        	url: '/api/clinic-type',
        	type: 'GET',
        })
        .done(res => {
        	console.log(res);
        	$.each(res.data, (index, el) => {
        		$('#clinic-type').append(`<option value="${el.id}">${el.name}</option>`)
        	});
        })
        .fail((err) => {
        	console.log(err);
        })
        .always(function() {
        	console.log("complete");
        });
        
	});
</script>
@endsection