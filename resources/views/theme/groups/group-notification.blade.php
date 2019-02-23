@extends($grouptheme)
@section('content')
<div class="container">
	<div class="group-main">
		<div class="row">			
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget">
					<div class="widget-header">
						<h3 class="widget-caption">Notifications</h3>
					</div>
					@foreach($data as $key=>$value)
					<div class="widget-body bordered-top bordered-sky">
						<div class="card">
							<div class="content">
								<ul class="list-profile" id="connect">
									<li class="mt-list-item padding-v-10">
										<div class="list-image">
											<img alt="image" class="img-thumbnail" src="{{getImage($value->group_image)}}">
										</div>
										<div class="list-text user-connection">
											<h3 class="list-text-title wordwap">
											<a href="{{route('groups.index',$value->group_id)}}">
												{{$value->group_title}}
											</a>
											</h3>
											<p class="list-inner-text padding-v-5">
												{{$value->totalmember}} Members
											</p>
											
											<div class="user-btn-gorup ">
												<a href="{{route('joingroup.request',['acceptgroupinvitation',$value->group_id])}}" class="btn btn-primary">Accept</a>
					<a href="{{route('joingroup.request',['invitationremove',$value->group_id])}}"  class="btn btn-info">Decline</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection