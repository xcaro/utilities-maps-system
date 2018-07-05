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
				<button type="button" class="btn btn-primary create-type" data-type="create"><i class="ti-plus"></i> Thêm mới</button>
			</div>
			<div class="card-content table-responsive table-full-width">
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Chuyên khoa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list_type as $item)
							<tr>
								<td class="text-center">{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td class="td-actions text-right">
									<button type="button" data-id="{{ $item->id }}" data-type="update" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs edit-type">
										<i class="ti-pencil-alt"></i>
									</button>
									<button type="button" rel="tooltip" title="Xoá" class="btn btn-danger btn-simple btn-xs" onclick="javascript:removeType({{$item->id}})">
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
						<input type="text" name="name" class="form-control" placeholder="Tên loại" required />
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
                url: '/admin/ctype/' + id,
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
					 url: `ctype/${id}`,
					 type: 'GET',
					 dataType: 'JSON',
				})
				.done((res) => {
					 $('input[name="name"]').val(res.name);
				})
				.fail((err) => console.log(err))
				.always(() => console.log("get data complete"));
			}
		});
		$('.btn-submit-update').click(function(event) {
			$.ajax({
			  url: '/admin/ctype/' + id,
			  method: 'PUT',
			  dataType: 'JSON',
			  data: {
			      name:$('input[name="name"]').val(),
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
			  url: '/admin/ctype/',
			  method: 'POST',
			  dataType: 'JSON',
			  data: {
			      name:$('input[name="name"]').val(),
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