@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title = ''}}</h4>
                
            </div>
            <div class="card-content table-responsive table-full-width">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>latitude</th>
                            <th>longitude</th>
                            <th>notes</th>
                            <th>type</th>
                        </tr>
                    </thead>
                    <tbody>
	                        <tr>
	                            <td class="text-center"></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td class="td-actions text-right">
	                                <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
	                                    <i class="ti-user"></i>
	                                </a>
	                                <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
	                                    <i class="ti-pencil-alt"></i>
	                                </a>
	                                <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
	                                    <i class="ti-close"></i>
	                                </a>
	                            </td>
	                        </tr>
                        
                        
                    </tbody>

                </table>
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
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
      				<label>Name</label>
		        	<input type="text" name="" class="form-control" placeholder="Type name" />
		        </div>
      		</div>
      	</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
	$(document).ready(function() {
		$('#exampleModal').modal({show:true});
	});
</script>
@endsection