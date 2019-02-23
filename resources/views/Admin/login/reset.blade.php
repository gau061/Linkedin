
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Password Reset </title>
        
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
        <p class="login-box-msg">Password reset Enter your Email</p>
            @if($error = Session::get('error'))
                <div class="alert alert-success">
                    {{ $error }}
                </div>
            @endif
        	
         	{!! Form::open(['route'=>'password.reset','method'=>'post','autocomplete'=>'off']) !!}
            <div class="form-group has-feedback">                
            	{!! Form::email('email',Input::get('email'),['class'=>'form-control','placeholder'=>'Email' ,'autofocus']) !!}
                 @if ($errors->has('email'))<span class="help-block"><strong><font color="red">{{ $errors->first('email') }}</font></strong></span>@endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {!! Form::submit('Send',['class'=>'btn btn-primary btn-block btn-flat']) !!}
                </div>
            </div>
         {!! Form::close() !!}
         <br>
    	<a href="{{ route('login') }}" class="btn btn-default btn-flat btn-sm btn-block">Back</a>
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