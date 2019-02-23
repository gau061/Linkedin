@extends($grouptheme)
@section('content')
<legend class="text-center">Create Group</legend>
	<div class="container">
		
			{!! Form::open(['route'=>'group.insert','method'=>'post','class'=>'form-horizontal','files'=>'true']) !!}
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					{!! Form::label('group_title','Group Title:',['class'=>'control-label']) !!}
					{!! Form::text('group_title',Input::old('group_title'),['id'=>'group_title','class'=>'form-control','placeholder'=>'Name Your Group'])!!}
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					{!! Form::label('Description','Description:',['class'=>'control-label']) !!}
					{!! Form::textarea('description',Input::old('description'),['placeholder'=>'Write Description Of Your Group here.','id'=>'Description','class'=> 'form-control', 'rows' => 3]) !!}
				</div>
				
				<div class="col-md-12 col-sm-12 col-lg-12">
				{!! Form::label('group_image','Select Your Group Profile:',['class' => 'control-label']) !!}
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
						{!! Form::file('group_image',['id'=>'group_image','class' => 'form-control']) !!}
						</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					{!! Form::label('group_rules','Group Rules:',['class'=>'control-label']) !!}
					{!! Form::textarea('group_rules',Input::old('group_rules'),['placeholder'=>'Write Your Group Rules here.','id'=>'group_rules','class'=> 'form-control', 'rows' => 2]) !!}
				</div>

				<div class="col-md-12 col-sm-12 col-lg-12 ">
					{!!Form::label('industry','Select Industry:',['class' => 'control-label'])!!}
					<select class="form-control " name="industry">
						<option value="">---Select Industry---</option>
						@foreach($industryname as $key=>$value)
							
					<option value="{!! $value->id !!}" @if(Input::old('industry') == $value['id']) selected="selected" @endif >{!! $value['industry_name'] !!}</option>
						@endforeach 
					</select>
				</div>

				<div class="col-md-12 col-sm-12 col-lg-12 ">
					{!!Form::label('group_status','Group Status:',['class' => 'control-label'])!!}
					<select name="group_status" class="form-control">
				<option value="0" @if(Input::old('group_status') == 0) selected="selected" @endif>Draft</option>
                    <option value="1" @if(Input::old('group_status') == 1) selected="selected" @endif>Public</option>
                   <option value="2" @if(Input::old('group_status') == 2) selected="selected" @endif>Private</option>
                    </select>
				</div>

				<div class="col-md-12 col-sm-12 col-lg-12">
					<br>
					
					{!! Form::submit('Create Group',['class'=>'btn btn-success']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
@endsection