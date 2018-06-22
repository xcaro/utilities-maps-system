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
                <h4 class="card-title">Traffic Report Map</h4>
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
		var markers = [];
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 13,
		});
		$.each(listReport, (index, el) => {
			let infowindow = new google.maps.InfoWindow({
	          content: `${el.comment}<hr>
							<button type="button" class="btn btn-primary confirm-report" data-report-id="${el.id}">Confirm</button>
							<button type="button" class="btn btn-danger">Delete</button>`
	        });
			let marker = new google.maps.Marker({
	          position: {lat: 10.764237, lng: 106.689597},
	          map: map,
	          icon: "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjU2LDBDMTY3LjY0MSwwLDk2LDcxLjYyNSw5NiwxNjBjMCwyNC43NSw1LjYyNSw0OC4yMTksMTUuNjcyLDY5LjEyNUMxMTIuMjM0LDIzMC4zMTMsMjU2LDUxMiwyNTYsNTEybDE0Mi41OTQtMjc5LjM3NSAgIEM0MDkuNzE5LDIxMC44NDQsNDE2LDE4Ni4xNTYsNDE2LDE2MEM0MTYsNzEuNjI1LDM0NC4zNzUsMCwyNTYsMHogTTI1NiwyNTZjLTUzLjAxNiwwLTk2LTQzLTk2LTk2czQyLjk4NC05Niw5Ni05NiAgIGM1MywwLDk2LDQzLDk2LDk2UzMwOSwyNTYsMjU2LDI1NnoiIGZpbGw9IiNEODAwMjciLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K",
	        });
	        marker.addListener('click',() => {
	          infowindow.open(map, marker);
	        });

	        markers.push(marker)
		});
		$(document).on('click', 'button.confirm-report', (e) => {
			console.log(markers[0])
			markers[0].setMap(null)
			markers[0] = new google.maps.Marker({
	          position: {lat: 10.764237, lng: 106.689597},
	          map: map,
	         });
			let id = $(e.target).data('report-id');
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