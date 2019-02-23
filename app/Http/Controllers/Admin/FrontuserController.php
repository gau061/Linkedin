<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Frontuser;
use App\Education;
use App\Userskills;
use App\Skill;
use App\Experince;
use App\PostFeed;

class FrontuserController extends AdminController
{
    public function __construct()
    {
    	parent::__construct();
    	$this->frontuser = new Frontuser;
    	$this->education = new Education;
    	$this->userskills = new Userskills;
    	$this->skills = new Skill;
        $this->experince = new Experince;
    	$this->postfeed = new PostFeed;
    }
    public function index()
    {	
    	$data = $this->frontuser->fetchData();
    	return view('Admin.frontuser.index',compact('data'));
    }
    public function show($id)
    {
    	$data = $this->frontuser->findData($id);
    	$educ = $this->education->getData($id);
    	$skills = $this->userskills->getData($id);
    	$userkill    = unserialize($skills['skills']);
    	if(!empty($userkill)){
            $skill = $this->skills->skillGetWithName($userkill);
        }
        $postcount = $this->postfeed->userPostFeedCount($id);        
        $experince = $this->experince->getData($id);
    	return view('Admin.frontuser.view',compact('data','educ','skill','experince','postcount'));
    }
    public function change_status($id,$sid)
    {
        $data = Frontuser::where('id',$id)->update(['status'=>$sid]);
    	return redirect()->back();
    }

    public function delete($id)
    {
        $data = Frontuser::where('id',$id)->first();
            image_delete($data->profile_pic);
        $data->delete();
        return redirect()->back()->with('success','User delete successfully.');
    }
}
