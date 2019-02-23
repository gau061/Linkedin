@extends($AdminTheme)

@section('title','Details of'.' '.$data->firstname.' '. $data->lastname)

@section('content-header')
<h1>Details of {{ $data->firstname }} {{ $data->lastname }}</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Details of {{ $data->firstname }} {{ $data->lastname }}</li>
	</ol>
@endsection
@section('content')

<style type="text/css">
	.cover-pic{
		position: relative;
		width:100%; 
	}
	.proPic{
		position: absolute;
		left:38%;
		top:23%;
	}
	.proPic img{
		width:125px; 
		height:125px; 
	}
</style>

	<div class="{{ frontuser_alert($data->status)->class }}">		
		<p class="text-center">{{ frontuser_alert($data->status)->message }}</p>
	</div>
	<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-10 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Profile Details</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
	                  	<tbody>
		                    <tr>
		                    	<td colspan="2">
									<p class="text-center">
										<img src="{{ user_data($data->id)->CoverPic }}" class="cover-pic" />
										<div class="proPic">
											<img src="{{ user_data($data->id)->ProPic }}" />
										</div>
									</p>
								</td>
		                    </tr>
		                    <tr>
		                    	<td colspan="2"> </td>
		                    </tr><tr>
		                    	<td colspan="2"> </td>
		                    </tr><tr>
		                    	<td colspan="2"> </td>
		                    </tr>
		                    <tr>
		                    	<td colspan="2"> </td>
		                    </tr>
		                    <tr>
		                    	<th>Full Name</th>
		                    	<td><p>{{ $data->firstname }} {{ $data->lastname }}</p></td>
		                    </tr>
		                    <tr>
		                    	<th>Email</th>
		                    	<td>{{ $data->email }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Brithdate</th>
		                    	<td>{{ $data->birthdate }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Cellphone</th>
		                    	<td>{{ $data->cellphone }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Unique Id</th>
		                    	<td>{{ $data->unique_id }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Gender</th>
		                    	<td>{{ gender($data->gender) }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Website</th>
		                    	<td>{{ $data->website }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Address</th>
		                    	<td>{{ $data->address }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Postal Code</th>
		                    	<td>{{ $data->postalcode }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Country</th>
		                    	<td><span class="bfh-countries" data-country="{{ $data->country }}" ></span></td>
		                    </tr>
		                    <tr>
		                    	<th>State</th>
		                    	<td><span class="bfh-states" data-country="{{ $data->country }}" data-state="{{ $data->state }}"></span></td>
		                    </tr>
		                     <tr>
		                    	<th>City</th>
		                    	<td>{{ $data->city }}</td>		                    
							<tr>
		                    	<th>Reason</th>
		                    	<td></td>
		                    </tr>
		                    <tr>
		                    	<th>About Us (Headline)</th>
		                    	<td>{!! $data->aboutus !!}</td>
		                    </tr>
		                    <tr>
		                    	<th>Created Date</th>
		                    	<td>{{ date_format($data->created_at,'d, M  Y') }}</td>
		                    </tr>
		                    <tr>
		                    	<th>Updated Date</th>
		                    	<td>{{ date_format($data->updated_at,'d, M  Y') }}</td>
		                    </tr>
	                  	</tbody>
	              	</table>
	    		</div>
			</div>
		</div>
	</div>
	<div class="col-lg-7 col-md-7 col-sm-10 col-xs-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Action Details</h3>
					</div>
					<div class="box-body">
						@if($data->status == 0)
							<a href="{{ route('front.status',array($data->id,'1')) }}" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Active</a>
						@elseif($data->status == 1)
							<a href="{{ route('front.status',array($data->id,'3')) }}" class="btn btn-danger btn-flat"><i class="fa fa-ban"></i> Disabled</a>
						@elseif($data->status == 3)
							<a href="{{ route('front.status',array($data->id,'1')) }}" class="btn btn-info btn-flat"><i class="fa fa-check"></i> Enabled</a>
						@else
							<a href="{{ route('front.status',array($data->id,'1')) }}" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Active</a>
						@endif
					</div>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Post Details</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped">
							 	<thead>
							 		<th class="text-center">Text</th>
							 		<th class="text-center">Artical</th>
							 		<th class="text-center">Image</th>
							 		<th class="text-center">Video</th>
							 		<th class="text-center">Total Post</th>
							 	</thead>
			                  <tbody>
			                  	@if(!empty($postcount))
			                  	<tr class="text-center">
			                  		<td>{{ $postcount->TEXT_FILE }}</td>
			                  		<td>{{ $postcount->ARTICAL }}</td>
			                  		<td>{{ $postcount->IMAGE }}</td>
			                  		<td>{{ $postcount->VIDEO }}</td>
			                  		<td>{{ $postcount->TOTAL }} </td>
			                  	</tr>
			                  	@else
			                  		<tr class="text-center">
			                  		<td colspan="5">Record Not found.</td>
			                  		</tr>
			                  	@endif
			                  </tbody>
			            </table>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Skills Details</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">		
							 <table class="table table-bordered table-striped  frontuser-data">
							 	<thead>
							 		<th class="text-center" width="30px">No</th>
							 		<th>Skills</th>
							 	</thead>
			                  <tbody>
			                  	@if(!empty($skill) && count($skill) > 0)
				                  	@foreach($skill as $key => $value)
			                    	<tr>
			                    		<td class="text-center">{{ ++$key }}</td>
			                    		<td>{{ $value->skills }}</td>
			                    	</tr>
				                    @endforeach
				                @else
				                	<tr>
				                		<td class="text-center" colspan="2">Record Not found.</td>
				                	</tr>
				                @endif
			                  </tbody>
			                </table>
			            </div>
					</div>
				</div>				
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Education Details</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">		
							 <table class="table table-bordered table-striped frontuser-data">
							 	<thead>
							 		<th class="text-center">No</th>
							 		<th class="text-center">College/University</th>
							 		<th>Course/Degree</th>
							 		<th class="text-center">Field</th>
							 		<th class="text-center">Grade</th>
							 		<th class="text-center">Activities</th>
							 		<th class="text-center">From - To</th>
							 	</thead>
			                  <tbody>
			                  	@if(!empty($educ) && count($educ) > 0)
				                  	@foreach($educ as $key => $educdata)
			                    	<tr class="text-center">
			                    		<td>{{ ++$key }}</td>
			                    		<td>{{ $educdata->school }}</td>
			                    		<td>{{ $educdata->course }}</td>
			                    		<td>{{ $educdata->field }}</td>
			                    		<td>{{ $educdata->grade }}</td>
			                    		<td>{{ $educdata->activities }}</td>
			                    		<td>{{ $educdata->from }} - {{ $educdata->to }} </td>
			                    	</tr>
				                    @endforeach
				                @else
				                	<tr>
				                		<td class="text-center" colspan="7">Record Not found.</td>
				                	</tr>
				                @endif
			                  </tbody>
			                </table>
			            </div>
					</div>
				</div>				
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Experince Details</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">		
							 <table class="table table-bordered table-striped frontuser-data">
							 	<thead>
							 		<th class="text-center">No</th>
							 		<th>Designation</th>
							 		<th>Company</th>
							 		<th>Location</th>
							 		<th class="text-center">From - To</th>
							 		<th>Description</th>
							 	</thead>
			                  <tbody>
			                  	@if(!empty($experince) && count($experince) > 0)
				                  	@foreach($experince as $key => $exe)
			                    	<tr>
			                    		<td>{{ ++$key }}</td>
			                    		<td>{{ $exe->title }}</td>
			                    		<td>{{ $exe->company }}</td>
			                    		<td>{{ $exe->location }}</td>
			                    		<td>{{ $exe->from }} - {{ $exe->to }} </td>
			                    		<td>{{ $exe->description }}</td>
			                    	</tr>
				                    @endforeach
				                @else
				                	<tr>
				                		<td class="text-center" colspan="6">Record Not found.</td>
				                	</tr>
				                @endif
			                  </tbody>
			                </table>
			            </div>
					</div>
				</div>				
			</div>


		</div>
	</div>
	<!-- <div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Events Details</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">	
					<table class="table table-bordered table-striped">
					 	<thead>
					 		<th class="text-center">No</th>
					 		<th>Name</th>
					 		<th class="text-center">Status</th>
					 		<th class="text-center">Ban</th>
					 		<th class="text-center">Action</th>
					 	</thead>
	                  <tbody>
	                  	@if(!empty($event) && count($event) > 0)
		                	@foreach($event as $key => $eventdata)
	                    	<tr>
	                    		<td class="text-center">{{ ++$key }}</td>
	                    		<td>{{ $eventdata->event_name }}</td>
	                    		<td class="text-center">{{ status($eventdata->event_status) }}</td>
	                    		<td class="text-center">{{ org_status($eventdata->ban) }}</td>
	                    		<td class="text-center"><a href="{{ route('events.view',$eventdata->id) }}" class="btn btn-info btn-flat"><i class="fa fa-eye"></i> View</a>
	                    			@if($eventdata->ban == 0)
										<a href="{{ route('events.ban',$eventdata->id) }}" class="btn-flat btn btn-success" ><i class="fa  fa-check"></i> Enable</a>
									@else
										<a href="{{ route('events.revoke',$eventdata->id) }}" class="btn-flat btn btn-danger"><i class="fa fa-close"></i> Disable</a>
									@endif
	                    		</td>
	                    	</tr>
		                	@endforeach
		                @else
			                <tr>
			                    <td colspan="5" class="text-center"> Record Not Found.</td>
			                </tr>
		                @endif
	                  </tbody>
	              </table>
	            </div>
			</div>
		</div>
	</div> -->
</div>
@endsection