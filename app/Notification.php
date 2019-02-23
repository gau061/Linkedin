<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Requests;
use DB;
class Notification extends Model
{
     public function countReq()
     {
      $id = chackeAuthUser();
      return  DB::table('friend_request')
 			->select('friend_request.*','frontusers.firstname','frontusers.lastname','frontusers.profile_pic','frontusers.country','frontusers.state','frontusers.city','frontusers.unique_id')
 			->join('frontusers','frontusers.id','=','friend_request.sender_id')
 			->where('friend_request.reciver_id',$id)
 			->where('friend_request.request_status','Pending')
 			->get();
    }

    public function Connected()
    {
      $id = chackeAuthUser();
  
      $first = DB::table('friend_request')->select('friend_request.*','reciver_id AS FRIEND_ID')
                ->where('sender_id', $id)
                ->where('request_status', 'Connected');

      $second = DB::table('friend_request')->select('friend_request.*','sender_id AS FRIEND_ID')
                ->where('reciver_id', $id)
                ->where('request_status', 'Connected')
                ->union($first)
                ->get();

      return $second;
    }

    public function know()
    {
      
        $first = DB::table('friend_request')->select('friend_request.*')
            ->where('sender_id',chackeAuthUser())
            ->Orwhere('reciver_id',chackeAuthUser())
            ->where('request_status', 'Connected')
            ->get();

        return $first;
    }

    public function frontoffriend()
    {
        $frdlist = $this->Connected();
        $friendArray = array();
        foreach ($frdlist as $key => $value) {
          $friendArray[] = $value->FRIEND_ID;
        }       

        $first = DB::table('friend_request')->select('friend_request.request_status','reciver_id AS FRIEND_ID')
                ->distinct('friend_request.reciver_id')
                ->where('request_status', 'Connected')
                ->whereIn('sender_id', $friendArray)
                ->whereNotIn('reciver_id', $friendArray)
                ->where('reciver_id','!=', chackeAuthUser());
              
        $second = DB::table('friend_request')->select('friend_request.request_status','sender_id AS FRIEND_ID')
                ->distinct('friend_request.sender_id')
                ->where('request_status', 'Connected')
                ->whereIn('reciver_id', $friendArray)
                ->whereNotIn('sender_id', $friendArray)
                ->where('sender_id','!=', chackeAuthUser())                
                ->union($first)
                ->get();

      return $second;

    }

    public function RecConec()
    {
      $id = chackeAuthUser();
  
      $first = DB::table('friend_request')->select('friend_request.*','reciver_id AS FRIEND_ID')
                ->where('sender_id', $id)
                ->where('request_status', 'Connected');

      $second = DB::table('friend_request')->select('friend_request.*','sender_id AS FRIEND_ID')
                ->where('reciver_id', $id)
                ->where('request_status', 'Connected')
                ->union($first)
                ->take(15)
                ->orderBy('created_at','DESC')
                ->get();

      return $second;
    }
}


