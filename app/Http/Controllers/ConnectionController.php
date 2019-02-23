<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Frontuser;
use App\Notification;
use App\Requests;
use DB;
class ConnectionController extends HomeController
{
	public function __construct()
    {
        parent::__construct();
        $this->notification = new Notification;
        $this->request = new Requests;
    }

    public function index()
    {   
        $know       = $this->notification->know();
        $fof    = $this->notification->frontoffriend();
        $connect    = $this->notification->countReq();
        $requ_check = $this->request->checkRequestFof();
    	return view('theme.connection.connection',compact('connect','know','fof','frendlist','requ_check'));
    }

    public function search(Request $request) {

        $query = $request->get('query');
        
  		$user=Frontuser::where('firstname','LIKE','%'.$query.'%')
            ->Orwhere('lastname','LIKE','%'.$query.'%')
            ->Orwhere('email','LIKE','%'.$query.'%')
            ->get();

       $data=array();
        foreach ($user as $users) {
            $data[]=array('id'=>user_data($users->id)->user_id,'name'=>$users->firstname.' '.$users->lastname.' - '.$users->email);
        }

        if(count($data)):
            return response()->json($data);
        else:
            return ['name' => 'Record Not Found.'];
        endif;
    }

    public function connList()
    {
        $connect = $this->notification->Connected();
        return view('theme.connection.connectionlist',compact('connect'));
    }

    public function connectdList(Request $request)
    {
        $input = $request->all();

        $id = chackeAuthUser();

        $data = DB::table('friend_request')
            ->select('friend_request.*','frontusers.firstname','frontusers.lastname','frontusers.profile_pic','frontusers.country','frontusers.state','frontusers.city','frontusers.unique_id')
            ->join('frontusers','frontusers.id','=','friend_request.sender_id')
            ->where('friend_request.reciver_id',$id)
            ->where('friend_request.request_status','Connected')
            ->where('frontusers.firstname','LIKE','%'.$input['data'].'%')
            ->get();
            
        return response()->json($data);
    }
}
