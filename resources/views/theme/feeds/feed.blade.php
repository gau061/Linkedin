@extends($theme)
@section('content')
<div class="page-content feed">
    <div class="container">
        <div class="row">
            <!-- left links -->
            <div class="col-md-3 col-sm-12">
                <div class="profile-nav row">
                    <div class="widget">
                        <div class="widget-body box-user col-sm-6 col-sm-offset-3 col-md-9 col-lg-9">
                            <div class="user-heading box-user">
                                <div class="round">
                                    <a href="#" target="_blank"><img src="{{ userProPic() }}" alt=""></a>
                                </div>
                                <h1 class="wordwap">{{ fusername() }}</h1>
                                <p>{{ fuserEmail() }}</p>
                                <hr/>
                                <i class="fa fa-user-plus"></i>
                                <a href="{{ route('connection.index') }}">
                                    <h3>@lang('words.feed_left_box.feed_con')</h3>
                                    <p>@lang('words.feed_left_box.feed_gro')</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end left links -->
            <!-- center posts -->
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <!-- left posts-->
                    <div class="col-md-12">
                        <!-- post state form -->
                        <div class="box profile-info n-border-top write-post">
                            {!! Form::open(['route'=>'feed.store','method'=>'post','files' => 'true']) !!}
                            {{ Form::hidden('post_type', '0', ['id' => 'postType'] ) }}
                            {{ Form::textarea('post_text', null, ['class' => 'form-control input-md','size' => '30x3','style' => 'resize:none', 'placeholder'=>trans('words.feed_box.feed_content')]) }}
                            <div class="media" style="margin-top:0;">
                                <img id="pImg" src="" alt="your image" style="display: none;" />
                                <div controls id="pVideo" style="display: none; width: 100%;"></div>
                            </div>
                            <div class="box-footer box-form">
                                <ul class="nav nav-pills post-link pull-left">
                                    <li><a href="{{ route('feed.article.new') }}" target="_blank"><i class="fa fa-edit"></i> @lang('words.artical_box.artica_btn_1')</a></li>
                                    <li>
                                        <input type="file" name="post_image" id="postImage" style="display: none;" accept=".png, .jpg, .jpeg">
                                        <label class="link-label" style="cursor:pointer;" for="postImage"><i class="fa fa-camera"></i> @lang('words.artical_box.artica_btn_2')</label>
                                    </li>
                                    <li>
                                        <a class="link-label" id="postVideo" style="cursor:pointer;"><i class=" fa fa-film"></i> Video </a>
                                    </li>
                                    <li>
                                        <select name="post_status" class="form-control">
                                            <option value="0">Public</option>
                                            <option value="1" selected>Connection</option>
                                            <option value="2">Private</option>
                                        </select>
                                    </li>
                                </ul>
                                <input type="submit" name="feedpost" class="btn btn-primary pull-right createFeed" value="@lang('words.artical_box.artica_btn_3')" />
                                <div class="clearfix"></div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- end post state form -->
                        <div id="postFeed">
                            @include('theme.feeds.feedLoad')
                        </div>
                        @if($feeds->total() > 10)
                        <div id="pagination">
                            <a href="{{ $nextURL }}" class="btn btn-primary">Load More</a>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- end left posts-->
            </div>
            <!-- end  center posts -->
            <!-- right posts -->
            <div class="col-md-3 col-sm-12">
                <!-- Friends activity -->
                <div class="row">
                    <div class="widget col-sm-6 col-md-12 col-lg-12">
                        <div class="widget-header">
                            <h3 class="widget-caption">@lang('words.feed_rgt_box.rgt_box_1')</h3>
                        </div>
                        <div class="widget-body bordered-top bordered-sky">
                            <div class="card">
                                @if(!empty($recConn))
                                <div class="content">
                                    <ul class="list-unstyled team-members">
                                        @foreach($recConn as $key => $value)
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="avatar">
                                                        <img src="{{ user_data($value->FRIEND_ID)->ProPic }}" alt="img" class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-xs-9">
                                                    <b><a href="{{ route('profile',user_data($value->FRIEND_ID)->user_id) }}">{{ user_data($value->FRIEND_ID)->Name }}</a></b>
                                                    <b><br/>
                                                    <span class="timeago"><a href="{{ route('profile',user_data($value->FRIEND_ID)->user_id) }}">View Profile</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Friends activity -->
                    <!-- People You May Know -->
                    @inject('fof','App\Notification')
                    <!-- People You May Know -->
                    @if(!empty($fof))
                    <div class="widget col-sm-6 col-md-12 col-lg-12">
                        <div class="widget-header">
                            <h3 class="widget-caption">@lang('words.feed_rgt_box.rgt_box_2')</h3>
                        </div>
                        <div class="widget-body bordered-top bordered-sky">
                            <div class="card">
                                <div class="content">
                                    <ul class="list-unstyled team-members">
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach($fof->frontoffriend() as $key => $value)
                                        @if($i <= 5)
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="avatar">
                                                        <img src="{{user_data($value->FRIEND_ID)->ProPic}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    {{user_data($value->FRIEND_ID)->Name}}
                                                </div>
                                                <div class="col-xs-3 text-right">
                                                    @if(in_array($value->FRIEND_ID,$requ_check))
                                                    <btn class="btn btn-sm btn-azure btn-icon"><a href="javascript:void(0)"  class="msg-cncel" data-url="{{ route('request.send',['cancel',$value->FRIEND_ID]) }}" style="color: #fff;"><i class="fa fa-close"></i></a></btn>
                                                    @else
                                                    <btn class="btn btn-sm btn-azure btn-icon"><a  href="{{ route('request.send',['send',$value->FRIEND_ID]) }}" style="color: #fff;"><i class="fa fa-user-plus"></i></a></btn>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- End people yout may know -->
            </div>
            <!-- end right posts -->
        </div>
    </div>
</div>
@endsection
@section('pageScript')
<!-- Modal -->
<div id="feedShareModal" class="modal fade" role="dialog" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="feedShareModal-content" id="feedShareModal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Share Post</h4>
            </div>
            <div class="modal-body" id="feedSharData">
                <div class="box profile-info n-border-top write-post">
                    {!! Form::open(['route'=>'feed.post.share','method'=>'post']) !!}
                    <input type="hidden" id="postId" name="post_id" value="" />
                    {{ Form::textarea('post_text', null, ['class' => 'form-control input-md','size' => '30x3','style' => 'resize:none', 'placeholder'=>trans('words.feed_box.feed_content')]) }}
                    <div class="box-body" id="feedData" style="padding: 10px 10px 0px 10px;"></div>
                    <div class="box-footer box-form">
                        <ul class="nav nav-pills post-link pull-left">
                            <li>
                                <select name="post_status" class="form-control">
                                    <option value="0">Public</option>
                                    <option value="1" selected>Connection</option>
                                    <option value="2">Private</option>
                                </select>
                            </li>
                        </ul>
                        <input type="submit" name="feedpost" class="btn btn-primary pull-right createFeed" value="@lang('words.artical_box.artica_btn_3')" />
                        <div class="clearfix"></div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript" src="{{ asset('/public/js/feed/feed.js') }}"></script>
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
$('#postFeed').append(data.feeds);
if(data.nextURL == null){
$("#pagination").html('');
}

}).fail(function () {
alert('Posts could not be loaded.');
});
}
</script>
@endsection