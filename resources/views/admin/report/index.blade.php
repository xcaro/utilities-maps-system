@extends('layouts.admin')
@section('styles')
<style>
	
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
                <h4 class="card-title">Lọc báo cáo</h4>
			</div>
			<div class="card-content">
				<div class="row" id="filter-options">
						<div class="form-group col-md-3">
							<select class="form-control" id="report-type">
								<option value="0">Tất cả loại báo cáo</option>
								@foreach($listType as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-3">
							<select class="form-control" id="report-district">
								<option value="0">Tất cả khu vực</option>
								@foreach($listDistrict as $dst)
									<option value="{{ $dst->id }}">{{ $dst->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-3">
							<select class="form-control" id="report-status">
								<option value="2">Tất cả trạng thái</option>
								<option value="0">Chưa xác nhận</option>
								<option value="1">Xác nhận</option>
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
                <h4 class="card-title">Bảng đồ tình trạng giao thông <span id="filter-option"></span></h4>
            </div>
			<div class="card-content">
				<!--<div id="admin">
					<report-map></report-map>
				</div>-->
            	<div id="map" class="map map-big"></div>
            </div>
		</div>
    </div>
</div>

@endsection
@section('scripts')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>-->
<script src="http://localhost:8000/socket.io/socket.io.js"></script>
<script>
	var listType = {!!$listType!!};
	var types = {};
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
	/**
	 * Hiển thị tất cả report lên bản đồ
	 * @param  {map} map        :obj google map
	 * @param  {obj} listReport :danh sách tất cả report
	 * @return {void}            
	 */
	var displayMarkers = (map, listReport) => {
		clearAllMarkers(markers);
		$.each(listReport, (index, el) => {
			displayMarker(map, el);
		});
	}

	/**
	 * Hiển thị một report lên bản đồ
	 * @param  {map} map    
	 * @param  {obj} report 
	 * @return {void}      
	 */
	var displayMarker = (map, report) => {
		let infowindow = new google.maps.InfoWindow({
			content: `${report.comment == null ? '':report.comment}<hr>
	 						<button type="button" class="btn btn-primary confirm-report" data-report-id="${report.id}" data-report-type="${report.type_id}">${report.confirm?'Unconfirm':'Confirm'}</button>
	 						<button type="button" class="btn btn-danger">Delete</button>`
		});
		let marker = new google.maps.Marker({
			draggable: true,
            animation: google.maps.Animation.DROP,
			position: {lat: report.latitude, lng: report.longitude},
			icon: (report.confirm) ? types[report.type_id].confirmed_icon: types[report.type_id].unconfirmed_icon,
		});
		marker.addListener('click', () => {
			infowindow.open(map, marker);
		});
		marker.setMap(map);
		markers[report.id] = (marker);
	}

	$(() => {
		
		// format Danh sách loại rp
		$.each(listType, (index, el) => {
			types[el.id] = {
				confirmed_icon: el.confirmed_icon,
				unconfirmed_icon: el.unconfirmed_icon,
			};
		});

		/**
		 * Khởi tạo bản đồ
		 * @type {google}
		 */
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.764237, lng: 106.689597},
        	mapTypeControl: false,
        	zoom: 12,
		});
		
		// Show các rp
		//displayMarkers(map, listReport);
		var socket = io('http://127.0.0.1:8000');
      	socket.on('connection', (res) => {
      		let reportType = $('#report-type').val();
			let reportDistrict = $('#report-district').val();
			let reportStatus = $('#report-status').val();

			if (res.type == 'add') {
				$.notify({
					icon: 'ti-flag-alt',
					message: 'Có báo cáo mới',
				}, {
					type: 'warning',
					delay: 5000,
					placement: {
		                from: 'top',
		                align: 'right'
		            }
				});
			}

      		if (res.type == 'initial' || res.type == 'add') {
      			let report = res.new_val;
      			let flag = false;
				if (reportType == 0 || reportDistrict == 0 || reportStatus == 2) {
					flag = true;
				}
				else if (reportType == report.type && reportDistrict == report.district_id && reportStatus == report.confirm) {
					flag = true;
				}
				if (flag) {
					displayMarker(map, res.new_val);
				}
      		}
      		console.log(res);
      	});
		// Thực hiện confirm
		$(document).on('click', 'button.confirm-report', (e) => {
			let id = $(e.target).data('report-id');
			$.ajax({
				url: '/admin/report/' + id + '/confirm',
				method: 'PUT',
				data: { _token: token},
			})
			.done((res) => {
				console.log(res);
				if(res.success){
					markers[id].setIcon(types[$(e.target).data('report-type')].confirmed_icon);
					$(e.target).text('Unconfirm');
				}
			})
			.fail((err) => console.log(err))
			.always(() => console.log("complete"));
			
		});
		
		$('#btn-filter').click((e) => {
			let reportType = $('#report-type').val();
			let reportDistrict = $('#report-district').val();
			let reportStatus = $('#report-status').val();

			$.ajax({
				url: '/admin/report/filter',
				method: 'POST',
				dataType: 'JSON',
				data: {
					type:reportType,
					district:reportDistrict,
					status:reportStatus,
					_token: token,
				},
			})
			.done((res) => {
				console.log(res);
				clearAllMarkers(markers);
				displayMarkers(map, res);
			})
			.fail((err) => {
				console.log(err);
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
	
</script>
@endsection