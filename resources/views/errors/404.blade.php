@extends('theme.layout.master')

@section('title','Page Not Found.')
@section('content')

	<section class="pageheader-main">
			<div class="pageheader-color">
				@if($exception->getMessage() == null)         
					<h1 class="pageheader-title">Sorry, the page not found.</h1>
				@else
					<h1 class="pageheader-title">{{ $exception->getMessage() }}</h1>
				@endif
			</div>
	</section>

	<section class="text-center" style="margin-top:7%; width:100%; ">
			<img src="{{ asset('/public/default/404-error.png') }}">
	</section>

@endsection