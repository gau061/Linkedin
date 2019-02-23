<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostArticle extends Model
{
    protected $table = 'post_article';
 	protected $fillable = [
        'post_id', 'user_id', 'article_title', 'article_image', 'article_description', 'article_status'
	];

    public function viewData($id)
    {
        return static::where('post_id',$id)->first();
    }

	public function insertData($input) 
    {
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
