<div class="widget">
	<div class="widget-header">
		<h3 class="widget-caption">Pending Members</h3>
	</div>
	<div class="widget-body bordered-top bordered-sky">
		<div class="card">
			<div class="content">
				@foreach($pendingUser as $data)
				<ul class="list-profile" id="connect">
					<li class="mt-list-item">
						<div class="list-image">
							<img alt="image" class="img-thumbnail"  href="#" src="{{user_data($data->user_id)->ProPic}}">
						</div>
						<div class="list-text user-connection">
							<h3 class="list-text-title wordwap">
								<a href="{{ route('profile',user_data($data->user_id)->user_id) }}">
								{{ user_data($data->user_id)->Name }}                                  
								</a>
							</h3>
							<div class="user-btn-gorup">
								<a href="{{route('joingroup.status',['accept',$data->group_id,$data->user_id,$data->remember_token])}}" class="btn btn-primary">Accept</a>
								<a href="{{route('joingroup.status',['ignorependinguser',$data->group_id,$data->user_id,$data->remember_token])}}" class="btn btn-info">Decline</a>
							</div>
						</div>
					</li>
				</ul>
				@endforeach
			</div>
		</div>
	</div>
</div>