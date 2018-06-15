@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get('type')}}">{{Session::get('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
                
            </div>
            <div class="card-content table-responsive table-full-width">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>latitude</th>
                            <th>longitude</th>
                            <th>comment</th>
                            <th>type</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($listReport as $report)
	                        <tr>
	                            <td class="text-center">{{ $report->id }}</td>
	                            <td>{{ $report->latitude }}</td>
	                            <td>{{ $report->longitude }}</td>
	                            <td>{{ $report->comment }}</td>
	                            <td>{{ $report->type->name }}</td>
	                            <td class="td-actions text-right">
	                                <a href="#" rel="tooltip" title="View" class="btn btn-info btn-simple btn-xs">
	                                    <i class="ti-info"></i>
	                                </a>
	                                <a href="{{ route('admin.reports.edit', $report->id) }}" rel="tooltip" title="Edit" class="btn btn-success btn-simple btn-xs">
	                                    <i class="ti-pencil-alt"></i>
	                                </a>
	                                <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs remove-report" >
	                                    <i class="ti-close"></i>
	                                </a>
	                            </td>
	                        </tr>
                        @endforeach
                        
                    </tbody>

                </table>
                <div class="text-center">
                	{{ $listReport->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.remove-report').click(() => {
            swal({
                //title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
                confirmButtonClass: "btn btn-success btn-fill",
                cancelButtonClass: "btn btn-danger btn-fill",
                buttonsStyling: false
            }).then(() => {
              swal({
                //title: 'Deleted!',
                text: 'Your imaginary file has been deleted.',
                type: 'success',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
                })
            }, dismiss => {
              // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
              if (dismiss === 'cancel') {
                swal({
                  //title: 'Cancelled',
                  text: 'Your imaginary file is safe :)',
                  type: 'error',
                  confirmButtonClass: "btn btn-info btn-fill",
                  buttonsStyling: false
                })
              }
            });
        });
    });
</script>
@endsection