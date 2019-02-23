<?php

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function getRole()
    {
    	return static::pluck('display_name','id')->all();
    }

    public function getRoleId($role_id)
    {
        return static::where("id",$role_id)->first();
    }
}
