<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';
    protected $fillable = ['group_id','user_id','user_type'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
     public function groupMembersList($groupid)
    {
        return static::select('group_members.user_id','group_members.group_id','group_members.user_type')
        ->where('group_members.group_id',$groupid)
        ->get();
    }
    public function deletegroupmember($groupid){
      //dd($groupid);
       $data = static::where('group_id',$groupid);
       $data->delete();
    }

    public function selectAdmin($group_id){
        return static::select('group_members.group_id','group_members.user_type','group_members.user_id')
        ->where('user_type','=','Group Owner')
        ->where('group_members.group_id',$group_id)
        ->get();
    }
    public function countmember($gid)
    {
        $count = DB::table('group_members')
                 ->select('user_id', DB::raw('count(*) as total'))
                 ->groupBy('group_id')
                 ->where('group_id',$gid)
                 ->get();

    }
    public function deletemember($gid,$uid){
         $data = static::where('group_id',$gid)
        ->where('user_id',$uid)
        ->delete();
    }

   public function dispayGroup($uid){
    // dd($uid);
         return static::select('group_members.*','group_profiles.*')
        ->join('group_profiles','group_profiles.group_id','=','group_members.group_id')
        ->where('group_members.user_id',$uid)
        ->get();

    } 


     public function Manageleavebtn($group_id,$uid)
    {
      return static::select('group_members.user_type')
      ->where('group_id',$group_id)
      ->where('user_id',$uid)
      ->get();
    }
    
    public function ismember($gid,$uid){
      return static::select('user_type')
      ->where('user_id',$uid)
      ->where('group_id',$gid)
      ->first();
    }

   public function joingroupbtn($gid,$uid)
   {
      return static::select('user_type')
      ->where('group_id',$gid)
      ->where('user_id',$uid)
      ->first();
    }
    public function checkstatusconnect($gid,$user_id)
    {
      return static::select('group_members.*')
      ->where('group_id',$gid)
      ->where('user_id',$user_id)
      ->where('user_type','Member')
      ->first();
    }

}
