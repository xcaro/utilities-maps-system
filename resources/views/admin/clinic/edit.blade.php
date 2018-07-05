@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="card">
        	<form class="form-horizontal" method="POST" action="{{ route('admin.clinic.update', request()->route('clinic')) }}">
        		@csrf
        		{{ method_field('PUT') }}
				<div class="card-header">
	                <h4 class="card-title">Chỉnh sửa phòng khám</h4>
	            </div>
				<div class="card-content">
					<div class="form-group">
						<label class="col-md-3 control-label">Tên phòng khám</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Tên phòng khám" class="form-control" required value="{{ $cln->name }}" name="name">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Địa chỉ</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Địa chỉ" class="form-control" required value="{{ $cln->address }}" name="address" id="clinic-address">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Chuyên khoa</label>
	                    <div class="col-md-9">
	                        <select class="form-control" name="type">
	                        	@foreach($listType as $type)
	                        	<option value="{{ $type->id }}" {{ $type->id == $cln->type ?'selected':''}}>{{ $type->name }}</option>
	                        	@endforeach
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Quận</label>
	                    <div class="col-md-9">
	                    	<select class="form-control" name="district">
	                        	@foreach(\App\District::all() as $dst)
	                        	<option value="{{ $dst->id }}" {{ $cln->district_id == $dst->id ?'selected':''}}>{{ $dst->name }}</option>
	                        	@endforeach
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Người quản lý</label>
	                    <div class="col-md-9">
							<label class="form-control-static">{{ $cln->userCreated->name }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Ngày hết hạn</label>
	                    <div class="col-md-9">
							<input type="text" class="form-control datetimepicker" placeholder="Ngày hết hạn" name="end_date" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Mô tả</label>
	                    <div class="col-md-9">
	                        <textarea id="editor" name="description"></textarea>
	                    </div>
					</div>
					<input type="hidden" name="latitude" value="{{ $cln->latitude }}" />
					<input type="hidden" name="longitude" value="{{ $cln->longitude }}" />
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-9">
							<div class="checkbox">
							    <input id="active" type="checkbox" name="active" {{ \Illuminate\Support\Carbon::now() < $cln->end_date ? 'checked':'' }}>
							    <label for="active">
									Đang hoạt động
								</label>
							</div>							
						</div>

					</div>
	            </div>
	            <div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
	                    	<button type="submit" class="btn btn-primary btn-fill">Chỉnh sửa</button>
	                    	<a href="{{ route('admin.clinic.index') }}"><button type="button" class="btn btn-danger btn-fill">Thoát</button></a>
						</div>
					</div>
	            </div>
        	</form>
		</div>
    </div>
</div>
<!--<button id="get-location">get location</button>-->
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
<script>
	$(function(argument) {
		ClassicEditor
		.create(document.querySelector( '#editor' ), {
			toolbar: ['Bold', 'Italic', 'bulletedList', 'numberedList', 'blockQuote','link']
		})
	    .then( editor => {
	        editor.setData('{{ $cln->description }}') ;
	    } )
	    .catch( error => {
	        console.error( error );
	    } );
	    $('.datetimepicker').datetimepicker({
	    	defaultDate: '{{ $cln->end_date }}',
	    	format: 'YYYY-MM-DD HH:mm:ss',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
         }).on("dp.change",function(event) {
         	let end_date = new Date($('input[name="end_date"]').val());
		    let now = new Date();
		    if (end_date < now) {
		    	$('input[name="active"]').prop('checked', false);
		    }
         });

	    $('input[name="address"]').change(function(event) {
	    	geocoder = new google.maps.Geocoder();
	    	let address = $('input[name="address"]').val();
		    geocoder.geocode( { 'address': address}, function(results, status) {
		      if (status == 'OK') {
		      	$('input[name="latitude"]').val(results[0].geometry.location.lat());
		      	$('input[name="longitude"]').val(results[0].geometry.location.lng());
		        console.log(results[0].geometry.location);
		      } else {
		        alert('Geocode was not successful for the following reason: ' + status);
		      }
		    });
	    });
	    var autocompleteFrom = new google.maps.places.Autocomplete(document.getElementById('clinic-address'));
	});

</script>
@endsection