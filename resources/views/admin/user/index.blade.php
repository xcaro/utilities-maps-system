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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Loại</th>
                            <th>Trạn thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
	                        <tr>
	                            <td class="text-center">1</td>
	                            <td>Admin</td>
	                            <td>admin@example.com</td>
	                            <td>Admin</td>
	                            <td><span class="label label-danger">disable</span></td>
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
@endsection