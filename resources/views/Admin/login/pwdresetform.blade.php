<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Password Update </title>
        @include('AdminTheme.css')

        <!-- iCheck -->        
        <link rel="stylesheet" href="{{ asset('AdminTheme/plugins/iCheck/square/blue.css')}}">

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
    <div class="login-logo">
        <a href="{{ route('login') }}"><b>{{ env('PREFIX_NAME') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Update Your Password</p>

         	{!! Form::model($token,['route'=>['password.update','token'=>$token],'method'=>'patch','autocomplete'=>'off']) !!}
            <div class="form-group has-feedback">                
            	{!! Form::email('email',Input::get('email'),['class'=>'form-control','placeholder'=>'Email' ,'autofocus','autocomplete'=>'false']) !!}
                 @if ($errors->has('email'))<span class="help-block"><strong><font color="red">{{ $errors->first('email') }}</font></strong></span>@endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'New Password' ,'autofocus','id'=>'inputPassword']) !!}
                @if ($errors->has('password'))<span class="help-block"><strong><font color="red">{{ $errors->first('password') }}</font></strong></span>@endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Confirm Password']) !!}
                @if ($errors->has('confirm_password'))<span class="help-block"><strong><font color="red">{{ $errors->first('confirm_password') }}</font></strong></span>@endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {!! Form::submit('Update Password',['class'=>'btn btn-primary btn-block btn-flat']) !!}
                </div>
            </div>
         {!! Form::close() !!}
         <br>
    </div>
</div>
        @include('AdminTheme.script')
        <!-- iCheck -->        
        <script src="{{ asset('AdminTheme/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' /* optional */
            });
          });
        </script>
    </body>
</html>