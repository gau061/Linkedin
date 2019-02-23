@extends($theme)
@inject('CountNotification', 'App\Notification')
@section('content')
<div class="container">
    <div class="row page-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="cover-nav">
                        <li><a href="{{ route('profile',user_data(chackeAuthUser())->user_id) }}"><i class="fa fa-fw fa-user-o"></i>@lang('words.pro_menu.tab_1')</a></li>
                        <li><a href="{{ route('timeline.index') }}"><i class="fa fa-fw fa-bars"></i> @lang('words.pro_menu.tab_2')</a></li>
                        <li><a href="{{ route('connection.list') }}"><i class="fa fa-fw fa-users"></i> @lang('words.pro_menu.tab_3')</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    @php /*
                    <!--div class="box profile-info n-border-top write-post">
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
                </div-->
                */ @endphp


                <div id="postFeed">
                    @include('theme.feeds.feedLoad')
                </div>                   
                @if($feeds->total() > 10)
                <div id="pagination">
                    <a href="{{ $nextURL }}" class="btn btn-primary">Load More</a>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="profile-nav">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="user-heading">
                                <h1>@if( count($CountNotification->Connected()) > 0) {{ count($CountNotification->Connected()) }} @endif</h1>
                                <p>@lang('words.connection_pg.text_1')</p>
                                <hr/>
                                <a href="{{ route('connection.list') }}">
                                    <h3>@lang('words.connection_pg.text_2')</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">@lang('words.pro_rgt.text_1')</h3>
                    </div>
                    <div class="widget-body bordered-top bordered-sky">
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_2')</span></div>
                                    <div class="col-sm-8">
                                        {!! Carbon\Carbon::parse(auth()->guard('frontuser')->check()?auth()->guard('frontuser')->user()->birthdate:'')->format('d F Y') !!}
                                    </div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_4')</span></div>
                                    <div class="col-sm-8">
                                        @if(user_data(chackeAuthUser())->gender == 0)
                                        Male
                                        @else
                                        Female
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_5')</span></div>
                                    <div class="col-sm-8">
                                        {{user_data(chackeAuthUser())->city}},
                                        <span class="bfh-states" data-country="{{user_data(chackeAuthUser())->country}}" data-state="{{user_data(chackeAuthUser())->state}}"></span>,
                                        <span class="bfh-countries" data-country="{{user_data(chackeAuthUser())->country}}"></span>
                                    </div>
                                </div>
                            </li>
                            @if(! is_null(user_data(chackeAuthUser())->cellphone))
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_3')</span></div>
                                    <div class="col-sm-8">{{user_data(chackeAuthUser())->cellphone}}</div>
                                </div>
                            </li>
                            @endif
                            @if(! is_null(user_data(chackeAuthUser())->website))
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_6')</span></div>
                                    <div class="col-sm-8"><a href="{{ user_data(chackeAuthUser())->website }}" target="_blank">{{ user_data(chackeAuthUser())->website }}</a></div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if(!empty($recConn))
                <div class="widget widget-friends">
                    <div class="widget-header">
                        <h3 class="widget-caption">@lang('words.pro_rgt_b.text_1')</h3>
                    </div>
                    <div class="widget-body bordered-top  bordered-sky">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="img-grid" style="margin: 0 auto;">
                                    @foreach($recConn as $key => $value)
                                    <li>
                                        <a href="{{ route('profile',user_data($value->FRIEND_ID)->user_id) }}">
                                            <img src="{{ user_data($value->FRIEND_ID)->ProPic }}" alt="image">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
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