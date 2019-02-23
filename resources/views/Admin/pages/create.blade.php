@extends($AdminTheme)

@section('title','Page Create')

@section('content-header')
	<h1>Page Settings </h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Page Settings</li>
	</ol>
@endsection

@section('content')
	<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Page Setting</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		@if($success = Session::get('success'))
		<div class="alert alert-success">{{ $success }}</div>
		@endif

		{!! Form::open(['method'=>'post','route'=>'page.store','files' => 'true']) !!}	

		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-8">
				<div class="form-group">
					<label for="firstname" class="control-label">Title :</label>
					{!! Form::text('page_title','',['class'=>'form-control','placeholder'=>'Title' ,'autofocus','id'=>'firstname', 'maxlength' => '30']) !!}
					@if ($errors->has('page_title'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_title') }}</font></strong></span>@endif
				</div>
				<div class="form-group">
					<label class="form-label" for="desc">Page Description :</label>
					{!! Form::textarea('page_desc','', array('class' => 'form-control summernote','id' => 'desc')) !!}
					@if ($errors->has('page_desc'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_desc') }}</font></strong></span>@endif
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-sm-4">
				<div class="form-group">
					<label for="img">Page Status :</label> <br>
					<label for="active">
						<input type="radio" name="page_status" value="1" checked="" id="active"> Active
					</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<label for="dactive">
						<input type="radio" name="page_status" value="0" id="dactive"> Deactive
					</label>
					@if ($errors->has('page_status'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_status') }}</font></strong></span>@endif
				</div>
				<h4><b>SEO Metas</b></h4>
				<div class="form-group">
					<label>Title :</label> <br>
					{!! Form::text('title','',['class'=>'form-control','autofocus']) !!}
				</div>
				<div class="form-group">
					<label>Keyword :</label> <br>
					{!! Form::text('keyword','',['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Description :</label> <br>
					{!! Form::textarea('description','',['class'=>'form-control','style'=>'resize:none','size' => '3x5']) !!}
				</div>

				<div class="form-group">
					<label for="img">Image </label>
					{!! Form::file('page_image',['class'=>'form-control', 'autofocus','id'=>'img']) !!}
					@if ($errors->has('page_image'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_image') }}</font></strong></span>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="form-group">
					<input type="submit" value="Create Page" class="btn btn-primary btn-flat">
					<input type="reset" value="Reset Page" class="btn btn-default btn-flat">
				</div>
			</div>
		</div>
	    {!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
@endsection
