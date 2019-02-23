<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\HomeController;
use App\Frontuser;

use App\PostFeed;
use App\PostArticle;
use App\PostImage;
use App\PostVideo;
use App\Notification;
use App\ImageUpload;
use App\PostComment;
use App\PostLike;
use App\Requests;
use File;
use Hash;
use Mail;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use App\Commonnotification;


class FeedController extends HomeController
{
    public function __construct() {

		parent::__construct();
        $this->frontUser = new Frontuser;
        $this->postFeed = new PostFeed;
        $this->PostImage = new PostImage;
        $this->PostVideo = new PostVideo;
        $this->PostArticle = new PostArticle;
        $this->PostComment = new PostComment;
        $this->PostLike = new PostLike;
        $this->notification = new Notification;
        $this->request = new Requests;
        $this->commonnotify=new Commonnotification;     
	}

 	public function index() {
        $feeds = $this->postFeed->getFeed();
        //dd($feeds);
        $nextURL = $feeds->nextPageUrl();
        $lastURL = $feeds->lastPage() - 1;
        if(isset($_GET['page']) ){
            $nextURL = $feeds->nextPageUrl();
            $loadview = view('theme.feeds.feedLoad', ['feeds' => $feeds])->render();
            return response()->json(['nextURL' => $nextURL, 'feeds' => $loadview]);
        }
        $recConn = $this->notification->RecConec();
        $requ_check = $this->request->checkRequestFof();
 		return view('theme.feeds.feed',compact('feeds', 'nextURL','lastURL','recConn','requ_check'));
 	}

/* ================================================================= */
/* USER FEED */
/* ================================================================= */
    public function timeline($user_id='')
    {
        $uid = ($user_id == '')?chackeAuthUser():user_uniqueid_data($user_id)->id;
        if($uid == null)
            return redirect()->route('timeline.index');

        $feeds = $this->postFeed->getUserFeed($uid); 
        $nextURL = $feeds->nextPageUrl();
        $lastURL = $feeds->lastPage() - 1;
        if(isset($_GET['page']) ){
            $nextURL = $feeds->nextPageUrl();
            $loadview = view('theme.feeds.feedLoad', ['feeds' => $feeds])->render();
            return response()->json(['nextURL' => $nextURL, 'feeds' => $loadview]);
        }
        $recConn = $this->notification->RecConec();
        return view('theme.feeds.timeline',compact('feeds', 'nextURL','lastURL','recConn'));
    }
/* ================================================================= */
/* CREATE FEED - STORE */
/* ================================================================= */
 	public function store(Request $request) {
        $post_video = null;
        $post_image = null;
        $post_uniqui_id = str_shuffle(time());
 		$input = $request->all();
        if($input['post_type'] == 1){
            $post_image = $request->file('post_image');
            $this->validate($request, [
                'post_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
        }else if($input['post_type'] == 2){
            $post_video = $input['post_video'];
            $this->validate($request, [
                'post_video' => 'required|url',
            ]);
        }else{
            $this->validate($request, [
                'post_text' => 'required',
            ]);
        }

        $imagedata = null;
        if($post_image != null){
            $imagedata = updateFeedImage($post_image,'pImage');

            $postImageData['user_id'] = auth()->guard('frontuser')->user()->id;
            $postImageData['post_id'] = $post_uniqui_id;
            $postImageData['post_image'] = $imagedata;
            $data_image = $this->PostImage->insertData($postImageData);
        }

        $videodata = null;
        if($post_video != null && $post_video != ''){
            $videodata = parseVideos($post_video);
            $postVideoData['user_id']       = auth()->guard('frontuser')->user()->id;
            $postVideoData['post_id']       = $post_uniqui_id;
            $postVideoData['post_video']    = $videodata['url'];
            $postVideoData['video_image']   = $videodata['fullsize'];
            $postVideoData['video_format']  = $videodata['video_type'];
            $data_image = $this->PostVideo->insertData($postVideoData);
        }        
        
 		$input['post_status'] = $input['post_status'];
        $input['post_id'] = $post_uniqui_id;
 		$input['user_id'] = auth()->guard('frontuser')->user()->id;
        $input['post_text'] = htmlentities($input['post_text']);

        $data = $this->postFeed->insertData($input);

        notificationMsg('success',$this->operationMsg('custom','Feed is created.'));
        return response()->json(['success' => 'Feed is created.']);

       	//return redirect()->route('feeds');
 	}
/* ================================================================= */
/* UPDATE FEED - UPDATE */
/* ================================================================= */
 	public function update(Request $request, $id){
        $input = $request->all();
 	}
/* ================================================================= */
/* FEED ARTICLE */
/* ================================================================= */
    public function article($post_id){        
        $articleData = $this->PostArticle->viewData($post_id);
        $feed = $this->postFeed->getArticlePost($post_id);
        return view('theme.feeds.article',compact('articleData','feed'));
    }
/* ================================================================= */
/* ARTICAL CREATE */
/* ================================================================= */
    public function articleCreate()
    {
        return view('theme.feeds.articleCreate');
    }
/* ================================================================= */
/* ARTICAL CREATE - POST */
/* ================================================================= */
    public function articleInsert(Request $request) {
        $input = $request->all();
        $this->validate($request, [
            'article_title' => 'required',
            'article_image' => 'image|mimes:jpeg,png,jpg,gif',
            'article_description' => 'required',
        ]);        
        if(isset($input['publish'])){
            $input['article_status'] = 1;
            $post_input['post_status'] = 1;
        }else{
            $input['article_status'] = 0;
            $post_input['post_status'] = 0;
        }
        if($request->has('article_image')){
            $input['article_image'] = updateFeedArticleImage($request->file('article_image'));
        }
        $post_uniqui_id = str_shuffle(time());
        $input['post_id'] = $post_uniqui_id;
        $input['user_id'] = auth()->guard('frontuser')->user()->id;
        $data_article = $this->PostArticle->insertData($input);

        $post_input['post_id'] = $post_uniqui_id;
        $post_input['user_id'] = auth()->guard('frontuser')->user()->id;
        $post_input['post_type'] = 3;
        $post_input['post_text'] = '';
        $data_feed = $this->postFeed->insertData($post_input);

        return redirect()->route('feeds');
    }
/* ================================================================= */
/* FEED COMMENT */
/* ================================================================= */
    public function comment(Request $request) {
        $input = $request->all();
        $this->validate($request, [         
            'post_comment' => 'required',
        ]);

        $post_id = convert_uudecode($input['cpid']);
        $post_user_id = convert_uudecode($input['cpuid']);
        $commenter_user_id = convert_uudecode($input['cpcid']);
        //dd($post_id, $post_user_id, $commenter_user_id);

        $cdata['feed_post_id'] = $post_id;
        $cdata['post_user_id'] = $post_user_id;
        $cdata['commenter_user_id'] = $commenter_user_id;
        $cdata['post_comment'] = $input['post_comment'];
        $data = $this->PostComment->insertData($cdata);
        //dd(dateFormat($data->created_at));

        /*insert notification table*/
        $notifyinput['user_id']=$cdata['post_user_id'];
        $notifyinput['request_user_id']=$cdata['commenter_user_id'];
        $notifyinput['notification_type']='post_comment';
        $notifyinput['notification_id']=$cdata['feed_post_id'];
        $this->commonnotify->createData($notifyinput);
        

        $feedCommet = $this->PostComment->coundFeedLike($post_id);
        $commentData = array();
        $commentData['cmt_profilePid']  = user_data($commenter_user_id)->ProPic;
        $commentData['cmt_fullname']    = user_data($commenter_user_id)->Name;
        $commentData['cmt_commetdate']  = dateFormat($data->created_at);
        $commentData['cmt_comment']     = $input['post_comment'];
        //dd($commentData);
        return response()->json(['post_id' => $post_id, 'commentData' => $commentData, 'feedCommet' => $feedCommet, 'success' => 'Comment Successfully']);
    }
/* ================================================================= */
/* FEED LIKE */
/* ================================================================= */
    public function like(Request $request)
    {
        $getdata = $request->all();   

        $input['feed_post_id']  = $getdata['fid'];
        $input['post_user_id']  = $getdata['fuid'];
        $input['liker_user_id'] = $getdata['uid'];
        $data = $this->PostLike->getFeedLike($getdata['fid'],$getdata['uid']);
        if (is_null($data)) {

            /*insert notification table*/
            $notifyinput['user_id']=$input['post_user_id'];
            $notifyinput['request_user_id']=$input['liker_user_id'];
            $notifyinput['notification_type']='post_like';
            $notifyinput['notification_id']=$input['feed_post_id'];
            //dd($notifyinput);
            $this->commonnotify->createData($notifyinput);
            $this->PostLike->insertData($input);
            $feedLikes = $this->PostLike->coundFeedLike($getdata['fid']);
            return response()->json(['status' => 1, 'feedLikes' => $feedLikes, 'success' => 'Feed is likded.']);
        }else{
            $this->PostLike->removeLike($getdata['fid'],$getdata['uid']);
            $deletelikenotify  = $this->commonnotify->deletelikenotify($getdata);
            $feedLikes = $this->PostLike->coundFeedLike($getdata['fid']);
            return response()->json(['status' => 0, 'feedLikes' => $feedLikes, 'success' => 'Feed is unliked.']);
        }
    }

/* ================================================================= */
/* FEED SHARE */
/* ================================================================= */
    public function share(Request $request) {
        $getdata        = $request->all();
        $postData       = $this->postFeed->getFeedbyId($getdata['fid']);

        $html = '';
        $html .= '<div class="box box-widget animated fadeIn">';
            $html .= '<div class="box-header with-border">';
                $html .= '<div class="user-block">';
                    $html .= '<img class="img-circle" src="'.user_data($postData->user_id)->ProPic.'" alt="User Image">';
                    $html .= '<span class="username"><a href="'.route('profile',user_data($postData->user_id)->user_id).'">'.user_data($postData->user_id)->Name.'</a></span>';
                    $html .= '<span class="description">'. postStatus($postData->post_status).' - '.dateFormat($postData->created_at).'</span>';                    
                $html .= '</div>';
            $html .= '</div>';
            
            $html .= '<div class="box-body">';
                if($postData->post_text != ''){
                    $html .= '<div class="post-text" >'. \Str::words(html_entity_decode(nl2br($postData->post_text)), 35).'</div>';
                }
                if($postData->post_type == '1'):
                    $html .= '<div class="post-image">';
                        $html .= '<img class="img-responsive show-in-modal" src="'.getFeedImage($postData->post_image).'" alt="Photo">';
                    $html .= '</div>';
                endif;

                if($postData->post_type == '2'):
                    $html .= '<div class="post-video">';
                        if( $postData->video_format != '0' && ($postData->video_format) != null  ):
                            $html .= '<iframe width="100%" height="320"
                                    frameborder="0" 
                                    webkitAllowFullScreen mozallowfullscreen allowFullScreen 
                                    type="application/x-shockwave-flash" 
                                    src="'.$postData->post_video.'">';
                            $html .= '</iframe>';
                        else:
                            $html .= '<br/>';
                            $html .= '<h3 class="text-center">Videio Not Found..!</h3>';
                            $html .= '<br/>';                            
                        endif;
                    $html .= '</div>';
                endif;

                if($postData->post_type == '3'):
                $html .= '<div class="post-article">';
                    if($postData->article_image != ''):
                    $html .= '<a>';
                        $html .= '<img class="img-responsive show-in-modal" src="'.getFeedImage($postData->article_image, 'thumb').'" alt="Photo">';
                    $html .= '</a>';
                    endif;
                    $html .= '<div class="attachment-block clearfix">';
                        $html .= '<h4 class="attachment-heading wordwap">';
                            $html .= '<a>'.$postData->article_title.'</a>';
                        $html .= '</h4>';
                        $html .= '<div class="attachment-text">';
                            $html .= strip_tags(Str::words($postData->article_description, 50,' ....'));                            
                        $html .= '</div>';
                    $html .= '</div>';
                $html .= '</div>';
                endif;
            $html .= '';
            $html .= '';            
            $html .= '</div>';
        $html .= '</div>';

        return response()->json(['feedData' => $html]);
    }

    public function feedshare(Request $request) {
        $getdata        = $request->all();

        $post_uniqui_id = str_shuffle(time());
        $postData       = $this->postFeed->getFeedbyId($getdata['post_id']);

        if ($postData->shared_id == 0) {
            $inputData['shared_id']   = $postData->post_id;
        }else{
            $inputData['shared_id']   = $postData->shared_id;
        }

        $inputData['post_id']       = $post_uniqui_id;
        $inputData['user_id']       = auth()->guard('frontuser')->user()->id;
        $inputData['post_type']    = $postData->post_type;
        $inputData['post_text']     = htmlentities($getdata['post_text']);
        $inputData['post_status']   = $getdata['post_status'];
        $saveData = $this->postFeed->insertData($inputData);
        
        //dd($data);
         /*insert in notifications */
        $notifyinput['user_id']=$postData['user_id'];
        $notifyinput['request_user_id']=$inputData['user_id'];
        $notifyinput['notification_type']='post_share';
        $notifyinput['notification_id']=$inputData['post_id'];
        //dd($notifyinput);
        $this->commonnotify->createData($notifyinput);
        notificationMsg('success',$this->operationMsg('custom','Feed is shared.'));
        return response()->json(['success' => 'Feed is shared.']);
       
    }

/* ================================================================= */
/* FEED REMOVE */
/* ================================================================= */
    public function feedRemove(request $request) {
        $getdata = $request->all();
        $feed_id  = $getdata['fid'];

        $feedPost = $this->postFeed->getFeedbyId($feed_id);

        if($feedPost->user_id == chackeAuthUser()){
            if($feedPost->shared_id == 0 ){
                switch ($feedPost->post_type) {
                    case '1':
                        //Image
                        $this->RemoveImageFeed($feedPost->post_id);                    
                        break;

                    case '2':
                        //Video
                        $this->RemoveVideoFeed($feedPost->post_id);
                        break;

                    case '3':
                        //Artical
                        $this->RemoveArticalFeed($feedPost->post_id);
                        break;
                    
                    default:
                    //
                    break;
                }
            }
            $rcmt   = $this->PostComment->deleteData($feedPost->post_id);
            $rlike  = $this->PostLike->deleteData($feedPost->post_id);
            $rshare = $this->postFeed->deleteShareData($feedPost->post_id);
            $rdata  = $this->postFeed->deleteData($feedPost->post_id);
            $deletenotify=$this->commonnotify->deletenpostnotification($feedPost->post_id);
            $deletesharenotify=$this->commonnotify->deletesharenotify($feedPost->post_id);
            $deletecommentnotify= $this->commonnotify->deletecommentnotify($feedPost->post_id);
            
            return response()->json(['success' => 'Feed is remvoe Successfully.']);
        }else{
            return response()->json(['error' => 'You cannot remove anoter user feed.']);
        }
        return response()->json(['success' => 'Feed is remvoe Successfully.']);                
    }

    public function RemoveImageFeed($feed_id) {
        $postImage = $this->PostImage->singleData($feed_id);
        if(isset($postImage) && !empty($postImage)){
            $image = $postImage->post_image;
            if(isset($image) && $image!=''){
                removeFeedImage($image);
            }
            $this->PostImage->deleteData($feed_id);
        }
    }
    public function RemoveVideoFeed($feed_id) {
        $this->PostVideo->deleteData($feed_id);
    }
    public function RemoveArticalFeed($feed_id) {
        $post_article = $this->PostArticle->viewData($feed_id);
        if(isset($post_article) && !empty($post_article)){
            $image = $post_article->article_image;
            if(isset($image) && $image!=''){
                removeArticalImage($image);
            }
            $this->PostArticle->deleteData($feed_id);            
        }        
    }
}
