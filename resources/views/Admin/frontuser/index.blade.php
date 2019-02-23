@extends($AdminTheme)

@section('title','Frontuser List')
@section('content-header')
<h1>Frontuser List</h1>
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Frontuser list</a></li>
</ol>
@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Frontuser List</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">		
		@if($error = Session::get('error'))
			<div class="alert alert-danger">
				{{ $error }}
			</div>
      	@elseif($success = Session::get('success'))
	      	<div class="alert alert-success">
				{{ $success }}
	    	</div>
    	@endif
	    <div class="table-responsive">		
			<table class="datatable table table-bordered table-striped ">
				<thead>
					<tr>
						<th>No</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Profile Pic</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				@if(!empty($data))
				<tbody>				
					@foreach($data as $key => $post)
					<tr>
						<td>{{ ++$key }}</td>
						<td>{{ user_data($post->id)->Name }}</td>
						<td>{{ user_data($post->id)->Email }}</td>
						<td>{{ user_data($post->id)->cellphone }}</td>
						<td><img src="{{ user_data($post->id)->ProPic }}"  class="img-responsive" width="50" /></td>
						<td class="text-center" >{{ status($post->status) }}</td>
						<td class="text-center">
							<a href="{{ route('frontuser.show',$post->id) }}" class="btn btn-flat btn-info"><i class="fa fa-eye"></i> View</a>
							<a href="{{ route('frontuser.delete',$post->id) }}" class="btn btn-danger btn-flat" onclick=" return confirm('are you sure ?')">Delete <i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
				@endif
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection


