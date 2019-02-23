<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Requests;
use Mail;
use App\Commonnotification;


class RequestController extends HomeController
{
	public function __construct()
    {
        parent::__construct();
        $this->request = new Requests;
        $this->commonnotify=new Commonnotification;
    }

    public function request($slug,$request_id)
    {
    	$input['sender_id']  = chackeAuthUser();
    	$input['reciver_id'] = $request_id; 
        //dd($input);
    	$data = $this->request->checkRequest($input);
        if ($slug == 'send') {
            
            if(is_null($data)){
                $data=$this->request->createData($input);
                $sid=$data['reciver_id'];
                $tomail=user_data($sid)->Email;
                $rid=chackeAuthUser();
                //dd($tomail);
                $name=user_data($sid)->Name;
                $user=array();
                $user['uid']=$rid;
                $user['sname']=user_data($sid)->Name;
                $user['propic']=user_data($rid)->ProPic;
                $user['rname']=user_data($rid)->Name;
                $user['user_id']=user_data($rid)->user_id;
                $user = (object) $user;
                

                Mail::send('theme.email.frdreq_invitation',['user'=>$user],function($message) use ($tomail)
                {
                $message->from(frommail(), forcompany());
                $message->to($tomail);
                $message->subject("Related to friend request mail");
                });

                /*insert notification table*/
                $notifyinput['user_id']=$input['reciver_id'];
                $notifyinput['request_user_id']=chackeAuthUser();
                $notifyinput['notification_type']='friend_request';
                //dd($notifyinput);
                $this->commonnotify->createData($notifyinput);

                notificationMsg('success',$this->operationMsg('custom','Invitation sent to'.'  '.$name));
            }
            
        }elseif($slug == 'remove') {
            $this->request->ReqCancel($input);
            notificationMsg('success',$this->operationMsg('custom','Your Connection Remove.'));
        }
        else{
            $this->request->ReqCancel($input);
            $notifyinput['user_id']=$input['reciver_id'];
            $notifyinput['request_user_id']=chackeAuthUser();
            //dd($notifyinput);
            $this->commonnotify->deletenotify($notifyinput);
            notificationMsg('success',$this->operationMsg('custom','Your Request Successfully Cancel.'));

        }
    	return redirect()->back();
    }

    public function status($status,$sender_id)
    {
        $input['reciver_id'] = chackeAuthUser();

        if($status == 'accept'){
            $this->request->accept($sender_id,$input['reciver_id']);
            notificationMsg('success',$this->operationMsg('custom','Request is Accepted.'));
            return redirect()->back();       
        }else{
            $this->request->ignore($sender_id,$input['reciver_id']);
            $notifyinput['user_id']=$input['reciver_id'];
            $notifyinput['request_user_id']=$sender_id;
            //dd($notifyinput);
            $this->commonnotify->deletenotify($notifyinput);
            notificationMsg('success',$this->operationMsg('custom','Request is Ignore.'));
            return redirect()->back();       
        }
    }


}
