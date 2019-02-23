@extends($AdminTheme)

@section('title','Create User')

@section('content-header')
<h1>Edit User</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Edit User</li>
	</ol>
@endsection

@section('content')
	<div class="row">
	<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit User</h3>
			</div>
			<div class="box-body">
				{!! Form::model($data,['method'=>'patch','route'=>['users.update',$data->id], 'class'=>'form-horizontal']) !!}
				<div class="box-body">
				<div class="form-group">
					<label for="firstname" class="col-sm-3 control-label">First Name</label>
					<div class="col-sm-9">
						{!! Form::text('first_name',$data->first_name,['class'=>'form-control','placeholder'=>'First Name' ,'autofocus','id'=>'firstname']) !!}
						@if ($errors->has('first_name'))<span class="help-block"><strong><font color="red">{{ $errors->first('first_name') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-sm-3 control-label">Last Name</label>
					<div class="col-sm-9">
						{!! Form::text('last_name',$data->last_name,['class'=>'form-control','placeholder'=>'Last Name' ,'autofocus','id'=>'lastname']) !!}
						@if ($errors->has('last_name'))<span class="help-block"><strong><font color="red">{{ $errors->first('last_name') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="form-group">
					<label for="brith_date" class="col-sm-3 control-label">Brith Date</label>
					<div class="col-sm-9">
						{!! Form::text('brith_date',$data->brith_date,['class'=>'form-control datepicker','placeholder'=>'Brith Date' ,'autofocus','id'=>'brith_date','readonly','style'=>'border-radius:0px']) !!}
						@if ($errors->has('brith_date'))<span class="help-block"><strong><font color="red">{{ $errors->first('brith_date') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="form-group">
					<label for="brith_date" class="col-sm-3 control-label">Contacts</label>
					<div class="col-sm-9">
						{!! Form::text('contacts',$data->contacts,['class'=>'form-control digits','placeholder'=>'Enter Contact' ,'autofocus','id'=>'contacts']) !!}
						@if ($errors->has('contacts'))<span class="help-block"><strong><font color="red">{{ $errors->first('contacts') }}</font></strong></span>@endif
					</div>
				</div>

				<div class="form-group">
					<label for="role_id" class="col-sm-3 control-label">Admin Type</label>
					<div class="col-sm-9">
						{!! Form::select('role_id',[''=>'Select Role']+$listrole,$roleslists->role_id,['class' => 'form-control','selected']) !!}
						@if ($errors->has('role_id'))<span class="help-block"><strong><font color="red">{{ $errors->first('role_id') }}</font></strong></span>@endif
					</div>
				</div>
			 	<div class="form-group">
		          	<label for="inputEmail" class="col-sm-3 control-label">Gender</label>
			          <div class="col-sm-9">
				            <label>
				              {!! Form::radio('gender',0,['class'=>'minimal']) !!} Male
				            </label>
			            		&nbsp;&nbsp;&nbsp;
				            <label>
				              {!! Form::radio('gender',1,['class'=>'minimal']) !!} Female
				            </label>
			          </div>
		        </div>
		        <div class="form-group">
		          	<label for="inputEmail" class="col-sm-3 control-label">Status</label>
			          <div class="col-sm-9">
				            <label>
				              {{ Form::radio('status',1,true,['class'=>'minimal']) }} Active
				            </label>
			            		&nbsp;&nbsp;&nbsp;
				            <label>
				              {{ Form::radio('status',0,false,['class'=>'minimal']) }} DisActive
				            </label>
			          </div>
		        </div>
		        <div class="form-group">
					<label for="username" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						{!! Form::text('username',$data->username,['class'=>'form-control','placeholder'=>'Enter Email' ,'autofocus','id'=>'username','readonly'=>'true']) !!}
						@if ($errors->has('email'))<span class="help-block"><strong><font color="red">{{ $errors->first('email') }}</font></strong></span>@endif
					</div>
				</div>
		        <div class="form-group">
					<label for="email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						{!! Form::text('email',$data->email,['class'=>'form-control','placeholder'=>'Enter Email' ,'autofocus','id'=>'email','readonly'=>'true']) !!}
						@if ($errors->has('email'))<span class="help-block"><strong><font color="red">{{ $errors->first('email') }}</font></strong></span>@endif
					</div>
				</div>
		        <div class="form-group">
			          <div class="col-sm-offset-3 col-sm-2">
			            {{ Form::submit('Submit', ['class'=>'btn btn-primary btn-flat']) }}
			          </div>
			    </div>
			</div>
			    {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
