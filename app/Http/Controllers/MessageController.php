<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Frontuser;
use App\Notification;
use App\Message;
use DB;

class MessageController extends HomeController
{

	public function __construct()
	{
		parent::__construct();
        $this->frontuser = new Frontuser;
        $this->notification = new Notification;
		$this->message = new Message;
	}

    public function index($uniqueId=null) {   
        $datas  = Frontuser::where('unique_id',$uniqueId)->first();

        $send = array();
        if(!empty($datas))
            $send = $this->message->getMessaged($uniqueId);

        $data = $this->frontuser->profileFetch($uniqueId);
        $frndlist = $this->notification->Connected();
        $msgread = $this->message->getMesgList();
        $msgSeen = $this->message->getMesgRead();
        return view('theme.message.index',compact('data','frndlist','send','uniqueId','msgread','msgSeen'));
    }

    public function msgSend(Request $request,$recver_id) {
        $input = $request->all();

        if(is_null($input['message'])){
            return response()->json('Null');
        }else{
            $s_data = array();
            $s_data['sender_id']  = uniquequ_id();
            $s_data['reciver_id'] = $recver_id;
            $s_data['chatbox_id'] = 'S_'.uniquequ_id();
            $s_data['message']    = $input['message'];
            $this->message->createData($s_data);

            $r_data = array();
            $r_data['sender_id']  = uniquequ_id();
            $r_data['reciver_id'] = $recver_id;
            $r_data['chatbox_id'] = 'R_'.$recver_id;
            $r_data['message']    = $input['message'];
            $this->message->createData($r_data);
        }
        return response()->json(["message"=>$input['message'], "userImage"=>user_uniqueid_data(uniquequ_id())->ProPic]);
    }

    public function msgFetch($firend_uid) {
        $GLOBALS['u_id'] = $firend_uid;

        $send = $this->message->getMessaged($firend_uid);
        $userimage['user']      =  user_uniqueid_data(uniquequ_id())->ProPic;
        $userimage['friend']    =  user_uniqueid_data($firend_uid)->ProPic;
        return response()->json([$send,uniquequ_id(),$userimage]);
    }

    public function deleteData($uniqid)
    {
        $this->message->deleteMsg($uniqid);
        return response()->json('Message Coversation is Cleared.');
    }

    public function msgRead($sender_id)
    {
        Message::where('sender_id',$sender_id)->update(['read' => 1]);
        return response()->json('success');
    }

    public function newMsgFetch($sender_id)
    {
        $msg = Message::where('sender_id',$sender_id)
                ->where('reciver_id',uniquequ_id())
                ->where('chatbox_id','R_'.uniquequ_id())
                ->where('read',0)
                ->get();

        $data = array();
        foreach ($msg  as $key => $value) {
            $data[$key]['sender_id'] = $value->sender_id;
            $data[$key]['reciver_id'] = $value->reciver_id;
            $data[$key]['message'] = $value->message;
            $data[$key]['profile_pic'] = user_data($sender_id)->ProPic;
        }

        return response()->json($data,200);
    }
    public function newMsgStatus($sender_id)
    {
        $msg = Message::where('sender_id',$sender_id)
                // ->where('reciver_id',uniquequ_id())
                // ->where('chatbox_id','R_'.uniquequ_id())
                // ->where('chatbox_id','S_'.$sender_id)
                ->update(['read' => 1]);

        return response()->json('success',200);
    }
}
