@extends($AdminTheme)

@section('title',$settings['page_title'])

@section('content-header')
	<h1>{{$settings['page_title'] }}</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">{{$settings['page_title']}}</li>
	</ol>
@endsection


@section('content')
	<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">{{$settings['page_title']}}</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		@if($success = Session::get('success'))
		<div class="alert alert-success">{{ $success }}</div>
		@endif

		{!! Form::open(['method'=>'patch','route'=>['pages.update',$settings['page_slug']],'files' => 'true']) !!}

			<div class="row">
				<div class="col-md-8 col-lg-8 col-sm-8">
					<div class="form-group">
						<label for="{{$settings['page_title']}}" class="control-label">Title :</label>
						{!! Form::text('page_title',$settings['page_title'],['class'=>'form-control','placeholder'=> 'Page Title' ,'autofocus','id'=>$settings['page_title'] , 'maxlength' => '30']) !!}
						@if ($errors->has('page_title'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_title') }}</font></strong></span>@endif
					</div>

					<div class="form-group">
						<label class="form-label" for="desc">Page Description :</label>
						{!! Form::textarea('page_desc',$settings['page_desc'], array('class' => 'form-control summernote','id' => 'desc')) !!}
						@if ($errors->has('page_desc'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_desc') }}</font></strong></span>@endif
					</div>
				</div>
				<div class="col-md-4 col-lg-4 col-sm-4">

					<div class="form-group">
						<label for="img">Page Status :</label> <br>
						<label for="active">
							<input type="radio" name="page_status" value="1"  id="active" {{ $settings['page_status'] == '1'?'checked':'' }}> Active
						</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<label for="dactive">
							<input type="radio" name="page_status" value="0" {{ $settings['page_status'] == '0'?'checked':'' }} id="dactive"> Deactive
						</label>
						@if ($errors->has('page_status'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_status') }}</font></strong></span>@endif
					</div>

					<h4><b>SEO Metas</b></h4>
				<div class="form-group">
					<label>Title :</label> <br>
					{!! Form::text('title',$settings['title'],['class'=>'form-control','autofocus']) !!}
				</div>
				<div class="form-group">
					<label>Keyword :</label> <br>
					{!! Form::text('keyword',$settings['keyword'],['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Description :</label> <br>
					{!! Form::textarea('description',$settings['description'],['class'=>'form-control','style'=>'resize:none','size' => '3x5']) !!}
				</div>


					<div class="form-group">
						<label for="img">Image </label>
						{!! Form::file('page_image',['class'=>'form-control','placeholder'=>'Title' ,'autofocus','id'=>'img']) !!}
						@if ($errors->has('page_image'))<span class="help-block"><strong><font color="red">{{ $errors->first('page_image') }}</font></strong></span>@endif

						{!! Form::hidden('old_image',$settings['page_image']) !!}
					</div>

					<div class="form-group">
						@if(! is_null($settings['page_image']))
						<img src="{{ getImage($settings['page_image'], 'thumb') }}">
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12">
					<div class="form-group">
						<input type="submit" value="Update Page" class="btn btn-primary btn-flat">
						<input type="reset" value="Reset Page" class="btn btn-default btn-flat">
					
						<a href="{{ route('pages.delete',$settings['id']) }}" class="btn btn-danger btn-flat pull-right" onclick="return confirm('Are you Sure Delete This page ?');">Remove Page</a>
					</div>
				</div>
			</div>
	    {!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
@endsection
