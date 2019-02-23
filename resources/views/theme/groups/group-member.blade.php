<div class="widget">
	<div class="widget-header">
		<h3 class="widget-caption">Group Members</h3>
	</div>
	<div class="widget-body bordered-top bordered-sky">
		<div class="card">
			<div class="content">
				@foreach($members as $data)
				<ul class="list-profile" id="connect">
					<li class="mt-list-item">
						<div class="list-image">
							<img alt="image" class="img-thumbnail" src="{{user_data($data->user_id)->ProPic}}">
						</div>
						<div class="list-text user-connection">
							<h3 class="list-text-title wordwap">
							<a href="{{ route('profile',user_data($data->user_id)->user_id) }}">
								{{ user_data($data->user_id)->Name }}
							</a>
							</h3>
							<h3 class="list-text-title wordwap">{{$data->user_type}}</h3>
							<div class="user-btn-gorup">
								@if($data->user_type == 'Member')
								<a href="javascript:void(0)" class="btn btn-primary btn-member-delete"
					 			data-url="{{route('groupmember.remove',[$data->group_id,$data->user_id])}}">Remove</a>
								@else
								<a href="{{route('groups.index',$val->group_id)}}" class="btn btn-primary">View Group</a>
								@endif
							</div> 
						</div>
					</li>
				</ul>
				@endforeach
			</div>
		</div>
	</div>
</div>