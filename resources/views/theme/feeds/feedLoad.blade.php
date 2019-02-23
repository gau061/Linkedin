@foreach($feeds as $feed)
<!--   posts -->
<div class="box box-widget animated fadeIn post-{{$feed->post_id}}" id="feedPost-{{$feed->post_id}}">
    <div class="box-header with-border">
        <div class="user-block">
            <img class="img-circle" src="{{ user_data($feed->user_id)->ProPic }}" alt="User Image">
            <span class="username">
                <a href="{{ route('profile',user_data($feed->user_id)->user_id) }}">{{ user_data($feed->user_id)->Name }}</a>
                @if($feed->shared_id != 0)
                    shared <a href="{{ route('profile',user_data($feed->Shared_userId)->user_id) }}">{{ user_data($feed->Shared_userId)->Name }}</a>'s Post
                @endif
            </span>
            <span class="description">{{ postStatus($feed->post_status) }} - {{ dateFormat($feed->created_at) }}</span>
            <!-- {{ $feed->post_id }} - {{ $feed->user_id }} - {{ $feed->shared_id }} -->
        </div>
        @if($feed->user_id==chackeAuthUser())
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool removeFeed" data-feed="{{$feed->post_id}}" data-url="{{ route('feed.remove') }}"><i class="fa fa-times"></i></button>
        </div>
        @endif
    </div>
    <div class="box-body">
        @if($feed->post_text != '')
            <div class="post-text" >{!! html_entity_decode(nl2br($feed->post_text)) !!}</div>
        @endif
        @if($feed->shared_id != 0)
            <div class="box box-widget animated fadeIn" style="margin:10px;width:auto;">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{ user_data($feed->Shared_userId)->ProPic }}" alt="User Image">
                        <span class="username"><a href="{{ route('profile',user_data($feed->Shared_userId)->user_id) }}">{{ user_data($feed->Shared_userId)->Name }}</a></span>
                        <span class="description">&nbsp;</span>
                    </div>
                </div>
                <div class="box-body">
                    @if($feed->Shared_text != '')
                        <div class="post-text" >{!! html_entity_decode(nl2br($feed->Shared_text)) !!}</div>
                    @endif
        @endif
            @if($feed->post_type == '1')                            
            <div class="post-image">
                <img class="img-responsive show-in-modal" src="{!! getFeedImage($feed->post_image) !!}" alt="Photo">
            </div>
            @endif
            @if($feed->post_type == '2')
            <div class="post-video">
                @if( $feed->video_format != '0' && ($feed->video_format) != null  )
                    <iframe width="100%" height="320"
                            frameborder="0" 
                            webkitAllowFullScreen mozallowfullscreen allowFullScreen 
                            type="application/x-shockwave-flash" 
                            src="{{ $feed->post_video }}">
                    </iframe>                                 
                @else
                    <br/>
                    <h3 class="text-center">Videio Not Found..!</h3>
                    <br/>
                @endif                                
            </div>
            @endif
            @if($feed->post_type == '3')
            <div class="post-article">
                @php $articalLink = ($feed->shared_id != 0)?$feed->shared_id:$feed->post_id @endphp
                @if($feed->article_image != '')
                <a href="{{ route('feed.article',$articalLink) }}" target="_blank">
                    <img class="img-responsive show-in-modal" src="{!! getFeedImage($feed->article_image, 'thumb') !!}" alt="Photo">
                </a>
                @endif
                <div class="attachment-block clearfix">
                    <h4 class="attachment-heading wordwap">
                        <a href="{{ route('feed.article',$articalLink) }}" target="_blank">{{$feed->article_title}}</a>
                    </h4>
                    <div class="attachment-text">
                        {!! strip_tags(Str::words($feed->article_description, 50,' ....'))  !!}
                        <a href="{{ route('feed.article',$articalLink) }}" target="_blank">Read This Article</a>
                    </div>                                
                </div>
            </div> 
            @endif

        @if($feed->shared_id != 0)
                </div>
            </div>
        @endif

        <!-- <hr class="post-sep" /> -->
        <div class="feed-like-share">            
            @php $sharePid = ($feed->shared_id == 0)?$feed->post_id:$feed->shared_id @endphp
            <button type="button" class="btn btn-link btn-xs feed-share" data-user="{{chackeAuthUser()}}" data-fuser="{{$feed->user_id}}" data-feed="{{ $sharePid }}"><i class="fa fa-share"></i> Share</button>

            <button type="button" class="btn btn-link btn-xs feed-like" data-user="{{chackeAuthUser()}}" data-fuser="{{$feed->user_id}}" data-feed="{{ $feed->post_id }}">
                @if(post_like($feed->post_id, chackeAuthUser()) == 1)
                    <i class="fa fa-thumbs-up"></i> Like
                @else
                    <i class="fa fa-thumbs-o-up"></i> Like
                @endif
            </button>
            <div id="FeedBody-{{$feed->post_id}}" class="like-share">
                <span class="text-muted postLike">{{ $feed->TOTAL_LIKES==''?'0':$feed->TOTAL_LIKES }} likes</span> 
                <span class="text-muted">|</span>
                <span class="text-muted postComment">{{ $feed->TOTAL_COMMENT==''?'0':$feed->TOTAL_COMMENT }} comments</span>
            </div>
        </div>
    </div>
    
    <div id="comment-{{$feed->post_id}}">
        <div class="box-footer box-comments">
        @if(count(post_comment($feed->post_id)) != 0 )
            @foreach(post_comment($feed->post_id) as $comment)
            <div class="box-comment">
                <img class="img-circle img-sm" src="{{ profile_pic($comment->profile_pic,'thumb') }}" alt="{{ $comment->firstname }} {{ $comment->lastname }}">
                <div class="comment-text">
                    <span class="username">
                        {{ $comment->firstname }} {{ $comment->lastname }}
                        <span class="text-muted pull-right">{{ dateFormat($comment->created_at) }}</span>
                    </span>
                    <p>{{ $comment->post_comment }}</p>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div class="box-footer">
        {!! Form::open(['route'=>'feed.comment','method'=>'post', 'id'=>'frm-comment-'.$feed->post_id ]) !!}                                
            {{ Form::hidden('cpid', convert_uuencode($feed->post_id)) }}
            {{ Form::hidden('cpuid', convert_uuencode($feed->user_id)) }}
            {{ Form::hidden('cpcid', convert_uuencode(chackeAuthUser())) }}
            <div class="cmt-snd">
                <img class="img-responsive img-circle img-sm" src="{{ userProPic() }}" alt="Alt Text">
                <div class="img-push" style="padding-right:40px;">
                    {{ Form::text('post_comment', '', ['class'=>'form-control input-sm','id' => 'post_comment','placeholder'=>'Press enter to post comment'] ) }}
                </div>
                <button type="submit" name="" class="cmt-snd-btn feedComment" value=""></button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!--  end posts-->
@endforeach


@php /*
    {{ $feeds->lastItem() }}
    {{ $feeds->nextPageUrl() }}
    $feeds->render()
*/ @endphp