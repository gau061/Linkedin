@extends($theme)
@section('content')
<div class="wrapper">
            <div class="parallax">
                <div class="parallax-image"></div>             
                <div class="small-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10 col-sm-push-1 col-md-6 col-md-push-3 col-lg-6 col-lg-push-3">
                                <div class="card-group animated flipInX">
                                	<?php
                                		$url = URL::current();
                                		$url = explode('/',$url);
                                	?>
                                	@if($url[4] == 'location')
                                    <div class="card">
                                        <div class="card-block center">
                                            <h4 class="m-b-0">
                                                <span class="icon-text">User Profile Details</span>
                                            </h4>
                                            <p class="text-muted">Fill Your Details</p>
                                            <form action="{{ route('profile.fill.user','location') }}" method="post" autocomplete="off">
                                            	{{ csrf_field() }}
                                                <div class="form-group text-left">
                                                	<label>Country :</label>
                                                    <select id="countries_states1" class="form-control bfh-countries" name="country" style="border-radius: 0px;"></select>
                                                    <font color="red">@if($errors->has('country'))<b>{{ $errors->first('country') }}</b>@endif</font>
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>State :</label>
                                                    <select class="form-control bfh-states" data-country="countries_states1"  id="stat" name="state" style="border-radius: 0px;"></select>
                                                    <font color="red">@if($errors->has('state'))<b>{{ $errors->first('state') }}</b>@endif</font>
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>City :</label>
                                                    <input type="text" class="form-control" name="city">
                                                    <font color="red">@if($errors->has('city'))<b>{{ $errors->first('city') }}</b>@endif</font>
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>Postal code :</label>
                                                    <input type="text" class="form-control" name="postalcode" onkeypress = "return isNumber(event)">
                                                    <font color="red">@if($errors->has('postalcode'))<b>{{ $errors->first('postalcode') }}</b>@endif</font>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                    <div class="card">
                                        <div class="card-block center">
                                            <h4 class="m-b-0">
                                                <span class="icon-text">User Personal  Details</span>
                                            </h4>
                                            <p class="text-muted">Fill Your Details</p>
                                            <form action="{{ route('profile.fill.user','address') }}" method="post" autocomplete="off">
                                            	{{ csrf_field() }}
                                                <div class="form-group text-left">
                                                	<label>Date Of Birth :</label>
                                                	<input type="text" name="birthdate" class="form-control date">
                                                	<font color="red">@if($errors->has('birthdate'))<b>{{ $errors->first('birthdate') }}</b>@endif</font>
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>Gender :</label><br>
                                                	<label class="radio-inline">
      													<input type="radio" name="gender" value="0" checked="">Male
    												</label>
    												<label class="radio-inline">
      													<input type="radio" name="gender" value="1">Female
    												</label>
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>CellPhone :</label>
                                                	<input type="text" name="cellphone" onkeypress = "return isNumber(event)" class="form-control">
                                                </div>
                                                <div class="form-group text-left">
                                                	<label>Website :</label>
                                                	<input type="text" name="website" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="row col-md-22 hidden">
                    <form action="" method="POST" autocomplete="off">
                        <input type="text" id="short" name="" placeholder="Username or email">
                        <input type="password" id="short" name="" placeholder="Password">
                        <!--<input type="checkbox" name="remember" value="1">-->
                        <a type="submit" href="profile.html" name="login" class="btn btn-danger">Login</a>
                        <span class="forgot-password-link">
                            <a href="#">Forgot your password?</a><br>
                        </span>
                    </form> 
                </div>
                <div class="container">
                    <p class="text-muted"> Copyright © Company - All rights reserved </p>
                </div>
            </footer>
        </div>

@endsection