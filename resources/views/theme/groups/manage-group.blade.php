@inject('countpending','App\GroupRequest')
@extends($grouptheme)
@section('content')
<div class="container">
	<div class="group-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-header">
					@foreach($groupdata as $key => $val)
						<h1 class="widget-caption">{!! $val->group_title !!}</h1>
					
					
					<a href="{{route('groups.index',$val->group_id)}}" class="btn btn-primary float-right">View</a>
					@endforeach	
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="widget">
					<div class="widget-header">
						<h3 class="widget-caption">Manage Group</h3>
					</div>
					<div class="widget-body bordered-top bordered-sky">
						<ul class="list-unstyled margin-none collapse-menus">
							<li class="">								
								<a href="{{ route('group.manage',$data->group_id) }}"  data-url="dashboard" class="btn btn-link tabs">Dashboard</a>
							</li>
							<li class="">
								Manage members
							</li>
							
							<li class="">								
								<a href="{{ route('group.manage',[$data->group_id,'admins']) }}"  data-url="admins" class="btn btn-link tabs">Admins</a>
							</li>
							<li class="">								
								<a href="{{route('group.manage',[$data->group_id,'members'])}}"  data-url="members" class="btn btn-link tabs">Members</a>
							</li>
							<li class="">								
								<a href="{{route('group.manage',[$data->group_id,'pending'])}}"  data-url="pending" class="btn btn-link tabs">Pending Members
								 @if(count($countpending->userPendingRequest($data->group_id)) > 0 )
                                    <span class="badge">
                                        {{ count($countpending->userPendingRequest($data->group_id)) }}
                                    </span>
                                @endif</a>
								
							</li>
							<li class="">								
								<a href="{{route('group.manage',[$data->group_id,'invited'])}}"  data-url="invited" class="btn btn-link tabs">Invited Users</a>
							</li>
							<li class="">
								Manage Group
							</li>
							<li class="">								
								<a href="{{route('group.manage',[$data->group_id,'details'])}}"  data-url="details" class="btn btn-link tabs">Group details</a>
							</li>
							<li class="">								
								<a href="{{route('group.manage',[$data->group_id,'delete'])}}"  data-url="delete" class="btn btn-link tabs">Delete Group</a>
							</li>
						
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='dashboard')?'active':'' }}" id="dashboard">
						<div class="widget">
							<div class="widget-header">
								<h3 class="widget-caption">Group Dashboard</h3>
							</div>
							<div class="widget-body bordered-top bordered-sky">
								<div class="card">
									<div class="content">
										Dahaboard
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- ADMIN -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='admins')?'active':'' }}" id="admins">
						@include('theme.groups.group-admins')
					</div>
					<!-- MEMBER -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='members')?'active':'' }}" id="members">
						@include('theme.groups.group-member')
					</div>
					<!-- PENDING MEMBER -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='pending')?'active':'' }}" id="pending">
						@include('theme.groups.group-pending-member')
					</div>
					<!-- INVITED MEMBER -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='invited')?'active':'' }}" id="invited">
						@include('theme.groups.group-invited-member')
					</div>
					<!-- DETAILS -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='details')?'active':'' }}" id="details">
						@include('theme.groups.group-details')
					</div>
					<!-- DELETE -->
					<div role="tabpanel" class="tab-pane fade in {{ ($active=='delete')?'active':'' }}" id="delete">
						 @include('theme.groups.group-delete')

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection