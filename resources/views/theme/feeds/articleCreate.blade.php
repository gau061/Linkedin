@extends($theme)
@section('content')
<div class="page-content">
	<div class="container ">
		<div class="row">
	        <div class="col-md-12">
        	{!! Form::open(['route'=>'feed.article.insert','method'=>'post','files' => 'true', 'class' => 'articlePost']) !!}
        		<div class="form-group">
        			{{ Form::text('article_title', '', ['id' => 'article_title', 'autofocus', 'class' => '', 'placeholder'=>'Headline'] ) }}
        			@if ($errors->has('article_title'))<span class="help-block"><strong><font color="red">{{ $errors->first('article_title') }}</font></strong></span>@endif
        		</div>
        		<div class="form-group articleImage">
        			<img src="{{ asset('public/default/header-image.jpg') }}" onclick="document.getElementById('ApostImage').click();" id="artImg" />
        			<input type="file" name="article_image" id="ApostImage" style="display: none;" accept=".png, .jpg, .jpeg">
        			@if ($errors->has('article_image'))<span class="help-block"><strong><font color="red">{{ $errors->first('article_image') }}</font></strong></span>@endif
        		</div>
        		<div class="form-group articleText">
        			{!! Form::textarea('article_description','', array('class' => 'form-control summernote','id' => 'desc')) !!}
        			@if ($errors->has('article_description'))<span class="help-block"><strong><font color="red">{{ $errors->first('article_description') }}</font></strong></span>@endif
        		</div>
        		<div class="form-group text-center">

        		</div>
        		<div class="form-group text-center">
        			<input name="publish" type="submit" value="publish Article" class="btn btn-primary btn-lg btn-flat">
					<input name="draft" type="submit" value="Draft" class="btn btn-default btn-lg btn-flat">
        		</div>
    	 	{!! Form::close() !!}
	        </div>
	    </div>
	</div>
</div>
@endsection
@section('pageScript')
    <script type="text/javascript" src="{{ asset('/public/js/feed/feed.js') }}"></script>
@endsection