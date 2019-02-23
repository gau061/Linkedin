@extends($theme)
@section('content')
	<section class="pageheader-main">
		@if(! is_null($data->page_image))
			<div class="pageheader-image" style="background-image:url({{getImage($data->page_image)}});">
				<h1 class="pageheader-title">{{ $data->page_title }}</h1>
			</div>
		@else
			<div class="pageheader-color">
				<h1 class="pageheader-title">{{ $data->page_title }}</h1>
			</div>
		@endif
	</section>
	<div class="container">{!! $data->page_desc !!}</div>
	<div class="clearfix"></div>
	<br/><br/><br/><br/>
@endsection