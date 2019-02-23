<?php
namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Validator;
use App\Group_profile;
use App\Industry;
use App\Frontuser;
use App\GroupRequest;
use App\GroupMember;
use App\Groupfeed;
use App\Notification;
use DB;
use Mail;
use App\Commonnotification;

class GroupController extends HomeController {
    public function __construct() {
        parent::__construct();
        $this->group_profile = new Group_profile;
        $this->industry = new Industry;
        $this->frontUser  = new Frontuser;
        $this->grouprequest = new GroupRequest;
        $this->groupMember = new GroupMember;
        $this->groupfeed = new Groupfeed;
        $this->notification = new Notification;
        $this->commonnotify=new Commonnotification;

    }

    /* INDEX */
    public function groupindex($groupid){
        
        $group=$this->group_profile->selectmygroup($groupid);
        // dd($group);
        $uid=auth()->guard('frontuser')->user()->id;
        $members = $this->groupMember->groupMembersList($groupid);
        $ismember=$this->groupMember->ismember($groupid,$uid);
        $dispaymember = $this->group_profile->groupprofile($groupid);
        $manage_group = $this->groupMember->Manageleavebtn($groupid,$uid);
        $user_type = $this->groupMember->joingroupbtn($groupid,$uid);
        // dd($user_type);
        $req_status = $this->grouprequest->joingroupbtn1($groupid,$uid);
        // dd($req_status);
        /*GroupFeed*/
        $groupfeed = $this->groupfeed->getGroupFeed($groupid);
            // dd($groupfeed); 
            $nextURL = $groupfeed->nextPageUrl();
            $lastURL = $groupfeed->lastPage() - 1;
            if(isset($_GET['page']) ){
                $nextURL = $groupfeed->nextPageUrl();
                $loadview = view('theme.groupfeeds.groupfeedLoad', ['groupfeed' => $groupfeed],['user_type' => $user_type],['req_status'=>$req_status])->render();
                return response()->json(['nextURL' => $nextURL, 'groupfeed' => $loadview]);
            }
            $recConn = $this->notification->RecConec();
            /* End GroupFeed */
        return view('theme.groups.index',compact('group','members','manage_group','user_type','req_status','con','ismember','dispaymember','groupfeed', 'nextURL','lastURL','recConn'));

 }
  
    /* CREATE GROUP */
    public function groupCreate(){
       $industryname = $this->industry->getdata(); 
        return view('theme.groups.creategroup',compact('industryname'));
    }
    public function groupInsert(Request $request){
        $input = $request->all();
        $group_id = str_shuffle(time());
        
        $this->validate($request,[
            'group_title' => 'required',
            'description' => 'required',
            'group_image' => 'required',
            'industry'    => 'required',
            'group_rules' => 'required',
        ]);

        if($input['group_image'] != null) {
            $path = 'user/Group_profile/';
            $imagedata = uploadCustomeImage($input['group_image'],$path,'pImage','crop',150,150);
            $input['group_image']= $imagedata;
        }
        $input['slug'] = str_slug($input['group_title']);
        $input['user_id'] = auth()->guard('frontuser')->user()->id;
        $input['group_id'] = $group_id;
        $data = $this->group_profile->insertData($input);

        $group=array();
        $group['group_id']=$group_id;
        $group['user_id']=auth()->guard('frontuser')->user()->id;
        $group['user_type']='Group Owner';

        $this->groupMember->createData($group);

        notificationMsg('success',$this->operationMsg('custom','Group is created.'));
        return redirect()->route('group.usergroups');
    }


    /*Search User To Invite*/
    public function searchuser(Request $request) {

        $gid = explode('/',\URL::previous());
        //dd($gid);
        (int)$groupid = $gid[5];
        $grid = (int)$groupid;
        $query = $request->get('query');


        $user = $this->frontUser->searchUser($query);

        // $rqc = $this->grouprequest->getGroupReq();
        // dd($rqc,$grid);
        // foreach ($rqc as $key => $value) {

        //     if(array_key_exists((int)$groupid,(int)$key)){
        //         echo 'treu';
        //     }else{
        //         echo "false";
        //     }
        // }
        // in_array($group, $rqc);


        $data=array();

        foreach ($user as $key => $users) {
                $data[]=array('id'=>user_data($users->id)->user_id,'name'=>$users->firstname.' '.$users->lastname.' - '.$users->email);
        }
        if(count($data)):
            return response()->json($data);
        else:
            return ['name' => 'Record Not Found.'];
        endif;
    }

    /* Insert Invited User */
    public function groupMemberInvite(Request $request){
        $input = $request->all();
        $data=array();
        $data['name']=$input['search'];
        $user_email = explode('- ',$data['name']);
        $Tomail = $user_email[1];
        $id=chackeAuthUser();

        $request_user_name=user_data($id)->Name;
        $user_id = user_data($user_email[1])->id;
        // dd($user_id);
        $user_name = user_data($user_email[1])->Name;

        if(isset($user_email[1])) {
            $userdata=array();
            $userdata['group_id']=$input['gid'];
            $gid = $userdata['group_id'];
            // dd($gid);
            $userdata['user_id']=$user_id;
            $userdata['group_user_status'] = 'Invited';
            $groupinfo=$this->group_profile->groupprofile($gid);
            
            $userinfo =  array();
            $userinfo['user_id'] = $userdata['user_id'];

            $userinfo['group_id'] = $gid;
            
            $userinfo['name'] = $user_name;
            $userinfo['email'] = $user_email[1];
            $userinfo['ToName'] = $request_user_name;
            $userinfo['groupImage'] = getImage($groupinfo['group_image']);
             // dd($userinfo['groupImage']);
            $userinfo['user_unique']=user_data($id)->user_id;
            $userinfo['group_title'] = $groupinfo['group_title'];
            // $userinfo['groupid']=$gid;
            $userinfo = (object) $userinfo;
             
            Mail::send('theme.email.invitationmail',['userinfo'=>$userinfo],function($message) use ($Tomail){
            $message->from(frommail(), forcompany());
            $message->to($Tomail);
            $message->subject("I have invited you to join in my group");
          });
            /*insert notification table*/
            $notifyinput['user_id']=$userdata['user_id'];
            $notifyinput['request_user_id']=chackeAuthUser();
            $notifyinput['notification_type']='group_invitation';
            $notifyinput['notification_id']=$gid;
            
            $this->commonnotify->createData($notifyinput); 

            $this->grouprequest->createData($userdata);
            notificationMsg('success',$this->operationMsg('custom','User is Invited. . . '));
            return redirect()->route('group.manage',[$gid,'invited']);
        } 
    }
    

/* SELECT GROUP */

    public function groupSelect(){
        
        $uid=auth()->guard('frontuser')->user()->id;
        $mygroup = $this->groupMember->dispayGroup($uid);
        if (is_null($mygroup)){
            \App::abort(404, 'Page Not Found.');
        }
        return view('theme.groups.mygroup',compact('mygroup'));
    }

    /* DISCOVER GROUP */
    public function discoverGroup() {
        //dd('yes');
        $uid=auth()->guard('frontuser')->user()->id;
        $data=$this->group_profile->getdiscovergroup($uid);
        //dd($data);
        return view('theme.groups.discover-group',compact('data'));
    }

    /* MANAGE GROUP */
    public function groupManage($group_id) {
        $url = \URL::current();
        $activ = explode('/', $url);
        $active = isset($activ)?isset($activ[6])?$activ[6]:'dashboard':'';
        $data = Group_profile::where('group_id',$group_id)->first();
        if (is_null($data)){
            \App::abort(404, 'Page Not Found.');
        }
        $industryname = $this->industry->getdata();
        $uid=auth()->guard('frontuser')->user()->id;
        $admin = $this->groupMember->selectAdmin($group_id);
        $groupdata = $this->group_profile->selectGroupTitle($uid,$group_id);
        $pendingUser = $this->grouprequest->userPendingRequest($group_id);
        //dd($pendingUser);
        $mygroup = $this->group_profile->selectmygroup($group_id);
        $members = $this->groupMember->groupMembersList($group_id);
        $invitedmember = $this->grouprequest->selectInvitedMember($group_id);
        return view('theme.groups.manage-group', compact('active','data','industryname','admin','groupdata','pendingUser','mygroup','members','group_id','invitedmember'));
    }   

    /* UPDATE GROUP */
    public function groupUpdate(Request $request, $id) {
        $input = $request->all();
        if(isset($input['group_image']) && ($input['group_image']) != Null) {
            $path ='user/Group_profile/';
            $imagedata = uploadCustomeImage($input['group_image'],$path,'pImage','crop',150,150);

            if(!empty($input['old_image'])) {
                image_delete($input['old_image']);
            }
            $input['group_image']= $imagedata;
            $this->group_profile->updateGroupProfile($id,$input);
        } else {
            $input['group_image'] = $input['old_image'];
            $this->group_profile->updateGroupProfile($id,$input);
        }
        notificationMsg('success',$this->operationMsg('custom','Group Profile Updated Successfully...'));
        return redirect()->route('group.usergroups');
    }

    /* Group Delete */
    public function groupDelete($group_id){ 
        $uid=auth()->guard('frontuser')->user()->id;
        $groupdata = $this->group_profile->selectGroupTitle($uid,$group_id);
        $data=array();
        foreach($groupdata as $key=>$value)
        {
            $data=$value['group_title'];
        }
        $groupname=$data;
        notificationMsg('success',$this->operationMsg('custom', $groupname.''.' is deleted. . .'));
        $deletegroupprofiles=$this->group_profile->deleteGroup($group_id);
        $deletegrouprequest=$this->grouprequest->deleterequest($group_id);
        $deletegroupmember=$this->groupMember->deletegroupmember($group_id);
        return route('group.usergroups');
    }

    /* Group Notification */

        public function groupnotification(){
        $data=$this->grouprequest->getinvitegroup();
        return view('theme.groups.group-notification',compact('data'));
        }

    /*Group Member Remove */
        public function groupmemberremove($gid,$uid)
        {
        $name=user_data($uid)->Name;
        notificationMsg('success',$this->operationMsg('custom',$name.''.' is remove from your group'));
        $data=$this->grouprequest->deletememberrequest($gid,$uid);
        $deletem=$this->groupMember->deletemember($gid,$uid);
        return route('group.manage',[$gid,'members']);
       }

    /*Leave Group*/
    public function LeaveGroup($gid){
        $uid=auth()->guard('frontuser')->user()->id;
        $Name=user_data($uid)->Name;
        notificationMsg('success',$this->operationMsg('custom',$Name.''.' Is Leave This Group'));
        $data=$this->grouprequest->deletememberrequest($gid,$uid);
        $deleteMember=$this->groupMember->deletemember($gid,$uid);
        return route('group.usergroups');
    }


    /*search group */
    public function searchgroup(Request $request)
    {
        $query = $request->get('query');
        $group=  $this->group_profile->groupsearch($query);
        
        $data=array();
        foreach ($group as $groups) {
            $data[]=array('id'=>$groups->group_id,'name'=> $groups->group_title);
        }
        if(count($data)):
            return response()->json($data);
        else:
            return ['name' => 'Record Not Found.'];
        endif;
    }

    /*search all group */
    public function searchallgroup(Request $request)
    {
        $query = $request->get('searchgroup');
        
        if(is_null($query))
        {
            return redirect()->back();
        }
        else
        {
            $data=  $this->group_profile->groupsearch($query);
            //dd($data);
            return view('theme.groups.groupview',compact('data'));
        }
    }

    /*active group*/
    public function activegroup($groupid)
    {
        $this->group_profile->groupactive($groupid);
        return redirect()->route('group.usergroups'); 
    }
}