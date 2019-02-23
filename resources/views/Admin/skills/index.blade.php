@extends($AdminTheme)
@section('title','Skills List')
@section('content-header')
<h1>Skills List </h1>
<ol class="breadcrumb">
  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Skills</li>
</ol>
@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Skills List</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		@if($success = Session::get('success'))
		<div class="alert alert-success">{{ $success }}</div>
		@endif
		<div style="width: 250px; position: absolute;">
			<button data-toggle="modal" data-target="#modal-default" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add</button>
			@include('Admin.skills.create')
		</div>
		
		<div class="table-responsive">
			<table id="datatable" class="datatable table table-bordered table-striped ">
				<thead>
					<tr>
						<th width="50">No.</th>
						<th>Skill</th>
						<th width="250px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $val)
					<tr>
						<td>{{ ++$key }}</td>
						<td>{{ $val->skills }}</td>
						<td>
							<button data-toggle="modal" data-target="#modal-default-{{ $val->id }}" class="btn btn-info btn-flat"><i class="fa fa-edit"></i> Edit</button>
							@include('Admin.skills.edit')
							<a href="{{ route('skills.remove',$val->id) }}" class="btn btn-danger btn-flat" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
@endsection
