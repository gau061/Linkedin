<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id', 'role_id'
    ];


    public $timestamps = false;

	public function addRoleUser($input)
    {	
        return static::create(array_only($input,$this->fillable));
    }

    public function updateRoleUser($id,$input)
    {
        return static::where('user_id',$id)->update(array('role_id' => $input));
    }

    public function getUserRole($id)
	{
		return static::where("user_id",$id)->first();
	}

    public function getRoleUser($id)
    {
        return static::select('role_user.*','roles.display_name as display_role')
                    ->where('user_id',$id)
                    ->join("roles","roles.id","=","role_user.role_id")
                    ->first();
    }
}	
