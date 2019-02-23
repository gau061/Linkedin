<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','first_name','last_name','password','gender','contacts','profile_pic','status','email','remember_token','current_login','last_login','brith_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createData($input)
    {
        return static::create(array_only($input,$this->fillable));
    }
    public function getData()
    {
        return static::get();
    }
    public function checkValid($token)
    {
        return static::where('remember_token',$token)->first();
    }
    public function updateData($token,$pwd)
    {
        return static::where('remember_token',$token)->update(['password'=>$pwd]);
    }
    public function upDatetoken($email,$tok)
    {
        return static::where('email',$email)->update(['remember_token'=>$tok]);
    }
    public function findData($mail)
    {
        return static::where('email',$mail)->first();
    }
    public function updateUserData($input, $id)
    {
        return static::where('id',$id)->update(array_only($input,$this->fillable));
    }
    public function updateUserpwd($pwd,$id)
    {
        return static::where('id',$id)->update(['password'=>$pwd]);
    }
    public function countData()
    {
        return static::count();
    }
    public function findsData($id)
    {
        return static::where('id',$id)->first();
    }
    public function deleteData($id)
    {
        $data = static::where('id',$id)->first();

        if(!empty($data['profile_pic']))
        {
          $datas = image_delete($data['profile_pic']);
            $path = $datas['path'];
            $image = $datas['image_name'];
            $image_thum = $datas['image_thumbnail'];
            ImageUpload::removeFile($path,$image,$image_thum);
        }
        return $data->delete();
    } 
    public function setLoginTime($id,$input)
    {
        return static::where('id',$id)->update(['current_login'=>$input]);
    }
    public function updateLast_time($id,$input)
    {
        return static::where('id',$id)->update(['last_login'=>$input]);
    } 
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
