<div class="widget">
	<div class="widget-header">
		<h3 class="widget-caption">Invited Members</h3>
	</div>
	<div class="widget-body bordered-top bordered-sky">
		<div class="card">
			<div class="content">
				<ul class="list-profile" id="connect">
				{!! Form::open(['route'=>'groupmember.invite','method'=>'post']) !!}
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8">

						{!! Form::label('searchuser','Invite your connections:',['class'=>'control-label']) !!}
						{!! Form::hidden('gid',$group_id)!!}						
						 <div class="text-search">
                                <input type="text" name="search" class="form-control text-box-search" placeholder="Search Connections by Name . . ."  id="searchuser" value="{{ Input::get('search') }}" data-url="{{$group_id}}" autocomplete="off">

                                <i class="fa fa-search search"></i>
                          </div>
					</div>
					<div class="col-lg-4 col-md-4  col-sm-4" style="padding-top: 23px;">
						
						{!! Form::submit('Invite',['class'=>'btn btn-primary'])!!}
					</div>
			    </div>
			    

			 	  @foreach($invitedmember as $key => $value)
					<li class="mt-list-item">
						<div class="list-image">
							<img alt="image" class="img-thumbnail" src="{{user_data($value->user_id)->ProPic}}">
						</div>
						<div class="list-text user-connection">
							<h3 class="list-text-title wordwap">
							<a href="{{ route('profile',user_data($value->user_id)->user_id) }}">
								{{user_data($value->user_id)->Name}}                              
							</a>
							</h3>
							<h3 class="list-text-title wordwap">
								{{ $value->user_type }}
							</h3>
							<div class="user-btn-gorup">
							<a href="{{route('joingroup.status',['ignore',$value->group_id,$value->user_id])}}" class="btn btn-info">Decline</a>
							</div> 
						</div>
					</li>
					@endforeach
					{!! Form::close() !!}
				</ul>
			</div>
		</div>
	</div>
</div>
@section('pageScript')
    <script type="text/javascript" src="{{ asset('/public/js/search/search.js') }}"></script>
@endsection