<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{	
	protected $table = 'pages';
	protected $fillable = ['page_title','page_slug','page_desc','page_image','page_status','title','keyword','description'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function getList()
    {
    	return static::get();
    }
    public function updateData($slug,$input)
    {
        return static::where('page_slug',$slug)->update(array_only($input,$this->fillable));
    }
}
