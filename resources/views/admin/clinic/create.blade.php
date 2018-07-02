@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="card">
        	<form class="form-horizontal">
				<div class="card-header">
	                <h4 class="card-title">Tạo phòng khám</h4>
	            </div>
				<div class="card-content">
					<div class="form-group">
						<label class="col-md-3 control-label">Tên phòng khám</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Tên phòng khám" class="form-control" required>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Địa chỉ</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Địa chỉ" class="form-control" required>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Chuyên khoa</label>
	                    <div class="col-md-9">
	                        <select class="form-control">
	                        	@foreach($listType as $type)
	                        	<option value="{{ $type->id }}">{{ $type->name }}</option>
	                        	@endforeach
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Quận</label>
	                    <div class="col-md-9">
	                    	<select class="form-control">
	                        	@foreach(\App\District::all() as $dst)
	                        	<option value="{{ $dst->id }}">{{ $dst->name }}</option>
	                        	@endforeach
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Người quản lý</label>
	                    <div class="col-md-9">
							<label class="col-md-9 control-label"></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Mô tả</label>
	                    <div class="col-md-9">
	                        <textarea name="content" id="editor"></textarea>
	                    </div>
					</div>

	            </div>
	            <div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
	                    	<button type="button" class="btn btn-primary btn-fill">Tạo mới</button>
	                    	<a href="{{ route('admin.clinic.index') }}"><button type="button" class="btn btn-danger btn-fill">Thoát</button></a>
						</div>
					</div>
	            </div>
        	</form>
		</div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
<script>
	$(function(argument) {
		ClassicEditor
		.create(document.querySelector( '#editor' ), {

		})
	    .then( editor => {
	        console.log( editor );
	    } )
	    .catch( error => {
	        console.error( error );
	    } );
	});

</script>
@endsection