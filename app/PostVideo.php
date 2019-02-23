<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    protected $table = 'post_video';
 	protected $fillable = [
        'post_id', 'user_id', 'post_video', 'video_image', 'video_format'
	];

	public function insertData($input) {
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
}
