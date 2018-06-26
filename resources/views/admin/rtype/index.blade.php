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
                <button type="button" class="btn btn-primary" data-type="create"><i class="ti-plus"></i> Thêm mới</button>
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
	                            <td class="td-actions text-right">
	                                <!--<a href="#" rel="tooltip" title="View Type" class="btn btn-info btn-simple btn-xs">
                                      <i class="ti-info"></i>
                                  </a>-->
	                                <a href="#"  data-id="{{ $item->id }}" data-type="update" rel="tooltip" title="Edit Type" class="btn btn-success btn-simple btn-xs show-modal-type">
	                                    <i class="ti-pencil-alt"></i>
	                                </a>
	                                <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
	                                    <i class="ti-close"></i>
	                                </a>
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
          <h5 class="modal-title">Thay đổi thông tin</h5>
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
        		</div>
        	</div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update-type">Update</button>
          <button type="button" class="btn btn-primary" id="create-type">Create</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
	$(document).ready(() => {
    
		$('#report-type-modal').on('show.bs.modal', (event) => {
      $('#report-type-modal input').val('');
      let token = '{{csrf_token()}}';
      let button = $(event.relatedTarget);

      //var typeId = button.data('id');
      if (button.data('type') === 'create') { //Create type
        $('#create-type').show();
        $('#update-type').hide();


        $('#create-type').click((event) => {
          $.ajax({
            url: `rtype`,
            type: 'POST',
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
                  type: "danger"
              });
            }
          })
          .fail((err) => {
            swal({
                title: "Thất bại!",
                text: 'Xảy ra lỗi',
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "danger"
            });
          })
          .always(() => {
            setTimeout(() => location.reload(), 2000);
          });
          
        });
      } else { // Update type
        $('#update-type').show();
        $('#create-type').hide();

        $.ajax({
          url: `rtype/${typeId}`,
          type: 'GET',
          dataType: 'JSON',
        })
        .done((res) => {
          console.log(res);
          $('input[name="name"]').val(res.name);
          $('input[name="confirmed_icon"]').val(res.confirmed_icon);
          $('input[name="unconfirmed_icon"]').val(res.unconfirmed_icon);
          $('input[name="menu_icon"]').val(res.menu_icon);
        })
        .fail((err) => console.log(err))
        .always(() => console.log("complete"));

        $('#update-type').click((event) => {
            console.log(typeId)
          $.ajax({
            url: `rtype/${typeId}`,
            type: 'PUT',
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
                  type: "danger"
              });
            }
          })
          .fail((err) => {
            swal({
                title: "Thất bại!",
                text: 'Xảy ra lỗi',
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "danger"
            });
          })
          .always(() => {
            setTimeout(() => location.reload(), 2000);
          });
        });

      }
    });
    $('.show-modal-type').click(() => $('#report-type-modal').modal({show:true}));

	});
</script>
@endsection