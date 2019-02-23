@extends($AdminTheme)


@section('title','Contact Page')
@section('content-header')
<h1>Contact Page</h1>
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Contact page</a></li>
</ol>
@endsection
@section('content')

	@if($success = Session::get('success'))
		<div class="alert alert-success">{{ $success }}</div>
	@endif
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Contact</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
			{!! Form::open(array('route' => 'contact.update','autocomplete'=>'off','files'=>'true','method'=>'post')) !!}
				<div class="form-group">
					<label class="form-label">{!! $settings['contact-page-title']['name'] !!}</label>
					{!! Form::text($settings['contact-page-title']['slug'], $settings['contact-page-title']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['contact-page-title']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['contact-page-location']['name'] !!}</label>
					{!! Form::text($settings['contact-page-location']['slug'], $settings['contact-page-location']['value'], array('class' => 'form-control query','id'=>'location')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['contact-page-location']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['contact-page-address']['name'] !!}</label>
					{!! Form::text($settings['contact-page-address']['slug'], $settings['contact-page-address']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['contact-page-address']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['contact-page-phone']['name'] !!}</label>
					{!! Form::text($settings['contact-page-phone']['slug'], $settings['contact-page-phone']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['contact-page-phone']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['contact-page-email']['name'] !!}</label>
					{!! Form::text($settings['contact-page-email']['slug'], $settings['contact-page-email']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['contact-page-email']['slug']) !!}</font></strong></span>
				</div>
				<input type="submit"  value="Update" class="btn btn-flat btn-success">
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection

