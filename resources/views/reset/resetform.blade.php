@extends($theme)


@section('content')
	<div class="parallax">
        <div class="parallax-image"></div>
        <div class="small-info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-push-1 col-md-6 col-md-push-3 col-lg-6 col-lg-push-3">
                        <div class="card-group animated flipInX">
                            <div class="card">
                                <div class="card-block center">
                                    <div class="site-logo logo-in-box ">
                                        <a href="index.html">
                                            <img src="{{for_logo()}}" alt="LinkedIn" title="LinkedIn" />
                                        </a>
                                    </div>
                                    <hr/>    
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 col-lg-8 col-lg-push-2">
                                        @if($success = Session::get('success'))
                                            <p class="text-muted"><div class="alert alert-success">{{ $success }}</div></p>
                                        @endif
                                        @if($error = Session::get('error'))
                                            <p class="text-muted"><div class="alert alert-danger">{{ $error }}</div></p>
                                        @endif
                                        <div class="page-title">
                                            <h4 style="border: none;">Update Password</h4>
                                        </div>
                                        {!! Form::open(['route'=>['pwd.update',$token],'method'=>'patch']) !!}
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email')}}">
                                                <font color="red"><b>@if($errors->has('email')) {{ $errors->first('email') }} @endif</b></font>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="New Password">
                                                <font color="red"><b>@if($errors->has('password')) {{ $errors->first('password') }} @endif</b></font>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                                                <font color="red"><b>@if($errors->has('confirm_password')) {{ $errors->first('confirm_password') }} @endif</b></font>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit"  value="Update Password" class="btn btn-primary btn-block" />
                                            </div>
                                            <div class="clearfix"></div>
                                        {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection