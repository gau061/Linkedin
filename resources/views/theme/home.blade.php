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
                                    <div class="page-title">
                                        <h4 style="border: none;margin-bottom: 0;">@lang('words.user_sign_up.user_sign_tit')</h4>
                                        <p class="text-muted">@lang('words.user_sign_up.user_create')</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 col-lg-8 col-lg-push-2">
                                            {!! Form::open(['route'=>'signup.post','method'=>'post','class'=>'contact-form']) !!}
                                                <div class="form-group">
                                                    {!! Form::text('firstname','',['class'=>'form-control','placeholder'=>trans('words.user_sign_up.user_fnm_pl')]) !!}
                                                    @if($errors->has('firstname')) <span class="error">{{ $errors->first('firstname') }} </span> @endif
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::text('lastname','',['class'=>'form-control','placeholder'=>trans('words.user_sign_up.user_lnm_pl')]) !!}
                                                    @if($errors->has('lastname')) <span class="error">{{ $errors->first('lastname') }} </span> @endif
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::email('email','',['class'=>'form-control','placeholder'=>trans('words.user_sign_up.user_emai_pl')]) !!}
                                                    @if($errors->has('email')) <span class="error">{{ $errors->first('email') }} </span> @endif
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('words.user_sign_up.user_pwd_pl')]) !!}
                                                    @if($errors->has('password')) <span class="error">{{ $errors->first('password') }} </span> @endif
                                                </div>
                                                <input type="submit" name="register" value="@lang('words.user_sign_up.user_reg_btn')" class="btn btn-primary" />
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