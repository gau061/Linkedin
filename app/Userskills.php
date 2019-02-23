<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Userskills extends Model
{
	protected $table = 'user_skills';
    protected $fillable = ['user_id','skills'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function getData($id)
    {
    	return  static::where('user_id',$id)->first();
    }
}
