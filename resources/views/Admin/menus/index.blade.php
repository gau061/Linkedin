@extends($AdminTheme)

@section('title','Menu Settings')

@section('content-header')
	<h1>Menu Settings</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Menu Settings</li>
	</ol>
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-12 col-lg-12 col-xs-12">
		@if($success = Session::get('success'))
			<div class="alert alert-success">{{ $success }}</div>
		@endif
	</div>

	<!-- Header Menu -->
		<div class="col-md-6 col-lg-6 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Header Menu</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					{!! Form::open(['method'=>'post','route'=>['menus.store','header']]) !!}
						<div class="row">
							<div class="col-md-8 col-lg-8 col-xs-12">
								<label>Page Listing</label>
								@foreach($data as $key => $value)
									<div class="form-group">
										<input type="checkbox" name="page[{{$key}}]" id="{{ $value->id }}" value="{{ $value->id }}"  {{ in_array($value->id,$menu)?'checked':'' }}/>
										<label for="{{$value->id}}">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{ $value->page_title }}</label><br>	
									</div>
									@if ($errors->has('page'))
										<span class="help-block"><strong><font color="red">{{ $errors->first('page') }}</font></strong></span>
									@endif 
								@endforeach
							</div>
							<div class="col-md-4 col-lg-4 col-xs-12">
								<label>Page Ordering</label>
								@foreach($data as $key => $value)
									<div class="form-group">
										@if(in_array($value->id,array_keys($mnord)))
											<input type="number" name="order[{{$key}}]" min="1" max="20" value="{{$mnord[$value->id]}}" />
										@else
											<input type="number" name="order[{{$key}}]" min="1" max="20"/>
										@endif
									</div>
								@endforeach
							</div>
							<div class="col-md-12 col-lg-12 col-xs-12">
								<input type="submit"  class="btn btn-primary btn-flat" value="Update Header Menu">
								<input type="reset"  class="btn btn-default btn-flat" value="Reset Header Menu">
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	<!-- Header menu box -->

	<!-- Footer Menu Box -->
		<div class="col-md-6 col-lg-6 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Footer Menu</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					{!! Form::open(['method'=>'post','route'=>['menus.store','footer']]) !!}
						<div class="row">
							<div class="col-md-8 col-lg-8 col-xs-12">
								<label>Page Listing</label>
								@foreach($data as $key => $value)
									<div class="form-group">
										<input type="checkbox" name="page[{{$key}}]" id="{{ $value->id }}-" value="{{ $value->id }}"  {{ in_array($value->id,$menu_fotaer)?'checked':'' }}/>
										<label for="{{$value->id}}-">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{ $value->page_title }}</label><br>	
									</div>
									@if ($errors->has('page'))
										<span class="help-block"><strong><font color="red">{{ $errors->first('page') }}</font></strong></span>
									@endif 
								@endforeach
							</div>
							<div class="col-md-4 col-lg-4 col-xs-12">
								<label>Page Ordering</label>
								@foreach($data as $key => $value)
									<div class="form-group">
										@if(in_array($value->id,array_keys($mford)))
											<input type="number" name="order[{{$key}}]" min="1" max="20" value="{{$mford[$value->id]}}" />
										@else
											<input type="number" name="order[{{$key}}]" min="1" max="20"/>
										@endif
									</div>
								@endforeach
							</div>
							<div class="col-md-12 col-lg-12 col-xs-12">
								<input type="submit"  class="btn btn-primary btn-flat" value="Update Footer Menu">
								<input type="reset"  class="btn btn-default btn-flat" value="Reset Footer Menu">
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	<!-- Footer Menu box -->
	
</div>
@endsection