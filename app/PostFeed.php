<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Notification;

class PostFeed extends Model
{
    protected $table = 'post_feed';
 	protected $fillable = [
        'post_id', 'shared_id', 'user_id', 'post_type', 'post_text', 'post_status'
	];

	public function insertData($input){
        
    	return static::create(array_only($input,$this->fillable));
    }

    public function updateData($id,$input)
    { 
        return static::where('id',$id)->update(array_only($input,$this->fillable));
    }

    public function deleteData($id)
    {
        return static::where('post_id',$id)->delete();
    }
    
    public function deleteShareData($id)
    {
        return static::where('shared_id',$id)->delete();
    }

    public function getAll() {
        return static::get();
    }

    public function getArticlePost($post_id) {
        $data = static::select( "post_feed.*", "post_article.article_title","post_article.article_image","post_article.article_description",
                DB::raw("(SELECT COUNT(post_likes.liker_user_id) FROM post_likes
                WHERE post_likes.feed_post_id = post_feed.post_id
                GROUP BY post_likes.feed_post_id) as TOTAL_LIKES"),
                DB::raw("(SELECT COUNT(post_comments.post_comment) FROM post_comments
                WHERE post_comments.feed_post_id = post_feed.post_id
                GROUP BY post_comments.feed_post_id) as TOTAL_COMMENT") )
        ->leftJoin('post_article','post_article.post_id','=','post_feed.post_id')        
        ->where('post_feed.post_id',$post_id)->first();

        return $data;        
    }

    public function getFeedbyId($feed_id) {
        $spost =  static::select( "post_feed.*", "post_images.post_image","post_video.post_video","post_video.video_image","post_video.video_format", "post_article.article_title","post_article.article_image","post_article.article_description" )
        ->leftJoin('post_images', 'post_feed.post_id', '=', 'post_images.post_id')
        ->leftJoin('post_video', 'post_feed.post_id', '=', 'post_video.post_id')
        ->leftJoin('post_article', 'post_feed.post_id', '=', 'post_article.post_id')
        ->where('post_feed.post_id',$feed_id)
        ->first();

        return $spost;
    }

    public function getFeed() {
        $GLOBALS['firendList'] = array();
        $notification = new Notification;
        $firend_id = $notification->Connected();
        $firendList[] = chackeAuthUser();
        foreach ($firend_id as $key => $value) {
            $firendList[] = $value->FRIEND_ID;
        }
        $GLOBALS['firendList'] = $firendList;

        $feedData = static::select( "post_feed.*", "SHAREDPOST.post_text AS Shared_text","SHAREDPOST.post_type AS Shared_type","SHAREDPOST.user_id AS Shared_userId",
                                "post_images.post_image","post_video.post_video","post_video.video_image","post_video.video_format",
                                "post_article.article_title","post_article.article_image","post_article.article_description",
                DB::raw("(SELECT COUNT(post_likes.liker_user_id) FROM post_likes
                WHERE post_likes.feed_post_id = post_feed.post_id
                GROUP BY post_likes.feed_post_id) as TOTAL_LIKES"),
                DB::raw("(SELECT COUNT(post_comments.post_comment) FROM post_comments
                WHERE post_comments.feed_post_id = post_feed.post_id
                GROUP BY post_comments.feed_post_id) as TOTAL_COMMENT") )
        ->leftJoin('post_feed AS SHAREDPOST','SHAREDPOST.post_id','=','post_feed.shared_id')
        ->leftJoin('post_images', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_images.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_images.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->leftJoin('post_video', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_video.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_video.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->leftJoin('post_article', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_article.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_article.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->where(function ($query) {
            $query->where('post_feed.post_status', 2)->Where('post_feed.user_id', chackeAuthUser());
        })
        ->orwhere(function ($query) {
            $query->where('post_feed.post_status', 1)->WhereIn('post_feed.user_id', $GLOBALS['firendList']);
        })
        ->orwhere(function ($query) {
            $query->where('post_feed.post_status', 0);
        })
        ->orderBy('post_feed.created_at', 'desc')        
        ->paginate(10);        
        return $feedData;
    }

    public function getUserFeed($user_id) {
    	$GLOBALS['firendList'] = array();
        $notification = new Notification;
        $firend_id = $notification->Connected();
        $firendList[] = $user_id;
        foreach ($firend_id as $key => $value) {
            $firendList[] = $value->FRIEND_ID;
        }
        $GLOBALS['firendList'] = $firendList;

        $feedData = static::select( "post_feed.*","SHAREDPOST.post_text AS Shared_text","SHAREDPOST.post_type AS Shared_type","SHAREDPOST.user_id AS Shared_userId",
                                "post_images.post_image","post_video.post_video","post_video.video_image","post_video.video_format",
                                "post_article.article_title","post_article.article_image","post_article.article_description",
                DB::raw("(SELECT COUNT(post_likes.liker_user_id) FROM post_likes
                WHERE post_likes.feed_post_id = post_feed.post_id
                GROUP BY post_likes.feed_post_id) as TOTAL_LIKES"),
                DB::raw("(SELECT COUNT(post_comments.post_comment) FROM post_comments
                WHERE post_comments.feed_post_id = post_feed.post_id
                GROUP BY post_comments.feed_post_id) as TOTAL_COMMENT") )
        ->leftJoin('post_feed AS SHAREDPOST','SHAREDPOST.post_id','=','post_feed.shared_id')
        ->leftJoin('post_images', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_images.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_images.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->leftJoin('post_video', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_video.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_video.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->leftJoin('post_article', function ($join) {            
            $join->where(function ($query) {
                $query->on('post_article.post_id', '=', 'post_feed.post_id')->where('post_feed.shared_id', '==', 0);
            });
            $join->orwhere(function ($query) {
                $query->on('post_article.post_id', '=', 'post_feed.shared_id')->where('post_feed.shared_id', '!=', 0);
            });
        })
        ->Where('post_feed.user_id', $user_id)
        // ->where(function ($query) {
        //     $query->where('post_feed.post_status', 2)->Where('post_feed.user_id', chackeAuthUser());
        // })
        // ->orwhere(function ($query) {
        //     $query->where('post_feed.post_status', 1)->WhereIn('post_feed.user_id', $GLOBALS['firendList']);
        // })
        // ->orwhere(function ($query) {
        //     $query->where('post_feed.post_status', 0);
        // })
        ->orderBy('post_feed.created_at', 'desc')
        ->paginate(10);        
        return $feedData;
    }

    public function userPostFeedCount($id){

        $data = static::select(
                DB::raw("(SELECT COUNT(*) FROM post_feed WHERE post_type=0) as TEXT_FILE"),
                DB::raw("(SELECT COUNT(*) FROM post_feed WHERE post_type=1) as IMAGE"),
                DB::raw("(SELECT COUNT(*) FROM post_feed WHERE post_type=2) as VIDEO"),
                DB::raw("(SELECT COUNT(*) FROM post_feed WHERE post_type=3) as ARTICAL"),
                DB::raw("(SELECT COUNT(*) FROM post_feed) as TOTAL")
            )
        ->where('user_id',$id)        
        ->first();
        return  $data;
    }

}
