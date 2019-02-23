<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grouppostcomment extends Model
{
	protected $table = 'grouppost_comments';
   	protected $fillable = [
        'group_id','feed_post_id', 'post_user_id', 'commenter_user_id', 'post_comment'
	];

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }

    public function coundFeedLike($fid) {
        return static::where('feed_post_id',$fid)->count();
    }
     public function deleteData($id,$group_id)
    {
        return static::where('feed_post_id',$id)
        ->where('grouppost_comments.group_id',$group_id)
        ->delete();
    }


}
