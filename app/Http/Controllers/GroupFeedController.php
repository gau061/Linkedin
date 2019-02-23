<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Groupimage;
use App\Groupfeed;
use App\Grouppostlike;
use App\Grouppostcomment;
use App\Notification;
use App\GroupMember;
use File;
class GroupFeedController extends HomeController
{

function __construct()
{
	$this->groupimage = new Groupimage; 
    $this->groupfeed = new Groupfeed;
    $this->groupMember = new GroupMember;
    $this->grouppostlike = new Grouppostlike;
    $this->grouppostcomment = new Grouppostcomment;
}
     /************************************/
     /* Insert Data
     /************************************/
        public function store(Request $request)
        {
        	$post_image = null;
            $post_uniqui_id = str_shuffle(time());
            $input = $request->all();

            if($input['post_type'] == 1){
            	$post_image = $request->file('post_image');
	            $this->validate($request, [
	                'post_image' => 'required|image|mimes:jpeg,png,jpg,gif',
	            ]);
        	}
            else{
	            $this->validate($request, [
	            	'post_title' => 'required',
	                'post_desc' => 'required',
	            ]);
       		}

       		 $imagedata = null;
            if($post_image != null){
                $imagedata = updateFeedImage($post_image,'pImage');
                $postImageData['group_id'] = $input['gid'];
    			$postImageData['user_id'] = auth()->guard('frontuser')->user()->id;
                $postImageData['post_id'] = $post_uniqui_id;
                $postImageData['post_image'] = $imagedata;
                $postImageData['post_status'] = 1;
                // dd($postImageData);
                $data_image = $this->groupimage->insertData($postImageData);
            }
                $input['group_id'] = $input['gid'];
                $input['post_id'] = $post_uniqui_id;
         		$input['user_id'] = auth()->guard('frontuser')->user()->id;
                $input['post_desc'] = htmlentities($input['post_desc']);
                $input['post_title'] = htmlentities($input['post_title']);
                $input['post_status'] = 1;

                $data = $this->groupfeed->insertData($input);
                notificationMsg('success',$this->operationMsg('custom','GroupFeed is created.'));
                return response()->json(['success' => 'GroupFeed is created.']);

        }

	
/* ================================================================= */
/* FEED LIKE */
/* ================================================================= */
    public function grouplike(Request $request)
    {
        $getdata = $request->all();  
        $input['group_id'] =$getdata['groupId']; 
        $input['feed_post_id']  = $getdata['fid'];
        $input['post_user_id']  = $getdata['fuid'];
        $input['liker_user_id'] = $getdata['uid'];
        $data = $this->grouppostlike->getFeedLike($getdata['fid'],$getdata['uid']);
        if (is_null($data)) {
            $this->grouppostlike->insertData($input);
            $feedLikes = $this->grouppostlike->coundFeedLike($getdata['fid']);
           
            return response()->json(['status' => 1, 'feedLikes' => $feedLikes, 'success' => 'Groupfeed is likded.']);
        }else{
            $this->grouppostlike->removeLike($getdata['fid'],$getdata['uid']);
            $feedLikes = $this->grouppostlike->coundFeedLike($getdata['fid']);
            
            return response()->json(['status' => 0, 'feedLikes' => $feedLikes, 'success' => 'Groupfeed is unliked.']);
        }
    }

/* ================================================================= */
/* FEED COMMENT */
/* ================================================================= */
    public function groupcomment(Request $request) {
        $input = $request->all();
        $this->validate($request, [         
            'post_comment' => 'required',
        ]);

        $post_id = convert_uudecode($input['cpid']);
        $post_user_id = convert_uudecode($input['cpuid']);
        $commenter_user_id = convert_uudecode($input['cpcid']);
        $group_id = $input['gid'];
       
        $cdata['feed_post_id'] = $post_id;
        $cdata['post_user_id'] = $post_user_id;
        $cdata['commenter_user_id'] = $commenter_user_id;
        $cdata['post_comment'] = $input['post_comment'];
        $cdata['group_id'] = $group_id;
        $data = $this->grouppostcomment->insertData($cdata);
       
        $feedCommet = $this->grouppostcomment->coundFeedLike($post_id);
        $commentData = array();
        $commentData['cmt_profilePid']  = user_data($commenter_user_id)->ProPic;
        $commentData['cmt_fullname']    = user_data($commenter_user_id)->Name;
        $commentData['cmt_commetdate']  = dateFormat($data->created_at);
        $commentData['cmt_comment']     = $input['post_comment'];
        $commentData['group_id'] = $group_id;

        return response()->json(['post_id' => $post_id, 'commentData' => $commentData, 'feedCommet' => $feedCommet, 'success' => 'Comment Successfully']);
    }

/* ================================================================= */
/* FEED REMOVE */
/* ================================================================= */
    public function groupfeedRemove(request $request) {
        $getdata = $request->all();
        $feed_id  = $getdata['fid'];
        $group_id = $getdata['gid'];
        
        $feedPost = $this->groupfeed->getFeedbyId($feed_id,$group_id);
        $user_type = $this->groupMember->joingroupbtn($group_id,chackeAuthUser());
        
        if($feedPost->user_id == chackeAuthUser() || $user_type->user_type == 'Group Owner'){
                switch ($feedPost->post_type) {
                    case '1':
                        //Image
                        $this->RemoveImageFeed($feedPost->post_id,$group_id);                    
                        break;
                default:
                    
                    break;
                }
            $rcmt   = $this->grouppostcomment->deleteData($feedPost->post_id,$group_id);
            $rlike  = $this->grouppostlike->deleteData($feedPost->post_id,$group_id);
            $rdata  = $this->groupfeed->deleteData($feedPost->post_id,$group_id);
           // $rshare = $this->postFeed->deleteShareData($feedPost->post_id);
           // $deletenotify=$this->commonnotify->deletenpostnotification($feedPost->post_id);
            // $deletesharenotify=$this->commonnotify->deletesharenotify($feedPost->post_id);
            // $deletecommentnotify= $this->commonnotify->deletecommentnotify($feedPost->post_id);
            return response()->json(['success' => 'GroupFeed is remove Successfully.']);
        }
        return response()->json(['success' => 'GroupFeed is remove Successfully.']);                
    }

    public function RemoveImageFeed($feed_id,$group_id) {
        $postImage = $this->groupimage->singleData($feed_id,$group_id);
        if(isset($postImage) && !empty($postImage)){
            $image = $postImage->post_image;
            // dd($image);
            if(isset($image) && $image!=''){
                removeFeedImage($image);
            }
            $this->groupimage->deleteData($feed_id,$group_id);
        }
    }
}
