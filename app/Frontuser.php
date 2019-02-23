<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Frontuser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'frontusers';
	
 	protected $fillable = ['firstname','lastname','status','profile_pic','cover_pic','aboutus','gender','birthdate','email','password','remember_token','cellphone','website','country','state','city','postalcode','address','reason','other_reason','unique_id'];

 	protected $hidden = ['password','remember_token'];

 	public function createData($input)
 	{
 		return static::create(array_only($input,$this->fillable));
 	}
 	public function avtivation($token)
 	{
 		return static::where('remember_token',$token)->first();
 	}
 	public function tokenUpdate($id)
 	{
 		return static::where('id',$id)->update(['status'=>1,'remember_token'=>str_random(60)]);
 	}
 	public function checkmail($email)
 	{
 		return static::where('email',$email)->first();
 	}
 	public function password_update($token,$password)
 	{
 		return static::where('remember_token',$token)->update(['password' => $password]);
 	}
 	public function tokeUpdate($email,$token)
 	{
 		return static::where('email',$email)->update(['remember_token' => $token]);
 	}
 	public function findData($id)
 	{
		return static::where('id',$id)->first();
 	}
 	public function UpdatedataPro($id, $input)
 	{
 		return static::where('id',$id)->update(array_only($input,$this->fillable));
 	}
 	public function updateUserpwd($id,$pwd)
 	{
 		return static::where('id',$id)->update(['password'=>$pwd]);
 	}
 	public function close($id,$res,$other_res)
 	{
 		return static::where('id',$id)->update(['status' => 2,'reason'=>$res,'other_reason'=>$other_res]);
 	}
 	public function fetchData()
 	{
 		return static::get();
 	}
 	public function getUserList()
 	{
 		return static::select('frontusers.*')
 		->orderBy('id','desc')
 		->take(8)
 		->get();
 	}
 	public function profileFetch($id)
 	{
 		return static::where('unique_id',$id)->first();
 	}
 	public function updateProfile($id,$input)
 	{
 		return static::where('id',$id)->update(array_only($input,$this->fillable));
 	}

 	public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function finduser($id)
 	{
 		//dd($id);
		return static::where('id',$id)->first();
 	}
   public function searchUser($queryData){
    $GLOBALS['queryData'] = $queryData;
    $data = static::whereNotIn('frontusers.id',function($query){
      $query->select('group_requests.user_id')->from('group_requests')
      ->where('group_requests.user_id','!=',chackeAuthUser());
    })
    ->where('frontusers.id', '!=', chackeAuthUser())
    ->where(function ($query) {
    $query->where('firstname','LIKE','%'.$GLOBALS['queryData'].'%')
    ->Orwhere('lastname','LIKE','%'.$GLOBALS['queryData'].'%')
    ->Orwhere('email','LIKE','%'.$GLOBALS['queryData'].'%');
    })
    ->get();
    return $data;
  }
   

}
