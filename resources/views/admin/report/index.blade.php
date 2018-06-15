@extends('layouts.admin')
@section('styles')
<style>
	
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="card card-map">
			<div class="card-header">
                <h4 class="card-title">Satellite Map</h4>
            </div>
			<div class="card-content">
                <div id="map" class="map map-big"></div>
            </div>
		</div>
    </div>
</div>

@endsection
@section('scripts')
<script>
	var listReport = {!!$listReport!!};
	$(() => {
		let map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 13,
		});
		$.each(listReport, (index, el) =>{
			console.log(el);
			let infowindow = new google.maps.InfoWindow({
	          content: `${el.comment}<hr>
							<button type="button" class="btn btn-primary confirm-report" data-report-id="${el.id}">Confirm</button>
							<button type="button" class="btn btn-danger">Delete</button>`
	        });
			let marker = new google.maps.Marker({
	          position: {lat: el.latitude, lng: el.longitude},
	          map: map,
	        });
	        marker.addListener('click', function() {
	          infowindow.open(map, marker);
	        });
		});
		$(document).on('click', 'button.confirm-report', (e) => {
			let id = $(e.target).data('report-id');
			console.log(id);
			$.ajax({
				url: '/admin/reports/' + id + '/confirm',
				type: 'POST',
				data: {_method: 'PUT', _token: '{{csrf_token()}}'},
			})
			.done((res) => {
				console.log(res);
			})
			.fail(() => {
				console.log("error");
			})
			.always(() => {
				console.log("complete");
			});
			
		});
	});
	
</script>
@endsection