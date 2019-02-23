@extends($AdminTheme)
@section('title','User List')
@section('content-header')
<h1>User List </h1>
<ol class="breadcrumb">
  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">User</li>
</ol>
@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">User List</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		@if($success = Session::get('success'))
		<div class="alert alert-success">{{ $success }}</div>
		@endif
		
			<div style="width: 250px; position: absolute;">
				<a href="{{ route('users.create') }}" class="btn btn-primary btn-flat">Add &nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
			</div>
		
		<div class="table-responsive">
			<table id="datatable" class="datatable table table-bordered table-striped ">
				<thead>
					<tr>
						<th>No.</th>
						<th>Fullname</th>
						<th>Username</th>
						<th>Status</th>
						<th>Email</th>
						<th width="250px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $val)
					<tr>
						<td>{{ ++ $key }}</td>
						<td>{{ $val->first_name }} {{ $val->last_name }}</td>
						<td>{{ $val->username }}</td>
						<td>{{ status($val->status) }}</td>
						<td>{{ $val->email }}</td>
						<td>
							
								<a href="{{ route('users.edit',$val->id) }}" class="btn btn-info btn-flat">Edit <i class="fa fa-edit"></i></a>
							
							
								<button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#{{ $val->id }}-modal-default">View <i class="fa fa-eye"></i></button>
								@include('Admin.user.model')
							@if($val->id != 1)
									<a href="{{ route('users.delete',$val->id) }}" class="btn btn-danger btn-flat" onclick=" return confirm('are you sure ?')">Delete <i class="fa fa-trash"></i></a>
								@endif
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!--modal-->
@endsection