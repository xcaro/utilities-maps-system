@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="form-group col-md-3">
						<select class="form-control" id="cln-type">
							<option>Tất cả loại</option>
							@foreach($listType as $type)
								<option value="{{ $type->id }}">{{ $type->name }}</option>
							@endforeach 
						</select>
					</div>
					<div class="form-group col-md-3">
						<select class="form-control" id="cln-dst">
							<option>Tất cả khu vực</option>
							@foreach($listDistrict as $dst)
								<option value="{{ $dst->id }}">{{ $dst->name }}</option>
							@endforeach 
						</select>
					</div>
					<div class="form-group col-md-3">
						<select class="form-control" id="cln-status">
							<option value="2">Tất cả trạng thái</option>
							<option value="1">Đã duyệt</option>
							<option value="0">Chưa được duyệt</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<button class="btn btn-primary" type="button" id="btn-filter"><i class="ti-search"></i> Tìm </button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card card-map">
			<div class="card-header">
                <h4 class="card-title">Danh sách phòng </h4>
			</div>
			<div class="card-content">
            	<div id="map" class="map map-big"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
<script>
	var type = {
		confirm: 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjU2LDBDMTY3LjY0MSwwLDk2LDcxLjYyNSw5NiwxNjBjMCwyNC43NSw1LjYyNSw0OC4yMTksMTUuNjcyLDY5LjEyNUMxMTIuMjM0LDIzMC4zMTMsMjU2LDUxMiwyNTYsNTEybDE0Mi41OTQtMjc5LjM3NSAgIEM0MDkuNzE5LDIxMC44NDQsNDE2LDE4Ni4xNTYsNDE2LDE2MEM0MTYsNzEuNjI1LDM0NC4zNzUsMCwyNTYsMHogTTI1NiwyNTZjLTUzLjAxNiwwLTk2LTQzLTk2LTk2czQyLjk4NC05Niw5Ni05NiAgIGM1MywwLDk2LDQzLDk2LDk2UzMwOSwyNTYsMjU2LDI1NnoiIGZpbGw9IiMwMDZERjAiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K',
		unconfirm: 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjU2LDBDMTY3LjY0MSwwLDk2LDcxLjYyNSw5NiwxNjBjMCwyNC43NSw1LjYyNSw0OC4yMTksMTUuNjcyLDY5LjEyNUMxMTIuMjM0LDIzMC4zMTMsMjU2LDUxMiwyNTYsNTEybDE0Mi41OTQtMjc5LjM3NSAgIEM0MDkuNzE5LDIxMC44NDQsNDE2LDE4Ni4xNTYsNDE2LDE2MEM0MTYsNzEuNjI1LDM0NC4zNzUsMCwyNTYsMHogTTI1NiwyNTZjLTUzLjAxNiwwLTk2LTQzLTk2LTk2czQyLjk4NC05Niw5Ni05NiAgIGM1MywwLDk2LDQzLDk2LDk2UzMwOSwyNTYsMjU2LDI1NnoiIGZpbGw9IiNEODAwMjciLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'
	};
	var listClinic = {!! $listClinic !!};
	var markers = {};
	var displayClinic = (map, cln) => {
		let infowindow = new google.maps.InfoWindow({
        	content: `<b>Tên: <i>${cln.name}</i></b><br/><b>Địa chỉ: </b><i>${cln.address}</i><hr>
						<button type="button" class="btn ${cln.confirmed?'btn-primary':'btn-success'} confirm-report" data-cln-id="${cln.id}" >${cln.confirmed?'Unconfirm':'Confirm'}</button>
						<button type="button" class="btn btn-danger">Delete</button>`,
			maxWidth:200,
        });
        let marker = new google.maps.Marker({
	        position: {lat: cln.latitude, lng: cln.longitude},
	        map: map,
	        draggable: true,
            animation: google.maps.Animation.DROP,
	        icon: (cln.confirmed) ? type.confirm: type.unconfirm
        });
        marker.addListener('click',() => {
          infowindow.open(map, marker);
        });
        markers[cln.id] = (marker);
	}
	$(() => {
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 12,
		});
		$.each(listClinic, (index, el) => {
			displayClinic(map, el);
		});

		$('#btn-filter').click((e) => {
			let clnType = $('#cln-type').val();
			let clnDistrict = $('#cln-dst').val();
			let clnStatus = $('#cln-status').val();

			$.ajax({
				url: '/admin/clinic/filter',
				method: 'POST',
				dataType: 'JSON',
				data: {
					type:clnType,
					district:clnDistrict,
					status:clnStatus,
					_token:token,
				},
			})
			.done((res) => {
				console.log(res);
				clearAllMarkers(markers);
				displayMarkers(map, res);
			})
			.fail((err) => console.log(err))
			.always(() => console.log("complete"));
		});
	});
</script>
@endsection