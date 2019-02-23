<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userlogin extends Model
{
    protected $table = 'user_login_data';

    protected $fillable = ['current_login','no_user'];

    public $timestamps = false;

    public function getData(){
        return static::take(5)->orderBy('current_login','DESC')->get();
    }
    public function createDate($input){
        return static::create(['current_login'=>$input]);
    }

    public function increase_user($input)
    {
        return static::where('current_login',$input)->increment('no_user',1);
    }

    public function descrse_user($input)
    {
        return static::where('current_login',$input)->decrement('no_user',1);
    }

}
