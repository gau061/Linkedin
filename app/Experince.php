<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experince extends Model
{
	protected $table = 'experinces';
    protected $fillable = ['user_id','title','company','location','from','to','description'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function getData($id)
    {
    	return static::where('user_id',$id)->get();
    }
    public function updateData($id,$input)
    {
        return static::where('id',$id)->update(array_only($input,$this->fillable));
    }
}
