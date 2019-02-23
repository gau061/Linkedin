@extends($theme)
@section('content')
<div class="page-content">
	<div class="container">
		<section class="articleView">
			@if($articleData->article_image != '')
				<div class="articleImage">
                    <img class="img-responsive show-in-modal" src="{!! getFeedImage($articleData->article_image) !!}" alt="Photo">
				</div>
            @endif
            <div class="articleHeader">	
				<h1>{{$articleData->article_title}}</h1>
			</div>
            <div class="articleData">
            	<div class="box-header with-border row">
            		<div class="col-sm-6">
		                <div class="user-block">
		                    <img class="img-circle" src="{{ user_data($articleData->user_id)->ProPic }}" alt="User Image">
		                    <span class="username"><a href="#">{{ user_data($articleData->user_id)->Name }}</a></span>
		                    <span class="description">Published on - {{ \Carbon\carbon::createFromFormat('Y-m-d H:i:s', $articleData->created_at)->format('F jS,  Y') }}</span>
		                </div>	                
		            </div>	            
		            <div class="col-sm-6 article-setting">
		        		@if(chackeAuthUser() == $articleData->user_id)
			            	<span class="edit-article"><a href=""><i class="fa fa-edit"></i> Edit article</a></span>
			            	<span>|</span>
			            	<span class="remove-article"><a href=""><i class="fa fa-trash"></i> Remove article</a></span>
			        	@endif
		        	</div>
            	</div>
            </div>
            <div class="box-header with-border">	        	
        		<div class="feed-like-share">
                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-share"></i> Share</button>
                    <button type="button" class="btn btn-link btn-xs feed-like" data-user="{{chackeAuthUser()}}" data-fuser="{{$articleData->user_id}}" data-feed="{{ $articleData->post_id }}">
                        @if(post_like($articleData->post_id, chackeAuthUser()) == 1)
                            <i class="fa fa-thumbs-up"></i> Like
                        @else
                            <i class="fa fa-thumbs-o-up"></i> Like
                        @endif
                    </button>	                       
                    <span id="FeedBody-{{$articleData->post_id}}">
                        <span class="pull-right text-muted like-share">{{ $feed->TOTAL_LIKES==''?'0':$feed->TOTAL_LIKES }} likes - {{ $feed->TOTAL_COMMENT==''?'0':$feed->TOTAL_COMMENT }} comments</span>
                    </span>
                </div>
        	</div>			
			<div class="articleText">
				{!! $articleData->article_description !!}
			</div>
			<div id="comment-{{$feed->post_id}}">
					<h3>Article Comment</h3>
                    @if(count(post_comment($feed->post_id)) != 0 )
                    <div class="box-footer box-comments">
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
                    </div>
                    @else
                    <div class="box-footer box-comments">
                    	<div class="box-comment">                            
                            <div class="comment-text">
                                <p><b>0 - Comments </b></p>
                            </div>
                        </div>
                    </div>
                    @endif
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
		</section>
		
	</div>
</div>
@endsection
@section('pageScript')
    <script type="text/javascript" src="{{ asset('/public/js/feed/feed.js') }}"></script>
@endsection