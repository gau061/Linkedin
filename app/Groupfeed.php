<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Groupfeed extends Model
{
    protected $table = 'group_feeds';
 	protected $fillable = [
        'group_id','post_id','user_id','post_title','post_desc','post_type','post_status'
	];

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }
  

    public function getGroupFeed($groupid) {
         $feedData = static::select("group_feeds.*",
              "group_images.post_image",
              DB::raw("(SELECT COUNT(grouppost_likes.liker_user_id) FROM grouppost_likes
                WHERE grouppost_likes.feed_post_id = group_feeds.post_id
                GROUP BY grouppost_likes.feed_post_id) as TOTAL_LIKES"),
             DB::raw("(SELECT COUNT(grouppost_comments.post_comment) FROM grouppost_comments
                WHERE grouppost_comments.feed_post_id = group_feeds.post_id
                GROUP BY grouppost_comments.feed_post_id) as TOTAL_COMMENT") 
          )
               
        ->leftJoin('group_images', function ($join) {            
            $join->where(function ($query) {
                $query->on('group_images.post_id', '=', 'group_feeds.post_id');
            });
        })
       
        ->where(function ($query) {
            $query->where('group_feeds.post_status', 0)->Where('group_feeds.user_id', chackeAuthUser());
        })
     
        ->orwhere(function ($query) {
            $query->where('group_feeds.post_status', 1);
        })
        ->where('group_feeds.group_id',$groupid)
        ->orderBy('group_feeds.created_at', 'desc')        
        ->paginate(10);        
        return $feedData;
    }

 public function getFeedbyId($feed_id,$group_id) {
        $spost =  static::select( "group_feeds.*", "group_images.post_image" )
        ->leftJoin('group_images', 'group_feeds.post_id', '=', 'group_images.post_id')
        ->where('group_feeds.post_id',$feed_id)
        ->where('group_feeds.group_id',$group_id)
        ->first();
         return $spost;
    }


     public function deleteData($id,$group_id)
    {
        return static::where('post_id',$id)
        ->where('group_feeds.group_id',$group_id)
        ->delete();
    }
   










}
