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
        <div class="card">
			<form class="form-horizontal" method="POST" action="{{ route('admin.user.update-password', $user->id) }}">
                @csrf
                <div class="card-header">
					<h4 class="card-title">
						Đổi mật khẩu
					</h4>
				</div>
                <div class="card-content">
					<div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu cũ</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="Mật khẩu cũ" class="form-control" required name="oldPass" value="{{ old('oldPass') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu mới</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="Mật khẩu mới" class="form-control" required name="newPass" value="{{ old('newPass') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nhập lại mật khẩu mới</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="Nhập lại mật khẩu mới" class="form-control" required name="renewPass" value="{{ old('renewPass') }}">
                        </div>
                    </div>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-fill btn-info">
								Cập nhật
							</button>
                            <a href="{{ route('admin.user.index') }}"><button type="button" class="btn btn-fill btn-success">Quay về</button></a>
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