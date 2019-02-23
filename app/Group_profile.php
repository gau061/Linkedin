<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group_profile extends Model
{
	protected $table = 'group_profiles';
	protected $fillable = ['group_id','user_id','group_title','slug','description','group_image','industry','group_status','group_rules'];
  	
  	public function insertData($input)	{
   		return static::create(array_only($input,$this->fillable));
   	}

   	public function editProfile($id) {
       		return static::find($id);
     }
     public function updateGroupProfile($id,$input) {
       		return static::find($id)->update(array_only($input,$this->fillable));     
     }
     
    public function selectdata($uid){
      return static::select('group_profiles.*')
      ->where('user_id',$uid)
      ->get();
    }

    public function selectmygroup($group_id){
      return static::select('group_profiles.*')
      ->where('group_id',$group_id)
      ->select("group_profiles.*",
        DB::raw("(SELECT COUNT(group_members.user_id) FROM group_members
              WHERE group_members.group_id = group_profiles.group_id
             GROUP BY group_members.group_id) as totalmember"))
      ->get();
    }

    public function selectGroupTitle($uid,$groupid){
        return static::select('group_profiles.group_title','group_profiles.group_id')
        ->where('group_profiles.group_id',$groupid)
        ->where('group_profiles.user_id',$uid)
        ->get();
    }

    
    public function getdiscovergroup(){
      $data = static::whereNotIn('group_profiles.group_id',function($query){
        $query->select('group_requests.group_id')->from('group_requests')
        ->where('group_requests.user_id', chackeAuthUser());
      })
      ->whereNotIn('group_profiles.group_id',function($query){
        $query->select('groupnotinteresteds.group_id')->from('groupnotinteresteds')
        ->where('groupnotinteresteds.user_id', chackeAuthUser());
      })
      ->where('group_profiles.user_id', '!=', chackeAuthUser())
      ->where('group_status',1)
      ->select("group_profiles.*",
                    DB::raw("(SELECT COUNT(group_members.user_id) FROM group_members
                      WHERE group_members.group_id = group_profiles.group_id
                      GROUP BY group_members.group_id) as totalmember"))
      ->get();
      return $data;
    }
    
    public function deleteGroup($groupid){
       $data = static::where('group_id',$groupid);
        if(!empty($data->image)){
          image_delete($data['group_image']);
        }
        $data->delete();
    }
        
      public function groupadmin($groupid)
      {
         return static::select('group_profiles.*','frontusers.firstname','frontusers.lastname',
          'frontusers.email')
         ->join('frontusers','frontusers.id','=','group_profiles.user_id')
         ->where('group_id',$groupid)
         ->get();
      }

      public function groupprofile($gid)
      {
        return static::select('*')
        ->where('group_id',$gid)
        ->first();
      }

      public function groupsearch($queryData)
      {
        $GLOBALS['queryData'] = $queryData;
         $data = static::where('group_profiles.user_id', '!=', chackeAuthUser())
         ->where('group_profiles.group_status',1)
          ->where(function ($query) {
        $query->where('group_title','LIKE','%'.$GLOBALS['queryData'].'%');
      })
      ->select("group_profiles.*",
              DB::raw("(SELECT COUNT(group_members.user_id) FROM group_members
                WHERE group_members.group_id = group_profiles.group_id
                GROUP BY group_members.group_id) as totalmember"))
      ->get();
      return $data;
      }

      public function groupactive($gid)
      {
        return static::where('group_id',$gid)
        ->update(['group_status'=> 1]);
      }

     
}
