<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $fillable = [
        'feed_post_id', 'post_user_id', 'liker_user_id'
	];

    public function getFeedLike($fid,$uid)
    {
        return static::where('feed_post_id',$fid)->where('liker_user_id',$uid)->first();
    }

    public function coundFeedLike($fid)
    {
        return static::where('feed_post_id',$fid)->count();
    }

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }

    public function updateData($id,$input)
    { 
        return static::where('id',$id)->update(array_only($input,$this->fillable));
    }

    public function removeLike($fid,$uid)
    {
        return static::where('feed_post_id',$fid)->where('liker_user_id',$uid)->delete();
    }

    public function deleteData($fid)
    {
        return static::where('feed_post_id',$fid)->delete();
    }

}
