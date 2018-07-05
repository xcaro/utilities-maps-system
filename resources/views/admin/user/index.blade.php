@extends('layouts.admin')
@section('content')
@can('user-control')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title = ''}}</h4>
                <a href="{{ route('admin.user.create') }}"><button type="button" class="btn btn-success btn-fill" data-type="create"><i class="ti-plus"></i> Thêm mới</button></a>
            </div>
            <div class="card-content table-responsive table-full-width">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Loại</th>
                            <th>Trạn thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
	                        <tr>
	                            <td class="text-center">{{ $user->id }}</td>
	                            <td>{{ $user->name }}</td>
	                            <td>{{ $user->email }}</td>
	                            <td>{{ $user->role ? $user->role->title : 'Người dùng'}}</td>
	                            <td><span class="label label-{{ $user->active ? 'success':'danger' }}">{{ $user->active ? 'kích hoạt':'Khoá' }}</span></td>
	                            <td class="td-actions text-right">
	                                <!--<a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                        <i class="ti-user"></i>
                                    </a>-->
	                                <a href="{{ route('admin.user.edit', $user->id) }}" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs">
	                                    <i class="ti-pencil-alt"></i>
	                                </a>
	                                <a href="#" rel="tooltip" title="Khoá" class="btn btn-danger btn-simple btn-xs" onclick="javascript:suspendUser({{$user->id}})">
	                                    <i class="ti-close"></i>
	                                </a>
	                            </td>
	                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <div class="text-center">
{{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@cannot('user-control')
Bạn không có quyền
@endcannot
@endsection
@section('scripts')
<script>
    let suspendUser = (id) => {
        swal({
            text: 'Bạn có chắc chắn muốn khoá tài khoản không?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            confirmButtonClass: "btn btn-success btn-fill",
            cancelButtonClass: "btn btn-danger btn-fill",
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: '/admin/user/' + id,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token:token,
                    _method:'DELETE',
                },
            })
            .done((res) => {
                if (res.success){
                    swal({
                        text: 'Tài khoản đã được khoá',
                        type: 'success',
                        confirmButtonClass: "btn btn-success btn-fill",
                        buttonsStyling: false
                    });
                } 
            })
            .fail(function() {
                swal({
                  text: 'Xảy ra lỗi',
                  type: 'error',
                  confirmButtonClass: "btn btn-info btn-fill",
                  buttonsStyling: false
              })
            })
            .always(() => setTimeout(() => location.reload(), 2000));
            
        
      }, function(dismiss) {
              // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
              if (dismiss === 'cancel') {
                swal({
                  text: 'Đã huỷ',
                  type: 'success',
                  confirmButtonClass: "btn btn-primary btn-fill",
                  buttonsStyling: false
              })
            }
        });
    }
</script>
@endsection