<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skills'];

    public function getData()
    {
    	return static::orderBy('id','desc')->get();
    }
    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function updateData($id,$input)
    {
    	return static::where('id',$id)->update(array_only($input,$this->fillable));
    }
    public function deleteData($id)
    {
    	return static::where('id',$id)->delete();
    }
    public function skillsGet()
    {
        return static::get();
    }
    public function skillGetWithName($input)
    {   
        return static::whereIn('id',$input)->get();
    }
}
