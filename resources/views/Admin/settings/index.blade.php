@extends($AdminTheme)


@section('title','Site Settings')
@section('content-header')
	<h1>Settings</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Settings</a></li>
	</ol>
@endsection
@section('content')
@if($data = \Session::get('success'))
	<div class="alert alert-success">{{ $data }}</div>
@endif
{!! Form::open(array('route' => 'settings.update','autocomplete'=>'off','files'=>'true','method'=>'post','files'=>true)) !!}
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-cog"></i>&nbsp;&nbsp; Site Settings</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
						<div class="form-group">
							<label class="form-label">{!! $settings['site-logo']['name'] !!} : </label>
							{!! Form::file($settings['site-logo']['slug'],['class'=>'form-control col-lg-6 col-md-6']) !!}	
							{!! Form::hidden('image_old',$settings['site-logo']['value']) !!}	
							<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-logo']['slug']) !!}</font></strong></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 text-center">
						<img src="{{ !empty ($settings['site-logo']['value'])?getImage($settings['site-logo']['value']):asset('/public/default/default-logo.png') }}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
						<div class="form-group">
							<label class="form-label">{!! $settings['site-favicon']['name'] !!} : </label>
							{!! Form::file($settings['site-favicon']['slug'],['class'=>'form-control col-lg-6 col-md-6']) !!}	
							{!! Form::hidden('favicon_old',$settings['site-favicon']['value']) !!}	
							<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-logo']['slug']) !!}</font></strong></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 text-center">

						<img src="{{ !empty ($settings['site-favicon']['value'])?getImage($settings['site-favicon']['value']):asset('/public/default/default-favicon.png') }}" width="50">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
						<div class="form-group">
							<label class="form-label">{!! $settings['site-title']['name'] !!} :</label>
							{!! Form::text($settings['site-title']['slug'], $settings['site-title']['value'], array('class' => 'form-control')) !!}
							<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-title']['slug']) !!}</font></strong></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
								<label class="form-label">{!! $settings['site-country']['name'] !!} :</label>
									<select id="countries_timezones1" class="form-control bfh-countries" data-country="{{$settings['site-country']['value']}}" name="{{$settings['site-country']['slug']}}"></select>
									<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-country']['slug']) !!}</font></strong></span>
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
									<label class="form-label">{!! $settings['site-time-zone']['name'] !!} :</label>
									<select class="form-control bfh-timezones" data-country="countries_timezones1" name="{{$settings['site-time-zone']['slug']}}" data-timezone="{{ $settings['site-time-zone']['value'] }}"></select>
									<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-time-zone']['slug']) !!}</font></strong></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"><i class="fa fa-cog"></i>&nbsp;&nbsp; Footer Settings</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<div class="form-group">
					<label class="form-label">{!! $settings['copyright-footer-text']['name'] !!} :</label>
					{!! Form::text($settings['copyright-footer-text']['slug'], $settings['copyright-footer-text']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['copyright-footer-text']['slug']) !!}</font></strong></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"><i class="fa fa-cog"></i>&nbsp;&nbsp; Email Configuration</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
				<div class="form-group">
					<label class="form-label">{!! $settings['site-email']['name'] !!} :</label>
					{!! Form::text($settings['site-email']['slug'], $settings['site-email']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-email']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['site-mail-port']['name'] !!} :</label>
					{!! Form::text($settings['site-mail-port']['slug'], $settings['site-mail-port']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-mail-port']['slug']) !!}</font></strong></span>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
				<div class="form-group">
					<label class="form-label">{!! $settings['site-mail-driver']['name'] !!} :</label>
					{!! Form::text($settings['site-mail-driver']['slug'], $settings['site-mail-driver']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-mail-driver']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['site-mail-username']['name'] !!} :</label>
					{!! Form::text($settings['site-mail-username']['slug'], $settings['site-mail-username']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-mail-username']['slug']) !!}</font></strong></span>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
				<div class="form-group">
					<label class="form-label">{!! $settings['site-mail-host']['name'] !!} :</label>
					{!! Form::text($settings['site-mail-host']['slug'], $settings['site-mail-host']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-mail-host']['slug']) !!}</font></strong></span>
				</div>
				<div class="form-group">
					<label class="form-label">{!! $settings['site-mail-password']['name'] !!} :</label>
					{!! Form::text($settings['site-mail-password']['slug'], $settings['site-mail-password']['value'], array('class' => 'form-control')) !!}
					<span class="help-block"><strong><font color="red">{!! $errors->first($settings['site-mail-password']['slug']) !!}</font></strong></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="box box-primary">
	<div class="box-body text-center">
		<input type="submit"  value="Save Site Settings" class="btn btn-flat btn-success btn-lg">
	</div>
</div>
{!! Form::close() !!}


<script type="text/javascript">
function isNumber(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode == 46)
   {
       var inputValue = $("#inputfield").val()
       if (inputValue.indexOf('.') < 1)
       {
           return true;
       }
       return false;
   }
   if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
   {
       return false;
   }
   return true;
}
</script>
@endsection


