@extends($AdminTheme)

@section('title','Create Roles')

@section('content-header')
<h1>Create Roles</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Create Roles</li>
	</ol>
@endsection

@section('content')
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Create Roles</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['method'=>'post','route'=>'roles.store']) !!}
				<div class="form-group">
					<div class="col-sm-6">
					<label for="name" class="control-label">Name</label>
						{!! Form::text('name','',['class'=>'form-control','placeholder'=>'Enter Name' ,'autofocus','id'=>'firstname']) !!}
						@if ($errors->has('name'))<span class="help-block"><strong><font color="red">{{ $errors->first('name') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
					<label for="display_name" class="control-label">Display Name</label>
						{!! Form::text('display_name','',['class'=>'form-control','placeholder'=>'Enter Display name' ,'autofocus','id'=>'display_name']) !!}
						@if ($errors->has('display_name'))<span class="help-block"><strong><font color="red">{{ $errors->first('display_name') }}</font></strong></span>@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
					<label for="description" class="control-label">Description</label>
						{!! Form::textarea('description','',['class'=>'form-control','size'=>'3x5','placeholder'=>'Enter Description']) !!}
						@if ($errors->has('description'))<span class="help-block"><strong><font color="red">{{ $errors->first('description') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<br>
						<label>Permission :</label>
					</div>
						 	@foreach($permission as $value)
						<div class="col-md-2" style="margin-bottom:20px;">
                        		<input data-toggle="toggle" data-size="small" type="checkbox" value="{{ $value->id }}" name="permission[]">
                            	{{ $value->display_name }}
                        </div>
                        	@endforeach
					</div>
		        <div class="form-group">
			          <div class="col-md-12">
		        	<br>
			            {{ Form::submit('Submit', ['class'=>'btn btn-primary btn-flat']) }}
			          </div>
			    </div>
				</div>
			    {!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection