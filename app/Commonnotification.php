<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commonnotification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['user_id','request_user_id','notification_type','notification_id','notification_status'];

     public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function deletenotify($notifyinput)
    {
		return static::where('user_id',$notifyinput['user_id'])
        ->where('request_user_id',$notifyinput['request_user_id'])
        ->where('notification_type','friend_request')
        ->delete();
    }
    public function deletenotifygroupreq($notifyinput)
    {
		return static::where('user_id',$notifyinput['user_id'])
        ->where('request_user_id',$notifyinput['request_user_id'])
        ->where('notification_id',$notifyinput['notification_id'])
        ->where('notification_type','group_request')
        ->delete();
    }
    public function deletenotifygroupinvite($notifyinput)
    {
		return static::where('user_id',$notifyinput['user_id'])
        ->where('request_user_id',$notifyinput['request_user_id'])
        ->where('notification_id',$notifyinput['notification_id'])
        ->where('notification_type','group_invitation')
        ->delete();
    }
    public function deletesharenotify($id)
    {
    	return static::where('notification_id',$id)
    	->where('notification_type','post_share')
    	->delete();
    }
    public function deletelikenotify($getdata)
    {
    	return static::where('notification_id',$getdata['fid'])
    	->where('notification_type','post_like')
    	->where('request_user_id',$getdata['uid'])
    	->delete();
    }
    public function deletecommentnotify($id)
    {
    	return static::where('notification_id',$id)
    	->where('notification_type','post_comment')
    	->delete();
    }
    public function deletenpostnotification($id)
    {
    	return static::where('notification_id',$id)
    	->delete();
    }
}
