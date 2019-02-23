<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'feed_post_id', 'post_user_id', 'commenter_user_id', 'post_comment'
	];

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }

    public function coundFeedLike($fid) {
        return static::where('feed_post_id',$fid)->count();
    }

    public function updateData($id,$input)
    { 
        return static::where('id',$id)->update(array_only($input,$this->fillable));
    }

    public function deleteData($id)
    {
        return static::where('feed_post_id',$id)->delete();
    }
}
