<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\GroupRequest;
use App\GroupMember;
use App\Group_profile;
use App\Groupnotinterested;
use Mail;
use App\Commonnotification;

class GroupRequestController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
        $this->grouprequest = new GroupRequest;
        $this->groupmember=new GroupMember;
        $this->groupprofile=new Group_profile;
        $this->notinterest=new Groupnotinterested;
        $this->commonnotify=new Commonnotification;
    }
    public function joingrouprequest($slug,$groupid)
    {
    	$input['group_id'] = $groupid;
    	$input['user_id']  = chackeAuthUser();
    	$tokens = str_random(60);
        $input['remember_token']=$tokens;
        //dd($input);

        if ($slug == 'send') {
            /* check in groupnot interested table*/
            $interested=$this->notinterest->existsin($input);
            if(!$interested->isEmpty()){
                $interested=$this->notinterest->deleteinterestedgroup($input);  
            }  
            /*Email*/
            $data=$this->groupprofile->groupadmin($groupid);

            $userdata = array();
            foreach($data as $key=>$value){
                $userdata = $value;
            } 
            $id=chackeAuthUser();
            $requested_username = user_data($id)->Name;
            $userdata['requid']=$id;
            $userdata['user_unique']=user_data($id)->user_id;
            $userdata['FromName'] =  $requested_username;
            $userdata['propic']=user_data($id)->ProPic;
            $userdata['city']=user_data($id)->city;
            $userdata['state']=user_data($id)->state;
            $userdata['country']=user_data($id)->country;
            $userdata = (object) $userdata;
            $userdata['token']=$tokens;
            

            $mail= array($userdata->email);
        
            Mail::send('theme.email.requestedmail',['userdata'=>$userdata],function($message) use ($mail)
            {
                $message->from(frommail(), forcompany());
                $message->to($mail);
                $message->subject("Request to join in  group");
            });

        /*insert notification table*/
            $notifyinput['user_id']=$userdata['user_id'];
            $notifyinput['request_user_id']=chackeAuthUser();
            $notifyinput['notification_type']='group_request';
            $notifyinput['notification_id']=$input['group_id'];
            //dd($notifyinput);
            $this->commonnotify->createData($notifyinput);

            /*End Emailcode*/
            $this->grouprequest->createData($input);
            notificationMsg('success',$this->operationMsg('custom','Your Request Successfully Sent.'));
            

        }elseif($slug == 'acceptgroupinvitation') {
            $id=chackeAuthUser();
        
            $requested_username = user_data($id)->Name;
            
            $user_data=$this->groupprofile->groupadmin($groupid);
            
            foreach($user_data as $key=>$value)
            {
                $userdata = $value;
            } 

            $uid=$userdata->user_id;
            $mail = $userdata->email;
            $name= user_data($uid)->Name;
        
            $groupinfo=$this->groupprofile->groupprofile($groupid);

            $user = array();
            $user['group_id'] = $groupid;
            $user['Name']  =   $name;
            $user['user_unique']=user_data($id)->user_id;
            $user['groupImage'] = getImage($groupinfo['group_image']);
            $user['group_title'] = $groupinfo['group_title'];
            $user['to']=user_data($input['user_id'])->Name;
            $user = (object) $user;
            
            Mail::send('theme.email.useracceptinvitation',['user'=>$user],function($message) use ($mail)
            {
                $message->from(frommail(), forcompany());
                $message->to($mail);
                $message->subject("Invitation Accepted Mail");
            });

            $data=$this->grouprequest->acceptinvitation($input);
            notificationMsg('success',$this->operationMsg('custom','Invitation is Accepted.'));

            $member=array();
            $member['group_id']=$input['group_id'];
            $member['user_id']=$input['user_id'];
            $member['user_type']='Member';

            if (!is_null($data)){
                $this->groupmember->createData($member);
            }

        }elseif($slug=='notinterested'){
            $input['group_id'] = $groupid;
            $input['user_id']  = chackeAuthUser();
            $this->notinterest->createData($input);
        }
        else{

            $user_data=$this->groupprofile->groupadmin($groupid);

            foreach($user_data as $key=>$value){
               $userdata = $value;
            }
            
            $tomail=$userdata->email;
            $touserid=$userdata->user_id;
            $sendername =user_data($touserid)->Name;
            $id=chackeAuthUser();
            $fromname = user_data($id)->Name;
            $frompic = user_data($id)->user_id;
            
            $admin=array();
            $admin['fromname']=$fromname;
            $admin['sendername']=$sendername;
            $admin['gtitle']=$userdata->group_title;
            $admin['gid']=$userdata->group_id;
            $admin['gimg']=getImage($userdata->group_image);
            $admin['tomail']=$userdata->email;
            $admin['touserid']=user_data($input['user_id'])->user_id;
           
            $admin = (object) $admin;
            //dd($admin);
            Mail::send('theme.email.declineuserrequest',['admin'=>$admin],function($message) use ($tomail)
            {
                $message->from(frommail(), forcompany());
                $message->to($tomail);
                $message->subject("Decline Invitation");
            });

            $this->grouprequest->invitationremove($input);
            notificationMsg('success',$this->operationMsg('custom','Your Invitation is decline.'));
        }
        return redirect()->back();
    }

    
    public function joingroupstatus($status,$groupid,$request_uid,$token='')
    {
        //dd($token);
        $gettoken=$this->grouprequest->gettoken($groupid,$request_uid);
        if($status == 'accept'){
            //dd($gettoken);
            if(!is_null($gettoken))
            {
                if($token==$gettoken['remember_token'])
                {
                    $data=$this->grouprequest->accept($groupid,$request_uid,$token);

                    notificationMsg('success',$this->operationMsg('custom','Request is Accepted.'));
                    $input=array();
                    $input['group_id']=$groupid;
                    $input['user_id']=$request_uid;
                    $input['user_type']='Member';
                    $groupadmin=chackeAuthUser();
                    
                    $sid  = user_data($request_uid)->id;
                    $Toname = user_data($request_uid)->Name;
                    $Tomail = user_data($request_uid)->Email;
                    $Fromname = user_data($groupadmin)->Name;
                    $groupinfo=$this->groupprofile->groupprofile($groupid);
                    
                    $user = array();
                    $user['group_id'] = $groupid;
                    $user['Name'] = $Toname;
                    $user['groupImage'] = getImage($groupinfo['group_image']);
                    $user['group_title'] = $groupinfo['group_title'];
                    $user['user_unique']=user_data($groupinfo['user_id'])->user_id;
                    $user['toname'] = user_data($groupinfo['user_id'])->Name;
                    $user['user_id'] = $input['user_id'];
                    $user['ToEmail'] = $Tomail;
                    $user['Fromname'] = $Fromname;
                     //dd($user);
                    $user = (object) $user;
                    if (!is_null($data)){
                        Mail::send('theme.email.adminacceptrequest',['user'=>$user],function($message) use ($Tomail){
                            $message->from(frommail(), forcompany());
                            $message->to($Tomail);
                            $message->subject("Congratulation,Admin Has been Accept your Request");
                        });
                   		$this->groupmember->createData($input);
                	}
                }
                else{
                    notificationMsg('success',$this->operationMsg('custom','You have already accept this request.'));
                }
            }
        }elseif($status=='ignore'){

            if(!is_null($token)){
                
                if($token==$gettoken['remember_token'])
                {
                    $groupadmin=chackeAuthUser();
                    $Toname = user_data($request_uid)->Name;
                    $Tomail = user_data($request_uid)->Email;
                    $Fromname = user_data($groupadmin)->Name;
                    // dd($Fromname);
                    $groupinfo=$this->groupprofile->groupprofile($groupid);
                    $mail=user_data($groupinfo['user_id'])->Email;
                    //dd($groupinfo);
                    $decline = array();
                    $decline['group_id'] = $groupid;
                    $decline['groupImage'] = getImage($groupinfo['group_image']);
                    $decline['user_unique']=user_data($groupinfo['user_id'])->user_id;

                    $decline['toname'] = user_data($groupinfo['user_id'])->Name;
                    $decline['group_title'] = $groupinfo['group_title'];
                    $decline['Name'] = $Toname;
                    $decline['tounique_id']=user_data($request_uid)->user_id;
                    $decline['Fromname'] = $Fromname;
                    $decline['ToEmail'] = $Tomail;
                     //dd($decline);
                    $decline = (object) $decline;
                     //dd($Tomail);
                    Mail::send('theme.email.declinerequestedmail',['decline'=>$decline],function($message) use ($Tomail){
                        $message->from(frommail(), forcompany());
                        $message->to($Tomail);
                        $message->subject("Sorry,Decline your Request");
                     });

                    /*delete notifications*/
                    $notifyinput['user_id']=$groupinfo['user_id'];
                    $notifyinput['request_user_id']=chackeAuthUser();
                    $notifyinput['notification_id']=$groupid;
                    $this->commonnotify->deletenotifygroupreq($notifyinput);
                    /*end notifications*/

                    $data=$this->grouprequest->ignore($groupid,$request_uid);
                    notificationMsg('success',$this->operationMsg('custom','cancel request of invited user.'));
                }
                else{
                    notificationMsg('success',$this->operationMsg('custom','you have already accept this request so you cannot decline this request.'));
                }
            }
        }
        else{
            $groupadmin=chackeAuthUser();
            $Toname = user_data($request_uid)->Name;
            $Tomail = user_data($request_uid)->Email;
            $Fromname = user_data($groupadmin)->Name;
            // dd($Fromname);
            $groupinfo=$this->groupprofile->groupprofile($groupid);
            //dd($groupinfo);
            $decline = array();
            $decline['group_id'] = $groupid;
            $decline['groupImage'] = getImage($groupinfo['group_image']);
            $decline['user_unique']=user_data($groupinfo['user_id'])->user_id;
            $decline['toname'] = user_data($groupinfo['user_id'])->Name;
            $decline['group_title'] = $groupinfo['group_title'];
            $decline['Name'] = $Toname;
            $decline['Fromname'] = $Fromname;
            $decline['ToEmail'] = $Tomail;
            //dd($decline);
            $decline = (object) $decline;
             
            Mail::send('theme.email.admindeclinerequest',['decline'=>$decline],function($message) use ($Tomail){
                $message->from(frommail(), forcompany());
                $message->to($Tomail);
                $message->subject("Sorry,Decline your Request");
             });

            /*delete notifications*/
            $notifyinput['user_id']=$request_uid;
            $notifyinput['request_user_id']=chackeAuthUser();
            $notifyinput['notification_id']=$groupid;
            //dd($notifyinput);
            $this->commonnotify->deletenotifygroupinvite($notifyinput);
            /*end notifications*/

            $data=$this->grouprequest->ignore($groupid,$request_uid);
            notificationMsg('success',$this->operationMsg('custom','Decline Request of User.'));
        }
            
        return redirect()->route('groups.index',[$groupid]); 
    }


}
