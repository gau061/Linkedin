<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grouppostlike extends Model
{
	protected $table = 'grouppost_likes';
	protected $fillable = [
        'group_id','feed_post_id', 'post_user_id', 'liker_user_id'
	];

    public function getFeedLike($fid,$uid)
    {
        return static::where('feed_post_id',$fid)->where('liker_user_id',$uid)->first();
    }
    public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }
    public function coundFeedLike($fid)
    {
        return static::where('feed_post_id',$fid)->count();
    }
    public function removeLike($fid,$uid)
    {
        return static::where('feed_post_id',$fid)->where('liker_user_id',$uid)->delete();
    }
    public function deleteData($fid,$group_id)
    {
        return static::where('feed_post_id',$fid)
        ->where('grouppost_likes.group_id',$group_id)
        ->delete();
    }

}
