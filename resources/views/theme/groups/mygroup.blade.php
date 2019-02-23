@inject('industry',App\Industry)
@extends($grouptheme)
@section('content')
<div class="container">
	<div class="group-main">
		<div class="row">
			<div class="col-sm-3">
				<div class="widget">
					<div class="widget-header">
						<h3 class="widget-caption">My Groups</h3>
					</div>
					<div class="widget-body bordered-top bordered-sky">
						<ul class="list-unstyled profile-about margin-none">
							<li class="padding-v-5">
								<div class="group-btn-gorup">
									<a href="{{route('group.create')}}" class="btn btn-primary">Create Group</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="widget">
					<div class="widget-header">
						<h3 class="widget-caption">Groups That I Manage</h3>
					</div>
					<div class="widget-body bordered-top bordered-sky">
						@foreach($mygroup as $key => $val)
						<div class="card">
							<div class="content">
								<ul class="list-profile" id="connect">
									<li class="mt-list-item">
										<div class="list-image">
											<img alt="image" class="img-thumbnail" src="{{getImage($val->group_image) }}">
										</div>
										<div class="list-text user-connection">
											<h3 class="list-text-title wordwap">
											<a href="{{route('groups.index',$val->group_id)}}">
												{!! $val->group_title !!}
											</a>
											<h3 class="list-text-title wordwap">{{$val->user_type}}</h3>			
											</h3>
											<p class="list-inner-text">
												@foreach($industry->selectindustry($val->group_id) as $key=>$value)
												<span class="bfh-countries">{!! $value->industry_name !!}
												</span>
												@endforeach
											</p>

											
											@if($val->user_type == 'Group Owner')
											<div class="user-btn-gorup">
												@if($val->group_status==0)
												<a href="{{ route('group.manage',$val->group_id) }}" class="btn btn-primary"><i class="fa fa-cog"></i> Manage Group</a>
												<a href="{{ route('group.active',$val->group_id) }}" class="btn btn-info"><i class="fa fa-check"></i>Active this Group</a>
												@else
												<a href="{{ route('group.manage',$val->group_id) }}" class="btn btn-primary"><i class="fa fa-cog"></i> Manage Group</a>
												@endif
											</div>
											
											@else
											<div class="user-btn-gorup">
												<a href="{{route('groups.index',$val->group_id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>View Group</a>
												
												<a href="javascript:void(0)" class="btn btn-info leavegroup"
						 						data-url="{{ route('leavegroup',$val->group_id) }}"><i class="fa fa-user-times"></i>Leave  Group</a>
											</div>
											@endif

										</div>
									</li>
								</ul>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection