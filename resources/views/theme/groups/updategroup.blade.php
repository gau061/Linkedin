
<legend class="text-center">Manage Group</legend>
	<div class="container">
		
			{!! Form::model($data,['route'=>['group.update',$data->id],'method'=>'put','class'=>'form-horizontal','files'=>'true']) !!}
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-8">
					{!! Form::label('group_title','Group Title:',['class'=>'control-label']) !!}
					{!! Form::text('group_title',null,['id'=>'group_title','class'=>'form-control','placeholder'=>'Name Your Group','disabled'])!!}
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-8">
					{!! Form::label('slug','URL:',['class'=>'control-label']) !!}
					{!! Form::text('slug',null,['id'=>'slug','class'=>'form-control','placeholder'=>'Name Your Group'])!!}
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-8">
					{!! Form::label('Description','Description:',['class'=>'control-label']) !!}
					{!! Form::textarea('description',null,['placeholder'=>'Write Description Of Your Group here.','id'=>'Description','class'=> 'form-control', 'rows' => 3]) !!}
				</div>
			</div>

			<div class="row">	
				<div class="col-md-12 col-sm-8 col-lg-8">
				{!! Form::label('group_image','Select Your Group Profile:',['class' => 'control-label']) !!}
					{!! Form::hidden('old_image',$data->group_image) !!}
					<div class="img-thumbnail">
						<img src="{{ getImage($data->group_image) }}" height="80" width="80">
					</div>
				</div>
				<div class="col-md-12 col-sm-8 col-lg-8">
					{!! Form::file('group_image',['id'=>'group_image','class' => 'form-control']) !!}
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-8">
					{!! Form::label('group_rules','Group Rules:',['class'=>'control-label']) !!}
					{!! Form::textarea('group_rules',null,['placeholder'=>'Write Your Group Rules here.','id'=>'group_rules','class'=> 'form-control', 'rows' => 2]) !!}
				</div>
			</div>
			
				<div class="row">
				<div class="col-md-12 col-sm-8 col-lg-8 ">
					{!!Form::label('industry','Select Industry:',['class' => 'control-label'])!!}
					<select class="form-control " name="industry">
						<option value="">---Select Industry---</option>
						@foreach($industryname as $industry)
						<option value="{!! $industry['id'] !!}" @if($data->industry == $industry['id']) selected="selected" @endif >{!! $industry['industry_name'] !!}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-8 col-lg-8 ">
					{!!Form::label('group_status','Group Status:',['class' => 'control-label'])!!}
					<select name="group_status" class="form-control">
						<option value="0" @if($data->group_status == 0) selected="selected" @endif>Draft</option>
                        <option value="1" @if($data->group_status == 1) selected="selected" @endif>Public</option>
                        <option value="2" @if($data->group_status == 2) selected="selected" @endif>Private</option>
                    </select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-8 col-lg-8">
					<br>
					{!! Form::submit('Save Changes',['class'=>'btn btn-success']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>