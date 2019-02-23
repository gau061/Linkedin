<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Frontuser;
use App\Userskills;
use App\Skill;
use App\Experince;
use App\Education;
use App\Requests;
use App\Notification;
use App\Setting;
use File;
use Hash;
use Mail;
use Validator;
use Auth;
use App\GroupMember;

class UserController extends HomeController
{
    public function __construct()
	{
		parent::__construct();
        $this->frontUser  = new Frontuser;
        $this->skills     = new Skill;
        $this->userskills = new Userskills;
        $this->experince  = new Experince;
        $this->education  = new Education;
        $this->request    = new Requests;
        $this->notification    = new Notification;
        $this->settings    = new Setting;
        $this->groupMember = new GroupMember;
	}
    public function mailview()
    {
        return view('theme.requestedmail');
    }

 	public function index(){
 		return view('theme.feeds.feed');
 	}

 	public function store(Request $request)
 	{
 		$input = $request->all();
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:frontusers',
            'password'=>'required',
        ]);

        
        $tokens = str_random(60);
        $mail = [$request->email];

        $userdata = array();
        $userdata = [
            'firstname'     => $input['firstname'],
            'lastname'      => $input['lastname'],
            'email'         => $input['email'],
            'remember_token'=>  $tokens,
        ];
        $userdata = (object) $userdata;
       
        Mail::send('theme.email.registerUser',['userdata'=>$userdata],function($message) use ($mail)
        {
            $message->from(frommail(), forcompany());
            $message->to($mail);
            $message->subject("Activate Your Account");
        });

        
        $input['password'] = bcrypt($request->password);
        $input['unique_id'] = str_shuffle(time());
        $input['remember_token'] = $tokens;
        $data = $this->frontUser->createData($input);
        return redirect()->route('user.login')->with('success','Confirmation link send to '. $input['email']);
 	}
 	public function activation($token)
 	{
 		$data = $this->frontUser->avtivation($token);

		if (is_null($data)) {
			return redirect()->route('user.login')->with('error','This Link is Expired.');
		}
     
       	$datas = $this->frontUser->tokenUpdate($data->id); 
       	return redirect()->route('user.login')->with('success','Your Account is Active.');
 	}

    public function profile($id) {
        $uid    = explode('-',$id);
        if(isset($uid[1])){
           $user_id = user_uniqueid_data($uid[1])->user_id;           
            if($user_id == $id){
                $data   = $this->frontUser->profileFetch($uid[1]);
            }else{
                \App::abort(404,'Sorry, Page Not Found !!!');                
            }
        }else{
            \App::abort(404,'Sorry, Page Not Found !!!');
        }
        if(is_null($data))
            \App::abort(404,'Sorry, Page Not Found !!!');

        $skills      = $this->skills->skillsGet();
        $userskill   = $this->userskills->getData($data->id);
        $userkill    = unserialize($userskill['skills']);
        $exe         = $this->experince->getData($data->id);
        if(!empty($userkill)){
            $user_skills = $this->skills->skillGetWithName($userkill);
        }
        $education  = $this->education->getData($data->id);

        $input['sender_id'] = chackeAuthUser();
        $input['reciver_id'] = $data->id;

        $status = $this->request->checkRequest($input);
        $connect = $this->notification->countReq();
        $recConn = $this->notification->RecConec();

        return view('theme.user.profile',compact('data','skills','user_skills','userkill','exe','education','status','connect','recConn'));
    }

    public function profileUpdate(Request $request,$id)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'firstname' => 'required',
            'lastname'  => 'required',
            'country'   => 'required',
            'state'     => 'required',
            'birthdate' => 'required',
            'city'      => 'required',
            'postalcode'=> 'required',
            'address'   => 'required',
            'cellphone' => 'required',
            'website'   => 'url|nullable',
        ]);

        if ($validator->passes()) {
            $this->frontUser->updateProfile($id,$input);
            notificationMsg('success',$this->operationMsg('update','Profile'));
            return response()->json(['success' => 'Your Profile is Updated.']);
        }
        return response()->json(array('error'=>$validator->errors()->all()));
    }

    public function userSkills(Request $request)
    {
        $input = $request->all();


        $data['user_id'] = chackeAuthUser();

        if (empty($request->skills)) {
            Userskills::where('user_id',$data['user_id'])->delete();
            notificationMsg('success',$this->operationMsg('custom','Your Skills is Remove.'));
            return response()->json(['success' => 'Your Skills is Remove.']);
        }

        $data['skills']  = serialize($input['skills']);
        $datackeck = Userskills::where('user_id',$data['user_id'])->first();

        if (!empty($datackeck)) {
            Userskills::where('user_id',$data['user_id'])->delete();
            $this->userskills->createData($data);    
            notificationMsg('success',$this->operationMsg('custom','Your Skills is Updated.'));
            return response()->json(['success' => 'Your Skills is Updated.']);
         }else{
            $this->userskills->createData($data);
            notificationMsg('success',$this->operationMsg('custom','Your Skills is Created.'));
            return response()->json(['success' => 'Your Skills is Created.']);
         }
        return response()->json(array('error'=>'Skill is Not Required'));
    }

    public function skillsRemove($id)
    {

        $uid    = chackeAuthUser();
        $data   = Userskills::where('user_id',$uid)->first();
        $sdatas = unserialize($data['skills']);

        if (count($sdatas) == 1) {
            Userskills::where('user_id',$uid)->delete();          
            notificationMsg('success',$this->operationMsg('custom','Your Skills is Removed.'));
            return redirect()->back();  
        }

        if (in_array($id,$sdatas)) {
            $key = array_search($id,$sdatas);        
            unset($sdatas[$key]);

            Userskills::where('user_id',$uid)->delete();
            $datas['user_id'] = $uid; 
            $datas['skills']  = serialize($sdatas);
            $this->userskills->createData($datas);   

            notificationMsg('success',$this->operationMsg('custom','Your Skills is Removed.'));
            return redirect()->back();
        }
    }

    public function experince(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'title'       => 'required',
            'company'     => 'required',
            'location'    => 'required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {

            $input['user_id'] = chackeAuthUser();
            $input['from']    = $input['fmonth'].'-'.$input['fyear'];
            if (! isset($input['cur'])) {
                $input['to']      = $input['tmonth'].'-'.$input['tyear'];
            }
            $this->experince->createData($input);
            notificationMsg('success',$this->operationMsg('custom','Your Experince is Created.'));
        }
        return response()->json(array('error'=>$validator->errors()->all()));
    }

    public function experinceUpdate(Request $request,$id)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'title'       => 'required',
            'company'     => 'required',
            'location'    => 'required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {
            $input['from']   = $input['fmonth'].'-'.$input['fyear'];
            if (! isset($input['cur'])) {
                $input['to'] = $input['tmonth'].'-'.$input['tyear'];
            }
            $this->experince->updateData($id,$input);
            notificationMsg('success',$this->operationMsg('custom','Your Experince is Updated.'));
        }
        return response()->json(array('error'=>$validator->errors()->all()));
    }

    public function education(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'school'        => 'required',
            'course'        => 'required',
            'field'         => 'required',
            'grade'         => 'required',
            'from'          => 'required',
            'to'            => 'required',
        ]);

        if ($validator->passes()) { 
            $input['user_id'] = chackeAuthUser();
            $this->education->createData($input);
            notificationMsg('success',$this->operationMsg('custom','Your Education is Created.'));
        }
       return response()->json(array('error'=>$validator->errors()->all()));
    }

    public function eduUpdate(Request $request,$id)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'school'        => 'required',
            'course'        => 'required',
            'field'         => 'required',
            'grade'         => 'required',
            'from'          => 'required',
            'to'            => 'required',
        ]);

        if ($validator->passes()) { 
            $this->education->UpdateData($input,$id);
            notificationMsg('success',$this->operationMsg('custom','Your Education is Updated.'));
        }
       return response()->json(array('error'=>$validator->errors()->all()));
    }
    public function experinceDelete($id)
    {
        Experince::where('id',$id)->delete();
        notificationMsg('success',$this->operationMsg('custom','Your Experience is Deleted.'));
        return redirect()->back();
    }
    public function educationDelete($id)
    {       
        Education::where('id',$id)->delete();
        notificationMsg('success',$this->operationMsg('custom','Your Education is Deleted.'));
        return redirect()->back();
    }

    public function formOpen()
    {
        if(auth()->guard('frontuser')->user()->profile_status == 'Pending'){
            return view('theme.profile.form');
        }else{
            return redirect()->route('feeds');
        }
    }

    public function fillUser(Request $request,$slug)
    {   
        $input = $request->all();
        if($slug == 'location'){
            $this->validate($request,[
                'country'       =>  'required',
                'state'         =>  'required',
                'city'          =>  'required',
                'postalcode'    =>  'required',
            ]);

            $this->frontUser->UpdatedataPro(chackeAuthUser(),$input);
            return redirect()->route('profile.fill','details');
        }else{
            $this->validate($request,[
                'birthdate'       =>  'required',
            ]);
            $this->frontUser->UpdatedataPro(chackeAuthUser(),$input);
            Frontuser::where('id',chackeAuthUser())->update(['profile_status' => 'Completed']);
            notificationMsg('success',$this->operationMsg('custom','Your Profile is Updated.'));
            return redirect()->route('feeds');
        }
    }

    public function profile_cover(Request $request,$slug)
    {   
        $input = $request->all();
        $data  = Frontuser::where('id',chackeAuthUser())->first();

        if($slug == 'CoverImage'){
            if (isset($data['cover_pic']) && ! is_null($data['cover_pic'])) {
                image_delete($data->cover_pic);
            }

            $image_name = uploadCustomeImage($request->cover_image,'user/cover','cover','crop',750,260);
            Frontuser::where('id',chackeAuthUser())->update(['cover_pic' => $image_name]);
            return response()->json('cover');
        }else{
            if (isset($data['profile_pic']) && ! is_null($data['profile_pic'])) {
                image_delete($data->profile_pic);
            }

            $image_name = uploadCustomeImage($request->profile_image,'user/profile','profile','crop',150,150);
            Frontuser::where('id',chackeAuthUser())->update(['profile_pic' => $image_name]);
            return response()->json('profile');
        }
    }

    public function contact()
    {
        $settings = $this->settings->getSettings();
        return view('theme.pages.contact',compact('settings'));
    }

    public function contact_post(Request $request)
    {
        $input = $request->all();

            $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
            
        $user_id = (auth()->guard('frontuser')->check()?auth()->guard('frontuser')->user()->id:'0');
        $input['user_id'] = $user_id;

        $message    = $input['message'];
        $mail       = $input['email'];
        $name       = $input['name'];
        $subject    = $input['subject'];
        
        //dd($mail, $name);

        Mail::send('pages.contact-mail',['userdata'=>$input],function($message) use ($mail,$subject,$name)
        {
            $message->from(frommail());
            $message->to(frommail());
            $message->subject($subject);
        });

        $this->contact->createData($input);
        return redirect()->back()->with('success','Message send Successfully.');
    }

    public function memberprofile($gid,$id) {
        
        $groupid=$gid;
        $uid    = explode('-',$id);
        $user_id=user_data($uid[1])->id;
        if(isset($uid[1])){
           $user_id = user_uniqueid_data($uid[1])->user_id;           
            if($user_id == $id){
                $data   = $this->frontUser->profileFetch($uid[1]);
            }else{
                \App::abort(404,'Sorry, Page Not Found !!!');                
            }
        }else{
            \App::abort(404,'Sorry, Page Not Found !!!');
        }
        if(is_null($data))
            \App::abort(404,'Sorry, Page Not Found !!!');

        $skills      = $this->skills->skillsGet();
        $userskill   = $this->userskills->getData($data->id);
        $userkill    = unserialize($userskill['skills']);
        $exe         = $this->experince->getData($data->id);
        if(!empty($userkill)){
            $user_skills = $this->skills->skillGetWithName($userkill);
        }
        $education  = $this->education->getData($data->id);

        $input['sender_id'] = chackeAuthUser();
        $input['reciver_id'] = $data->id;

        $status = $this->request->checkRequest($input);
        $connect = $this->notification->countReq();
        $recConn = $this->notification->RecConec();

        return view('theme.user.memberprofile',compact('data','skills','user_skills','userkill','exe','education','status','connect','recConn'));
    }
    

    
}

