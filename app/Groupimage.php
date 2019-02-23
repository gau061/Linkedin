<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupimage extends Model
{
   protected $table = 'group_images';
 	protected $fillable = [
        'group_id','post_id', 'user_id', 'post_image'
	];

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }
    public function singleData($post_id,$group_id)
    {
        return static::where('post_id',$post_id)
        ->where('group_images.group_id',$group_id)
        ->first();
    }
    public function deleteData($post_id,$group_id)
    {
        return static::where('post_id',$post_id)
        ->where('group_images.group_id',$group_id)
        ->delete();
    }

}
