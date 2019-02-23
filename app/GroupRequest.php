<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class GroupRequest extends Model
{
    protected $table = 'group_requests';

    protected $fillable = ['group_id','user_id','group_user_status','remember_token'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }

    public function userPendingRequest($groupid)
    {
        return static::select('user_id','group_id','remember_token')
        ->where('request_status','Pending')
        ->where('group_user_status','Requested')
        ->where('group_id',$groupid)
        ->get();
    }
    
    public function accept($groupid,$request_uid,$token)
    {
      //dd($token);
        return static::where('group_id',$groupid)
        ->where('user_id',$request_uid)
        ->update(['request_status' => 'Connected','remember_token'=>str_random(60)]);
        
        
    }
    public function ignore($groupid,$request_uid)
    {
        return static::where('group_id',$groupid)
        ->where('user_id',$request_uid)
        ->delete();
    }

    public function deleterequest($groupid){
      //dd($groupid);
       $data = static::where('group_id',$groupid);
       $data->delete();
    }

    public function selectInvitedMember($group_id) {
        return static::select('user_id','group_id')
        ->where('group_user_status','Invited')
        ->where('request_status','Pending')
        ->where('group_id',$group_id)
        ->get();
    }

    public function getinvitegroup(){
      
      return static::select('group_requests.*','group_profiles.*')
      ->join('group_profiles','group_profiles.group_id','=','group_requests.group_id')
      ->where('group_requests.group_user_status','Invited')
      ->where('group_requests.request_status','Pending')
      ->where('group_requests.user_id',chackeAuthUser())
      ->select("group_profiles.*",
        DB::raw("(SELECT COUNT(group_members.user_id) FROM group_members
        WHERE group_members.group_id = group_profiles.group_id
        GROUP BY group_members.group_id) as totalmember"))
      ->get();  
    }

    public function getnotify(){
      
      return static::select('group_requests.group_id','group_profiles.*')
      ->join('group_profiles','group_profiles.group_id','=','group_requests.group_id')
      ->where('group_requests.group_user_status','Invited')
      ->where('group_requests.request_status','Pending')
      ->where('group_requests.user_id',chackeAuthUser())
      ->select("group_profiles.*",
        DB::raw("(SELECT COUNT(group_members.user_id) FROM group_members
        WHERE group_members.group_id = group_profiles.group_id
        GROUP BY group_members.group_id) as totalmember"))
      ->count();  
    }
    public function acceptinvitation($input)
    {
        return static::where('group_id',$input['group_id'])
        ->where('user_id',$input['user_id'])
        ->update(['request_status' => 'Connected']);
    }
    public function invitationremove($input)
    {
        return static::where('group_id',$input['group_id'])
        ->where('user_id',$input['user_id'])
        ->delete();
    }

    public function deletememberrequest($gid,$uid){
      $data = static::where('group_id',$gid)
        ->where('user_id',$uid)
        ->delete();
    }
    
    public function joingroupbtn1($gid,$uid)
    {
      return static::where('group_id',$gid)
      ->where('user_id',$uid)
      ->first();
    }

    public function getGroupReq()
    { 
      return static::pluck('user_id','group_id');
    }

    public function gettoken($gid,$uid)
    {
      return static::where('group_id',$gid)
      ->where('user_id',$uid)
      ->first();
    }    
}
