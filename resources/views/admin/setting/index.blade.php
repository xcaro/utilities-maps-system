@extends('layouts.admin')
@section('content')
@can('user-control')
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
			<form class="form-horizontal" method="POST" action="{{route('admin.setting.update')}}">
                @csrf
                <div class="card-header">
					<h4 class="card-title">
						Cài đặt
					</h4>
				</div>
                <div class="card-content">
					<div class="form-group">
                        <label class="col-md-5 control-label">Thời gian phòng khám hoạt động mặc định</label>
                        <div class="col-md-7">
                            <input type="text" placeholder="Số ngày" class="form-control" required value="{{$default_clinic_expire->value}}" name="default_clinic_expire">
                        </div>
                    </div>
                    
				<div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-fill btn-info">
								Lưu
							</button>
                            <!--<a href="#"><button type="button" class="btn btn-fill btn-success">Quay về</button></a>-->
						</div>
					</div>
				</div>
			</form>
    	</div> <!-- end card -->
	</div> <!--  end col-md-6  -->
    
</div>
@endcan
@cannot('user-control')
Bạn không có quyền
@endcannot
@endsection