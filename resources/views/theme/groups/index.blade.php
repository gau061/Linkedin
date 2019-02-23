@extends($grouptheme)
@section('content')
<div class="container page-content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget group-profile">
                        @foreach($group as $key=>$value)
                        <div class="group-image">
                            <img src="{{getImage($value->group_image) }}" alt="" class="">
                        </div>
                        <div class="group-text">
                            <div class="group-title-main">
                                <h2 class="group-title">{{$value->group_title}}</h2>
                                <div class="group-member">
                                    {{$value->totalmember}} Members
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">Actions</h3>
                    </div>
                    <div class="widget-body bordered-top bordered-sky">
                        @foreach($manage_group as $data)
                        @if($data->user_type == 'Member')
                        <div class="user-btn-gorup">
                            <a href="javascript:void(0)" class="btn btn-info leavegroup"
                            data-url="{{ route('leavegroup',$value->group_id) }}"><i class="fa fa-user-times"></i>Leave  Group</a>
                        </div>
                        @endif
                        @endforeach
                        
                        @if(is_null($user_type) && is_null($req_status))
                        <div class="user-btn-gorup">
                            <a href="{{route('joingroup.request',['send',$value->group_id])}}"
                            class="btn btn-success"><i class="fa fa-user-plus"></i>Join</a>
                        </div>
                        @elseif(is_null($user_type) && $req_status->group_user_status=='Requested' && $req_status->request_status=='Pending')
                        <a href="{{route('joingroup.status',['ignore',$value->group_id,chackeAuthUser()])}}" class="btn btn-info">Decline</a>
                        
                        @elseif(is_null($user_type) && $req_status->group_user_status=='Invited' && $req_status->request_status=='Pending')
                        <a href="{{route('joingroup.request',['acceptgroupinvitation',$value->group_id])}}" class="btn btn-primary">Accept</a>
                        <a href="{{route('joingroup.request',['invitationremove',$value->group_id])}}"  class="btn btn-info">Decline</a>
                        @endif
                        @foreach($manage_group as $data)
                        @if($data->user_type == 'Group Owner')
                        <div class="manage-group-btn">
                            <a href="{{route('group.manage',[$value->group_id])}}"  class="btn btn-primary"><i class="fa fa-cog "></i>Manage Group</a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">Description</h3>
                    </div>
                    @foreach($group as $key=>$value)
                    <div class="widget-body bordered-top bordered-sky text-justify">
                        {{$value->description}}
                    </div>
                    @endforeach
                </div>
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">Group Rules</h3>
                    </div>
                    @foreach($group as $key=>$value)
                    <div class="widget-body bordered-top bordered-sky text-justify">
                        {{$value->group_rules}}
                    </div>
                    @endforeach
                </div>
                <!--member-->
                @if($dispaymember->group_status == 1)
                <div class="widget widget-friends">
                    <div class="widget-header">
                        <h3 class="widget-caption">Members</h3>
                    </div>
                    <div class="widget-body bordered-top  bordered-sky">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="img-grid" style="margin: 0 auto;">
                                    @foreach($members as $key=>$val)
                                    <li>
                                        <a href="{{ route('profile',user_data($val->user_id)->user_id) }}">
                                            <img src="{{user_data($val->user_id)->ProPic}}" alt="image">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(!is_null($user_type) && $dispaymember->group_status == 2)
                <div class="widget widget-friends">
                    <div class="widget-header">
                        <h3 class="widget-caption">Members</h3>
                    </div>
                    <div class="widget-body bordered-top  bordered-sky">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="img-grid" style="margin: 0 auto;">
                                    @foreach($members as $key=>$val)
                                    <li>
                                        <a href="{{ route('memberprofile',[$val->group_id,user_data($val->user_id)->user_id]) }}">
                                            <img src="{{user_data($val->user_id)->ProPic}}" alt="image">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!--end member-->
            </div>
            <!-- end group about -->
            <!-- group posts -->
                <div class="col-md-7">
                    @if(!is_null($user_type))
                     <div class="box profile-info n-border-top">
                        {!! Form::open(['route'=>'groupfeed.store','method'=>'post','files' => 'true']) !!}
                        {{ Form::hidden('post_type','0', ['id' => 'postType'] ) }}
                        {{Form::hidden('gid',$value->group_id)}}
                        {{Form::text('post_title',null,['class'=>'form-control input-lg','placeholder'=>'Title'])}}
                        {{ Form::textarea('post_desc', null, ['class' => 'form-control input-md','size' => '30x3','style' => 'resize:none', 'placeholder'=>'share an artical , photo ,video or idea']) }}
                        <div class="media" style="margin-top:0;">
                            <img id="groupPostImg" src="" alt="your image" style="display: none;" />
                        </div>
                        <div class="box-footer box-form">
                            <input type="submit" name="GroupfeedPost" class="btn btn-primary pull-right createFeed" value="Post" />
                            <input type="file" name="post_image" id="postImage" style="display: none;" accept=".png, .jpg, .jpeg">
                            <ul class="nav nav-pills">
                            <li><a href="#" ><label class="link-label" style="cursor:pointer;" for="postImage"><i class="fa fa-camera"></i>  Images</a></label></li>
                        </ul>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    @endif 

                <!--   posts -->
                    @if($dispaymember->group_status == 1)
                    <div id="postFeed">
                        @include('theme.groupfeeds.groupfeedLoad')
                    </div> 
                    @elseif($dispaymember->group_status == 2  && !is_null($user_type))
                    <div id="postFeed">
                        @include('theme.groupfeeds.groupfeedLoad')
                    </div> 
                    @endif
                    <!--pagination-->
                    @if($groupfeed->total() > 10)
                        <div id="pagination">
                            <a href="{{ $nextURL }}" class="btn btn-primary">Load More</a>
                        </div>
                    @endif
                    <!--End pagination-->

                
                </div>
                <!--  end posts -->
            </div>
            <!-- end group posts -->
        </div>
    </div>
</div>
</div>

@endsection
@section('pageScript')
<script type="text/javascript" src="{{ asset('/public/js/groupfeed/groupfeed.js') }}"></script>
<script>
$(document).ready(function() {
$(document).on('click', '#pagination a', function (e) {
var myurl = $(this).attr('href');
var page=$(this).attr('href').split('page=')[1];
getPosts(page);
e.preventDefault();
});
});
function getPosts(page) {
$.ajax({
url : '?page=' + page,
type: "get",
datatype: "html",
}).done(function (data) {
$("#pagination a").attr("href", data.nextURL)
$('#postFeed').append(data.groupfeed);
if(data.nextURL == null){
$("#pagination").html('');
}

}).fail(function () {
alert('Posts could not be loaded.');
});
}
</script>
@endsection