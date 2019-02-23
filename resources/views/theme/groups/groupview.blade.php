@inject('groupreq','App\GroupRequest')
@extends($grouptheme)
@section('content')
<div class="container">
	<div class="group-main">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget">
					<div class="widget-header">
						<h3 class="widget-caption">Search Groups</h3>
					</div>
					<div class="widget-body bordered-top bordered-sky">
						@if(!$data->isEmpty())
						@foreach($data as $key=>$value)
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
											<p class="list-inner-text padding-b-5 text-justify">
												<span class="text-muted">{!!$value->description!!}</span>
											</p>
											<div class="user-btn-gorup">
												@if(!is_null($req=$groupreq->joingroupbtn1($value->group_id,chackeAuthUser())))
												@if($req->group_user_status=='Requested' && $req->request_status=='Pending')
												<a href="{{route('joingroup.status',['ignore',$value->group_id,chackeAuthUser()])}}" class="btn btn-info">Decline</a>
												@elseif($req->group_user_status=='Invited' && $req->request_status=='Pending')
												<a href="{{route('joingroup.request',['acceptgroupinvitation',$value->group_id])}}" class="btn btn-primary">Accept</a>
												<a href="{{route('joingroup.request',['invitationremove',$value->group_id])}}"  class="btn btn-info">Decline</a>
												@else
												<a href="javascript:void(0)" class="btn btn-info leavegroup"
                            					data-url="{{ route('leavegroup',$value->group_id) }}"><i class="fa fa-user-times"></i>Leave  Group</a>
												@endif
												@else
												<a href="{{route('joingroup.request',['send',$value->group_id])}}" class="btn btn-primary"><i class="fa fa-user-plus"></i>Join</a>
												
												@endif
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						@endforeach
						@else
						No Record
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection