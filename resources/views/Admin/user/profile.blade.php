@extends($AdminTheme)

@section('title','Admin')

@section('content-header')

<h1>User Profile </h1>

<ol class="breadcrumb">

  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>

  <li class="active">User Profile </li>

</ol>

@endsection



@section('content')
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">

        <div class="box-header with-border">

        <h3 class="box-title">User Login Details</h3>

      </div>  
      <div class="box-body box-profile">

        <img class="profile-user-img img-responsive img-circle" src="{{  adminUserData(auth()->user()->id)->ProPic }}" alt="User profile picture" style="height: 100px;">

        <h3 class="profile-username text-center">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>

        @if(auth()->user()->admin_type == 0)

        <p class="text-muted text-center">Master Admin</p>

        @else

        <p class="text-muted text-center">Sub Admin</p>

        @endif

        <ul class="list-group list-group-unbordered">

          <li class="list-group-item">

            <b>User Name</b> <span class="pull-right">{{ auth()->user()->username }}</span>

          </li>

          <li class="list-group-item">

            <b>User Email</b> <span class="pull-right">{{ auth()->user()->email }}</span>

          </li>

        </ul>

        

      </div>

      <!-- /.box-body -->

    </div>

    <!-- /.box -->

  </div>

  <!-- /.col -->

  <div class="col-md-5">

    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title">User Personal Details</h3>

      </div>

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

        {!! Form::open(['method'=>'post','route'=>['user.post','id'=>auth()->user()->id], 'class'=>'form-horizontal','files'=>'true']) !!}

        <div class="form-group">

          <label for="inputName" class="col-sm-3 control-label">First Name</label>

          <div class="col-sm-9">

            {!! Form::text('firstname', auth()->user()->first_name,['class'=>'form-control','placeholder'=>'First Name' ,'autofocus','id'=>'firstname']) !!}

             @if ($errors->has('firstname'))<span class="help-block"><strong><font color="red">{{ $errors->first('firstname') }}</font></strong></span>@endif

          </div>

        </div>

        <div class="form-group">

          <label for="inputName" class="col-sm-3 control-label">Last Name</label>

          <div class="col-sm-9">

            {!! Form::text('lastname', auth()->user()->last_name,['class'=>'form-control','placeholder'=>'Last Name' ,'autofocus','id'=>'lastname']) !!}

            @if ($errors->has('lastname'))<span class="help-block"><strong><font color="red">{{ $errors->first('lastname') }}</font></strong></span>@endif

          </div>

        </div>

        <div class="form-group">

          <label for="inputEmail" class="col-sm-3 control-label">Image</label>

            <div class="col-sm-9">

              {!! Form::hidden('old_image',auth()->user()->profile_pic) !!}

              {!! Form::file('image',['class'=>'form-control']) !!}

              @if ($errors->has('image'))<span class="help-block"><strong><font color="red">{{ $errors->first('image') }}</font></strong></span>@endif

            </div>

        </div>

        <div class="form-group">

          <label for="inputEmail" class="col-sm-3 control-label">Gender</label>

          <div class="col-sm-9">

            <label>

              {{ Form::radio('gender', '0', (auth()->user()->gender == '0'), ['class'=>'minimal']) }} Male

            </label>

            &nbsp;&nbsp;&nbsp;

            <label>

              {{ Form::radio('gender', '1', (auth()->user()->gender == '1'), ['class'=>'minimal']) }} Female

            </label>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-offset-3 col-sm-9">

            {{ Form::submit('Update Profile', ['class'=>'btn btn-primary btn-flat']) }}

          </div>

        </div>

        {!! Form::close() !!}

      </div>

    </div>

  </div>

  <!-- /.col -->

  <div class="col-md-4">

    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title">User Password Details</h3>

      </div>

      <div class="box-body">

        @if($error = Session::get('error_pass'))

              <div class="alert alert-danger">

                  {{ $error }}

              </div>

          @elseif($success = Session::get('success_pass'))

          <div class="alert alert-success">

                  {{ $success }}

              </div>

          @endif

        {!! Form::open(['method'=>'post','route'=>['user.password','id' => auth()->user()->id ], 'class'=>'form-horizontal']) !!}

        <div class="form-group">

          <label for="inputName" class="col-sm-4 control-label">Old Password</label>

          <div class="col-sm-8">

            {!! Form::password('old_password', ['class'=>'form-control','placeholder'=>'Old Password' ,'autofocus','id'=>'old_password']) !!}

            @if ($errors->has('old_password'))<span class="help-block"><strong><font color="red">{{ $errors->first('old_password') }}</font></strong></span>@endif

          </div>

        </div>

        <div class="form-group">

          <label for="inputName" class="col-sm-4 control-label">New Password</label>

          <div class="col-sm-8">

            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'New Password' ,'autofocus','id'=>'password']) !!}

            @if ($errors->has('password'))<span class="help-block"><strong><font color="red">{{ $errors->first('password') }}</font></strong></span>@endif

          </div>

        </div>

         <div class="form-group">

          <label for="inputName" class="col-sm-4 control-label">Re-Enter Password</label>

          <div class="col-sm-8">

            {!! Form::password('reenter_password', ['class'=>'form-control','placeholder'=>'Re-Enter Password' ,'autofocus','id'=>'reenter_password']) !!}

            @if ($errors->has('reenter_password'))<span class="help-block"><strong><font color="red">{{ $errors->first('reenter_password') }}</font></strong></span>@endif

          </div>

        </div>

       

        <div class="form-group">

          <div class="col-sm-offset-4 col-sm-10">

            {{ Form::submit('Update Password', ['class'=>'btn btn-primary btn-flat']) }}

          </div>

        </div>

        {!! Form::close() !!}

      </div>

    </div>

  </div>

  <!-- /.col -->

</div>

@endsection