@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
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
						<a href="{{ route('admin.clinic.create') }}"><button class="btn btn-fill btn-success">Thêm mới</button></a>
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
	var markers = {};

	/**
	 * Xoá tất cả các report trên bản đồ
	 * @param  {array} markers :danh sách obj report
	 * @return {void}         
	 */
	var clearAllMarkers = (markers) => {
		$.each(markers, (index, el) => {
			el.setMap(null);
		});
	}

	var displayClinic = (map, cln) => {
		let infowindow = new google.maps.InfoWindow({
        	content: `<b>Tên: <i>${cln.name}</i></b><br/>
        	<b>Địa chỉ: </b><i>${cln.address}</i><br/><b>Trạng thái: </b><span class="label ${cln.confirmed?'label-success':'label-danger'}">${cln.confirmed?'Xác nhận':'Chưa xác nhận'}</span>
        	<hr>
			<button type="button" class="btn ${cln.confirmed?'btn-primary':'btn-success'} " data-cln-id="${cln.id}" onclick="javascript:${cln.confirmed?'unconfirmClinic('+cln.id+')':'confirmClinic('+cln.id+')'}"><i class="${cln.confirmed?'ti-close':'ti-check'}"></i></button>
			<button type="button" class="btn btn-danger" onclick="javascript:suspendClinic(${cln.id})"><i class="ti-lock"></i></button>
			<a href="clinic/${cln.id}/edit"><button class="btn btn-info"><i class="ti-pencil-alt"></i></button></a>`,
			maxWidth:300,
        });
        let marker = new google.maps.Marker({
	        position: {lat: cln.latitude, lng: cln.longitude},
	        map: map,
	        draggable: true,
            animation: google.maps.Animation.DROP,
	        icon: (cln.confirmed) ? type.confirm: type.unconfirm
        });
        marker.addListener('click',() => {
			infowindow.open(map, marker)
			google.maps.event.addListener(map, "click", function(event) {
			    infowindow.close();
			});
		});
        markers[cln.id] = (marker);
	}

	var displayClinics = (map, lstCln) => {
		clearAllMarkers(markers);
		map.setCenter({lat:lstCln[0].latitude, lng: lstCln[0].longitude});
		$.each(lstCln, (index, el) => {
			displayClinic(map, el);
		});
	}
	var confirmClinic = (id) => {
		$.ajax({
  			url: '/admin/clinic/' + id + '/confirm',
  			method: 'PUT',
  			dataType: 'JSON',
  			data: {_token:token},
  		})
  		.done((res) => {
  			console.log(res);
  			if (res.success) {
  				pushNotify('success', 'Xác nhận thành công');
  			}
  		})
  		.fail((err) => console.log(err))
  		.always(() => console.log("complete"));
	}
	var unconfirmClinic = id => {
		$.ajax({
  			url: '/admin/clinic/' + id + '/unconfirm',
  			method: 'PUT',
  			dataType: 'JSON',
  			data: {_token:token},
  		})
  		.done((res) => {
  			console.log(res);
  			if (res.success) {
  				pushNotify('info', ' Huỷ xác nhận thành công');
  			}
  		})
  		.fail((err) => console.log(err))
  		.always(() => console.log("complete"));
	}
	var suspendClinic = (id) => {
		$.ajax({
			url: '/admin/clinic/' + id,
			method: 'POST',
			dataType: 'JSON',
			data: {
				_method:'DELETE',
				_token:token,
			},
		})
		.done((res) => {
			if (res.success) {
  				pushNotify('info', 'Đình chỉ phòng khám thành công');
  			}
		})
		.fail((err) => console.log(err))
  		.always(() => console.log("complete"));
		
	}
	$(() => {
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 12,
		});

		var socket = io('{{env('SOCKET_SERVER')}}');
      	socket.on('clinics', (res) => {
   			let clnType = $('#cln-type').val();
			let clnDistrict = $('#cln-dst').val();
			let clnStatus = $('#cln-status').val();

			if (res.type == 'add') {
				pushNotify('warning', 'Có thêm một phòng khám được đăng ký');
				// $.notify({
				// 	icon: 'ti-flag-alt',
				// 	message: 'Có báo cáo mới',
				// }, {
				// 	type: 'warning',
				// 	delay: 5000,
				// 	placement: {
		  //               from: 'top',
		  //               align: 'right'
		  //           }
				// });
			}

      		if (res.type == 'initial' || res.type == 'add') {
      			let cln = res.new_val;
      			let flag = false;
				if (clnType == 0 || clnDistrict == 0 || clnStatus == 2) {
					flag = true;
				}
				else if (clnType == cln.type && reportDistrict == cln.district_id && clnStatus == cln.confirm) {
					flag = true;
				}
				if (flag) {
					displayClinic(map, cln);
				}
      		}
      		if (res.type == 'change') {
      			markers[res.new_val.id].setMap(null);
      			displayClinic(map, res.new_val);
      		}
      		if (res.type == 'remove') {
				markers[res.old_val.id].setMap(null);
      		}
      		console.log(res);
      	});
      	// $(document).on('click', 'button.confirm-cln', (e) => {
      	// 	let id = $(e.target).attr('data-cln-id');
      	// 	//console.log(id);
      	// 	$.ajax({
      	// 		url: '/admin/clinic/' + id + '/confirm',
      	// 		method: 'PUT',
      	// 		dataType: 'JSON',
      	// 		data: {_token:token},
      	// 	})
      	// 	.done((res) => {
      	// 		console.log(res);
      	// 		if (res.success) {
      	// 			pushNotify('success', 'Xác nhận thành công');
      	// 		}
      	// 	})
      	// 	.fail((err) => console.log(err))
      	// 	.always(() => console.log("complete"));
      		
      	// });
      	// $(document).on('click', 'button.unconfirm-cln', (e) => {
      	// 	let id = $(e.target).attr('data-cln-id');
      		
      	// 	$.ajax({
      	// 		url: '/admin/clinic/' + id + '/unconfirm',
      	// 		method: 'PUT',
      	// 		dataType: 'JSON',
      	// 		data: {_token:token},
      	// 	})
      	// 	.done((res) => {
      	// 		console.log(res);
      	// 		if (res.success) {
      	// 			pushNotify('info', ' Huỷ xác nhận thành công');
      	// 		}
      	// 	})
      	// 	.fail((err) => console.log(err))
      	// 	.always(() => console.log("complete"));
      		
      	// });
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
				displayClinics(map, res);
			})
			.fail((err) => console.log(err))
			.always(() => console.log("complete"));
		});
	});
</script>
@endsection