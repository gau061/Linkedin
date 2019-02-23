<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
	protected $table = 'educations';
    protected $fillable = ['user_id','school','course','field','grade','activities','from','to'];

	public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function getData($id)
    {
    	return static::where('user_id',$id)->get();
    }
    public function UpdateData($input,$id)
    {
    	return static::where('id',$id)->update(array_only($input,$this->fillable));
    }
}
