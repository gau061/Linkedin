@extends($theme)

@section('content')
<div class="container">
	<div class="row page-content">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-sm-offset-3 col-md-offset-0">
					<div class="profile-nav">
						<div class="widget">
							<div class="widget-body">
								<div class="user-heading">
									<h1>{{ count($connect) }}</h1>
									<p>@lang('words.connection_pg.text_1')</p>
									<hr/>
									<a href="{{ route('connection.index') }}">
										<h3>@lang('words.connection_pg.text_6')</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12">
					<div class="text-search">
                        <input type="text" name="search" class="form-control text-box-search" placeholder="Search Your Connections" id="searchText" autocomplete="off">
                        <i class="fa fa-search search"></i>
                    </div>
                	<br>
					<div class="">
						<div class="widget">
							<div class="widget-header">
								<h3 class="widget-caption">@lang('words.connection_pg.text_7') ({{ count($connect) }}) </h3>
							</div>
							<div class="widget-body bordered-top bordered-sky">
								<div class="card">
									<div class="content">
									@if(count($connect) > 0)
										<ul class="list-profile" id="connect">
                                            @foreach($connect as $key => $req)
                                            <li class="mt-list-item">
                                                <div class="list-image">
                                                    <img alt="image" class="img-thumbnail" src="{{ user_data($req->FRIEND_ID)->ProPic }}">
                                              </div>
                                                <div class="list-text user-connection">
                                                    <h3 class="list-text-title wordwap">
                                                    	<a href="{{ route('profile',user_data($req->FRIEND_ID)->user_id) }}">
                                                    		{{ user_data($req->FRIEND_ID)->Name }}
                                                    	</a>
                                            		</h3>
                                                    <p class="list-inner-text">
                                                        <span class="bfh-states" data-country="{{ user_data($req->FRIEND_ID)->country }}" data-state="{{ user_data($req->FRIEND_ID)->state }}"></span>,
                                                        <span class="bfh-countries" data-country="{{ user_data($req->FRIEND_ID)->country }}"></span>
                                                        </p>
                                                    <div class="user-btn-gorup">
                                                        <a href="{{ route('message.index',user_data($req->FRIEND_ID)->unique_id) }}" class="btn btn-primary">@lang('words.msg_acp.text_1')</a>
                                                        <a href="{{ route('request.send',['remove',$req->FRIEND_ID]) }}" class="btn btn-info">Remove</a>
                                                    </div>
                                                </div>
                                            </li>	
                                            @endforeach
                                            @else
                                            <li>
                                            	@lang('words.msg_acp.text_2')
                                            </li>
                                        </ul>
                                    @endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('pageScript')
<script type="text/javascript">


$('body').on('keyup','#searchText',function(){

	var data = $(this).val();
	 $.ajax({
	 	url:"{{ route('connectd.list') }}",
	 	data:{data:data},
	 	success: function(result){
  			$('#connect').html('');
	 		if(result == ''){
	 			$('#connect').html('{{trans('words.msg_acp.text_2')}}');
	 		}
        	$.each(result, function( key, value ) {
        		var html = '<li class="mt-list-item">'+
	                            '<div class="list-image">'+
	                                '<img alt="image" class="img-thumbnail" src="{{userDefaultImage()}}">'+
	                            '</div>'+
	                            '<div class="list-text user-connection">'+
	                                '<h3 class="list-text-title wordwap">'+
	                                	'<a href="/profile/'+ value.firstname.toLowerCase()+'_'+value.lastname.toLowerCase()+'-'+value.unique_id+'">'+
	                                	 	value.firstname + ' ' +value.lastname +
	                                	 '</a>'+
	                                '</h3>'+
	                                '<p class="list-inner-text">'+
	                                	value.city + ','+
	                                    '<span class="bfh-states" data-country="'+ value.country +'" data-state="'+ value.state +'"></span> ,'+
	                                    '<span class="bfh-countries" data-country='+value.country+'></span>'+
	                                    '</p>'+
	                                '<div class="user-btn-gorup">'+
	                                	'<a href="" class="btn btn-primary">Message</a>'+
	                                '</div>'+
	                            '</div>'+
	                        '</li>'
		  		$('#connect').append(html);
			});
    	}
	});
});
</script>
@endsection