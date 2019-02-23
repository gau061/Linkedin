<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupnotinterested extends Model
{
    protected $table = 'groupnotinteresteds';
    protected $fillable = ['group_id','user_id'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function existsin($input)
    {
    	return static::where('group_id',$input['group_id'])
    	->where('user_id',$input['user_id'])
    	->get();
    }
    public function deleteinterestedgroup($input)
    {
    	return static::where('group_id',$input['group_id'])
    	->where('user_id',$input['user_id'])
    	->delete();
    }
}
