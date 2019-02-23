<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PostImage extends Model
{
    protected $table = 'post_images';
 	protected $fillable = [
        'post_id', 'user_id', 'post_image'
	];

	public function insertData($input) {
    	return static::create(array_only($input,$this->fillable));
    }

    public function updateData($post_id,$input)
    { 
        return static::where('post_id',$post_id)->update(array_only($input,$this->fillable));
    }
    public function getData()
    {
        return static::get();
    }
    public function singleData($post_id)
    {
        return static::where('post_id',$post_id)->first();
    }
    public function deleteData($post_id)
    {
        return static::where('post_id',$post_id)->delete();
    }

}
