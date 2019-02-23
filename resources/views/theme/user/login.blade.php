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
                                    <div class="site-logo logo-in-box">
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
                                        @if($errorsa = Session::get('errorsa'))
                                            <p class="text-muted"><div class="alert alert-danger">{{ $errorsa }}</div></p>
                                        @endif
                                        <!-- <div class="page-title">
                                            <h4 style="border: none;">SignIn</h4>
                                        </div> -->
                                        {!! Form::open(['route'=>'signin.post','method'=>'post']) !!}
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="Joel.Brooks@test.com">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="Password" value="123456">
                                            </div>
                                            <div class="form-group">
                                                    
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="login" value="Login" class="btn btn-primary btn-block" />
                                            </div>
                                            <div class="clearfix"></div>
                                            <p><a href="{{ route('email.form') }}" class="">Forgot password?</a></p>
                                            <p>Not a member? <a href="{{ route('index') }}" class="">Join now?</a></p>
                                            
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
@section('pageScript')
	<script type="text/javascript">
		
	</script>
@endsection