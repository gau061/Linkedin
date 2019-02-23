@extends($theme)

@section('title','Contact Page')
@section('content')
	<section class="pageheader-main contact-div">
			<div class="pageheader-color">
				<h1 class="pageheader-title">{{ $settings['contact-page-title']['value'] }}</h1>
			</div>
	</section>
	<div class="container-fluid contact-map">
		<iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={!! $settings['contact-page-location']['value'] !!}&output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	
	<div class="container">
		<div class="row contact-header">
			<div class="col-lg-12">
				<h2>Get In Tuch</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="contact-text-outer">
					<div class="contact-icon">
						<i class="fa fa-map"></i>
					</div>
					<div class="contact-text">
						<p>{!! $settings['contact-page-address']['value'] !!}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="contact-text-outer">
					<div class="contact-icon">
						<i class="fa fa-phone"></i>
					</div>
					<div class="contact-text">
						<p>{!! $settings['contact-page-phone']['value'] !!}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="contact-text-outer">
					<div class="contact-icon">
						<i class="fa fa-envelope"></i>
					</div>
					<div class="contact-text">
						<p>{!! $settings['contact-page-email']['value'] !!}</p>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		
		<div class="row contact-header">
			@if($success = Session::get('success'))
				<div class="col-lg-12">
					<div class="alert alert-success">{{ $success }}</div>
				</div>
			@endif
			<div class="col-lg-12">
				<h2>Send Us Message</h2>
			</div>
			<div class="col-lg-12 my-contact-form">
				<form method="POST" action="{{ route('contact.post') }}" autocomplete="off">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}" />				
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="name" class="form-control form-textbox" placeholder="Full Name" />
							</div>
								@if($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span>@endif
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="email" name="email" class="form-control form-textbox" placeholder="Email Address" />
							</div>
								@if($errors->has('email')) <span class="error">{{ $errors->first('email') }}</span>@endif
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="subject" class="form-control form-textbox" placeholder="Subject" />
							</div>
								@if($errors->has('subject')) <span class="error">{{ $errors->first('subject') }}</span>@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="form-control form-textbox" rows="2" cols="5" placeholder="Type a message" name="message"></textarea>
							</div>
								@if($errors->has('message')) <span class="error">{{ $errors->first('message') }}</span>@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-ms-12 col-lg-3">
							<input type="submit" value="Send A Message" class="pro-choose-file text-uppercase" />
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
			
@endsection