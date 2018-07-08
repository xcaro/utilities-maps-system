@extends('layouts.admin')
@section('styles')
<style>
	img.img-thumbnail{
	max-width: 46px;
	}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">


		<div class="card">
			<div class="card-header">
				<h4 class="card-title">{{ $title = ''}}</h4>
				<button type="button" class="btn btn-primary create-type" data-type="create"><i class="ti-plus"></i> Thêm mới</button>
			</div>
			<div class="card-content table-responsive table-full-width">
				<table class="table">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Tên loại</th>
							<th>Icon xác nhận</th>
							<th>Icon chưa xác nhận</th>
							<th>Icon menu</th>
							<th>Thời gian tồn tại</th>
						</tr>
					</thead>
					<tbody>
						@foreach($listType as $item)
							<tr>
								<td class="text-center">{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td><img src="{{ $item->confirmed_icon }}" class="img-thumbnail" ></td>
								<td><img src="{{ $item->unconfirmed_icon }}" class="img-thumbnail"></td>
								<td><img src="{{ $item->menu_icon }}" class="img-thumbnail"></td>
								<td>{{ $item->alive }}(s)</td>
								<td class="td-actions text-right">
									<button type="button" data-id="{{ $item->id }}" data-type="update" rel="tooltip" title="Edit Type" class="btn btn-success btn-simple btn-xs edit-type">
										<i class="ti-pencil-alt"></i>
									</button>
									<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs" onclick="javascript:removeType({{$item->id}})">
										<i class="ti-close"></i>
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="report-type-modal" tabindex="-1" role="dialog" aria-labelledby="report-type-modal" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="form-horizontal">
		<div class="modal-header">
			<h5 class="modal-title">Thông tin loại</h5>
			<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>-->
		</div>
		<div class="modal-body">
			<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="col-md-3 control-label">Tên loại</label>
					<div class="col-md-9">
						<input type="text" name="name" class="form-control" placeholder="Tên loại" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Đã xác nhận</label>
					<div class="col-md-9">
						<input type="text" name="confirmed_icon" class="form-control" placeholder="Đường dẫn icon đã xác nhận" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Chưa xác nhận</label>
					<div class="col-md-9">
						<input type="text" name="unconfirmed_icon" class="form-control" placeholder="Đường dẫn icon chưa xác nhận" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Icon menu</label>
					<div class="col-md-9">
						<input type="text" name="menu_icon" class="form-control" placeholder="Đường dẫn icon menu" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Thời gian tồn tại</label>
					<div class="col-md-9">
						<input type="text" name="alive" number="true" class="form-control" placeholder="Thời gian tồn tại" required/>
					</div>
				</div>
			</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary btn-submit-update" >Update</button>
			<button type="button" class="btn btn-primary btn-submit-create" >Create</button>
		</div>
		</div>
	</div>
	</div>
</div>

@endsection
@section('scripts')
<script>
	var removeType = id => {
		swal({
            text: 'Bạn có chắc chắn muốn xoá không?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            confirmButtonClass: "btn btn-success btn-fill",
            cancelButtonClass: "btn btn-danger btn-fill",
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: '/admin/rtype/' + id,
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
                        text: 'Xoá thành công',
                        type: 'success',
                        confirmButtonClass: "btn btn-success btn-fill",
                        buttonsStyling: false
                    });
                } else {
                	swal({
                        text: 'Không thể xoá',
                        type: "error",
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
	$(document).ready(() => {
		let id;
		$('.edit-type, .create-type').click(function(e) {
			$('#report-type-modal input').val('');
			$('#report-type-modal').modal({show:true});
			if ($(this).data('type') === 'create') {
				$('.btn-submit-update').hide();
				$('.btn-submit-create').show();
			}
			else {
				id = $(this).data('id');
				$('.btn-submit-create').hide();
				$('.btn-submit-update').show();
				$.ajax({
					 url: `rtype/${id}`,
					 type: 'GET',
					 dataType: 'JSON',
				})
				.done((res) => {
					 $('input[name="name"]').val(res.name);
					 $('input[name="confirmed_icon"]').val(res.confirmed_icon);
					 $('input[name="unconfirmed_icon"]').val(res.unconfirmed_icon);
					 $('input[name="menu_icon"]').val(res.menu_icon);
				})
				.fail((err) => console.log(err))
				.always(() => console.log("get data complete"));
			}
		});
		$('.btn-submit-update').click(function(event) {
			$.ajax({
			  url: '/admin/rtype/' + id,
			  method: 'PUT',
			  dataType: 'JSON',
			  data: {
			      name:$('input[name="name"]').val(),
			      confirmed_icon:$('input[name="confirmed_icon"]').val(),
			      unconfirmed_icon:$('input[name="unconfirmed_icon"]').val(),
			      menu_icon:$('input[name="menu_icon"]').val(),
			      _token:token,
			 },
			})
		 	.done((res) => {
		 		console.log(res);
				 if (res.success) {
					 swal({
						 title: "Thành công!",
						 text: res.message,
						 buttonsStyling: false,
						 confirmButtonClass: "btn btn-success btn-fill",
						 type: "success"
					 });
				 } else {
					 swal({
						 title: "Thất bại!",
						 text: res.message,
						 buttonsStyling: false,
						 confirmButtonClass: "btn btn-danger btn-fill",
						 type: "error"
					 });
				 }
			 })
			.fail(function(e) {
			  console.log(e);
			  swal({
				 title: "Thất bại!",
				 text: res.message,
				 buttonsStyling: false,
				 confirmButtonClass: "btn btn-danger btn-fill",
				 type: "error"
			  });
			})
			.always(() => setTimeout(() => location.reload(), 2000));
		});
		$('.btn-submit-create').click(function(event) {
			$.ajax({
			  url: '/admin/rtype/',
			  method: 'POST',
			  dataType: 'JSON',
			  data: {
			      name:$('input[name="name"]').val(),
			      confirmed_icon:$('input[name="confirmed_icon"]').val(),
			      unconfirmed_icon:$('input[name="unconfirmed_icon"]').val(),
			      menu_icon:$('input[name="menu_icon"]').val(),
			      _token:token,
			 },
			})
		 	.done((res) => {
				 if (res.success) {
					 swal({
						 title: "Thành công!",
						 text: res.message,
						 buttonsStyling: false,
						 confirmButtonClass: "btn btn-success btn-fill",
						 type: "success"
					 });
				 } else {
					 swal({
						 title: "Thất bại!",
						 text: res.message,
						 buttonsStyling: false,
						 confirmButtonClass: "btn btn-danger btn-fill",
						 type: "error"
					 });
				 }
			 })
			.fail(function(e) {
			  swal({
				 title: "Thất bại!",
				 text: res.message,
				 buttonsStyling: false,
				 confirmButtonClass: "btn btn-danger btn-fill",
				 type: "error"
			  });
			})
			.always(() => setTimeout(() => location.reload(), 2000));
		});
	});
</script>
@endsection