@foreach($groupfeed as $groupfeed)
<!--   posts -->
<div class="box box-widget animated fadeIn post-{{$groupfeed->post_id}}" id="feedPost-{{$groupfeed->post_id}}">
    <div class="box-header with-border">
        <div class="user-block">
            <img class="img-circle" src="{{ user_data($groupfeed->user_id)->ProPic }}" alt="User Image">
            <span class="username">
                <a href="{{ route('profile',user_data($groupfeed->user_id)->user_id) }}">{{ user_data($groupfeed->user_id)->Name }}</a>
                
            </span>
            <span class="description">{{ postStatus($groupfeed->post_status) }} - {{ dateFormat($groupfeed->created_at) }}</span>
            
        </div>
        @if(!is_null($user_type))
         @if($user_type->user_type == 'Group Owner')
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool removeFeed" data-gid="{{$groupfeed->group_id}}"  data-feed="{{$groupfeed->post_id}}" data-url="{{ route('groupfeed.remove') }}"><i class="fa fa-times"></i></button>
        </div>
        @elseif($groupfeed->user_id == chackeAuthUser())
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool removeFeed" data-gid="{{$groupfeed->group_id}}"  data-feed="{{$groupfeed->post_id}}" data-url="{{ route('groupfeed.remove') }}"><i class="fa fa-times"></i></button>
        </div>
        @else
        @endif
        @endif
    </div>
    <div class="box-body">
        @if($groupfeed->post_title != '' || $groupfeed->post_desc != '')
        <div class="post-text" ><strong>{!! html_entity_decode(nl2br($groupfeed->post_title)) !!}</strong><br/>
            {!! html_entity_decode(nl2br($groupfeed->post_desc)) !!}
        </div>
        @endif
        
        @if($groupfeed->post_type == '1')
        <div class="post-image">
            <img class="img-responsive show-in-modal" src="{!! getFeedImage($groupfeed->post_image) !!}" alt="Photo">
        </div>
        @endif
        
        @if($groupfeed->shared_id != 0)
    </div>
</div>
@endif
<!-- <hr class="post-sep" /> -->
<div class="groupfeed-like-share">
    @if(!is_null($user_type))
    <button type="button" class="btn btn-link btn-xs feed-like" data-user="{{chackeAuthUser()}}" data-fuser="{{$groupfeed->user_id}}" data-feed="{{ $groupfeed->post_id }}" data-gid="{{$groupfeed->group_id}}">
    @if(Postgroup_like($groupfeed->post_id, chackeAuthUser()) == 1)
    <i class="fa fa-thumbs-up"></i> Like
    @else
    <i class="fa fa-thumbs-o-up"></i> Like
    @endif
    </button>
    @endif
    
    <div id="FeedBody-{{$groupfeed->post_id}}" class="like-share">
        <span class="text-muted postLike">{{ $groupfeed->TOTAL_LIKES==''?'0':$groupfeed->TOTAL_LIKES }} likes</span>
        <span class="text-muted">|</span>
        <span class="text-muted postComment">{{ $groupfeed->TOTAL_COMMENT==''?'0':$groupfeed->TOTAL_COMMENT }} comments</span>
    </div>
</div>
</div>
<div id="comment-{{$groupfeed->post_id}}">
<div class="box-footer box-comments">
    
    @if(!is_null($user_type))
    @if(count(Postgroup_comment($groupfeed->post_id)) != 0 )
    @foreach(Postgroup_comment($groupfeed->post_id) as $comment)
    <div class="box-comment">
        <img class="img-circle img-sm" src="{{ profile_pic($comment->profile_pic) }}" alt="{{ $comment->firstname }} {{ $comment->lastname }}">
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
    @endif
</div>
</div>
@if(!is_null($user_type))
<div class="box-footer">
{!! Form::open(['route'=>'groupfeed.comment','method'=>'post', 'id'=>'frm-comment-'.$groupfeed->post_id ]) !!}
{{ Form::hidden('cpid', convert_uuencode($groupfeed->post_id)) }}
{{ Form::hidden('cpuid', convert_uuencode($groupfeed->user_id)) }}
{{ Form::hidden('cpcid', convert_uuencode(chackeAuthUser())) }}
{{Form::hidden('gid',$groupfeed->group_id)}}
<div class="cmt-snd">
    <img class="img-responsive img-circle img-sm" src="{{ userProPic() }}" alt="Alt Text">
    <div class="img-push" style="padding-right:40px;">
        {{ Form::text('post_comment', '', ['class'=>'form-control input-sm','id' => 'post_comment','placeholder'=>'Press enter to post comment'] ) }}
    </div>
    <button type="submit" name="" class="cmt-snd-btn feedComment" value=""></button>
</div>
{!! Form::close() !!}
</div>
@endif
</div>
<!--  end posts-->
@endforeach
@php /*
{{ $groupfeed->lastItem() }}
{{ $groupfeed->nextPageUrl() }}
$groupfeed->render()
*/ @endphp