@inject('industry',App\Industry)
<div class="widget">
	<div class="widget-header">
		<h3 class="widget-caption">Group Admins</h3>
	</div>
	<div class="widget-body bordered-top bordered-sky">
		<div class="card">
			<div class="content">
				<ul class="list-profile" id="connect">
					@foreach($admin as $key => $value)
					<li class="mt-list-item">
						<div class="list-image">
							<img alt="image" class="img-thumbnail" src="{{user_data($value->user_id)->ProPic}}">
						</div>
						<div class="list-text user-connection">
							<h3 class="list-text-title wordwap">
							<a href="{{ route('profile',chackeAuth()?usernames():'') }}">
								{{user_data($value->user_id)->Name}}                              
							</a>
							</h3>
							<h3 class="list-text-title wordwap">
								{{ $value->user_type }}
							</h3>
							<div class="user-btn-gorup">
								<a href="{{ route('profile',chackeAuth()?usernames():'') }}" class="btn btn-primary"> View Profile </a>
							</div> 
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>