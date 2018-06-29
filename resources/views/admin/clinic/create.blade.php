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
	                        <input type="text" placeholder="Họ tên" class="form-control" required>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Địa chỉ</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Họ tên" class="form-control" required>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Chuyên khoa</label>
	                    <div class="col-md-9">
	                        <select class="form-control">
	                        	<option>Bao tử</option>
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Địa chỉ</label>
	                    <div class="col-md-9">
	                        <input type="text" placeholder="Họ tên" class="form-control" required>
	                    </div>
					</div>


	            </div>
	            <div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
	                    	<button type="button" class="btn btn-primary btn-fill">Cancel</button>
	                    	<button type="button" class="btn btn-danger btn-fill">Cancel</button>
						</div>
					</div>
	            </div>
        	</form>
		</div>
    </div>
</div>
@endsection
@section('scripts')
@endsection