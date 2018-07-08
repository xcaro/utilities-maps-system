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
			<form class="form-horizontal" method="POST" action="{{ route('admin.user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="card-header">
					<h4 class="card-title">
						Chỉnh sửa tài khoản
					</h4>
				</div>
                <div class="card-content">
					<div class="form-group">
                        <label class="col-md-3 control-label">Họ tên</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Họ tên" class="form-control" required value="{{$user->name}}" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Email" class="form-control" required value="{{$user->email}}" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên tài khoản</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Tên tài khoản" class="form-control" required value="{{$user->username}}" name="username">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="Mật khẩu" class="form-control"  name="password">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Địa chỉ</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Địa chỉ" class="form-control" value="{{$user->address}}" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Số điện thoại</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Số điện thoại" class="form-control" value="{{$user->phone}}" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Loại tài khoản</label>
                        <div class="col-md-9">
                            <select class="form-control">
                                <option value="">---</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{$role->id == $user->role_id ?'selected':''}}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Trạng thái</label>
                        <div class="col-md-9">
                            <div class="checkbox">
                                <input id="active" type="checkbox" name="active" {{$user->active?'checked':''}}>
                                <label for="active">
                                    Kích hoạt
                                </label>
                            </div>      
                        </div>
                    </div>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<label class="col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-fill btn-info">
								Chỉnh sửa
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